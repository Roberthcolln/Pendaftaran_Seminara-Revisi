<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarKegiatan;
use App\Models\KategoriAnggota;
use App\Models\Reservasi;
use Illuminate\Support\Facades\DB;

class dashboardContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori_anggota = KategoriAnggota::first();
        $daftar_kegiatan = DB::table('daftar_kegiatans')
            ->join('kegiatan', 'daftar_kegiatans.id_kegiatan', '=', 'kegiatan.id_kegiatan')
            ->join('users', 'daftar_kegiatans.id', '=', 'users.id')
            ->join('kategori_anggota', 'daftar_kegiatans.id_kategori_anggota', 'kategori_anggota.id_kategori_anggota')

            ->select('daftar_kegiatans.*', 'kegiatan.nama_kegiatan', 'users.name', 'users.email', 'kategori_anggota.nama_kategori_anggota', 'kegiatan.tanggal_kegiatan', 'kegiatan.jam_kegiatan', 'kegiatan.biaya_kegiatan as biaya_kegiatan_kegiatan')
            ->get();

        $result = Reservasi::join('kategori_anggota', 'reservasi.id_kategori_anggota', '=', 'kategori_anggota.id_kategori_anggota')
            ->select('kategori_anggota.nama_kategori_anggota', DB::raw('COUNT(reservasi.nama) as jumlah_user'))
            ->groupBy('kategori_anggota.nama_kategori_anggota')
            ->get();

        $pendapatan = Reservasi::sum('harga_paket');
        $peserta = DB::table('reservasi')->count();
       
        return view('dashboard.index', compact('pendapatan', 'peserta', 'kategori_anggota', 'result', 'daftar_kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
