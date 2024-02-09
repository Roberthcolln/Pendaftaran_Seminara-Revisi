<?php

namespace App\Http\Controllers;

use App\Models\Kupon;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KuponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kupon = DB::table('kupon')
            ->join('paket', 'kupon.id_paket', 'paket.id_paket')
            ->get();
        $title = 'Data Kupon';
        return view('kupon.index', compact('kupon', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paket = Paket::all();
        $title = 'Tambah Kupon';
        return view('kupon.create', compact('title','paket'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_paket' => 'required',
            'kode_kupon' => 'required',
            'potongan_harga' => 'required',
        ]);
        $kupon = new Kupon();
        $kupon->id_paket = $request->id_paket;
        $kupon->kode_kupon = $request->kode_kupon;
        $kupon->potongan_harga = $request->potongan_harga;
        $kupon->save();
        return redirect()->route('kupon.index')->with('Sukses', 'Berhasil Tambah Data Kupon');
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
    public function edit( $id)
    {
        $kupon = Kupon::findorfail($id);
        $paket = Paket::all();
        $title = 'Edit Kupon';
        return view('kupon.edit', compact('kupon', 'title', 'paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kupon = Kupon::findorfail($id);
        $update = [
            'id_paket' => $request->id_paket,
            'kode_kupon' => $request->kode_kupon,
            'potongan_harga' => $request->potongan_harga,
        ];
        $kupon->update($update);
        return redirect()->route('kupon.index')->with('Sukses', 'Berhasil Edit Data Kupon');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $kupon = Kupon::findorfail($id);
        $kupon->delete();
        return redirect()->back()->with('Delete', 'Berhasil Hapus Data Kupon');
    }

    public function fetchPaket(Request $request)
    {
        $data['kupon'] = Kupon::where("id_paket",$request->id_paket)->get(["kode_kupon", "id_kupon"]);
        return response()->json($data);
    }
}
