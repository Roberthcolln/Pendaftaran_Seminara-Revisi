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
                    <form action="{{ route('paket.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group mb-2">
                            <label for="">Nama Paket <abbr title="" style="color: black">*</abbr></label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Paket disini...." name="nama_paket">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Harga Paket <abbr title="" style="color: black">*</abbr> </label>
                            <input type="number" name="harga_paket" id="money" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Deskripsi Paket</label>
                            <textarea name="deskripsi_paket" id="editor" cols="30" rows="10" class="form-control"></textarea>
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
      CKEDITOR.replace( 'editor', {
          filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token() ])}}",
          filebrowserUploadMethod: 'form'
      });
  </script> --}}
@endsection