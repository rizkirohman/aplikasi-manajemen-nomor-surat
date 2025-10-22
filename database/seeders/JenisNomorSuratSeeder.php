<?php

namespace Database\Seeders;

use App\Models\JenisNomorSurat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisNomorSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisNomorSurat::insert([
            [
                'jenis_nomor' => 'Surat Keluar',
            ],
            [
                'jenis_nomor' => 'Surat Keputusan',
            ],
            [
                'jenis_nomor' => 'Surat Edaran',
            ],
            [
                'jenis_nomor' => 'Nota Dinas',
            ],
            [
                'jenis_nomor' => 'Perjanjian Kerjasama',
            ],
            [
                'jenis_nomor' => 'Sertifikat',
            ],
            [
                'jenis_nomor' => 'Peraturan',
            ],
            [
                'jenis_nomor' => 'Instruksi',
            ],
            [
                'jenis_nomor' => 'Standard Operasional Prosedur',
            ],
            
        ]);
    }
}
