<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\ProfilController;
use App\Http\Controllers\Mahasiswa\SkillController;
use App\Http\Controllers\Mahasiswa\PortofolioController;
use App\Models\Mahasiswa;

/*
|--------------------------------------------------------------------------
| ROOT DOMAIN
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/ktm/login');
});

/*
|--------------------------------------------------------------------------
| KTM SYSTEM
|--------------------------------------------------------------------------
*/
Route::prefix('ktm')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | AUTH (Laravel Breeze)
    |--------------------------------------------------------------------------
    */
    require __DIR__ . '/auth.php';

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD DEFAULT (BREEZE)
    |--------------------------------------------------------------------------
    | Tetap diperlukan karena Breeze redirect ke route bernama "dashboard"
    */
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect('/ktm/mahasiswa/dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | QR PUBLIK – PROFIL MAHASISWA (READ ONLY)
    |--------------------------------------------------------------------------
    */
    Route::get('/p/{token}', function ($token) {
        $mahasiswa = Mahasiswa::where('qr_token', $token)
            ->with(['profil', 'skills', 'portofolio'])
            ->firstOrFail();

        return view('ktm.show', compact('mahasiswa'));
    })->middleware('throttle:60,1');

    /*
    |--------------------------------------------------------------------------
    | PROFILE (BREEZE)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN (TERKUNCI)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth', 'admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            // Dashboard Admin
            Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

            // Export & Print
            Route::get('mahasiswa/export', [MahasiswaController::class, 'exportCsv'])->name('mahasiswa.export');
            Route::get('mahasiswa/print', [MahasiswaController::class, 'print'])->name('mahasiswa.print');
            Route::post('mahasiswa/bulk-print', [MahasiswaController::class, 'bulkPrint'])->name('mahasiswa.bulkPrint');

            // Import
            Route::get('mahasiswa/import', [ImportController::class, 'create'])->name('mahasiswa.import');
            Route::post('mahasiswa/import', [ImportController::class, 'store'])->name('mahasiswa.import.store');

            // CRUD Mahasiswa
            Route::resource('mahasiswa', MahasiswaController::class);

            Route::get('mahasiswa/{id}/qr', [MahasiswaController::class, 'qr'])
                ->name('mahasiswa.qr');

            Route::patch('mahasiswa/{id}/toggle-status', [MahasiswaController::class, 'toggleStatus'])
                ->name('mahasiswa.toggleStatus');

            Route::get(
                'mahasiswa/{id}/download-qr',
                [MahasiswaController::class, 'downloadQr']
            )->name('mahasiswa.downloadQr');
        });

    /*
    |--------------------------------------------------------------------------
    | MAHASISWA (LOGIN ONLY)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')
        ->prefix('mahasiswa')
        ->group(function () {

            // Dashboard Mahasiswa
            Route::get('/dashboard', [DashboardController::class, 'index']);

            // Profil
            Route::get('/profil', [ProfilController::class, 'edit']);
            Route::post('/profil', [ProfilController::class, 'update']);

            // Skill
            Route::get('/skill', [SkillController::class, 'index']);
            Route::post('/skill', [SkillController::class, 'store']);
            Route::delete('/skill/{id}', [SkillController::class, 'destroy']);

            // Portofolio
            Route::get('/portofolio', [PortofolioController::class, 'index']);
            Route::post('/portofolio', [PortofolioController::class, 'store']);
            Route::delete('/portofolio/{id}', [PortofolioController::class, 'destroy']);
        });
});
