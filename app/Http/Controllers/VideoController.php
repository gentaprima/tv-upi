<?php

namespace App\Http\Controllers;

use App\Models\ModelVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function getVideo($jenis){
        $dataVideo = DB::table('tbl_video')
                        ->where('id_kategori',$jenis)
                        ->where('is_active',1)
                        ->limit(3)
                        ->orderBy('id','desc')
                        ->get();

        return response()->json([
            'success' => true,
            'data'  => $dataVideo
        ]);
        

    }

    public function store(Request $request){
        $imageBanner = $request->file('image');
        $filename = uniqid() . time() . "."  . explode("/", $imageBanner->getMimeType())[1];
        Storage::disk('uploads')->put('banner/'.$filename,File::get($imageBanner));

        // add banner to database
        ModelVideo::create([
            'judul' => $request->judul,
            'link'    => $request->link,
            'banner'  => $filename,
            'id_kategori'    => $request->kategori,
            'count'    => 0,
            'is_active' => $request->isActive,
            'tgl'       => $request->date
        ]);

        Session::flash('message', 'Banner berhasil ditambahkan.'); 
        Session::flash('icon', 'success');
        return redirect()->back()
                            ->withInput($request->input());
    }

    public function update(Request $request,$id){
        //Upload File
        $imageBanner = $request->file('image');
        $video = ModelVideo::find($id);
        if($imageBanner == null){
            $filename = $video['banner'];
        }else{

            $filename = uniqid() . time() . "."  . explode("/", $imageBanner->getMimeType())[1];
            Storage::disk('uploads')->put('banner/'.$filename,File::get($imageBanner));
        }

       


        // update banner to database
        $video->judul = $request->judul;
        $video->link = $request->link;
        $video->id_kategori = $request->kategori;
        $video->is_active = $request->isActive;
        $video->banner = $filename;
        $video->tgl = $request->date;
        $video->save();

        Session::flash('message', 'Banner berhasil diperbarui.'); 
        Session::flash('icon', 'success');
        return redirect()->back()
                            ->withInput($request->input());
    }

    public function destroy($id){
        $video = ModelVideo::find($id);
        $fileName = public_path().'/uploads/banner/'.$video['banner'];
        unlink($fileName);

        $video->delete();
        Session::flash('message', 'Banner berhasil dihapus.'); 
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function getVideoJson(Request $request){
        if($request->search != ''){

            $dataVideo = DB::table('tbl_video')
                ->select('tbl_video.*','tbl_kategori_video.nama_kategori')
                ->leftJoin('tbl_kategori_video', 'tbl_video.id_kategori', '=', 'tbl_kategori_video.id')
                ->where('judul','like','%'.$request->search.'%')
                ->orWhere('nama_kategori','like','%'.$request->search.'%')
                ->orWhere('tgl','like','%'.$request->search.'%')
                ->orderBy('id','desc')
                ->paginate(10);
        }else{
            $dataVideo = DB::table('tbl_video')
                ->select('tbl_video.*','tbl_kategori_video.nama_kategori')
                ->leftJoin('tbl_kategori_video', 'tbl_video.id_kategori', '=', 'tbl_kategori_video.id')
                ->orderBy('id','desc')
                ->paginate(10);
        }

        return response()->json([
            'status' => true,
            'data' => $dataVideo,
            'linkBanner' => asset('uploads/banner')
        ]);
    }

    // API

    public function addCount($id){
        $video = ModelVideo::find($id);
        $getCount = $video['count'];
        $video->count = $getCount + 1;
        $video->save();
        return response()->json([
            'status'  => true,
            'message' => "Berhasil menambahkan"  
        ]);
    }

    public function getVideoSelection(){
        $data = DB::table('tbl_video')
                    ->where('is_active',1)
                    ->orderBy('count','desc')
                    ->limit(3)
                    ->get();
        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }

    // API
}
