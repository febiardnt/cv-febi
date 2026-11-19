<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Keahlian - Portfolio Febi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            padding: 30px;
            color: #1e293b;
        }
        .card {
            max-width: 600px;
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
        input {
            width: 100%;
            box-sizing: border-box;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
        }
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

    <h1>Edit Keahlian</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p class="error">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('admin.skills.update', $skill->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <label>Nama Keahlian</label>
        <input type="text" name="skill_name"
            value="{{ old('skill_name', $skill->skill_name) }}" required>

        <label>Tingkat Penguasaan (0–100%)</label>
        <input type="number" name="proficiency"
            value="{{ old('proficiency', $skill->proficiency) }}"
            min="0" max="100" required>

        <br><br>
        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('admin.skills.index') }}">Batal</a>
    </form>

</div>
</body>
</html>
