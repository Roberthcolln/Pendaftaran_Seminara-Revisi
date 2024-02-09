@extends('layouts.admin')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $title }}</h3>
          <button type="button" class="btn btn-dark btn-sm" style="float: right;"><a class="text-white"
              href="{{route('kupon.create')}}"><i class="fas fa-plus"> Tambah</i></a></button>
        </div>
        <div class="card-body">
          @if ($message = Session::get('Sukses'))
          <div class="alert alert-success">
            <p class="m-0">{{ $message }}</p>
          </div>
          @endif
          @if ($message = Session::get('Delete'))
          <div class="alert alert-danger">
            <p class="m-0">{{ $message }}</p>
          </div>
          @endif
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Paket</th>
                <th>Kode Kupon</th>
                <th>Potongan Harga</th>
                <th>action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kupon as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama_paket }}</td>
                <td>{{ $row->kode_kupon }}</td>
                <td>Rp. {{ number_format($row->potongan_harga)  }}</td>
                <td><a href="{{ route('kupon.edit', $row->id_kupon) }}" class="btn btn-primary btn-xs" role="button" style="display: inline-block"><i class="fas fa-edit"> Update</i></a>
                  <form action="{{ route('kupon.destroy', $row->id_kupon) }}" method="POST" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" value="Button" title="Delete"
                      class="btn btn-danger btn-xs btn-flat show_confirm"><i class="fas fa-trash"> Destroy</i></button>
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