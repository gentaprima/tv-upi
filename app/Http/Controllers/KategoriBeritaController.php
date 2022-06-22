<?php

namespace App\Http\Controllers;

use App\Models\ModelkategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KategoriBeritaController extends Controller
{
    public function store(Request $request){
        
        ModelkategoriBerita::create([
            'nama_kategori' => $request->kategoriBerita
        ]);

        Session::flash('message', 'Kategori Berita berhasil ditambahkan.'); 
        Session::flash('icon', 'success');
        return redirect()->back();
    }


    public function update(Request $request,$id){
        $berita = ModelKategoriBerita::find($id);
        $berita->nama_kategori = $request->kategoriBerita;
        $berita->save();
        Session::flash('message', 'Kategori Berita berhasil diperbarui.'); 
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function destroy($id){
        $berita = ModelKategoriBerita::find($id);
        $berita->delete();
        Session::flash('message', 'Kategori Berita berhasil dihapus.'); 
        Session::flash('icon', 'success');
        return redirect()->back();
    }
}
