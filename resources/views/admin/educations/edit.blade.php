<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pendidikan - Portfolio Febi</title>
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
    <h1>Edit Pendidikan</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p class="error">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('admin.educations.update', $education->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <label>Nama Sekolah / Universitas</label>
        <input type="text" name="school_name"
            value="{{ old('school_name', $education->school_name) }}" required>

        <label>Jenjang Pendidikan</label>
        <input type="text" name="degree"
            value="{{ old('degree', $education->degree) }}" required>

        <label>Jurusan</label>
        <input type="text" name="major"
            value="{{ old('major', $education->major) }}">

        <label>Tahun Mulai</label>
        <input type="number" name="start_year"
            value="{{ old('start_year', $education->start_year) }}" required>

        <label>Tahun Selesai</label>
        <input type="number" name="end_year"
            value="{{ old('end_year', $education->end_year) }}">

        <label>Deskripsi</label>
        <textarea name="description">{{ old('description', $education->description) }}</textarea>

        <br><br>
        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('admin.educations.index') }}">Batal</a>
    </form>
</div>

</body>
</html>
