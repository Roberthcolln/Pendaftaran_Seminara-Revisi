

<?php

use Illuminate\Support\Facades\DB;

 $konf = DB::table('setting')->first();
 $user = DB::table('users')->first();
 $daftar_kegiatan = DB::table('daftar_kegiatans')
     ->join('kegiatan', 'daftar_kegiatans.id_kegiatan', '=', 'kegiatan.id_kegiatan')
     ->join('users', 'daftar_kegiatans.id', '=', 'users.id')
     ->join('kategori_anggota', 'daftar_kegiatans.id_kategori_anggota', 'kategori_anggota.id_kategori_anggota')
     ->select('daftar_kegiatans.*', 'kegiatan.nama_kegiatan', 'users.name', 'users.email', 'kategori_anggota.nama_kategori_anggota', 'kegiatan.tanggal_kegiatan', 'kegiatan.jam_kegiatan', 'kegiatan.biaya_kegiatan as biaya_kegiatan_kegiatan')
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
        <center><img src="{{asset ('logo/'.$konf->logo_setting)}}" style="width: 20%;"></center>
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
      <p> Tanggal Kegiatan  : {{ Carbon\Carbon::parse($daftar_kegiatan->tanggal_kegiatan)->isoFormat('dddd,D MMMM Y') }}</p> 
      <p>Nama Peserta : {{$daftar_kegiatan->name}}</p>
      <p>Kategori Peserta : {{$daftar_kegiatan->nama_kategori_anggota}}</p>
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
            <td>{{$daftar_kegiatan->nama_kegiatan}}</td>
            <td>{{$daftar_kegiatan->name}} <span class="badge badge-success">{{$daftar_kegiatan->email}}</span></td>
            
            
            <td>Rp. {{number_format($daftar_kegiatan->biaya_kegiatan)}}</td>
          </tr>
          <tr>
           
            
            <td></td>
            <td><b>Total Biaya Pendaftaran</b></td>
            <td><b>Rp. {{number_format($daftar_kegiatan->biaya_kegiatan)}}</b></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="">
      <p>Please complete payment :</p>
      

      <br />
      <p>Link <a href="{{route('order.index')}}"> Pembayaran</a></p>
    </div>
  </div>
</html>
