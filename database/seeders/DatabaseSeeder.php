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
            [
                'id'    => 8,
                'nama_kategori' => "Siaran Ulang"
            ],
        ];

        DB::table('tbl_kategori_video')->insert($dataKategoriVideo);
      
        DB::table('tbl_users')->insert([
            'email' => "admin@gmail.com",
            'nama_lengkap' => "Admin",
            'password' => Hash::make('admin'),
            'role' => 1,
        ]);

        $dataSiaran = [
            [
                'nama_siaran'   => "Religius",
                'waktu_mulai'   => "08:00",
                'waktu_selesai'  => "08:29",
                'hari'          => "senin"
            ],
            [
                'nama_siaran'   => "Religius",
                'waktu_mulai'   => "08:00",
                'waktu_selesai'  => "08:29",
                'hari'          => "selasa"
            ],
            [
                'nama_siaran'   => "Religius",
                'waktu_mulai'   => "08:00",
                'waktu_selesai'  => "08:29",
                'hari'          => "rabu"
            ],
            [
                'nama_siaran'   => "Religius",
                'waktu_mulai'   => "08:00",
                'waktu_selesai'  => "08:29",
                'hari'          => "kamis"
            ],
            [
                'nama_siaran'   => "Religius",
                'waktu_mulai'   => "08:00",
                'waktu_selesai'  => "08:29",
                'hari'          => "jumat"
            ],
            [
                'nama_siaran'   => "Religius",
                'waktu_mulai'   => "08:00",
                'waktu_selesai'  => "08:29",
                'hari'          => "sabtu"
            ],
            [
                'nama_siaran'   => "Religius",
                'waktu_mulai'   => "08:00",
                'waktu_selesai'  => "08:29",
                'hari'          => "minggu"
            ],
            [
                'nama_siaran'   => "Religius",
                'waktu_mulai'   => "08:29",
                'waktu_selesai'  => "08:56",
                'hari'          => "senin"
            ]

        ];

        DB::table('tbl_jadwal_siaran')->insert($dataSiaran);

        $dataAds = [
            [
                "image" => "default_ads.png",
                "urutan" => 1,
                "position"  => 1,
                "is_active" => 1,
                "jenis" => "beranda",
                "is_default"  => 1
            ],
            [
                "image" => "default_ads.png",
                "urutan" => 1,
                "position"  => 2,
                "is_active" => 1,
                "jenis" => "beranda",
                "is_default"  => 1
            ],
            [
                "image" => "default_ads.png",
                "urutan" => 1,
                "position"  => 3,
                "is_active" => 1,
                "jenis" => "beranda",
                "is_default"  => 1
            ],
            [
                "image" => "default_ads.png",
                "urutan" => 1,
                "is_active" => 1,
                "jenis" => "live",
                "is_default"  => 1,
                "position"  => null,
            ],
            [
                "image" => "default_ads.png",
                "urutan" => 1,
                "is_active" => 1,
                "jenis" => "berita",
                "is_default"  => 1,
                "position"  => null,
            ],
            [
                "image" => "default_ads.png",
                "urutan" => 1,
                "is_active" => 1,
                "jenis" => "detail-video",
                "is_default"  => 1,
                "position"  => null,
            ],
            [
                "image" => "default_ads.png",
                "urutan" => 1,
                "is_active" => 1,
                "jenis" => "detail-berita",
                "is_default"  => 1,
                "position"  => null,
            ],
            
        ];

        DB::table('tbl_ads')->insert($dataAds);
    }
}
