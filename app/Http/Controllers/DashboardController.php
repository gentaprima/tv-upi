<?php

namespace App\Http\Controllers;

use App\Models\ModelBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function getBanner(){
        $dataBanner = DB::table('tbl_banner')->get();
        $data['dataBanner'] = $dataBanner;
        return view('data_banner',$data);
    }

    public function getVideo(){
        $dataVideo = DB::table('tbl_video')
                        ->leftJoin('tbl_kategori_video','tbl_video.id_kategori','=','tbl_kategori_video.id')
                        ->get();
        $data['dataVideo'] = $dataVideo;
        $data['dataKategori'] = DB::table('tbl_kategori_video')->get();
        return view('data_video',$data);
    }

    public function getIklan($id){
        $dataAds = DB::table('tbl_ads')
                        ->where('jenis',$id)
                        ->get();
        $data['dataAds'] = $dataAds;
        $data['jenis'] = $id;
        return view('data_iklan',$data);
    }
}
