<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function store(Request $request){
        $cekUsers = DB::table('tbl_users')->where('email','=',$request->email)->first();

        if($cekUsers == null){
            $users = [
                'email' => $request->email,
                'nama_lengkap' => $request->fullName,
                'role'  => 0
            ];
    
            DB::table('tbl_users')->insert($users);
        }
        $data = DB::table('tbl_users')->where('email','=',$request->email)->first();
        return response()->json([
            'data' => $data,
            'status' => true,

        ]);

    }
}
