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
                    <form action="{{ route('reservasi.update', $reservasi->id_reservasi) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2">
                        <!-- <label for="">Kategori Peserta</label> -->
                        <input type="text" class="form-control" name="id_kategori_anggota" value="{{ $reservasi->id_kategori_anggota }}" hidden>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Nama Peserta</label>
                        <input type="text" class="form-control" name="nama" value="{{ $reservasi->nama }}" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" value="{{ $reservasi->email }}" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">No HP</label>
                        <input type="text" class="form-control" name="no_hp" value="{{ $reservasi->no_hp }}" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <!-- <label for="">Kegiatan</label> -->
                        <input type="text" class="form-control" name="id_kegiatan" value="{{ $reservasi->id_kegiatan }}" hidden>
                    </div>
                    <div class="form-group mb-2">
                        <!-- <label for="">Paket</label> -->
                        <input type="text" class="form-control" name="id_paket" value="{{ $reservasi->id_paket }}" hidden>
                    </div>
                    <div class="form-group mb-2">
                        <!-- <label for="">Kupon</label> -->
                        <input type="text" class="form-control" name="id_kupon" value="{{ $reservasi->id_kupon }}" hidden>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Harga</label>
                        <input type="text" class="form-control" name="harga_paket" value="{{ $reservasi->harga_paket }}" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <!-- <label for="">Potongan Harga</label> -->
                        <input type="text" class="form-control" name="potongan_harga" value="{{ $reservasi->potongan_harga }}" hidden>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Foto <abbr title="" style="color: black">*</abbr> </label>
                        <input id="inputImg" type="file" accept="image/*" name="bukti_pembayaran" class="form-control">
                        <img class="d-none w-25 h-25 my-2" id="previewImg" src="#" alt="Preview image">
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
@section('script')
@section('script')
<script>
    document.getElementById('inputImg').addEventListener('change', function() {
        // Get the file input value and create a URL for the selected image
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').setAttribute('src', e.target.result);
                document.getElementById('previewImg').classList.add("d-block");
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>

@endsection
@endsection