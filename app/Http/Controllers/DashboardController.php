<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function allRiwayat()
    {
        $getDataMasuk = DB::table('tb_data_masuk')
            ->get();

        $getDataKeluar = DB::table('tb_data_keluar')
            ->get();

        return view('dashboard.allRiwayat', compact('getDataMasuk', 'getDataKeluar'));
    }

    public function masuk(Request $request)
    {
        $id_user = $request->input('id_user');
        $tgl_masuk = $request->input('tgl');
        date_default_timezone_set('Asia/Jakarta');

        $existingData = DB::table('tb_data_masuk')
            ->where('id_user', $id_user)
            ->where('tgl_masuk', 'like', '%' . $tgl_masuk . '%')
            ->first();

        if ($existingData) {
            return redirect('/dashboard')->with('error', 'Anda sudah melakukan absen masuk hari ini.');
        }

        DB::table('tb_data_masuk')->insert([
            'id_user' => $id_user,
            'tgl_masuk' => date('Y-m-d H:i:s'),
            'latitude' => $request->input('latitude'),
            'name_user' => $request->input('name'),
            'longitude' => $request->input('longitude'),
        ]);

        return redirect('/dashboard')->with('success', 'Sukses absen hari ini.');
    }


    public function keluar(Request $request)
    {
        $id_user = $request->input('id_user');
        $tgl_keluar = $request->input('tgl');
        date_default_timezone_set('Asia/Jakarta');

        $existingData = DB::table('tb_data_keluar')
            ->where('id_user', $id_user)
            ->where('tgl_keluar', 'like', '%' . $tgl_keluar . '%')
            ->first();

        if ($existingData) {
            return redirect('/dashboard')->with('error', 'Terima kasih sudah absen hari ini.');
        }

        DB::table('tb_data_keluar')->insert([
            'id_user' => $request->input('id_user'),
            'tgl_keluar' => date('Y-m-d H:i:s'),
            'name_user' => $request->input('name'),
            'latitude_keluar' => $request->input('latitude2'),
            'longitude_keluar' => $request->input('longitude2'),
        ]);

        return redirect('/dashboard')->with('success', 'Sukses Keluar. Terima kasih untuk hari ini.');
    }

    public function riwayat(Request $request, String $id)
    {
        $masuk = DB::table('tb_data_masuk')
            ->where('id_user', $id)
            ->get();
        $keluar = DB::table('tb_data_keluar')
            ->where('id_user', $id)
            ->get();
        return view('dashboard.riwayat', compact('masuk', 'keluar'));
    }
}
