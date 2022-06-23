<?php

namespace App\Http\Controllers;

use App\Models\ModelJadwalSiaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PDO;

class JadwalSiaranController extends Controller
{
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'hari'  => "required",
            'namaSiaran'    => "required",
            'waktuMulai'    => "required",
            'waktuSelesai'    => "required",
        ], [
            'namaSiaran.required' => "Nama Siaran harus dilengkapi.",
            'waktuMulai.required' => "Waktu Mulai siaran harus dilengkapi.",
            'waktuSelesai.required' => "Waktu Selesai siaran harus dilengkapi.",
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status'   => false,
                'message'   => $validate->errors()->first()
            ]);
        }

        ModelJadwalSiaran::create([
            'hari' => $request->hari,
            'waktu_mulai'    => $request->waktuMulai,
            'waktu_selesai'  => $request->waktuSelesai,
            'nama_siaran'    => $request->namaSiaran
        ]);

        return response()->json([
            'status'    => true,
            'message'   => "Jadwal untuk hari" . " $request->hari" . " Berhasil ditambahkan"
        ]);
    }

    public function show($id)
    {
        $data =  DB::table('tbl_jadwal_siaran')
            ->where('hari', '=', $id)
            ->orderBy('waktu_mulai')
            ->get();

        return response()->json($data);
    }

    public function destroy($id)
    {
        $jadwalSiaran = ModelJadwalSiaran::find($id);
        $jadwalSiaran->delete();

        Session::flash('message', 'Jadwal Siaran berhasil dihapus.');
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'hari'  => "required",
            'namaSiaran'    => "required",
            'waktuMulai'    => "required",
            'waktuSelesai'    => "required",
        ], [
            'namaSiaran.required' => "Nama Siaran harus dilengkapi.",
            'waktuMulai.required' => "Waktu Mulai siaran harus dilengkapi.",
            'waktuSelesai.required' => "Waktu Selesai siaran harus dilengkapi.",
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status'   => false,
                'message'   => $validate->errors()->first()
            ]);
        }
        
        $jadwalSiaran = ModelJadwalSiaran::find($id);
        $jadwalSiaran->waktu_mulai = $request->waktuMulai;
        $jadwalSiaran->waktu_selesai = $request->waktuSelesai;
        $jadwalSiaran->nama_siaran = $request->namaSiaran;
        $jadwalSiaran->save();
        return response()->json([
            'status'    => true,
            'message'   => "Jadwal untuk hari" . " $request->hari" . " Berhasil diperbarui"
        ]);
    }

    // API

    public function getJadwalSiaran($hari){
        $data = DB::table('tbl_jadwal_siaran')
                    ->where('hari',$hari)
                    ->orderBy('waktu_mulai','asc')
                    ->get();

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);

    }

    // API
}
