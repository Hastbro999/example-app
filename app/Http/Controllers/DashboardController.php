<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function masuk(Request $request)
    {
        $id_user = $request->input('id_user');
        $tgl_masuk = $request->input('tgl');

        // Check if the data already exists in the table
        $existingData = DB::table('tb_data_masuk')
            ->where('id_user', $id_user)
            ->where('tgl_masuk', $tgl_masuk)
            ->first();

        if ($existingData) {
            // Data already exists, handle the error or return a response
            return redirect('/dashboard')->with('error', 'Anda sudah melakukan absen masuk hari ini.');
        }

        // If data doesn't exist, insert it into the table
        DB::table('tb_data_masuk')->insert([
            'id_user' => $id_user,
            'tgl_masuk' => $tgl_masuk,
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return redirect('/dashboard')->with('success', 'Sukses absen hari ini.');
    }


    public function keluar(Request $request)
    {
        DB::table('tb_data_keluar')->insert([
            'id_user' => $request->input('id_user'),
            'tgl_keluar' => $request->input('tgl'),
            'latitude_keluar' => $request->input('latitude2'),
            'longitude_keluar' => $request->input('longitude2'),
        ]);

        return redirect('/dashboard')->with('success', 'Sukses Keluar. Terima kasih untuk hari ini.');
    }
}
