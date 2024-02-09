@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
                <a href="{{ route('presensi_peserta.create') }}" id="scan" class="btn btn-dark btn-sm mr-2" style="float: right;"><i class="fas fa-list"></i> Absen Sekarang</a>
            </div>
            <div class="card-body table table-responsive">
                @if ($message = Session::get('Sukses'))
                <div class="alert alert-success">
                    <p class="m-0">{{ $message }}</p>
                </div>
                @endif
                <table class="table table-bordered" id="example1">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Peserta</th>
                            <th scope="col">Status Kehadiran</th>
                            <th scope="col">Waktu Presensi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data as $row )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->id_peserta}}</td>
                            <td>{{$row->status_kehadiran}}</td>
                            <td>{{ $row->waktu_presensi }}</td>
                            <td>
                                <form action="{{ route('presensi_peserta.destroy', $row->id) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" value="Button" title="Delete" class="btn btn-danger btn-xs btn-flat show_confirm"><i class="fas fa-trash"> Destroy</i></button>
                                </form>
                            </td>
                            <!-- <td>
                                <a href="{{ route('presensi_peserta.show', $row->id_peserta) }}" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i> Detail</a>
                            </td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection