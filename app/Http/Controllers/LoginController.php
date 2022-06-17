<?php

namespace App\Http\Controllers;

use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        $isLogin = Session::get('login');
        if($isLogin != null){
            return redirect('/beranda');
        }
        return view('login');
    }

    public function auth(Request $request){
        $getData = ModelUsers::where('email',$request->email)->first();

        if($getData == null){
            Session::flash('message', 'Mohon maaf, Akun tidak ditemukan.'); 
            Session::flash('icon', 'error'); 
            return redirect()->back()
                            ->withInput($request->input());
        }

        if(!Hash::check($request->password, $getData->password)){
            Session::flash('message', 'Mohon maaf, Email atau Password tidak sesuai.'); 
            Session::flash('icon', 'error');
            return redirect()->back()
                                ->withInput($request->input());
        }


        Session::put('dataUsers',$getData);
        Session::put('login', true);
        return redirect('/dashboard');
    }
}
