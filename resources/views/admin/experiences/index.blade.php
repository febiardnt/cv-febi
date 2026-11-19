<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengalaman - Portfolio Febi</title>
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
        .check { display: flex; align-items: center; gap: 8px; }
        .check input { width: auto; }
        @media(max-width: 700px) {
            body { padding: 12px; }
            .card { overflow-x: auto; padding: 16px; }
            table { min-width: 750px; }
        }
    </style>
</head>
<body>
<div class="container">

    <h1>Kelola Pengalaman Kerja</h1>
    <p>Halo, {{ $profile->nama }}. Kelola pengalaman kerja atau magang di sini.</p>

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
        <h2>Tambah Pengalaman</h2>

        <form action="{{ route('admin.experiences.store') }}" method="POST">
            @csrf

            <label>Nama Perusahaan / Tempat Kerja</label>
            <input type="text" name="company_name"
                value="{{ old('company_name') }}"
                placeholder="Contoh: PT Contoh Indonesia" required>

            <label>Posisi / Jabatan</label>
            <input type="text" name="position"
                value="{{ old('position') }}"
                placeholder="Contoh: Customer Service" required>

            <label>Lokasi</label>
            <input type="text" name="location"
                value="{{ old('location') }}"
                placeholder="Contoh: Sukabumi">

            <label>Tanggal Mulai</label>
            <input type="date" name="start_date"
                value="{{ old('start_date') }}">

            <label>Tanggal Selesai</label>
            <input type="date" name="end_date"
                value="{{ old('end_date') }}">

            <label class="check">
                <input type="checkbox" name="is_current" value="1"
                    {{ old('is_current') ? 'checked' : '' }}>
                Masih bekerja di tempat ini
            </label>

            <label>Deskripsi Pengalaman</label>
            <textarea name="description"
                placeholder="Jelaskan tugas atau pengalaman kerja">{{ old('description') }}</textarea>

            <br><br>
            <button type="submit" class="primary">Simpan Pengalaman</button>
        </form>
    </div>

    <div class="card">
        <h2>Daftar Pengalaman</h2>

        <table>
            <thead>
                <tr>
                    <th>Perusahaan</th>
                    <th>Posisi</th>
                    <th>Lokasi</th>
                    <th>Periode</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($experiences as $experience)
                    <tr>
                        <td>{{ $experience->company_name }}</td>
                        <td>{{ $experience->position }}</td>
                        <td>{{ $experience->location ?? '-' }}</td>
                        <td>
                            {{ $experience->start_date?->format('d-m-Y') ?? '-' }}
                            -
                            @if($experience->is_current)
                                Sekarang
                            @else
                                {{ $experience->end_date?->format('d-m-Y') ?? '-' }}
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a class="btn edit"
                                   href="{{ route('admin.experiences.edit', $experience->id) }}">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.experiences.destroy', $experience->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pengalaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada data pengalaman kerja.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
