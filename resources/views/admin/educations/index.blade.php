<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pendidikan - Portfolio Febi</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 30px;
            color: #1e293b;
        }
        .container {
            max-width: 1000px;
            margin: auto;
        }
        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 3px 12px #0000000d;
        }
        h1, h2 { margin-top: 0; }
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
            font-size: 14px;
        }
        .primary { background: #2563eb; }
        .secondary { background: #475569; }
        .edit { background: #d97706; }
        .delete { background: #dc2626; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
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
            margin-bottom: 15px;
        }
        .error { color: #dc2626; font-size: 14px; }
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

    <h1>Kelola Riwayat Pendidikan</h1>
    <p>Halo, {{ $profile->nama }}. Kelola data pendidikan CV di sini.</p>

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
        <h2>Tambah Pendidikan</h2>

        <form action="{{ route('admin.educations.store') }}" method="POST">
            @csrf

            <label>Nama Sekolah / Universitas</label>
            <input type="text" name="school_name"
                value="{{ old('school_name') }}"
                placeholder="Contoh: SMAN 1 Palabuhanratu" required>

            <label>Jenjang Pendidikan</label>
            <input type="text" name="degree"
                value="{{ old('degree') }}"
                placeholder="Contoh: SMA atau S1" required>

            <label>Jurusan</label>
            <input type="text" name="major"
                value="{{ old('major') }}"
                placeholder="Contoh: IPA atau Teknik Informatika">

            <label>Tahun Mulai</label>
            <input type="number" name="start_year"
                value="{{ old('start_year') }}"
                placeholder="Contoh: 2020" required>

            <label>Tahun Selesai</label>
            <input type="number" name="end_year"
                value="{{ old('end_year') }}"
                placeholder="Contoh: 2023 (kosongkan jika masih berlangsung)">

            <label>Deskripsi</label>
            <textarea name="description"
                placeholder="Keterangan pendidikan">{{ old('description') }}</textarea>

            <br><br>
            <button type="submit" class="primary">Simpan Pendidikan</button>
        </form>
    </div>

    <div class="card">
        <h2>Daftar Pendidikan</h2>

        <table>
            <thead>
                <tr>
                    <th>Nama Institusi</th>
                    <th>Jenjang</th>
                    <th>Jurusan</th>
                    <th>Periode</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($educations as $education)
                    <tr>
                        <td>{{ $education->school_name }}</td>
                        <td>{{ $education->degree }}</td>
                        <td>{{ $education->major ?? '-' }}</td>
                        <td>
                            {{ $education->start_year }} -
                            {{ $education->end_year ?? 'Sekarang' }}
                        </td>
                        <td>
                            <div class="actions">
                                <a class="btn edit"
                                   href="{{ route('admin.educations.edit', $education->id) }}">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.educations.destroy', $education->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pendidikan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada data pendidikan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
