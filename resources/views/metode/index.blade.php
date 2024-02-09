@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
            </div>
            <div class="card-body">

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Metode Pembayaran
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{url('bukti')}}">Transfer Bank</a>
                        <a class="dropdown-item" href="{{url('reservasi')}}">Midtrans</a>
                        
                    </div>
                </div>
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