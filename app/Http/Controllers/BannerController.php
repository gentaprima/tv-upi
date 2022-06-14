<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function getBanner(){
        $dataBanner = DB::table('tbl_banner')
                            ->where('is_active',1)
                            ->orderBy('urutan','asc')->get();

        return response()->json([
            'success' => true,
            'data'  => $dataBanner
        ]);
    }
}
