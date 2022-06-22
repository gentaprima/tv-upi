<?php

namespace App\Http\Controllers;

use App\Models\ModelKategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function getBanner(){
        return view('data_banner');
    }

    public function getKategoriBerita(){
        $data['dataBerita'] = ModelKategoriBerita::all();
        return view('data_kategori_berita', $data);
    }   

    public function getBerita(){
        $dataBerita = DB::table('tbl_berita')
                        ->leftJoin('tbl_kategori_berita','tbl_berita.id_kategori','=','tbl_kategori_berita.id')
                        ->get();

        $data['dataBerita'] = $dataBerita;
        $data['dataKategoriBerita'] = ModelKategoriBerita::all();
        return view('data_berita',$data);
    }

    public function test(){
        $array1 = [
            [
                'id'    => 1,
                'judul' => "judul 1",
                "like"  => false
            ],
            [
                'id'    => 2,
                'judul' => "judul 2",
                "like"  => false
            ],
        ];

        $array2 = [
            [
                'id'    => 1,
                'judul' => "judul 1",
                'like'  => true
            ]
        ];

        echo json_encode(array_replace_recursive($array1,$array2));



    }
}
