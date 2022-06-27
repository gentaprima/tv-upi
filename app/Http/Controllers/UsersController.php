<?php

namespace App\Http\Controllers;

use App\Models\ModelUsers;
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

    public function update(Request $request,$id){
        $users = ModelUsers::find($id);
        $users->jenis_kelamin = $request->gender;
        $users->nomor_telepon = $request->phoneNumber;
        $users->tgl_lahir = $request->dateBirth;
        $users->save();

        return response()->json([
            'status' => true,
            'message' => "Profil berhasil diperbarui"
        ]);
    }
}
