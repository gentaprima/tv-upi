<?php

namespace App\Http\Controllers;

use App\Models\ModelBerita;
use App\Models\ModelKategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BeritaController extends Controller
{
    public function store(Request $request){
        ModelBerita::create([
            'judul' => $request->judul,
            'id_kategori'   => $request->kategoriBerita,
            'deskripsi'     => $request->deskripsi,
            'tgl'           => date('Y-m-d'),
            'count_like'    => 0,
            'created_by'    => "Admin",
            'is_publish'    => $request->status
        ]);
        Session::flash('message', 'Berita berhasil ditambahkan.'); 
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function update(Request $request,$id){
        $berita = ModelBerita::find($id);
        $berita->judul = $request->judul;
        $berita->deskripsi = $request->deskripsi;
        $berita->tgl = date('Y-m-d');
        $berita->id_kategori = $request->kategoriBerita;
        $berita->is_publish = $request->status;
        $berita->save();

        Session::flash('message', 'Berita berhasil diperbarui.'); 
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function destroy($id){
        $berita = ModelBerita::find($id);
        $berita->delete();
        Session::flash('message', 'Berita berhasil dihapus.'); 
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function show($id){
        $data = DB::table('tbl_berita')
                        ->leftJoin('tbl_kategori_berita','tbl_berita.id_kategori','=','tbl_kategori_berita.id')
                        ->where('tbl_berita.id','=',$id)
                        ->first();

        return response()->json(
            $data
        );
    }
}
