<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
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
        date_default_timezone_set('Asia/Jakarta');
        // Check if the data already exists in the table
        $existingData = DB::table('tb_data_masuk')
            ->where('id_user', $id_user)
            ->where('tgl_masuk', 'like', '%' . $tgl_masuk . '%')
            ->first();

        if ($existingData) {
            // Data already exists, handle the error or return a response
            return redirect('/dashboard')->with('error', 'Anda sudah melakukan absen masuk hari ini.');
        }

        // If data doesn't exist, insert it into the table
        DB::table('tb_data_masuk')->insert([
            'id_user' => $id_user,
            'tgl_masuk' => date('Y-m-d H:i:s'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return redirect('/dashboard')->with('success', 'Sukses absen hari ini.');
    }


    public function keluar(Request $request)
    {
        $id_user = $request->input('id_user');
        $tgl_keluar = $request->input('tgl');
        date_default_timezone_set('Asia/Jakarta');
        // Check if the data already exists in the table
        $existingData = DB::table('tb_data_keluar')
            ->where('id_user', $id_user)
            ->where('tgl_keluar', 'like', '%' . $tgl_keluar . '%')
            ->first();

        if ($existingData) {
            // Data already exists, handle the error or return a response
            return redirect('/dashboard')->with('error', 'Terima kasih sudah absen hari ini.');
        }


        DB::table('tb_data_keluar')->insert([
            'id_user' => $request->input('id_user'),
            'tgl_keluar' => date('Y-m-d H:i:s'),
            'latitude_keluar' => $request->input('latitude2'),
            'longitude_keluar' => $request->input('longitude2'),
        ]);

        return redirect('/dashboard')->with('success', 'Sukses Keluar. Terima kasih untuk hari ini.');
    }

    public function riwayat(Request $request, String $id)
    {

        if ($request->ajax()) {
            $data = DB::table('tb_data_masuk')
                ->select('tb_data_masuk.tgl_masuk', 'tb_data_keluar.tgl_keluar')
                ->rightJoin('tb_data_keluar', 'tb_data_masuk.id_user', '=', 'tb_data_keluar.id_user')
                ->where('tb_data_masuk.id_user', $id)
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('dashboard.riwayat');
    }
}
