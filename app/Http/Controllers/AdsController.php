<?php

namespace App\Http\Controllers;

use App\Models\ModelAds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class AdsController extends Controller
{
    public function store(Request $request){
        $imageBanner = $request->file('image');
        $filename = uniqid() . time() . "."  . explode("/", $imageBanner->getMimeType())[1];
        Storage::disk('uploads')->put('ads/'.$filename,File::get($imageBanner));

        // add banner to database
        if($request->jenis == "beranda"){
            ModelAds::create([
                'image' => $filename,
                'urutan'    => $request->urutan,
                'jenis'     => $request->jenis,
                'is_active' => $request->isActive,
                'position'  => $request->position
            ]);
        }else{
            ModelAds::create([
                'image' => $filename,
                'urutan'    => $request->urutan,
                'jenis'     => $request->jenis,
                'is_active' => $request->isActive
            ]);
        }

        Session::flash('message', 'Iklan '.$request->jenis.' berhasil ditambahkan.'); 
        Session::flash('icon', 'success');
        return redirect()->back()
                            ->withInput($request->input());
    }

    public function addData(Request $request){

        if($request->jenis == "beranda"){
            $validate = Validator::make($request->all(),[
                'position'    => "required",
                'urutan'    => "required",
                'jenis'    => "required",
                'isActive'    => "required",
                'image'    => "required",
            ],[
                'position.required'    => "Posisi iklan harus dilengkapi",
                'urutan.required'    => "Ururan harus dilengkapi",
                'jenis.required'    => "Jenis harus dilengkapi",
                'isActive.required'    => "Status Publish harus dilengkapi",
                'image.required'    => "Foto Iklan harus dilengkapi",
            ]);
        }else{
            $validate = Validator::make($request->all(),[
                'urutan'    => "required",
                'jenis'    => "required",
                'isActive'    => "required",
                'image'    => "required",
            ],[
                'urutan.required'    => "Ururan harus dilengkapi",
                'jenis.required'    => "Jenis harus dilengkapi",
                'isActive.required'    => "Status Publish harus dilengkapi",
                'image.required'    => "Foto Iklan harus dilengkapi",
            ]);
        }

       

        if ($validate->fails()) {
            return response()->json([
                'status'   => false,
                'message'   => $validate->errors()->first()
            ]);
        }

        $imageBanner = $request->file('image');
        $filename = uniqid() . time() . "."  . explode("/", $imageBanner->getMimeType())[1];
        Storage::disk('uploads')->put('ads/'.$filename,File::get($imageBanner));

        // add banner to database
        if($request->jenis == "beranda"){
            ModelAds::create([
                'image' => $filename,
                'urutan'    => $request->urutan,
                'jenis'     => $request->jenis,
                'is_active' => $request->isActive,
                'position'  => $request->position
            ]);
        }else{
            ModelAds::create([
                'image' => $filename,
                'urutan'    => $request->urutan,
                'jenis'     => $request->jenis,
                'is_active' => $request->isActive
            ]);
        }

        return response()->json([
            'status'    => true,
            'message'   => "Iklan baru berhasil ditambahkan."
        ]);
    }

    public function update(Request $request,$id){
        $imageBanner = $request->file('image');
        $ads = ModelAds::find($id);
        if($imageBanner == null){
            $filename = $ads['image'];
        }else{

            $filename = uniqid() . time() . "."  . explode("/", $imageBanner->getMimeType())[1];
            Storage::disk('uploads')->put('ads/'.$filename,File::get($imageBanner));
        }
        

        // add banner to database
        $ads->urutan = $request->urutan;
        $ads->is_active = $request->isActive;
        $ads->image = $filename;
        $ads->position = $request->position;
        $ads->save();

        Session::flash('message', 'Iklan '.$request->jenis.' berhasil diperbarui.'); 
        Session::flash('icon', 'success');
        return redirect()->back()
                            ->withInput($request->input());
    }

    public function destroy($id){
        $ads = ModelAds::find($id);
        $fileName = public_path().'/uploads/ads/'.$ads['image'];
        unlink($fileName);

        $ads->delete();
        Session::flash('message', 'Iklan berhasil dihapus.'); 
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    // API

    public function getAds($jenis){
        $data = DB::table('tbl_ads')
                    ->where('jenis','=',$jenis)
                    ->orderBy('urutan')
                    ->get();

        return response()->json([
            'success' =>true,
            'data'    => $data
        ]);
    }

    public function getAdsBeranda($jenis,$position){
        $data = DB::table('tbl_ads')
                    ->where('jenis','=',$jenis)
                    ->where('position','=',$position)
                    ->orderBy('urutan')
                    ->get();

        return response()->json([
            'success' =>true,
            'data'    => $data
        ]);
    }

    // API
}
