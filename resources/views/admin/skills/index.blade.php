<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Keahlian - Portfolio Febi</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            margin: 0;
            padding: 30px;
        }
        .container { max-width: 950px; margin: auto; }
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
        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
        }
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
        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 7px;
            margin-top: 15px;
        }
        .error { color: #dc2626; }
        table { width: 100%; border-collapse: collapse; }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }
        th { background: #f8fafc; }
        .actions { display: flex; gap: 7px; align-items: center; }
        .progress {
            background: #e2e8f0;
            height: 9px;
            border-radius: 20px;
            overflow: hidden;
            min-width: 100px;
        }
        .bar {
            height: 100%;
            background: #2563eb;
            border-radius: 20px;
        }
        @media(max-width: 700px) {
            body { padding: 12px; }
            .card { overflow-x: auto; padding: 16px; }
            table { min-width: 600px; }
        }
    </style>
</head>
<body>
<div class="container">

    <h1>Kelola Keahlian</h1>
    <p>Halo, {{ $profile->nama }}. Kelola kemampuan dan keahlian di sini.</p>

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
        <h2>Tambah Keahlian</h2>

        <form action="{{ route('admin.skills.store') }}" method="POST">
            @csrf

            <label>Nama Keahlian</label>
            <input type="text" name="skill_name"
                value="{{ old('skill_name') }}"
                placeholder="Contoh: HTML, CSS, PHP, Laravel" required>

            <label>Tingkat Penguasaan (0–100%)</label>
            <input type="number" name="proficiency"
                value="{{ old('proficiency', 50) }}"
                min="0" max="100" required>

            <br><br>
            <button type="submit" class="primary">Simpan Keahlian</button>
        </form>
    </div>

    <div class="card">
        <h2>Daftar Keahlian</h2>

        <table>
            <thead>
                <tr>
                    <th>Nama Keahlian</th>
                    <th>Penguasaan</th>
                    <th>Persentase</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skills as $skill)
                    <tr>
                        <td>{{ $skill->skill_name }}</td>
                        <td>
                            <div class="progress">
                                <div class="bar"
                                     style="width: {{ $skill->proficiency }}%">
                                </div>
                            </div>
                        </td>
                        <td>{{ $skill->proficiency }}%</td>
                        <td>
                            <div class="actions">
                                <a class="btn edit"
                                   href="{{ route('admin.skills.edit', $skill->id) }}">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.skills.destroy', $skill->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus keahlian ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada data keahlian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
