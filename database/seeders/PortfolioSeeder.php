<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Education;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // Data profil pribadi
        $profile = Profile::firstOrCreate(
            ['nim' => '2430521005'],
            [
                'nama' => 'Febi Ardianti Sodikin',
                'program_studi' => 'Teknik Informatika',
                'universitas' => 'Universitas Muhammadiyah Sukabumi',
                'tentang_saya' => 'Mahasiswa Teknik Informatika yang memiliki minat dalam bidang teknologi informasi dan pengembangan web.',
            ]
        );

        // Riwayat pendidikan SMA
        Education::firstOrCreate(
            [
                'profile_id' => $profile->id,
                'school_name' => 'SMAN 1 Palabuhanratu',
            ],
            [
                'degree' => 'SMA',
                'major' => 'IPA',
                'end_year' => 2023,
            ]
        );

        // Riwayat pendidikan perguruan tinggi
        Education::firstOrCreate(
            [
                'profile_id' => $profile->id,
                'school_name' => 'Universitas Muhammadiyah Sukabumi',
            ],
            [
                'degree' => 'S1',
                'major' => 'Teknik Informatika',
            ]
        );
    }
}
