<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            padding: 25px;
            color: #1e293b;
        }

        .container {
            max-width: 750px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h2 {
            color: #172554;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin: 15px 0 7px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 15px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        button, .back {
            display: inline-block;
            padding: 12px 18px;
            border: none;
            border-radius: 7px;
            margin-top: 20px;
            text-decoration: none;
            cursor: pointer;
            font-size: 15px;
        }

        button {
            background: #2563eb;
            color: white;
        }

        .back {
            background: #e2e8f0;
            color: #1e293b;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .photo {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 10px 0;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Edit Profil Saya</h2>

    @if($errors->any())
        <div class="error">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <label>Nama Lengkap</label>
        <input type="text" name="nama"
               value="{{ old('nama', $profile->nama) }}" required>

        <label>NIM</label>
        <input type="text" name="nim"
               value="{{ old('nim', $profile->nim) }}" required>

        <label>Program Studi</label>
        <input type="text" name="program_studi"
               value="{{ old('program_studi', $profile->program_studi) }}">

        <label>Universitas</label>
        <input type="text" name="universitas"
               value="{{ old('universitas', $profile->universitas) }}">

        <label>Email</label>
        <input type="email" name="email"
               value="{{ old('email', $profile->email) }}">

        <label>Nomor Telepon</label>
        <input type="text" name="telepon"
               value="{{ old('telepon', $profile->telepon) }}">

        <label>Alamat</label>
        <textarea name="alamat">{{ old('alamat', $profile->alamat) }}</textarea>

        <label>Tentang Saya</label>
        <textarea name="tentang_saya">{{ old('tentang_saya', $profile->tentang_saya) }}</textarea>

        <label>Foto Profil</label>

        @if($profile->foto)
            <img class="photo"
                 src="{{ asset('storage/' . $profile->foto) }}"
                 alt="Foto Profil">
        @endif

        <input type="file" name="foto" accept="image/*">

        <button type="submit">Simpan Perubahan</button>

        <a href="{{ route('admin.index') }}" class="back">
            Kembali
        </a>

    </form>

</div>

</body>
</html>
