<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function store(Request $request){
        $users = [
            'email' => $request->email,
            'nama_lengkap' => $request->fullName,
            'role'  => 0
        ];

        DB::table('tbl_users')->insert($users);
        return response()->json([
            'message' => 'sukses',
            'status' => true,

        ]);

    }
}
