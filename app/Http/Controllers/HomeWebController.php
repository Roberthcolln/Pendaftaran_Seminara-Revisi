<?php

namespace App\Http\Controllers;

use App\Models\KategoriKegiatan;
use App\Models\DaftarKegiatan;
use App\Models\Setting;
use App\Models\KategoriAnggota;
use App\Models\SubKategoriKegiatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\pdfMail;
use App\Models\Kupon;
use App\Models\Paket;
use PDF;
use App\Models\Reservasi;
use App\Models\Bukti;

class HomeWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kegiatan = Kegiatan::all();
        $kategori_anggota = KategoriAnggota::all();
        $kupon = Kupon::all();
        $paket = Paket::all();
        $reservasi = DB::table('reservasi')
            ->join('paket', 'reservasi.id_paket', '=', 'paket.id_paket') // Ganti 'id_paket' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel paket
            ->join('kategori_anggota', 'reservasi.id_kategori_anggota', '=', 'kategori_anggota.id_kategori_anggota') // Ganti 'id_kategori_anggota' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kategori_anggota
            ->join('kegiatan', 'reservasi.id_kegiatan', '=', 'kegiatan.id_kegiatan') // Ganti 'id_kegiatan' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kegiatan
            ->leftJoin('kupon', 'reservasi.kode_kupon', '=', 'kupon.kode_kupon') // Ganti 'id_kupon' dan 'id' sesuai dengan kolom kunci asing dan utama pada tabel kupon
            ->select('reservasi.*', 'paket.nama_paket', 'kategori_anggota.nama_kategori_anggota', 'kegiatan.nama_kegiatan', 'kupon.kode_kupon')
            ->get();
        $title = 'Data Reservasi';
        return view('welcome', compact('title', 'kategori_anggota', 'kegiatan', 'kupon', 'paket', 'reservasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'id_kategori_anggota' => 'required',
            'id_kegiatan' => 'required',
            'id_paket' => 'required|exists:paket,id_paket',


        ]);
        

        $paket = Paket::find($request->id_paket);
        $kupon = Kupon::where('kode_kupon', $request->kode_kupon)->first();

        // Cek apakah kupon tersedia untuk paket tertentu
        if ($kupon && $kupon->id_paket == $paket->id_paket) {
            // Hitung harga baru setelah potongan
            $hargaBaru = $paket->harga_paket - $kupon->potongan_harga;

            $reservasi = new Reservasi([
                'id_paket' => $paket->id_paket,
                'kode_kupon' => $kupon->kode_kupon,
                'harga_paket' => $hargaBaru,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'id_kegiatan' => $request->id_kegiatan,
                'id_kategori_anggota' => $request->id_kategori_anggota,
                'potongan_harga' => $kupon->potongan_harga,
            ]);


            // Simpan reservasi
            $reservasi->save();

            // Response atau redirect ke halaman lain

            $data = [
                'email' => $reservasi->email,
                'nama' => $reservasi->nama,
                'subject' => 'Invoice Pendaftaran',
                'title' => 'Invoice Pendaftaran Seminar',
                'body' => 'hallo',
            ];

            ini_set('max_execution_time', 120);
            $pdf = PDF::loadView('reservasi.invoice', $data);

            $data['pdf'] = $pdf;
            Mail::to($data['email'])->send(new pdfMail($data));

            return redirect()->back()->with('Sukses', 'Pendaftaran Sukses!! Silahkan Cek Email Anda');
        } else {
            // If coupon is not valid or not provided, proceed without discount
            $reservasi = new Reservasi([
                'id_paket' => $paket->id_paket,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'id_kegiatan' => $request->id_kegiatan,
                'id_kategori_anggota' => $request->id_kategori_anggota,
                'harga_paket' => $paket->harga_paket, // No discount applied
            ]);
    
            // Simpan reservasi
            $reservasi->save();
    
            // Response atau redirect ke halaman lain
            $data = [
                'email' => $reservasi->email,
                'subject' => 'Invoice Pendaftaran',
                'title' => 'Form Portfgrammer',
                'body' => 'hallo',
            ];

            ini_set('max_execution_time', 120);
            $pdf = PDF::loadView('reservasi.invoice', $data);

            $data['pdf'] = $pdf;
            Mail::to($data['email'])->send(new pdfMail($data));
            
            return redirect()->back()->with('Sukses', 'Pendaftaran Sukses!! Silahkan Cek Email Anda (Tanpa Potongan Harga)');
        }
    }


    // public function upload(Request $request)
    // {
    //     $request->validate([
    //         'bukti_pembayaran' => 'required:jpg, jpeg, png, gif, raw, tiff',
    //         'nama' => 'required',
    //         'email' => 'required',

    //     ]);
    //     $file = $request->file('bukti_pembayaran');
    //     $namafile = 'Bukti Pembayaran' . date('Ymdhis') . '.' . $request->file('bukti_pembayaran')->getClientOriginalExtension();
    //     $file->move('file/bukti/', $namafile);

    //     $bukti = new Bukti();
    //     $bukti->bukti_pembayaran = $namafile;
    //     $bukti->nama = $request->nama;
    //     $bukti->email = $request->email;
    //     $bukti->save();
    //     return redirect()->back()->with('Sukses', 'Berhasil Tambah Bukti');
    // }
}
