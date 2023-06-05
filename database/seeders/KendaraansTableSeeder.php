<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kendaraan;

class KendaraansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'tahun_keluaran' => '2018-09-04',
                'warna' => 'Biru',
                'harga' => 80000000,
                'mesin' => 'Mesin 1',
                'kapasitas_penumpang' => '6',
                'tipe' => 'AT'
            ],
            [
                'tahun_keluaran' => '2018-09-04',
                'warna' => 'Merah',
                'harga' => 75000000,
                'mesin' => 'Mesin 2',
                'kapasitas_penumpang' => '6',
                'tipe' => 'Manual'
            ],
            [
                'tahun_keluaran' => '2019-10-04',
                'warna' => 'Biru',
                'harga' => 60000000,
                'mesin' => 'Mesin 1.5',
                'tipe_suspensi' => 'suspensi 1',
                'tipe_transmisi' => 'Matic'
            ],
            [
                'tahun_keluaran' => '2019-10-04',
                'warna' => 'Merah',
                'harga' => 65000000,
                'mesin' => 'Mesin 2',
                'tipe_suspensi' => 'suspensi 2',
                'tipe_transmisi' => 'Sport'
            ],
        ];

        // Insert the data into the "kendaraan" table
        Kendaraan::insert($data);
    }
}
