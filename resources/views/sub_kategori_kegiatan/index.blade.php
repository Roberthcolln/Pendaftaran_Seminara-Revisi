@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <a href="{{ route('sub_kategori_kegiatan.create') }}" class="btn btn-dark btn-sm" style="float: right;"><i class="fas fa-plus"></i> Tambah</a>
                </div>
                <div class="card-body table table-responsive">
                    @if ($message = Session::get('Sukses'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <table class="table table-bordered" id="example2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori Kegiatan</th>
                                <th>Sub Kategori Kegiatan</th>
                                <th>Aksi</th>
                            </tr>
                            <tbody>
                            @foreach ($sub_kategori_kegiatan as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->nama_kategori_kegiatan }}</td>
                                <td>{{ $row->nama_sub_kategori_kegiatan }}</td>
                                <td>
                                    <a href="{{ route('sub_kategori_kegiatan.edit', $row->id_sub_kategori_kegiatan) }}" class="btn btn-primary btn-xs" style="display: inline-block"><i class="fas fa-edit">Edit</i></a>
                                    <form action="{{ route('sub_kategori_kegiatan.destroy', $row->id_sub_kategori_kegiatan) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-xs btn-flat show_confirm"><i class="fas fa-trash"> Delete</i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection