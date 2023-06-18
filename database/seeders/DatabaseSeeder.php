<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Surat::create([
            'jenis_surat' => 'ASURANSI',
        ]);

        Surat::create([
            'jenis_surat' => 'IMUNISASI',
        ]);

        Surat::create([
            'jenis_surat' => 'KELAHIRAN',
        ]);

        Surat::create([
            'jenis_surat' => 'KEMATIAN',
        ]);

         Surat::create([
            'jenis_surat' => 'LAINLAIN',
        ]);

        Surat::create([
            'jenis_surat' => 'RAWATJALAN',
        ]);

        Surat::create([
            'jenis_surat' => 'RESUMEMEDIS',
        ]);

        Surat::create([
            'jenis_surat' => 'VISUM',
        ]);
    }
}
