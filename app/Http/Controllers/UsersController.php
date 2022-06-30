<?php

namespace App\Http\Controllers;

use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function updateProfile(Request $request,$id,$form){
        $imageProfile = $request->file('image');
        $profile = ModelUsers::find($id);
        if($imageProfile == null){
            $filename = $profile['foto'];
        }else{

            $filename = uniqid() . time() . "."  . explode("/", $imageProfile->getMimeType())[1];
            Storage::disk('uploads')->put('profile/'.$filename,File::get($imageProfile));
        }

        if($request->password != null){
            if($request->confirmPassword != $request->password){
                Session::flash('message', 'Password harus sama dengan konfirmasi password'); 
                Session::flash('icon', 'error');
                return redirect()->back()
                                    ->withInput($request->input());
            }
            $profile->password = Hash::make($request->password);
        }

        if($form == 2){
            $profile->role = $request->role;
        }

        $profile->nama_lengkap = $request->fullname;
        $profile->nomor_telepon = $request->phoneNumber;
        $profile->foto = $filename;
        $profile->save();
        Session::put('dataUsers',$profile);
        Session::flash('message', 'Data profil berhasil diperbarui'); 
        Session::flash('icon', 'success');
        return redirect()->back()
                            ->withInput($request->input());
    }

    public function addUsers(Request $request){

        $cekEmail = ModelUsers::where('email',$request->email)->first();
        if($cekEmail != null){
            Session::flash('message', 'Maaf, Email sudah digunakan.'); 
            Session::flash('icon', 'error');
            return redirect()->back()
                                ->withInput($request->input());
        }

        ModelUsers::create([
            'nama_lengkap' => $request->fullname,
            'email'        => $request->email,
            'nomor_telepon' => $request->phoneNumber,
            'role' => $request->role,
            'password' => Hash::make('1234')
        ]);
        Session::flash('message', 'Pengguna baru berhasil ditambahkan'); 
        Session::flash('icon', 'success');
        return redirect()->back()
                            ->withInput($request->input());
    }

    public function destroy($id){
        $users = ModelUsers::find($id);
        $users->delete();
        Session::flash('message', 'Pengguna berhasil dihapus'); 
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    // API

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

    // API
}
