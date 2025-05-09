<?php

namespace Database\Seeders;

use App\Models\NilaiKetos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NilaiKetosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nilaiData = [
            1 => [75, 80, 70, 79],
            2 => [80, 85, 72, 85],
            3 => [60, 70, 75, 80]
        ];

        foreach ($nilaiData as $id_ketos => $nilaiKriteria) {
            foreach ($nilaiKriteria as $id_kriteria => $skor) {
                // ID kriteria dimulai dari 1 (C1=1, C2=2, C3=3, C4=4)
                NilaiKetos::create([
                    'id_ketos' => $id_ketos,
                    'id_kriteria' => $id_kriteria + 1, // +1 karena array dimulai dari 0
                    'skor' => $skor
                ]);
            }
        }

        $this->command->info('Data nilai ketua OSIS berhasil ditambahkan!');

    }
}
