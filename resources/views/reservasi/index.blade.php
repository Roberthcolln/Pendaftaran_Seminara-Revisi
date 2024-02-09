@extends('layouts.admin')
@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
        <a href="{{ route('reservasi.create') }}" class="btn btn-dark btn-sm" style="float: right;"><i class="fas fa-plus"></i> Tambah</a>
      </div>
    </div>
    <div class="card-body">
      @if ($message = Session::get('Sukses'))
      <div class="alert alert-success">
        <p class="m-0">{{ $message }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </p>
      </div>
      @endif
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>

            <th>Nama</th>

            <th>Kegiatan</th>

            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="overflow-x-auto">
          @foreach ($reservasi as $row)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->nama_kegiatan }}</td>

           
            <td><a href="{{ url ('payment', $row->id_reservasi) }}" class="btn btn-primary btn-xs" role="button" style="display: inline-block"><i class="fas fa-edit">Payment</i></a>
              <a href="{{ route('reservasi.show', $row->id_reservasi) }}" class="btn btn-warning btn-xs" style="display: inline-block"><i class="fas fa-eye"> Detail</i></a>
              <form action="{{ route('reservasi.destroy', $row->id_reservasi) }}" method="POST" style="display: inline-block">
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

@endsection