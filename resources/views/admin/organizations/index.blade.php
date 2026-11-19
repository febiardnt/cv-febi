<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Organisasi - Portfolio Febi</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            margin: 0;
            padding: 30px;
        }
        .container { max-width: 1000px; margin: auto; }
        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin: 22px 0;
            box-shadow: 0 3px 12px #0000000d;
        }
        label {
            display: block;
            margin: 14px 0 7px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
        }
        textarea { min-height: 90px; }
        button, .btn {
            display: inline-block;
            border: 0;
            padding: 10px 15px;
            border-radius: 7px;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }
        .primary { background: #2563eb; }
        .secondary { background: #475569; }
        .edit { background: #d97706; }
        .delete { background: #dc2626; }
        table { width: 100%; border-collapse: collapse; }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }
        th { background: #f8fafc; }
        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 7px;
            margin-top: 15px;
        }
        .error { color: #dc2626; }
        .actions { display: flex; gap: 7px; align-items: center; }
        @media(max-width: 700px) {
            body { padding: 12px; }
            .card { overflow-x: auto; padding: 16px; }
            table { min-width: 650px; }
        }
    </style>
</head>
<body>
<div class="container">

    <h1>Kelola Organisasi</h1>
    <p>Halo, {{ $profile->nama }}. Kelola pengalaman organisasi di sini.</p>

    <a href="{{ route('admin.index') }}" class="btn secondary">
        Kembali ke Dashboard
    </a>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="card">
            @foreach($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="card">
        <h2>Tambah Organisasi</h2>

        <form action="{{ route('admin.organizations.store') }}" method="POST">
            @csrf

            <label>Nama Organisasi</label>
            <input type="text" name="organization_name"
                value="{{ old('organization_name') }}"
                placeholder="Contoh: Paskibra" required>

            <label>Jabatan</label>
            <input type="text" name="position"
                value="{{ old('position') }}"
                placeholder="Contoh: Anggota">

            <label>Tahun Mulai</label>
            <input type="number" name="start_year"
                value="{{ old('start_year') }}"
                placeholder="Contoh: 2021">

            <label>Tahun Selesai</label>
            <input type="number" name="end_year"
                value="{{ old('end_year') }}"
                placeholder="Contoh: 2022">

            <label>Deskripsi</label>
            <textarea name="description"
                placeholder="Jelaskan kegiatan atau tanggung jawab organisasi">{{ old('description') }}</textarea>

            <br><br>
            <button type="submit" class="primary">Simpan Organisasi</button>
        </form>
    </div>

    <div class="card">
        <h2>Daftar Organisasi</h2>

        <table>
            <thead>
                <tr>
                    <th>Organisasi</th>
                    <th>Jabatan</th>
                    <th>Periode</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($organizations as $organization)
                    <tr>
                        <td>{{ $organization->organization_name }}</td>
                        <td>{{ $organization->position ?? '-' }}</td>
                        <td>
                            {{ $organization->start_year ?? '-' }}
                            -
                            {{ $organization->end_year ?? 'Sekarang' }}
                        </td>
                        <td>{{ $organization->description ?? '-' }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn edit"
                                   href="{{ route('admin.organizations.edit', $organization->id) }}">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.organizations.destroy', $organization->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus organisasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada data organisasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
