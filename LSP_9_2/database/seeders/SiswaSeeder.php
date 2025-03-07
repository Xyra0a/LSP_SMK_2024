<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nis' => '1224001',
                'nama_siswa' => 'Arya',
                'kelas_id' => 1,
                'password' => bcrypt('1224001'),
            ],
            [
                'nis' => '1224002',
                'nama_siswa' => 'Amelia',
                'kelas_id' => 2,
                'password' => bcrypt('1224002')
            ],
        ];

        foreach ($data as $siswa) {
            siswa::create($siswa);
        }
    }
}
