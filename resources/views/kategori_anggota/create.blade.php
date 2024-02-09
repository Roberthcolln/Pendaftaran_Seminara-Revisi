@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error!</strong> 
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('kategori_anggota.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="">Nama Kategori Anggota</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama kategori anggota disini..." name="nama_kategori_anggota">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection