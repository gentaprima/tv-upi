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
                "path_url" => "62b00b6b1dbd11655704427.png",
                "urutan" => 1,
                "is_ads" => 0,
                "is_active" => 1,
            ],
            [
                "judul" => "test 2",
                "path_url" => "62b00b6b1dbd11655704427.png",
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
                'id_kategori' => 1,
                'banner' => "62b00b6b1dbd11655704427.png"
            ],
            [
                'judul' => 'test 1',
                'link'  => 'L6mQuFiVmx4',
                'is_active' => 1,
                'count' => 1,
                'id_kategori' => 2,
                'banner' => "62b00b6b1dbd11655704427.png"
            ]
        ];

        $dataKategoriVideo = [
            [
                'id'    => 1,
                'nama_kategori' => "EDUTALK"
            ],
            [
                'id'    => 2,
                'nama_kategori' => "EDUPRESTASI"
            ],
            [
                'id'    => 3,
                'nama_kategori' => "EDUPRENEUR"
            ],
            [
                'id'    => 4,
                'nama_kategori' => "UPIRISET"
            ],
            [
                'id'    => 5,
                'nama_kategori' => "UPISIONER"
            ],
            [
                'id'    => 6,
                'nama_kategori' => "Religius"
            ],
            [
                'id'    => 7,
                'nama_kategori' => "KBRI Jepang"
            ],
        ];

        DB::table('tbl_kategori_video')->insert($dataKategoriVideo);
        DB::table('tbl_video')->insert($dataVideo);
        DB::table('tbl_users')->insert([
            'email' => "admin@gmail.com",
            'nama_lengkap' => "Admin",
            'password' => Hash::make('admin'),
            'role' => 1,
        ]);
    }
}
