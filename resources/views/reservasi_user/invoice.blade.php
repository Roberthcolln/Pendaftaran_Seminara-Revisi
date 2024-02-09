<?php

use Illuminate\Support\Facades\DB;
use App\Models\KategoriAnggota;
use App\Models\Kegiatan;

$kategori_anggota = KategoriAnggota::all();
$kegiatan = Kegiatan::all();
$konf = DB::table('setting')->first();
$reservasi = DB::table('reservasi')
  ->join('kegiatan', 'reservasi.id_kegiatan', 'kegiatan.id_kegiatan')
  ->join('kategori_anggota', 'reservasi.id_kategori_anggota', 'kategori_anggota.id_kategori_anggota')
  ->first();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tagihan Pembayaran</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    #invoice {
      width: 80%;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
    }

    .company-info {
      margin-top: 20px;
      text-align: center;
    }

    .invoice-header,
    .invoice-body,
    .invoice-footer {
      margin-bottom: 20px;
    }

    .invoice-header h2 {
      color: #333;
    }

    .invoice-body table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    .invoice-body th,
    .invoice-body td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }


    .invoice-footer p {
      text-align: right;
    }
  </style>
</head>

<div id="invoice">
  <div class="invoice-header">
    <div class="header">
      <img src="{{ $konf->logo_setting }}" style="width: 20%;" alt="Gambar" >
      <div class="company-info">
        <h1>{{$konf->instansi_setting}}</h1>
        <p>{{$konf->alamat_setting}}</p>
        <p>{{$konf->email_setting}}</p>
        <p>{{$konf->no_hp_setting}}</p>
      </div>
    </div>
    <hr style="border: 3px solid #a5cd7d" />
    <center>
      <h2>INVOICE</h2>
    </center>
    
    <p>Nama Peserta : {{$reservasi->nama}}</p>
    <p>Kategori Peserta : {{$reservasi->nama_kategori_anggota}}</p>
    <p>Status : Terdaftar</p>
    
    
  </div>

  <div class="invoice-body">
    <table>
      <thead>
        <tr>
          <th>Nama Kegiatan</th>
          <th>Peserta</th>
          <th>Biaya Kegiatan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$reservasi->nama_kegiatan}}</td>
          <td>{{$reservasi->nama}} <span class="badge badge-success">{{$reservasi->email}}</span></td>


          <td>{{ number_format($reservasi->harga_paket)}}</td>
        </tr>
        <tr>


          <td></td>
          <td><b>Total Biaya Pendaftaran</b></td>
          <td><b>{{ number_format($reservasi->harga_paket)}}</b></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="">
    <p>Please complete payment :</p>


    <br />
    <p>Silahkan Login/ Registrasi Untuk Melakukan <a href="{{url('login')}}"> Pembayaran</a></p>
  </div>
</div>

</html>