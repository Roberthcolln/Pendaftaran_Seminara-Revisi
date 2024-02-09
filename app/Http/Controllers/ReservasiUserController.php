<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\KategoriAnggota;
use App\Models\Kupon;
use App\Models\Paket;
use App\Models\ReservasiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReservasiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservasi_user = DB::table('reservasi')
            ->join('paket', 'reservasi.id_paket', '=', 'paket.id_paket') // Ganti 'id_paket' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel paket
            ->join('kategori_anggota', 'reservasi.id_kategori_anggota', '=', 'kategori_anggota.id_kategori_anggota') // Ganti 'id_kategori_anggota' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kategori_anggota
            ->join('kegiatan', 'reservasi.id_kegiatan', '=', 'kegiatan.id_kegiatan') // Ganti 'id_kegiatan' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kegiatan
            ->leftJoin('kupon', 'reservasi.kode_kupon', '=', 'kupon.kode_kupon') // Ganti 'id_kupon' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kupon
            ->select('reservasi.*', 'paket.nama_paket', 'kategori_anggota.nama_kategori_anggota', 'kegiatan.nama_kegiatan', 'kupon.kode_kupon')
            ->get();
        $title = 'Data Pendaftaran';
        return view('reservasi_user.index', compact('title', 'reservasi_user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $title = 'Pembayaran';
        $request->request->add(['status' => 'Unpaid']);
        $reservasi_user = DB::table('reservasi')
            ->join('paket', 'reservasi.id_paket', '=', 'paket.id_paket') // Ganti 'id_paket' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel paket
            ->join('kategori_anggota', 'reservasi.id_kategori_anggota', '=', 'kategori_anggota.id_kategori_anggota') // Ganti 'id_kategori_anggota' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kategori_anggota
            ->join('kegiatan', 'reservasi.id_kegiatan', '=', 'kegiatan.id_kegiatan') // Ganti 'id_kegiatan' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kegiatan
            ->leftJoin('kupon', 'reservasi.kode_kupon', '=', 'kupon.kode_kupon') // Ganti 'id_kupon' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kupon
            ->select('reservasi.*', 'paket.nama_paket', 'kategori_anggota.nama_kategori_anggota', 'kegiatan.nama_kegiatan', 'kupon.kode_kupon')
            ->where('reservasi.id_reservasi', $id)
            ->first();

        //SAMPLE REQUEST START HERE

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $reservasi_user->nama,
                'gross_amount' => $reservasi_user->harga_paket,
            ),
            'customer_details' => array(
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('reservasi_user.payment', compact('snapToken', 'reservasi_user', 'title'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.serverKey');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_mount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                $reservasi_user = ReservasiUser::find($request->order_id);
                $reservasi_user->update(['status' => 'Paid']);
                $reservasi_user->save();
            }
        }
        return redirect()->route('reservasi_user.index')->with('Sukses', ' Berhasil');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reservasi_user = DB::table('reservasi')
            ->join('paket', 'reservasi.id_paket', '=', 'paket.id_paket') // Ganti 'id_paket' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel paket
            ->join('kategori_anggota', 'reservasi.id_kategori_anggota', '=', 'kategori_anggota.id_kategori_anggota') // Ganti 'id_kategori_anggota' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kategori_anggota
            ->join('kegiatan', 'reservasi.id_kegiatan', '=', 'kegiatan.id_kegiatan') // Ganti 'id_kegiatan' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kegiatan
            ->leftJoin('kupon', 'reservasi.kode_kupon', '=', 'kupon.kode_kupon') // Ganti 'id_kupon' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kupon
            ->select('reservasi.*', 'paket.nama_paket', 'kategori_anggota.nama_kategori_anggota', 'kegiatan.nama_kegiatan', 'kupon.kode_kupon')
            ->where('reservasi.id_reservasi', $id)
            ->first();
        $title = 'Detail Data Event';
        return view('reservasi_user.show', compact('title', 'reservasi_user'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hapus = ReservasiUser::findorfail($id);
        // delete data dri database
        $hapus->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Data Reservasi');
    }
    
}
