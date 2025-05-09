<?php

namespace Database\Seeders;

use App\Models\Ketos;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CalonKetosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $calonData = [
            [
                'nama' => 'Risal Kasi',
                'kelas' => 'XII IPA 1',
                'jkl' => 'l',
            ],
            [
                'nama' => 'Jein Berari',
                'kelas' => 'XII IPS 2',
                'jkl' => 'p',
            ],
            [
                'nama' => 'Septina Inam',
                'kelas' => 'XI IPA 3',
                'jkl' => 'p',
            ]
        ];

        foreach ($calonData as $data) {
            Ketos::create($data);
        }

        $this->command->info('Data calon ketua OSIS berhasil ditambahkan!');
    }
}
