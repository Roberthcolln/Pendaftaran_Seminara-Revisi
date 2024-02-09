<style>
  td {
    text-align: center;
  }

  tr {
    text-align: center;
  }

  th {
    text-align: center;
  }
</style>

@extends('layouts.admin')
@section('content')
<?php
$title = 'Home';
?>
<div class="container-fluid">


  <!-- Small boxes (Stat box) -->
  <div class="row">
    @if(Auth::user()->id == 1)
    <table id="" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Kategori Peserta</th>
          <th>Jumlah Peserta</th>

        </tr>
      </thead>
      <tbody class="overflow-x-auto">

        @foreach($result as $item)
        <tr>

          <td>{{ $item->nama_kategori_anggota }}</td>
          <td>{{ $item->jumlah_user }} Orang</td>
        </tr>
        @endforeach

      </tbody>
    </table>
    <div class="col-lg-6 col-6">
      <!-- small box -->
      <div class="small-box bg-secondary">
        <div class="inner">
          <h3>{{$peserta}}</h3>
          <p>Jumlah Peserta</p>
        </div>
        <div class="icon">
          <i class="fas fa-user"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-6 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>Rp. {{number_format($pendapatan)}}<sup style="font-size: 20px"></sup></h3>
          <p>Jumlah Pendapatan</p>
        </div>
        <div class="icon">
          <i class="fas fa-money-check-alt"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>





    <!-- <div class="col-lg-4 col-6">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3><sup style="font-size: 20px"></sup></h3>
          <p>Jumlah Peserta Perpaket</p>
        </div>
        <div class="icon">
          <i class="fas fa-print"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div> -->
    @else(Auth::user()->id > 1)
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
                        <a class="dropdown-item" href="{{url('bukti_user')}}">Transfer Bank</a>
                        <a class="dropdown-item" href="{{url('reservasi_user')}}">Midtrans</a>
                        
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
    @endif
  </div>
</div>
<!-- ./col -->


@endsection