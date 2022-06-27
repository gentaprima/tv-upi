<?php

namespace App\Http\Controllers;

use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function store(Request $request){
        $cekUsers = DB::table('tbl_users')->where('email','=',$request->email)->first();

        if($cekUsers == null){
            $users = [
                'email' => $request->email,
                'nama_lengkap' => $request->fullName,
                'tgl_lahir' => "",
                'jenis_kelamin' => '',
                'nomor_telepon' =>'',
                'foto'  => "",
                'date' => "",
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

        $validate = Validator::make($request->all(),[
            'gender'    => "required",
            'dateBirth' => "required",
            "phoneNumber"   => "required"
        ],[
            'gender.required' => "Jenis kelamin tidak boleh kosong",
            'dateBirth.required' => "Tanggal lahir tidak boleh kosong",
            "phoneNumber.required" => "Nomor telepon tidak boleh kosong"
        ]);


        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message'   => $validate->errors()->first()
            ]);
        }


        $users = ModelUsers::find($id);
        $users->jenis_kelamin = $request->gender;
        $users->nomor_telepon = $request->phoneNumber;
        $users->tgl_lahir = $request->dateBirth;
        $users->date = $request->date;
        $users->save();

        return response()->json([
            'status' => true,
            'message' => "Profil berhasil diperbarui"
        ]);
    }
}
