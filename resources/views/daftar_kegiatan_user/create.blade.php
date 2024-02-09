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

                @if ($message = Session::get('Sukses'))
                <div class="alert alert-success">
                    <p class="m-0">{{ $message }}</p>
                </div>
                @endif
                <form class="row g-3" action="{{ route('daftar_kegiatan_user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="form-group mb-2 col-md-4">
                        <label for="">Peserta</label>
                        <select class="form-control" name="user" disabled>
                            <option selected value="{{$user->id}}">{{ Auth::user()->name }} </option>
                        </select>
                    </div>
                    <div class="form-group mb-2 col-md-4">
                        <label for="">Email</label>
                        <select class="form-control" name="user" disabled>
                            <option selected value="{{$user->id}}"> {{ Auth::user()->email }}</option>
                        </select>
                    </div>
                    <div class="form-group mb-2 col-md-4">
                        <label for=""> Kategori Peserta</label>
                        <select name="id_kategori_anggota" id="sub-dd" class="form-control">
                            <option value=""></option>
                            @foreach ($kategori_anggota as $row)
                            <option value="{{ $row->id_kategori_anggota }}">{{ $row->nama_kategori_anggota }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2 col-md-4">
                        <label for=""> Nama Kegiatan</label>
                        <select name="id_kegiatan" id="sub-dd" class="form-control">
                            <option value=""></option>
                            @foreach ($kegiatan as $row)
                            <option value="{{ $row->id_kegiatan }}">{{ $row->nama_kegiatan }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2 col-md-4">
                        <label for=""> Tanggal Kegiatan</label>
                        <select name="tanggal_kegiatan" id="sub-dd" class="form-control">
                            <option value=""></option>
                            @foreach ($kegiatan as $row)
                            <option value="{{ $row->tanggal_kegiatan }}">{{ Carbon\Carbon::parse($row->tanggal_kegiatan)->isoFormat('dddd,D MMMM Y') }} / {{$row->jam_kegiatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2 col-md-4">
                        <label for=""> Biaya Kegiatan</label>
                        <select name="biaya_kegiatan" id="sub-dd" class="form-control">
                            <option value=""></option>
                            @foreach ($kegiatan as $row)
                            <option value="{{ $row->biaya_kegiatan }}"> Rp. {{number_format($row->biaya_kegiatan)}} </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group mb-2 col-md-4">
                        <label for=""> Potongan Harga</label>
                        <select name="potongan_harga" id="sub-dd" class="form-control">
                            <option value=""></option>
                            @foreach ($kegiatan as $row)
                            <option value="{{ $row->potongan_harga }}"> Rp. {{number_format($row->potongan_harga)}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2 col-md-4">
                        <label for="">Kupon *potongan harga </label>
                        <input type="text" name="kupon" class="form-control" value="{{ old('kupon') }}">
                    </div>
                    <div class="form-group mb-2 col-md-4">
                        <label for="">Bukti Pembayaran Pendaftaran<abbr title="" style="color: black">*</abbr> </label>
                        <input id="inputImg" type="file" accept="image/*" name="bukti_pembayaran" class="form-control"/>
                        <img class="d-none w-25 h-25 my-2" id="previewImg" src="#" alt="Preview image">
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection