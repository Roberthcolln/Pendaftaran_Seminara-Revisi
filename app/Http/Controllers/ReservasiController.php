<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\KategoriAnggota;
use App\Models\Kupon;
use App\Models\Paket;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservasi = DB::table('reservasi')
            ->join('paket', 'reservasi.id_paket', '=', 'paket.id_paket') // Ganti 'id_paket' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel paket
            ->join('kategori_anggota', 'reservasi.id_kategori_anggota', '=', 'kategori_anggota.id_kategori_anggota') // Ganti 'id_kategori_anggota' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kategori_anggota
            ->join('kegiatan', 'reservasi.id_kegiatan', '=', 'kegiatan.id_kegiatan') // Ganti 'id_kegiatan' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kegiatan
            ->leftJoin('kupon', 'reservasi.kode_kupon', '=', 'kupon.kode_kupon') // Ganti 'id_kupon' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kupon
            ->select('reservasi.*', 'paket.nama_paket', 'kategori_anggota.nama_kategori_anggota', 'kegiatan.nama_kegiatan', 'kupon.kode_kupon')
            ->get();
        $title = 'Data Reservasi';
        return view('reservasi.index', compact('title', 'reservasi'));
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
        $reservasi = DB::table('reservasi')
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
                'order_id' => $reservasi->nama,
                'gross_amount' => $reservasi->harga_paket,
            ),
            'customer_details' => array(
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('reservasi.payment', compact('snapToken', 'reservasi', 'title'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.serverKey');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_mount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                $reservasi = Reservasi::find($request->order_id);
                $reservasi->update(['status' => 'Paid']);
                $reservasi->save();
            }
        }
        return redirect()->route('reservasi.index')->with('Sukses', ' Berhasil');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reservasi = DB::table('reservasi')
            ->join('paket', 'reservasi.id_paket', '=', 'paket.id_paket') // Ganti 'id_paket' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel paket
            ->join('kategori_anggota', 'reservasi.id_kategori_anggota', '=', 'kategori_anggota.id_kategori_anggota') // Ganti 'id_kategori_anggota' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kategori_anggota
            ->join('kegiatan', 'reservasi.id_kegiatan', '=', 'kegiatan.id_kegiatan') // Ganti 'id_kegiatan' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kegiatan
            ->leftJoin('kupon', 'reservasi.kode_kupon', '=', 'kupon.kode_kupon') // Ganti 'id_kupon' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kupon
            ->select('reservasi.*', 'paket.nama_paket', 'kategori_anggota.nama_kategori_anggota', 'kegiatan.nama_kegiatan', 'kupon.kode_kupon')
            ->where('reservasi.id_reservasi', $id)
            ->first();
        $title = 'Detail Data Event';
        return view('reservasi.show', compact('title', 'reservasi'));
    }

    public function invoice($id)
    {
        $reservasi = DB::table('reservasi')
            ->join('paket', 'reservasi.id_paket', '=', 'paket.id_paket') // Ganti 'id_paket' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel paket
            ->join('kategori_anggota', 'reservasi.id_kategori_anggota', '=', 'kategori_anggota.id_kategori_anggota') // Ganti 'id_kategori_anggota' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kategori_anggota
            ->join('kegiatan', 'reservasi.id_kegiatan', '=', 'kegiatan.id_kegiatan') // Ganti 'id_kegiatan' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kegiatan
            ->leftJoin('kupon', 'reservasi.kode_kupon', '=', 'kupon.kode_kupon') // Ganti 'id_kupon' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kupon
            ->select('reservasi.*', 'paket.nama_paket', 'kategori_anggota.nama_kategori_anggota', 'kegiatan.nama_kegiatan', 'kupon.kode_kupon')
            ->where('reservasi.id_reservasi', $id)
            ->first();
        $title = 'Detail Data Event';
        return view('reservasi.invoice', compact('title', 'reservasi'));
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
        $hapus = Reservasi::findorfail($id);
        // delete data dri database
        $hapus->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Data Reservasi');
    }
    
}
