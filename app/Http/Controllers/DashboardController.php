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

    public function allRiwayat(Request $request)
    {
        // Ambil nilai filter dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $search = $request->input('search');

        // Query untuk data masuk
        $queryMasuk = DB::table('tb_data_masuk');

        if ($startDate) {
            $queryMasuk->where('tgl_masuk', '>=', $startDate);
        }

        if ($endDate) {
            $queryMasuk->where('tgl_masuk', '<=', $endDate);
        }

        if ($search) {
            $queryMasuk->where('name_user', 'like', '%' . $search . '%');
        }

        // Pagination untuk data masuk
        $getDataMasuk = $queryMasuk->paginate(5);

        // Query untuk data keluar
        $queryKeluar = DB::table('tb_data_keluar');

        if ($startDate) {
            $queryKeluar->where('tgl_keluar', '>=', $startDate);
        }

        if ($endDate) {
            $queryKeluar->where('tgl_keluar', '<=', $endDate);
        }

        if ($search) {
            $queryKeluar->where('name_user', 'like', '%' . $search . '%');
        }

        // Pagination untuk data keluar
        $getDataKeluar = $queryKeluar->paginate(5);

        // Kembalikan view dengan data yang sudah difilter
        return view('dashboard.allRiwayat', [
            'getDataMasuk' => $getDataMasuk,
            'getDataKeluar' => $getDataKeluar,
        ]);
    }

    public function masuk(Request $request)
    {
        // Mendapatkan data dari request
        $id_user = $request->input('id_user');
        $tgl_masuk = $request->input('tgl');

        // Mengatur zona waktu ke Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');

        // Mengecek apakah user sudah absen masuk pada hari ini
        $existingData = DB::table('tb_data_masuk')
            ->where('id_user', $id_user)
            ->whereDate('tgl_masuk', '=', date('Y-m-d')) // Validasi dengan tanggal hari ini
            ->first();

        // Jika sudah ada absen masuk, kembalikan pesan error
        if ($existingData) {
            return redirect('/dashboard')->with('error', 'Anda sudah melakukan absen masuk hari ini.');
        }

        // Jika belum ada, maka masukkan data baru
        DB::table('tb_data_masuk')->insert([
            'id_user' => $id_user,
            'tgl_masuk' => date('Y-m-d H:i:s'),
            'latitude' => $request->input('latitude'),
            'name_user' => $request->input('name'),
            'longitude' => $request->input('longitude'),
        ]);

        // Kembalikan pesan sukses setelah berhasil absen
        return redirect('/dashboard')->with('success', 'Sukses absen hari ini.');
    }

    public function keluar(Request $request)
    {
        // Mendapatkan data dari request
        $id_user = $request->input('id_user');
        $tgl_keluar = $request->input('tgl');

        // Mengatur zona waktu ke Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');

        // Mengecek apakah user sudah absen keluar pada hari ini
        $existingData = DB::table('tb_data_keluar')
            ->where('id_user', $id_user)
            ->whereDate('tgl_keluar', '=', date('Y-m-d')) // Validasi dengan tanggal hari ini
            ->first();

        // Jika sudah ada absen keluar, kembalikan pesan error
        if ($existingData) {
            return redirect('/dashboard')->with('error', 'Anda sudah melakukan absen keluar hari ini.');
        }

        // Jika belum ada, maka masukkan data baru
        DB::table('tb_data_keluar')->insert([
            'id_user' => $request->input('id_user'),
            'tgl_keluar' => date('Y-m-d H:i:s'),
            'name_user' => $request->input('name'),
            'latitude_keluar' => $request->input('latitude2'),
            'longitude_keluar' => $request->input('longitude2'),
        ]);

        // Kembalikan pesan sukses setelah berhasil absen keluar
        return redirect('/dashboard')->with('success', 'Sukses absen keluar hari ini. Terima kasih untuk hari ini.');
    }

    public function riwayat(Request $request, String $id)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $masukQuery = DB::table('tb_data_masuk')
            ->where('id_user', $id)
            ->orderBy('tgl_masuk', 'desc');

        $keluarQuery = DB::table('tb_data_keluar')
            ->where('id_user', $id)
            ->orderBy('tgl_keluar', 'desc');

        if ($startDate) {
            $masukQuery->whereDate('tgl_masuk', '>=', $startDate);
            $keluarQuery->whereDate('tgl_keluar', '>=', $startDate);
        }

        if ($endDate) {
            $masukQuery->whereDate('tgl_masuk', '<=', $endDate);
            $keluarQuery->whereDate('tgl_keluar', '<=', $endDate);
        }

        $masuk = $masukQuery->paginate(5);
        $keluar = $keluarQuery->paginate(5);

        return view('dashboard.riwayat', ['masuk' => $masuk, 'keluar' => $keluar, 'id' => $id]);
    }
}
