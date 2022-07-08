<?php

namespace App\Http\Controllers;

use App\Models\ModelBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function getBanner()
    {
        $dataBanner = DB::table('tbl_banner')
            ->where('is_active', 1)
            ->orderBy('urutan', 'asc')->get();

        return response()->json([
            'success' => true,
            'data'  => $dataBanner
        ]);
    }

    public function store(Request $request)
    {
        //Upload File
        $imageBanner = $request->file('image');
        $filename = uniqid() . time() . "."  . explode("/", $imageBanner->getMimeType())[1];
        Storage::disk('uploads')->put('banner/' . $filename, File::get($imageBanner));

        // add banner to database
        ModelBanner::create([
            'judul' => $request->judul,
            'urutan'    => $request->urutan,
            'path_url'  => $filename,
            'is_ads'    => $request->isAds,
            'is_active' => $request->isActive
        ]);

        Session::flash('message', 'Banner berhasil ditambahkan.');
        Session::flash('icon', 'success');
        return redirect()->back()
            ->withInput($request->input());
    }


    public function update(Request $request, $id)
    {
        //Upload File
        $imageBanner = $request->file('image');
        $banner = ModelBanner::find($id);
        if ($imageBanner == null) {
            $filename = $banner['path_url'];
        } else {

            $filename = uniqid() . time() . "."  . explode("/", $imageBanner->getMimeType())[1];
            Storage::disk('uploads')->put('banner/' . $filename, File::get($imageBanner));
        }


        // update banner to database
        $banner->judul = $request->judul;
        $banner->urutan = $request->urutan;
        $banner->is_ads = $request->isAds;
        $banner->is_active = $request->isActive;
        $banner->path_url = $filename;
        $banner->save();

        Session::flash('message', 'Banner berhasil diperbarui.');
        Session::flash('icon', 'success');
        return redirect()->back()
            ->withInput($request->input());
    }

    public function destroy($id)
    {
        $banner = ModelBanner::find($id);
        $fileName = public_path() . '/uploads/banner/' . $banner['path_url'];
        unlink($fileName);

        $banner->delete();
        Session::flash('message', 'Banner berhasil dihapus.');
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function getBannerJson(Request $request)
    {

        if ($request->search != '') {
            if (preg_match("/{$request->search}/i", "aktif") || preg_match("/{$request->search}/i", "tidak aktif")) {
                if (preg_match("/{$request->search}/i", "aktif")) {
                    $isActive = 1;
                } else if (preg_match("/{$request->search}/i", "tidak aktif")) {
                    $isActive = 0;
                }

                $dataBanner = DB::table('tbl_banner')
                    ->where('is_active', $isActive)
                    ->paginate(10);
            } else if (preg_match("/{$request->search}/i", "iklan") || preg_match("/{$request->search}/i", "bukan iklan")) {
                if (preg_match("/{$request->search}/i", "iklan")) {
                    $isAds = 1;
                } else if (preg_match("/{$request->search}/i", "bukan iklan")) {
                    $isAds = 0;
                }

                $dataBanner = DB::table('tbl_banner')
                    ->where('is_active', $isAds)
                    ->paginate(10);
            } else {
                $dataBanner = DB::table('tbl_banner')
                    ->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('urutan', 'like', '%' . $request->search . '%')
                    ->paginate(10);
            }
        } else {
            $dataBanner = DB::table('tbl_banner')
                          ->paginate(10);
        }

        return response()->json([
            'success'   => true,
            'data'      => $dataBanner,
            'linkBanner'    => asset('uploads/banner')
        ]);
    }
}
