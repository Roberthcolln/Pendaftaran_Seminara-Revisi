<?php

namespace App\Http\Controllers;


use App\Models\Bukti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BuktiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukti = DB::table('bukti')
            ->get();
        $title = 'Data Bukti Pembayaran';
        return view('bukti.index', compact('title', 'bukti'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bukti = Bukti::all();
        $title = 'Tambah Bukti Pembayaran';
        return view('bukti.create', compact( 'bukti', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required:jpg, jpeg, png, gif, raw, tiff',
            'nama' => 'required',
            'email' => 'required',
        
        ]);
        $file = $request->file('bukti_pembayaran');
        $namafile = 'Bukti Pembayaran' . date('Ymdhis') . '.' . $request->file('bukti_pembayaran')->getClientOriginalExtension();
        $file->move('file/bukti/', $namafile);

        $bukti = new Bukti();
        $bukti->bukti_pembayaran = $namafile;
        $bukti->nama = $request->nama;
        $bukti->email = $request->email;
        $bukti->save();
        return redirect()->route('bukti.index')->with('Sukses', 'Berhasil Tambah Bukti');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bukti $bukti)
    {
       
        $title = 'Edit Bukti Pembayaran';
        return view('bukti.edit', compact( 'bukti', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bukti $bukti)
    {
        $namafile = $bukti->bukti_pembayaran;
        $update = [
          
            'bukti_pembayaran' => $namafile,
            'nama' => $request->nama,
            'email' => $request->email,
            
        ];
        if ($request->bukti_pembayaran != "") {
            $request->bukti_pembayaran->move('file/bukti', $namafile);
        }
        $bukti->update($update);
        return redirect()->route('bukti.index')->with('Sukses', 'Berhasil Edit bukti');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hapus = Bukti::findorfail($id);
        $namafile = $hapus->bukti_pembayaran;
        $file = ('file/bukti/') . $namafile;
        // cek file:
        if (file_exists($file)) {
            @unlink($file);
        }
        // delete data dri database
        $hapus->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Data Bukti Pembayaran');
    }
}
