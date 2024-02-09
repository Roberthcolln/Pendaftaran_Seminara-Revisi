@extends('layouts.admin')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $title }}</h3>
          <!-- <a href="{{ route('kegiatan.create') }}" class="btn btn-dark btn-sm" style="float: right"><i class="fas fa-plus"></i> Tambah</a> -->
        </div>
        <div class="card-body">
          @if ($message = Session::get('Sukses'))
          <div class="alert alert-success">
            <p class="m-0">{{ $message }}</p>
          </div>
          @endif
          <table id="example3" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>QR Code</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Harga Pembayaran</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody class="overflow-x-auto">
              @foreach ($pembayaran as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td><center>{!! QrCode::size(100)->generate($row->nama) !!}</center></td> 
                <td>
                  {{ $row->nama }}
                  
                </td>
                <td>{{ $row->no_hp }}</td>
                <td>Rp. {{ number_format ($row ->harga_paket) }} </td>
                <td><span class="badge badge-success">Sudah Bayar</span></td>
                
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