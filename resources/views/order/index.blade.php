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
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group mb-2">
                            <label for="">Nama Peserta<abbr title="" style="color: black">*</abbr></label>
                            <input type="text" class="form-control" placeholder="Masukan sesuai dengan nama pendaftaran" name="nama">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Nomor Telepon <abbr title="" style="color: black">*</abbr> </label>
                            <input type="number" name="no_tlp" id="money" placeholder="08123456" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Biaya Pendaftaran <abbr title="" style="color: black">*</abbr> </label>
                            <input type="number" name="total_harga" id="money" placeholder="Masukan nominal sesuai harga pendaftaran" class="form-control">
                        </div>
                        
                </div>
                <div class="card-footer">
                    <button class="btn btn-dark"><i class="fas fa-chart"></i> Chekout</button>
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
