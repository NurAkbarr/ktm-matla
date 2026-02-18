<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup database to storage/app/backups';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = "backup-" . date('Y-m-d-H-i-s') . ".sql";
        $path = storage_path('app/backups');

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $filePath = $path . "/" . $filename;

        // Ambil konfigurasi database dari .env
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');
        $host = env('DB_HOST');

        // Command mysqldump (pastikan mysqldump ada di PATH environment variable Windows/Server)
        // Jika pakai password
        if ($password) {
            $command = "mysqldump --user={$username} --password={$password} --host={$host} {$database} > {$filePath}";
        } else {
            $command = "mysqldump --user={$username} --host={$host} {$database} > {$filePath}";
        }

        $this->info("Starting backup: {$filename}...");

        $output = null;
        $resultCode = null;
        exec($command, $output, $resultCode);

        if ($resultCode === 0) {
            $this->info("Backup successful! Saved to: {$filePath}");

            // Cleanup: Hapus backup lama, sisakan 7 terakhir
            $files = glob($path . "/*.sql");
            if (count($files) > 7) {
                // Urutkan berdasarkan waktu modifikasi (terlama di awal)
                array_multisort(array_map('filemtime', $files), SORT_ASC, $files);

                // Hapus file berlebih
                $filesToDelete = array_slice($files, 0, count($files) - 7);
                foreach ($filesToDelete as $file) {
                    unlink($file);
                    $this->info("Deleted old backup: " . basename($file));
                }
            }
        } else {
            $this->error("Backup failed! Return code: {$resultCode}");
            // Coba debug path mysqldump jika di XAMPP Windows
            $this->warn("Note: Ensure 'mysqldump' is in your System PATH or specify full path in command.");
        }
    }
}
