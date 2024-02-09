<?php

namespace App\Http\Controllers;


use App\Models\ListPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ListPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = DB::table('orders')
        ->join('reservasi', 'reservasi.id_reservasi', '=', 'reservasi.id_reservasi') 
        ->select('orders.*', 'reservasi.nama', 'reservasi.no_hp', 'reservasi.harga_paket')
        ->get();
        $title = 'Data List Pembayaran';
        return view('list_pembayaran.index', compact('title', 'pembayaran'));
    }

   
}
