@extends('layouts.admin')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $title }}</h3>
        </div>
        <div class="card-body">
          @if ($message = Session::get('Sukses'))
          <div class="alert alert-success">
            <p class="m-0">{{ $message }}</p>
          </div>
          @endif
          @if ($message = Session::get('Delete'))
          <div class="alert alert-danger">
            <p class="m-0">{{ $message }}</p>
          </div>
          @endif
          <div class="card" style="width: 18rem;">
            <div class="card-body">
           <center>{!! QrCode::size(100)->generate($order->nama) !!}</center> 
              <table class="mt-4">
                <tr>
                  <td>Nama Peserta</td>
                  <td> : {{$order->nama}}</td>
                </tr>
                
                <tr>
                  <td>Nomor Telepon</td>
                  <td> : {{$order->no_hp}}</td>
                </tr>
                <tr>
                  <td>Total Pembayaran</td>
                  <td> : Rp. {{number_format($order->total_harga)}}</td>
                </tr>
              </table>
              <button class="btn btn-primary mt-3" id="pay-button">Bayar Sekarang</button>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>


@endsection
@section('addjs')
<script type="text/javascript">
  // For example trigger on button clicked, or any time you need
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', function () {
    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
    window.snap.pay('{{$snapToken}}', {
      onSuccess: function(result){
        /* You may add your own implementation here */
        alert("payment success!"); console.log(result);
      },
      onPending: function(result){
        /* You may add your own implementation here */
        alert("wating your payment!"); console.log(result);
      },
      onError: function(result){
        /* You may add your own implementation here */
        alert("payment failed!"); console.log(result);
      },
      onClose: function(){
        /* You may add your own implementation here */
        alert('you closed the popup without finishing the payment');
      }
    })
  });
</script>
@endsection