<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Paket';
        $paket = Paket::all();
        return view('paket.index', compact('paket', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Paket';
        return view('paket.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required',
            'harga_paket'=> 'required',
            'deskripsi_paket' => 'required',
        ]);
        $paket = new Paket();
        $paket->nama_paket = $request->nama_paket;
        $paket->harga_paket = $request->harga_paket;
        $paket->deskripsi_paket = $request->deskripsi_paket;
        $paket->save();
        return redirect()->route('paket.index')->with('Sukses', 'Berhasil Tambah Data Paket');
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
    public function edit(Paket $paket)
    {
        $title = 'Edit Paket';
        return view('paket.edit', compact('paket', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $paket = Paket::findorfail($id);
        $update = [
            'nama_paket' => $request->nama_paket,
            'harga_paket' => $request->harga_paket,
            'deskripsi_paket' => $request->deskripsi_paket,
        ];
        $paket->update($update);
        return redirect()->route('paket.index')->with('Sukses', 'Berhasil Edit Data Paket');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->back()->with('Delete','Berhasil Hapus Data Paket');
    }
}