<?php

namespace App\Http\Controllers;

use App\Models\ModelAds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{
    public function store(Request $request){
        $imageBanner = $request->file('image');
        $filename = uniqid() . time() . "."  . explode("/", $imageBanner->getMimeType())[1];
        Storage::disk('uploads')->put('ads/'.$filename,File::get($imageBanner));

        // add banner to database
        ModelAds::create([
            'image' => $filename,
            'urutan'    => $request->urutan,
            'jenis'     => $request->jenis,
            'is_active' => $request->isActive
        ]);

        Session::flash('message', 'Iklan '.$request->jenis.' berhasil ditambahkan.'); 
        Session::flash('icon', 'success');
        return redirect()->back()
                            ->withInput($request->input());
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
        $ads->save();

        Session::flash('message', 'Iklan '.$request->jenis.' berhasil diperbarui.'); 
        Session::flash('icon', 'success');
        return redirect()->back()
                            ->withInput($request->input());
    }
}
