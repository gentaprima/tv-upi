<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $dataBanner = [
            [
                "judul" => "test 1",
                "path_url" => "indosat.png",
                "urutan" => 1,
                "is_ads" => 0,
                "is_active" => 1,
            ],
            [
                "judul" => "test 2",
                "path_url" => "admission.jpg",
                "urutan" => 2,
                "is_ads" => 0,
                "is_active" => 1,
            ]
        ];

        DB::table('tbl_banner')->insert($dataBanner);

        $dataVideo = [
            [
                'judul' => 'test 1',
                'link'  => 'L6mQuFiVmx4',
                'is_active' => 1,
                'count' => 1,
                'jenis' => "EDUTALK"
            ],
            [
                'judul' => 'test 1',
                'link'  => 'L6mQuFiVmx4',
                'is_active' => 1,
                'count' => 1,
                'jenis' => "EDUPRESTASI"
            ]
        ];

        DB::table('tbl_video')->insert($dataVideo);
        DB::table('tbl_users')->insert([
            'email' => "admin@gmail.com",
            'nama_lengkap' => "Admin",
            'password' => Hash::make('admin'),
        ]);
    }
}
