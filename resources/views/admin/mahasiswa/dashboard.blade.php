<h2>Dashboard Mahasiswa</h2>

<p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
<p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
<p><strong>Prodi:</strong> {{ $mahasiswa->prodi }}</p>

<hr>

<h3>Profil</h3>
<p>{{ $mahasiswa->profil->tentang_saya ?? 'Belum diisi' }}</p>

<a href="#">Edit Profil</a>

<hr>

<h3>Skill</h3>
<ul>
@foreach($mahasiswa->skills as $skill)
    <li>{{ $skill->nama_skill }} ({{ $skill->level }})</li>
@endforeach
</ul>

<a href="#">Tambah Skill</a>
