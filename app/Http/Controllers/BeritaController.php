<?php

namespace App\Http\Controllers;

use App\Models\ModelBerita;
use App\Models\ModelBeritaUsers;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function store(Request $request)
    {
        $imageBanner = $request->file('image');
        $filename = uniqid() . time() . "."  . explode("/", $imageBanner->getMimeType())[1];
        Storage::disk('uploads')->put('berita/' . $filename, File::get($imageBanner));
        ModelBerita::create([
            'judul' => $request->judul,
            'id_kategori'   => $request->kategoriBerita,
            'deskripsi'     => $request->deskripsi,
            'tgl'           => $request->date,
            'count_like'    => 0,
            'created_by'    => "Admin",
            'is_publish'    => $request->status,
            'image'         => $filename
        ]);
        Session::flash('message', 'Berita berhasil ditambahkan.');
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $berita = ModelBerita::find($id);
        $berita->judul = $request->judul;
        $berita->deskripsi = $request->deskripsi;
        $berita->tgl = $request->date;
        $berita->id_kategori = $request->kategoriBerita;
        $berita->is_publish = $request->status;
        $berita->save();

        Session::flash('message', 'Berita berhasil diperbarui.');
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $berita = ModelBerita::find($id);
        $berita->delete();
        Session::flash('message', 'Berita berhasil dihapus.');
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function show($id)
    {
        $data = DB::table('tbl_berita')
            ->leftJoin('tbl_kategori_berita', 'tbl_berita.id_kategori', '=', 'tbl_kategori_berita.id')
            ->where('tbl_berita.id', '=', $id)
            ->first();

        return response()->json(
            $data
        );
    }

    // API

    public function getLatestNews(Request $request)
    {
        $data = DB::table('tbl_berita')
            ->select('tbl_berita.*', 'tbl_kategori_berita.nama_kategori')
            ->leftJoin('tbl_kategori_berita', 'tbl_berita.id_kategori', '=', 'tbl_kategori_berita.id')
            ->orderBy('tbl_berita.id', 'desc')
            ->first();

        $ceklike = DB::table('tbl_berita_like')->where('id_berita','=',$data->id)->where('id_users','=',$request->idUsers)->first();
        if($ceklike != null){
            $data->like = true;
        }else{
            $data->like = false;

        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function getNews(Request $request)
    {
        if ($request->kategori == 0) {
            $data = DB::table('tbl_berita')
                ->select('tbl_berita.*', 'tbl_kategori_berita.nama_kategori')
                ->leftJoin('tbl_kategori_berita', 'tbl_berita.id_kategori', '=', 'tbl_kategori_berita.id')
                ->where('is_publish', '=', 1)
                ->orderBy('tbl_berita.id', 'desc')
                ->paginate(3);
        } else {
            $data = DB::table('tbl_berita')
                ->select('tbl_berita.*', 'tbl_kategori_berita.nama_kategori')
                ->leftJoin('tbl_kategori_berita', 'tbl_berita.id_kategori', '=', 'tbl_kategori_berita.id')
                ->where('id_kategori', '=', $request->kategori)
                ->where('is_publish', '=', 1)
                ->orderBy('tbl_berita.id', 'desc')
                ->paginate(3);
           
        }
        
        $arr = [];
        foreach($data as $dt){
            $idBerita = $dt->id;
            $ceklike = DB::table('tbl_berita_like')->where('id_berita','=',$idBerita)->where('id_users','=',$request->idUsers)->first();
            if($ceklike != null){
                $dt->like = true;
            }else{
                $dt->like = false;
            }

            array_push($arr,$dt);
        }
        

        return response()->json([
            'success' => true,
            'last_page' => $data->lastPage(),
            'data'    => $arr
        ]);
    }

    public function addLike($idUsers, $idBerita)
    {
        $berita = ModelBerita::find($idBerita);
        $countLike = $berita['count_like'];

        $getBeritaUsers = DB::table('tbl_berita_like')
            ->where('id_berita', '=', $idBerita)
            ->where('id_users', '=', $idUsers)
            ->first();

        if ($getBeritaUsers == null) {
            ModelBeritaUsers::create([
                'id_users' => $idUsers,
                'id_berita' => $idBerita
            ]);
            $berita->count_like = $countLike + 1;
        } else {
            $berita->count_like = $countLike - 1;
            DB::table('tbl_berita_like')->where('id_users', '=', $idUsers)->where('id_berita', '=', $idBerita)->delete();
        }
        $berita->save();

        return response()->json([
            'message' => 'sukses',
            'status' => true,

        ]);
    }

    // API
}
