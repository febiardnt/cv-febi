<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Portfolio Febi</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            background: #172554;
            color: white;
            position: fixed;
            padding: 25px 18px;
        }

        .sidebar h2 {
            margin-bottom: 35px;
        }

        .sidebar a {
            display: block;
            color: #dbeafe;
            text-decoration: none;
            padding: 13px;
            border-radius: 7px;
            margin-bottom: 8px;
        }

        .sidebar a:hover {
            background: #1e40af;
            color: white;
        }

        .main {
            margin-left: 240px;
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 15px;
        }

        .topbar a {
            background: #2563eb;
            color: white;
            padding: 10px 16px;
            border-radius: 7px;
            text-decoration: none;
        }

        .welcome {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 3px 10px #00000008;
        }

        .card h3 {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
            color: #1e40af;
        }

        .panel {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 22px;
            overflow-x: auto;
        }

        .panel h2 {
            margin-bottom: 18px;
            color: #172554;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 500px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background: #eff6ff;
            color: #1e3a8a;
        }

        .empty {
            color: #64748b;
            padding: 15px 0;
        }

        @media(max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
            }

            .sidebar a {
                display: inline-block;
                margin: 3px;
            }

            .main {
                margin-left: 0;
                padding: 18px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h2>My Portfolio</h2>

    <a href="/admin">Dashboard</a>
    <a href="/">Lihat Portofolio</a>
</div>

<div class="main">

    <div class="topbar">
        <div>
            <h1>Dashboard Admin</h1>
            <p>Pengelolaan data CV dan Portofolio</p>
        </div>

        <a href="/">Lihat Website</a>
    </div>

    @if($profile)

        <div class="welcome">
            <h2>Selamat Datang, {{ $profile->nama }}</h2>
            <p>
                {{ $profile->program_studi }}
                - {{ $profile->universitas }}
            </p>
            <p>NIM: {{ $profile->nim }}</p>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Pendidikan</h3>
                <p>{{ $profile->educations->count() }}</p>
            </div>

            <div class="card">
                <h3>Pengalaman Kerja</h3>
                <p>{{ $profile->experiences->count() }}</p>
            </div>

            <div class="card">
                <h3>Organisasi</h3>
                <p>{{ $profile->organizations->count() }}</p>
            </div>

            <div class="card">
                <h3>Keahlian</h3>
                <p>{{ $profile->skills->count() }}</p>
            </div>

            <div class="card">
                <h3>Prestasi</h3>
                <p>{{ $profile->achievements->count() }}</p>
            </div>

            <div class="card">
                <h3>Kontak Tambahan</h3>
                <p>{{ $profile->contacts->count() }}</p>
            </div>
        </div>

        <div class="panel">
            <h2>Informasi Profil</h2>
            <a href="{{ route('admin.profile.edit') }}"
   style="display:inline-block;background:#2563eb;color:white;
   padding:10px 16px;border-radius:7px;text-decoration:none;
   margin-bottom:15px;">
    Edit Profil
    <a href="{{ route('admin.educations.index') }}"
   style="display:inline-block;background:#0f766e;color:white;
   padding:10px 16px;border-radius:7px;text-decoration:none;
   margin-bottom:15px;">
    Kelola Pendidikan
    <a href="{{ route('admin.experiences.index') }}"
   style="display:inline-block;background:#0f766e;color:white;
   padding:10px 16px;border-radius:7px;text-decoration:none;
   margin-bottom:15px;">
    Kelola Pengalaman
    <a href="{{ route('admin.organizations.index') }}"
   style="display:inline-block;background:#7c3aed;color:white;
   padding:10px 16px;border-radius:7px;text-decoration:none;
   margin-bottom:15px;">
    Kelola Organisasi
    <a href="{{ route('admin.skills.index') }}"
   style="display:inline-block;background:#0891b2;color:white;
   padding:10px 16px;border-radius:7px;text-decoration:none;
   margin-bottom:15px;">
    Kelola Keahlian
</a>
</a>
</a>
</a>
</a>

            <table>
                <tr>
                    <th>Nama</th>
                    <td>{{ $profile->nama }}</td>
                </tr>
                <tr>
                    <th>NIM</th>
                    <td>{{ $profile->nim }}</td>
                </tr>
                <tr>
                    <th>Program Studi</th>
                    <td>{{ $profile->program_studi }}</td>
                </tr>
                <tr>
                    <th>Universitas</th>
                    <td>{{ $profile->universitas }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $profile->email ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td>{{ $profile->telepon ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $profile->alamat ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <div class="panel">
            <h2>Riwayat Pendidikan</h2>

            @forelse($profile->educations as $education)
                <p>
                    <strong>{{ $education->school_name }}</strong>
                    — {{ $education->major }}
                    ({{ $education->start_year ?? '-' }}
                    - {{ $education->end_year ?? 'Sekarang' }})
                </p>
            @empty
                <p class="empty">Belum ada data pendidikan.</p>
            @endforelse
        </div>

        <div class="panel">
            <h2>Data Lainnya</h2>
            <p>Pengalaman kerja: {{ $profile->experiences->count() }} data</p>
            <p>Organisasi: {{ $profile->organizations->count() }} data</p>
            <p>Keahlian: {{ $profile->skills->count() }} data</p>
            <p>Prestasi: {{ $profile->achievements->count() }} data</p>
            <p>Kontak: {{ $profile->contacts->count() }} data</p>
        </div>

    @else

        <div class="panel">
            <h2>Profil belum tersedia</h2>
            <p>Silakan masukkan data profil terlebih dahulu.</p>
        </div>

    @endif

</div>

</body>
</html>
