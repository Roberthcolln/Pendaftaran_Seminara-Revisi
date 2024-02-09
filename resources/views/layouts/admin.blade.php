<?php
$konf = DB::table('setting')->first();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="content">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @if (Auth::user()->id == 1)
  <title>Admin {{$konf->instansi_setting}} </title>
  @elseif (Auth::user()->id > 1)
  <title>Peserta {{$konf->instansi_setting}}</title>
  @endif

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="icon" href="{{asset ('favicon/',$konf->favicon_setting)}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="icon" href="{{ asset('favicon/'.$konf->favicon_setting) }}">
  <!--  Toastr  -->

  {{-- midtrans --}}
  <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.clientKey')}}"></script>
  <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="{{ asset('js/sweetalert.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
  <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
  <style>
    .select2 {
      width: 100% !important;
      height: 100%;
    }

    @media (min-width: 768px) {
      .w-md-50 {
        width: 50%;
      }
    }
  </style>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li align="center" class="well px-2" style="">
              <a href="{{ route('profile.show') }}" class="btn btn-sm btn-dark form-control mb-1"><span class="glyphicon glyphicon-lock"></span> Profile</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
              this.closest('form').submit();" class="btn btn-sm btn-danger form-control">Logout</a>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      {{-- <a href="{{ route('home.index') }}" class="brand-link"> --}}
      {{-- <a href="#" class="d-flex justify-content-center brand-link ">
          <span class="brand-text font-weight-light"><img src="{{ asset('img/logo.png') }}" style="width: 120px;"
      alt=""></span>
      </a> --}}

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <svg width="32px" height="32px" viewBox="-1.5 -1.5 18.00 18.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#fffafa">
              <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(1.5749999999999993,1.5749999999999993), scale(0.79)">
                <rect x="-1.5" y="-1.5" width="18.00" height="18.00" rx="9" fill="#ffffff" strokewidth="0"></rect>
              </g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path d="M5 5.5C5 4.11929 6.11929 3 7.5 3C8.88071 3 10 4.11929 10 5.5C10 6.88071 8.88071 8 7.5 8C6.11929 8 5 6.88071 5 5.5Z" fill="#000000"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 0C3.35786 0 0 3.35786 0 7.5C0 11.6421 3.35786 15 7.5 15C11.6421 15 15 11.6421 15 7.5C15 3.35786 11.6421 0 7.5 0ZM1 7.5C1 3.91015 3.91015 1 7.5 1C11.0899 1 14 3.91015 14 7.5C14 9.34956 13.2275 11.0187 11.9875 12.2024C11.8365 10.4086 10.3328 9 8.5 9H6.5C4.66724 9 3.16345 10.4086 3.01247 12.2024C1.77251 11.0187 1 9.34956 1 7.5Z" fill="#000000"></path>
              </g>
            </svg>
            </span>
            {{-- @endif --}}
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
          </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if (Auth::user()->id == 1)
            <li class="nav-item">
              <a href="{{route('dashboard.index')}}" class="{{ request()->is('panel/admin') ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-folder"></i>
                <p>
                  Master Kategori
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">


                <li class="nav-item">
                  <a href="{{route('kategori_kegiatan.index')}}" class="{{ request()->is('panel/kategori_kegiatan*') ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon far fa-circle"></i>
                    <p>
                      Kategori kegiatan
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('sub_kategori_kegiatan.index')}}" class="{{ request()->is('panel/sub_kategori_kegiatan*') ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon far fa-circle"></i>
                    <p>
                      Sub Kategori kegiatan
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('kategori_anggota.index')}}" class="{{ request()->is('panel/kategori_anggota*') ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon far fa-circle"></i>
                    <p>
                      Kategori Anggota
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-folder"></i>
                <p>
                  Master Seminar
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('kegiatan.index')}}" class="{{ request()->is('panel/kegiatan*') ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon far fa-circle"></i>
                    <p>
                      kegiatan
                    </p>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a href="{{route('daftar_kegiatan.index')}}" class="{{ request()->is('panel/daftar_kegiatan*') ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon far fa-circle"></i>
                    <p>
                      Pendaftaran
                    </p>
                  </a>
                </li> -->
                <li class="nav-item">
                  <a href="{{route('reservasi.index')}}" class="{{ request()->is('panel/daftar_kegiatan*') ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon far fa-circle"></i>
                    <p>
                      Reservasi
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('kupon.index')}}" class="{{ request()->is('panel/daftar_kegiatan*') ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon far fa-circle"></i>
                    <p>
                      Kupon
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('paket.index')}}" class="{{ request()->is('panel/daftar_kegiatan*') ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon far fa-circle"></i>
                    <p>
                      Paket
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('metode.index')}}" class="{{ request()->is('panel/daftar_kegiatan*') ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon far fa-circle"></i>
                    <p>
                      Metode Pembayaran
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('list_pembayaran.index')}}" class="{{ request()->is('panel/daftar_kegiatan_user*') ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon far fa-circle"></i>
                    <p>
                      List Pembayaran
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{route('presensi_peserta.index')}}" class="{{ request()->is('panel/order*') ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon far fa-circle"></i>
                    <p>
                      Presensi Peserta
                    </p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a href="{{route('setting.index')}}" class="{{ request()->is('partner') ? 'nav-link active' : 'nav-link'}}">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                  Setting
                </p>
              </a>
            </li>
            @elseif(Auth::user()->id > 1)
            <!-- <li class="nav-item">
              <a href="{{route('metode.index')}}" class="{{ request()->is('panel/daftar_kegiatan*') ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                  Metode Pembayaran
                </p>
              </a>
            </li> -->
            <!-- <li class="nav-item">
              <a href="{{route('order.index')}}" class="{{ request()->is('panel/order*') ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-digital-tachograph"></i>
                <p>
                  Pembayaran
                </p>
              </a>
            </li> -->
            @endif
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          Waktu Server Saat Ini:
          <p>
            <?php $tg = date('Y-m-d');
            echo Carbon\Carbon::parse($tg)->isoFormat('dddd, D MMMM Y'); ?> <span id="clock"></span>
          </p>
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>{{ $title }}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                {{-- <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li> --}}
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        @yield('content')
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
      </div>
      {{-- <strong>Copyright &copy;
        <?php $cpy = date('Y');
        echo $cpy; ?><a href="http://roberth.my-style.in" target="_blank"> Portfgrammer</a>.
      </strong> All rights reserved. --}}
      <strong>Copyright &copy;
        <?php $cpy = date('Y');
        echo $cpy; ?><a href="http://roberth.my-style.in" target="_blank"> Portfgrammer</a>.
      </strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- JQVMap -->
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
  {{-- livesearch --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  {{-- additional js script --}}
  @yield('addjs')
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        "buttons": ["csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
      $('#example3').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
      $('#example4').DataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "searching": true,
        "lengthChange": true,
        "autoWidth": true,
        "responsive": true,
        "language": {
          "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
          "sEmptyTable": "Tidak ada data di database"
        }
      });
      $('#example5').DataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "searching": true,
        "lengthChange": true,
        "autoWidth": true,
        "responsive": true,
        "language": {
          "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
          "sEmptyTable": "Tidak ada data di database"
        }
      });
    });
  </script>
  <script>
    function showTime() {
      var a_p = "";
      var today = new Date();
      var curr_hour = today.getHours();
      var curr_minute = today.getMinutes();
      var curr_second = today.getSeconds();
      if (curr_hour < 12) {
        a_p = "AM";
      } else {
        a_p = "PM";
      }
      if (curr_hour == 0) {
        curr_hour = 24;
      }
      if (curr_hour > 24) {
        curr_hour = curr_hour - 24;
      }
      curr_hour = checkTime(curr_hour);
      curr_minute = checkTime(curr_minute);
      curr_second = checkTime(curr_second);
      document.getElementById('clock').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
    }

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }
    setInterval(showTime, 500);
  </script>
  <script type="text/javascript">
    $('.show_confirm').click(function(event) {
      var form = $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
          title: `Yakin ingin menghapus data ini?`,
          text: "Jika di hapus maka data ini akan hilang.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
          }
        });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#kegiatan-dd').on('change', function() {
        var idKegiatan = this.value;
        $("#sub-dd").html('');
        $.ajax({
          url: "{{url('api/fetch-kegiatan')}}",
          type: "POST",
          data: {
            id_kategori_kegiatan: idKegiatan,
            _token: '{{csrf_token()}}'
          },
          dataType: 'json',
          success: function(result) {
            $('#sub-dd').html('<option value="">Select Sub Kategori Kegiatan</option>');
            $.each(result.sub_kategori_kegiatan, function(key, value) {
              $("#sub-dd").append('<option value="' + value
                .id_sub_kategori_kegiatan + '">' + value.nama_sub_kategori_kegiatan + '</option>');
            });
            $('#sub_sub-dd').html('<option value="">Select Sub Sub</option>');
          }
        });
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#event-dd').on('change', function() {
        var idKegiatan = this.value;
        $("#coupon-dd").html('');
        $.ajax({
          url: "{{url('api/fetch-paket')}}",
          type: "POST",
          data: {
            id_paket: idKegiatan,
            _token: '{{csrf_token()}}'
          },
          dataType: 'json',
          success: function(result) {
            $('#coupon-dd').html('<option value="">Select Kode Kupon</option>');
            $.each(result.kupon, function(key, value) {
              $("#coupon-dd").append('<option value="' + value
                .id_kupon + '">' + value.kode_kupon + '</option>');
            });
            $('#sub_coupon-dd').html('<option value="">Select Sub Sub</option>');
          }
        });
      });
    });
  </script>

  <script>
    $("#dropdown").select2({
      theme: "bootstrap4",
      placeholder: 'Silahkan pilih',
    });
  </script>
  <script>
    $("#dropdown2").select2({
      theme: "bootstrap4",
      placeholder: 'Silahkan pilih',
    });
  </script>
  <script type="text/javascript">
    function formatSearch(item) {
      var selectionText = item.text.split("|");
      var $returnString = $('<span>' + selectionText[0] + '</br><b>' + selectionText[1] + '</b></br>' + selectionText[2] + '</span>');
      return $returnString;
    };

    function formatSelected(item) {
      var selectionText = item.text.split("|");
      var $returnString = $('<span>' + selectionText[0].substring(0, 21) + '</span>');
      return $returnString;
    };
    $('#select2').select2({
      placeholder: "Silahkan Pilih Paket",
      theme: "bootstrap4",
      templateResult: formatSearch,
      templateSelection: formatSelected
    });
  </script>

</body>

</html>