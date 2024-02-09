<?php

namespace App\Http\Controllers;


use App\Models\BuktiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BuktiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukti_user = DB::table('bukti')
            ->get();
        $title = 'Data Bukti Pembayaran';
        return view('bukti_user.index', compact('title', 'bukti_user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bukti_user = BuktiUser::all();
        $title = 'Tambah Bukti Pembayaran';
        return view('bukti_user.create', compact( 'bukti_user', 'title'));
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

        $bukti = new BuktiUser();
        $bukti->bukti_pembayaran = $namafile;
        $bukti->nama = $request->nama;
        $bukti->email = $request->email;
        $bukti->save();
        return redirect()->route('bukti_user.index')->with('Sukses', 'Berhasil Tambah Bukti');
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
    public function edit(BuktiUser $bukti_user)
    {
       
        $title = 'Edit Bukti Pembayaran';
        return view('bukti_user.edit', compact( 'bukti_user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BuktiUser $bukti_user)
    {
        $namafile = $bukti_user->bukti_pembayaran;
        $update = [
          
            'bukti_pembayaran' => $namafile,
            'nama' => $request->nama,
            'email' => $request->email,
            
        ];
        if ($request->bukti_pembayaran != "") {
            $request->bukti_pembayaran->move('file/bukti', $namafile);
        }
        $bukti_user->update($update);
        return redirect()->route('bukti_user.index')->with('Sukses', 'Berhasil Edit bukti');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hapus = BuktiUser::findorfail($id);
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
