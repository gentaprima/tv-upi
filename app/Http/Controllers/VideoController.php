<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function getVideo($jenis){
        $dataVideo = DB::table('tbl_video')
                        ->where('jenis',$jenis)
                        ->where('is_active',1)->get();

        return response()->json([
            'success' => true,
            'data'  => $dataVideo
        ]);
        

    }
}
