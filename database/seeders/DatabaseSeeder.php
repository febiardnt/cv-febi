<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'nim' => '2430521005',
                'nama' => 'Febi Ardianti Sodikin',
                'program_studi' => 'Teknik Informatika',
                'universitas' => 'Universitas Muhammadiyah Sukabumi',
                'tentang_saya' => 'Saya adalah mahasiswa Teknik Informatika Universitas Muhammadiyah Sukabumi yang tertarik pada pengembangan web dan teknologi informasi.',
                'foto' => 'foto/febi.jpg',
            ]
        );
    }
}
