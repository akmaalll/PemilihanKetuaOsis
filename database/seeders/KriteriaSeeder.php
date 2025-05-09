<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteriaData = [
            [
                'kode' => 'C1',
                'kriteria' => 'Prestasi',
                'poin' => 40,
                'ket' => 'Penilaian berdasarkan prestasi akademik dan non-akademik'
            ],
            [
                'kode' => 'C2',
                'kriteria' => 'Kepemimpinan',
                'poin' => 25,
                'ket' => 'Kemampuan memimpin dan mengorganisir'
            ],
            [
                'kode' => 'C3',
                'kriteria' => 'Kehadiran',
                'poin' => 15,
                'ket' => 'Tingkat kehadiran dalam kegiatan sekolah'
            ],
            [
                'kode' => 'C4',
                'kriteria' => 'Kedisiplinan',
                'poin' => 20,
                'ket' => 'Kepatuhan terhadap peraturan sekolah'
            ]
        ];

        foreach ($kriteriaData as $data) {
            Kriteria::create($data);
        }

        $this->command->info('Data kriteria berhasil ditambahkan!');
    }
}