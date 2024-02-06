<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin')->insert(
            [
                'nama'         => 'Rico Aritonang',
                'jabatan'      => 'Admin Gudang',
                'created_at'    => date("Y-m-d H:i:s")
            ]);
    }
}
