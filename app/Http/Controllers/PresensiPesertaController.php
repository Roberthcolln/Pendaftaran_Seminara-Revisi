<?php

namespace App\Http\Controllers;

use App\Models\PresensiPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PresensiPesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('presensi_pesertas')->get();
        return view('presensi_peserta.index', [
            'title' => 'Data Presensi Peserta',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presensi_peserta.create', [
            'title' => 'Form Absensi Peserta'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            
        ]);

        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
        DB::table('presensi_pesertas')->insert([
            'id_peserta' => $request->id_peserta,
            'status_kehadiran' => 'Hadir',
            'waktu_presensi' => $today
        ]);

        return redirect()->route('presensi_peserta.index')->with('Sukses', 'Absensi Berhasil');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $x = explode('-',$id);
    //     $y = end($x);
    //     $id_peserta = number_format($y);
        
    //     $result = DB::table('daftar_kegiatans')
    //     ->where('id', $id_peserta)
    //     ->first();

    //     return view('presensi_peserta.show', [
    //         'title' => 'Detail Data Peserta',
    //         'result' => $result
    //     ]);
    // }

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
    public function destroy($id)
    {
        $hapus = PresensiPeserta::findorfail($id);
        // delete data dri database
        $hapus->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Data Presensi');
    }
}
