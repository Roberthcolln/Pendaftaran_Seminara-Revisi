<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\KategoriAnggota;
use App\Models\Kegiatan;
use App\Models\DaftarKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori_anggota = KategoriAnggota::all();
        $kegiatan = Kegiatan::all()->first();
        $daftar_kegiatan = DaftarKegiatan::all()->first();
        $user = User::all()->first();
        $order = Order::all();
        $title = 'Order';
        return view('order.index', compact('title', 'daftar_kegiatan', 'kategori_anggota', 'kegiatan', 'user', 'order'));
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
        $title = 'Pembayaran';
        $request->request->add(['status' => 'Unpaid']);
        $order = Order::create($request->all());

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
                'order_id' => $order->nama,
                'gross_amount' => $order->total_harga,
            ),
            'customer_details' => array(
                'nama' => $request->nama,
                'no_tlp' => $request->no_tlp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('order.show', compact('snapToken', 'order', 'title'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.serverKey');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_mount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                $order = Order::find($request->order_id);
                $order->update(['status' => 'Paid']);
                $order->save();
            }
        }
        return redirect()->route('daftar_kegiatan.index')->with('Sukses', 'Absensi Berhasil');
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
