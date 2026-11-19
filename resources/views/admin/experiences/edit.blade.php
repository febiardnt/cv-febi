<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengalaman - Portfolio Febi</title>
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
        .check { display: flex; align-items: center; gap: 8px; }
        .check input { width: auto; }
    </style>
</head>
<body>
<div class="card">

    <h1>Edit Pengalaman</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p class="error">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('admin.experiences.update', $experience->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <label>Nama Perusahaan / Tempat Kerja</label>
        <input type="text" name="company_name"
            value="{{ old('company_name', $experience->company_name) }}" required>

        <label>Posisi / Jabatan</label>
        <input type="text" name="position"
            value="{{ old('position', $experience->position) }}" required>

        <label>Lokasi</label>
        <input type="text" name="location"
            value="{{ old('location', $experience->location) }}">

        <label>Tanggal Mulai</label>
        <input type="date" name="start_date"
            value="{{ old('start_date', $experience->start_date?->format('Y-m-d')) }}">

        <label>Tanggal Selesai</label>
        <input type="date" name="end_date"
            value="{{ old('end_date', $experience->end_date?->format('Y-m-d')) }}">

        <label class="check">
            <input type="checkbox" name="is_current" value="1"
                {{ old('is_current', $experience->is_current) ? 'checked' : '' }}>
            Masih bekerja di tempat ini
        </label>

        <label>Deskripsi Pengalaman</label>
        <textarea name="description">{{ old('description', $experience->description) }}</textarea>

        <br><br>
        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('admin.experiences.index') }}">Batal</a>
    </form>

</div>
</body>
</html>
