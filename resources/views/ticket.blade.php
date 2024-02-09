<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Festava Live - Ticket HTML Form</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;400;700&display=swap" rel="stylesheet">

    <link href="web/css/bootstrap.min.css" rel="stylesheet">

    <link href="web/css/bootstrap-icons.css" rel="stylesheet">

    <link href="web/css/templatemo-festava-live.css" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to update the price when a package is selected
            function updatePrice() {
                var selectedPackage = document.querySelector('input[name="id_paket"]:checked');
                if (selectedPackage) {
                    var price = selectedPackage.dataset.price;
                    document.getElementById('harga-paket').value = price;
                }
            }

            // Attach the updatePrice function to the change event of the package radio buttons
            var packageRadioButtons = document.querySelectorAll('input[name="id_paket"]');
            packageRadioButtons.forEach(function(radio) {
                radio.addEventListener('change', updatePrice);
            });

            // Trigger the updatePrice function on page load if a package is already selected
            updatePrice();
        });
    </script>


</head>

<body>
    <main>

        <section class="ticket-section section-padding">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-10 mx-auto">

                        <form class="row g-3 custom-form ticket-form mb-5 mb-lg-0" action="{{ route('home.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

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

                            <h2 class="text-center mb-4">Form Pendaftaran</h2>

                            <div class="ticket-form-body">
                                <div class="row">

                                    <div class="form-group mb-2 col-md-6">
                                        <select name="id_kegiatan" id="sub-dd" class="form-select">
                                            <option value="">Pilih Kegiatan</option>
                                            @foreach ($kegiatan as $row)
                                            <option value="{{ $row->id_kegiatan }}">{{ $row->nama_kegiatan }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2 col-md-6">
                                        <select name="id_kategori_anggota" id="sub-dd" class="form-select">
                                            <option value="">Pilih Kategori </option>
                                            @foreach ($kategori_anggota as $row)
                                            <option value="{{ $row->id_kategori_anggota }}">{{ $row->nama_kategori_anggota }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2 col-md-6">
                                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder=" Nama ">
                                    </div>
                                    <div class="form-group mb-2 col-md-6">
                                        <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder=" e-mail ">
                                    </div>
                                    <div class="form-group mb-2 col-md-6">
                                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder=" Nomor Telephone ">
                                    </div>
                                    <div class="form-group mb-2 col-md-6">
                                        <input type="text" name="kode_kupon" class="form-control" value="{{ old('kode_kupon') }}" placeholder=" Kupon ">
                                    </div>

                                    <center><h6>Pilih Paket</h6></center>



                                    <div class="row">
                                        @foreach($paket as $row)
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-check form-control">
                                                <input type="radio" name="id_paket" class="form-check-input" id="flexRadioDefault1" value="{{ $row['id_paket'] }}" data-price="{{ $row['harga_paket'] }}">
                                                {{ $row['nama_paket'] }}
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>


                                    <div class="form-group mb-2 col-md-12">
                                        <input type="text" name="harga_paket" id="harga-paket" class="form-control" value="{{ old('harga_paket') }}" placeholder=" Harga Pendaftaran " readonly>
                                    </div>
                                    <div class="col-lg-4 col-md-10 col-8 mx-auto">
                                        <button type="submit" class="form-control">Buy Ticket</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- JAVASCRIPT FILES -->
    <script src="web/js/jquery.min.js"></script>
    <script src="web/js/bootstrap.min.js"></script>
    <script src="web/js/jquery.sticky.js"></script>
    <script src="web/js/custom.js"></script>


</body>

</html>