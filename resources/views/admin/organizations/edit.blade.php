<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Organisasi - Portfolio Febi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            padding: 30px;
            color: #1e293b;
        }
        .card {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }
        label {
            display: block;
            margin: 15px 0 7px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
        }
        textarea { min-height: 90px; }
        button, a {
            display: inline-block;
            padding: 10px 15px;
            border: 0;
            border-radius: 7px;
            text-decoration: none;
            color: white;
            cursor: pointer;
            background: #2563eb;
        }
        a { background: #475569; }
        .error { color: #dc2626; }
    </style>
</head>
<body>
<div class="card">

    <h1>Edit Organisasi</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p class="error">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('admin.organizations.update', $organization->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <label>Nama Organisasi</label>
        <input type="text" name="organization_name"
            value="{{ old('organization_name', $organization->organization_name) }}"
            required>

        <label>Jabatan</label>
        <input type="text" name="position"
            value="{{ old('position', $organization->position) }}">

        <label>Tahun Mulai</label>
        <input type="number" name="start_year"
            value="{{ old('start_year', $organization->start_year) }}">

        <label>Tahun Selesai</label>
        <input type="number" name="end_year"
            value="{{ old('end_year', $organization->end_year) }}">

        <label>Deskripsi</label>
        <textarea name="description">{{ old('description', $organization->description) }}</textarea>

        <br><br>
        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('admin.organizations.index') }}">Batal</a>
    </form>

</div>
</body>
</html>
