<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stok')->insert([
            [
                'nama_barang'   => 'Beras Gojo',
                'jumlah_stok'   => 42,
                'admin_id'      => 1,
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'nama_barang'   => 'Tepung Jajar Genjang',
                'jumlah_stok'   => 60,
                'admin_id'      => 1,
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'nama_barang'   => 'Minyak Rico',
                'jumlah_stok'   => 50,
                'admin_id'      => 1,
                'created_at'    => date("Y-m-d H:i:s")
            ]
        ]

        );
    }
}
