@extends('layouts.admin')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $title }}</h3>
          <a href="{{ route('bukti.create') }}" class="btn btn-dark btn-sm" style="float: right"><i class="fas fa-plus"></i> Tambah</a>
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
                <th>Nama Peserta</th>
                <th>Email</th>
                <th>Bukti Pembayaran</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="overflow-x-auto">
              @foreach ($bukti as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  {{ $row->nama }}
                </td>
                <td>{{ $row->email }}</td>
                
                <td><img src="{{ asset('file/bukti/'.$row->bukti_pembayaran) }}" alt="" class="img-fluid" style="width:200px; height:200px; max-width:100%;"></td>
                <td><a href="{{ route('bukti.edit', $row->id_bukti) }}" class="btn btn-primary btn-xs" role="button" style="display: inline-block"><i class="fas fa-edit">Edit</i></a>
                <form action="{{ route('bukti.destroy', $row->id_bukti) }}" method="POST" style="display: inline-block">
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