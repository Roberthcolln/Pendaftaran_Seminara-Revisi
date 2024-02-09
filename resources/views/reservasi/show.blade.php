@extends('layouts.admin')
@section('content')
<div class="reservasi">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <!-- <h3 class="card-title">{{ $title }} </h3> -->
                <a href="{{ route('reservasi.index') }}" class="btn btn-warning" style="float: right;"><i class="fas fa-backward"></i> Kembali</a>
            </div>
            <div class="card-body table table-responsive">
                <table class="table">



                    <tr>
                        <th style="width: 30%;">QR Code </th>
                        <th style="width: 20px;">:</th>
                        <td>
                            {!! QrCode::size(100)->generate($reservasi->nama) !!}
                        </td>
                    </tr>

                    <tr>
                        <th style="width: 30%;">Kegiatan </th>
                        <th style="width: 20px;">:</th>
                        <td>
                            {{ $reservasi->nama_kegiatan }}
                        </td>
                    </tr>

                    <tr>
                        <th style="width: 30%;">Paket </th>
                        <th style="width: 20px;">:</th>
                        <td>{{ $reservasi->nama_paket }} </td>
                    </tr>

                    <tr>
                        <th style="width: 30%;">Kategori Peserta </th>
                        <th style="width: 20px;">:</th>
                        <td>
                            {{ $reservasi->nama_kategori_anggota }}
                            
                        </td>
                    </tr>

                    <tr>
                        <th style="width: 30%;">Nama Peserta</th>
                        <th style="width: 20px;">:</th>
                        <td>{{ $reservasi->nama }} </td>
                    </tr>

                    <tr>
                        <th style="width: 30%;">Email & No Handphone</th>
                        <th style="width: 20px;">:</th>
                        <td>{{ $reservasi->email }} || {{$reservasi->no_hp}}</td>
                    </tr>


                    <tr>
                        <th style="width: 30%;">Harga Pendaftaran </th>
                        <th style="width: 20px;">:</th>
                        <td>Rp. {{number_format ($reservasi->harga_paket) }} </td>
                    </tr>

                    <tr>
                        <th style="width: 30%;">Kode Kupon </th>
                        <th style="width: 20px;">:</th>
                        <td>{{$reservasi->kode_kupon}}</td>
                    </tr>

                    

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection