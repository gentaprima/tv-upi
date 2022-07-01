<?php

namespace App\Http\Controllers;

use App\Models\ModelBanner;
use App\Models\ModelkategoriBerita;
use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use IXR_Client;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function getBanner()
    {
        $dataBanner = DB::table('tbl_banner')->get();
        $data['dataBanner'] = $dataBanner;
        return view('data_banner', $data);
    }

    public function getVideo()
    {
        $dataVideo = DB::table('tbl_video')
            ->select('tbl_video.*','tbl_kategori_video.nama_kategori')
            ->leftJoin('tbl_kategori_video', 'tbl_video.id_kategori', '=', 'tbl_kategori_video.id')
            ->get();
        $data['dataVideo'] = $dataVideo;
        $data['dataKategori'] = DB::table('tbl_kategori_video')->get();
        return view('data_video', $data);
    }

    public function getIklan($id)
    {
        $dataAds = DB::table('tbl_ads')
            ->where('jenis', $id)
            ->get();
        $data['dataAds'] = $dataAds;
        $data['jenis'] = $id;
        return view('data_iklan', $data);
    }

    public function getKategoriBerita()
    {
        $data['dataBerita'] = ModelkategoriBerita::all();
        return view('data_kategori_berita', $data);
    }

    public function getBerita()
    {
        $dataBerita = DB::table('tbl_berita')
            ->select('tbl_berita.*','tbl_kategori_berita.nama_kategori')
            ->leftJoin('tbl_kategori_berita', 'tbl_berita.id_kategori', '=', 'tbl_kategori_berita.id')
            ->get();

        $data['dataBerita'] = $dataBerita;
        $data['dataKategoriBerita'] = ModelKategoriBerita::all();
        return view('data_berita', $data);
    }

    public function jadwalSiaran()
    {
        $dataSiaran = DB::table('tbl_jadwal_siaran')
            ->groupBy('hari')
            ->orderBy('id')
            ->get();
        $data['dataJadwal'] = $dataSiaran;
        return view('data_jadwal_siaran', $data);
    }

    public function ubahSiaran($id)
    {
        $dataSiaran = DB::table('tbl_jadwal_siaran')
            ->where('hari', '=', $id)
            ->orderBy('waktu_mulai')
            ->get();
        $data['hari'] = $id;
        $data['siaran'] = $dataSiaran;
        return view('form_ubah_siaran', $data);
    }

    public function profile()
    {
        return view('profile');
    }

    public function dataUsers(){
        $data['dataProfile'] = ModelUsers::all()->where('role','!=',0);
        return view('data_users',$data);
    }

    public function test()
    {
        $url = "http://localhost/mediacp/";
        $command = "service.overview";
        $arguments = array(
            "auth" => "hspceXWkWMebVsRYsH-l1Yl7sKaXnlxbnaC3V5eoV8-bp3mdnquFlw==",
            "ServerID" => 10
        );

        $client = new IXR_Client($url . '/system/rpc.php');
        $client->debug = true;
        /** Set to true if you have difficulties **/

        if (!$client->query($command, $arguments)) {
            die('An error occurred - ' . $client->getErrorCode() . ":" . $client->getErrorMessage());
        }

        $return = $client->getResponse();
        
        if ($return['status'] == 'success') {
            echo $command . ' executed successfully.';
        } else {
            echo 'failed executing ' . $command;
        }

        /** Output debugging information **/
        // print_r($return);
    }
}
