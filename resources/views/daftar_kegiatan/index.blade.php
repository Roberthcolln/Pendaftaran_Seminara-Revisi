@extends('layouts.admin')
@section('content')

<style>
  .strikethrough {
    text-decoration: line-through;
  }




  .spinner-container {
    position: relative;
  }

  .vibrating-span {

    font-size: 18px;

  }

  @keyframes vibrate {
    0% {
      transform: translateX(0);
    }

    25% {
      transform: translateX(5px);
    }

    50% {
      transform: translateX(0);
    }

    75% {
      transform: translateX(-5px);
    }

    100% {
      transform: translateX(0);
    }
  }

  td {
    text-align: center;
  }

  th {
    text-align: center;
  }
</style>


<div class="container-fluid">
  <div class="row">
    <div class="col-12">
    <form action="{{ route('daftar_kegiatan.index') }}" method="get">
        <div class="row mb-5">
          <div class="col-sm-4">
            <label for=""> Filter Kegiatan</label>
            <select name="keyword"  id="dropdown1" class="form-control">
              <option value="" id="dropdown"></option>
              @foreach ($select as $row)
              <option value="{{ $row->id_kategori_anggota }}">{{($row->nama_kategori_anggota)}}</option>
              @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-primary mt-4">Search</button>
        </div>
      </form>
      <div class="card">
        <div class="card-header">
          <a href="{{ route('daftar_kegiatan.create') }}" class="btn btn-dark btn-sm" style="float: right"><i class="fas fa-plus"></i> Tambah</a>
        </div>
        <div class="card-body">
          @if ($message = Session::get('Sukses'))
          <div class="alert alert-success">
            <p class="m-0">{{ $message }}</p>
          </div>
          @endif
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>QR</th>
                <th>Nama Kegiatan</th>
                <th>Peserta</th>
                <th>Email</th>
                <th>Tanggal Kegiatan</th>
                <th>Biaya Kegiatan</th>
                <th>Bukti Pembayaran</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="overflow-x-auto">

              @foreach ($daftar_kegiatan as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{!! QrCode::size(100)->generate($row->name); !!} </td>
                <td>{{ $row->nama_kegiatan }}</td>
                <td>
                  {{ $row->name }} ({{$row->nama_kategori_anggota}})

                </td>
                <td>
                  {{ $row->email }}

                </td>
                <td>{{ Carbon\Carbon::parse($row->tanggal_kegiatan)->isoFormat('dddd,D MMMM Y') }} <span class="badge badge-info">{{$row->jam_kegiatan }}</span> </td>

                @if($row->kupon == $kegiatan->kupon )
                <td>
                  <span class=" strikethrough badge badge-danger">Rp. {{ number_format($kegiatan->biaya_kegiatan)}}</span> <span class="vibrating-span badge badge-success">Rp. {{ number_format($row->biaya_kegiatan) }}</span>
                </td>
                @elseif($row->kupon === null)
                <td>
                  <span class="vibrating-span badge badge-success">Rp. {{ number_format($kegiatan->biaya_kegiatan) }}</span>
                </td>
                @else
                <td>
                  <span class="vibrating-span badge badge-success">Rp. {{ number_format($kegiatan->biaya_kegiatan) }}</span>
                </td>
                @endif

                @if($row->bukti_pembayaran === null)
                <td><h5><span class="badge badge-warning">Tidak Ada Bukti Pembayaran</span></h5></td>
                @else
                <td><img src="{{ asset('file/pembayaran/'.$row->bukti_pembayaran) }}" alt="" class="img-fluid" style="width:200px; height:200px; max-width:100%;"></td>
                @endif
                

                <td>
                  <a href="{{ route('daftar_kegiatan.edit', $row->id_daftar_kegiatan) }}" class="btn btn-primary btn-xs" role="button" style="display: inline-block"><i class="fas fa-edit">Edit</i><br>
                    <a href="{{ route('order.index') }}" class="btn btn-warning btn-xs" style="display: inline-block"> <i class="fas fa-eye"> Pembayaran</i></a>
                  </a>
                  <form action="{{ route('daftar_kegiatan.destroy', $row->id_daftar_kegiatan) }}" method="POST" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" value="Button" title="Delete" class="btn btn-danger btn-xs btn-flat show_confirm"><i class="fas fa-trash">Delete</i></button>
                  </form>
                </td>
              </tr>
              @endforeach


            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
@endsection