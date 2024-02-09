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
                <form action="{{ route('kupon.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="">Pilih Paket</label>
                        <select name="id_paket" id="dropdown">
                            <option value=""></option>
                            @foreach ($paket as $item)
                            <option value="{{ $item->id_paket }}">{{ $item->nama_paket }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Kode Kupon <abbr title="" style="color: black">*</abbr></label>
                        <input type="text" class="form-control" placeholder="Masukkan Kode Kupon disini...." name="kode_kupon">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Potongan Harga <abbr title="" style="color: black">*</abbr> </label>
                        <input type="number" name="potongan_harga" id="money" class="form-control">
                    </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-dark"><i class="fas fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
{{-- <script>
    // $('#money').mask("#,##0.000.000", {reverse: false});
</script> --}}
{{-- <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ),{
            ckfinder: {
                uploadUrl: '{{route('image.upload').'?_token='.csrf_token()}}',
}
})
.catch( error => {
console.error( error );
} );
</script>
<script>
    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script> --}}
@endsection