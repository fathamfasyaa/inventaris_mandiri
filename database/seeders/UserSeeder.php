<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tm_user')->insert([
            [
                'user_id' => 'U001',
                'user_nama' => 'Fathan',
                'user_pass' => bcrypt('fatansya18'),
                'user_hak' => 'admin', // Hak akses admin
                'user_sts' => '01', // Status aktif
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 'U002',
                'user_nama' => 'Azriel',
                'user_pass' => bcrypt('azriel18'),
                'user_hak' => 'user', // Hak akses user biasa
                'user_sts' => '01', // Status aktif
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 'U003',
                'user_nama' => 'Bagus',
                'user_pass' => bcrypt('bagus18'),
                'user_hak' => 'user', // Hak akses user biasa
                'user_sts' => '01', // Status aktif
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
