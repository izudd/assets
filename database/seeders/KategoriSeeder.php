<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            'Instalasi Pengolahan Air',
            'IT Hardware/Software',
            'Jaringan Pipa',
        ];

        foreach ($kategori as $nama) {
            Kategori::firstOrCreate(['nama' => $nama]);
        }
    }
}
