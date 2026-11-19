<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->nama ?? 'CV Portofolio' }} | Portfolio</title>

    <style>
        
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    scroll-behavior: smooth;
}

body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: #fff7fb;
    color: #51445c;
    line-height: 1.7;
}

header {
    background: linear-gradient(135deg, #f8c8dc, #d9c5f5, #fce4ec);
    color: #51405f;
    padding: 65px 20px;
    text-align: center;
}

.profile-photo {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid white;
    margin-bottom: 18px;
    box-shadow: 0 8px 20px #9875a533;
}

header h1 {
    font-size: 36px;
    margin-bottom: 8px;
}

header p {
    color: #695675;
}

.button-group {
    margin-top: 25px;
}

.btn {
    display: inline-block;
    padding: 11px 23px;
    margin: 6px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.btn-primary {
    background: #c47ca9;
    color: white;
}

.btn-secondary {
    background: white;
    color: #a66d9b;
    border: 2px solid #d9b6d5;
}

.btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 12px #9875a533;
}

nav {
    background: white;
    padding: 18px 10px;
    text-align: center;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 3px 15px #a77b9915;
}

nav a {
    color: #8d5d87;
    text-decoration: none;
    margin: 0 10px;
    font-weight: 600;
}

nav a:hover {
    color: #d66d9b;
}

.container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 0 20px;
}

section {
    background: white;
    padding: 32px;
    margin-bottom: 25px;
    border-radius: 20px;
    box-shadow: 0 5px 20px #b78eaa12;
    border: 1px solid #f7e6ef;
}

h2 {
    color: #b46c9a;
    margin-bottom: 22px;
    border-bottom: 2px solid #f4d8e7;
    padding-bottom: 10px;
    font-size: 23px;
}

.item {
    margin-bottom: 22px;
    padding: 18px;
    background: #fff8fc;
    border-left: 4px solid #d9a6c7;
    border-radius: 12px;
}

.item h3 {
    font-size: 18px;
    color: #8e6088;
    margin-bottom: 5px;
}

.item p {
    color: #776b7c;
}

.skill {
    display: inline-block;
    background: #f2e4fa;
    color: #805c9b;
    padding: 9px 17px;
    border-radius: 25px;
    margin: 6px;
    font-weight: 600;
}

.contact a {
    color: #c16c9d;
    text-decoration: none;
}

.contact a:hover {
    text-decoration: underline;
}

footer {
    text-align: center;
    padding: 28px;
    background: linear-gradient(135deg, #d9c5f5, #f5c9df);
    color: #5d496b;
}

@media (max-width: 600px) {
    header h1 {
        font-size: 27px;
    }

    nav a {
        display: inline-block;
        margin: 5px 7px;
        font-size: 13px;
    }

    section {
        padding: 22px;
    }

    .container {
        padding: 0 13px;
    }
}

            
    </style>
</head>

<body>

@if($profile)

<header>
    @if($profile->foto)
        <img class="profile-photo"
             src="{{ asset('storage/' . $profile->foto) }}"
             alt="Foto Profil">
    @endif

    <h1>{{ $profile->nama }}</h1>
    <p>{{ $profile->program_studi }}</p>
    <p>{{ $profile->universitas }}</p>
    
    <div class="button-group">
    <a href="#kontak" class="btn btn-primary">
        Hubungi Saya
    </a>

    <a href="{{ asset('storage/cv-febi.pdf') }}"
       class="btn btn-secondary"
       target="_blank">
        Download CV
    </a>
</div>

</header>

<nav>
    <a href="#tentang">Tentang</a>
    <a href="#pendidikan">Pendidikan</a>
    <a href="#pengalaman">Pengalaman</a>
    <a href="#organisasi">Organisasi</a>
    <a href="#keahlian">Keahlian</a>
    <a href="#prestasi">Prestasi</a>
    <a href="#kontak">Kontak</a>
</nav>

<div class="container">

    <section id="tentang">
        <h2>Tentang Saya</h2>
        <p>{{ $profile->tentang_saya }}</p>
        <p><strong>NIM:</strong> {{ $profile->nim }}</p>
        <p><strong>Program Studi:</strong> {{ $profile->program_studi }}</p>
    </section>

    <section id="pendidikan">
        <h2>Riwayat Pendidikan</h2>

        @forelse($profile->educations as $education)
            <div class="item">
                <h3>{{ $education->school_name }}</h3>
                <p>{{ $education->degree }} - {{ $education->major }}</p>
                <p>
                    {{ $education->start_year ?? '-' }}
                    -
                    {{ $education->end_year ?? 'Sekarang' }}
                </p>
                <p>{{ $education->description }}</p>
            </div>
        @empty
            <p>Belum ada data pendidikan.</p>
        @endforelse
    </section>

    <section id="pengalaman">
        <h2>Pengalaman Kerja</h2>

        @forelse($profile->experiences as $experience)
            <div class="item">
                <h3>{{ $experience->position }}</h3>
                <p>{{ $experience->company_name }}</p>
                <p>{{ $experience->location }}</p>
                <p>{{ $experience->description }}</p>
            </div>
        @empty
            <p>Belum ada data pengalaman kerja.</p>
        @endforelse
    </section>

    <section id="organisasi">
        <h2>Pengalaman Organisasi</h2>

        @forelse($profile->organizations as $organization)
            <div class="item">
                <h3>{{ $organization->organization_name }}</h3>
                <p>{{ $organization->position }}</p>
                <p>
                    {{ $organization->start_year ?? '-' }}
                    -
                    {{ $organization->end_year ?? 'Sekarang' }}
                </p>
                <p>{{ $organization->description }}</p>
            </div>
        @empty
            <p>Belum ada data organisasi.</p>
        @endforelse
    </section>

    <section id="keahlian">
        <h2>Keahlian</h2>

        @forelse($profile->skills as $skill)
            <span class="skill">
                {{ $skill->skill_name }}
                ({{ $skill->proficiency }}%)
            </span>
        @empty
            <p>Belum ada data keahlian.</p>
        @endforelse
    </section>

    <section id="prestasi">
        <h2>Prestasi dan Sertifikat</h2>

        @forelse($profile->achievements as $achievement)
            <div class="item">
                <h3>{{ $achievement->title }}</h3>
                <p>{{ $achievement->issuer }}</p>
                <p>{{ $achievement->date }}</p>
                <p>{{ $achievement->description }}</p>
            </div>
        @empty
            <p>Belum ada data prestasi.</p>
        @endforelse
    </section>

    <section id="kontak" class="contact">
        <h2>Informasi Kontak</h2>

        @if($profile->email)
            <p>Email: {{ $profile->email }}</p>
        @endif

        @if($profile->telepon)
            <p>Telepon: {{ $profile->telepon }}</p>
        @endif

        @if($profile->alamat)
            <p>Alamat: {{ $profile->alamat }}</p>
        @endif

        @foreach($profile->contacts as $contact)
            <p>
                {{ $contact->label }}:
                @if($contact->url)
                    <a href="{{ $contact->url }}" target="_blank">
                        {{ $contact->value }}
                    </a>
                @else
                    {{ $contact->value }}
                @endif
            </p>
        @endforeach
    </section>

</div>

@else
    <div class="container">
        <section>
            <h2>Profil belum tersedia</h2>
            <p>Silakan tambahkan data profil terlebih dahulu.</p>
        </section>
    </div>
@endif

<footer>
    <p>&copy; {{ date('Y') }} {{ $profile->nama ?? 'Portfolio' }}. All Rights Reserved.</p>
</footer>

</body>
</html>
