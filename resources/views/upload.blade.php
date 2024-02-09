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
    <!--

TemplateMo 583 Festava Live

https://templatemo.com/tm-583-festava-live

-->

</head>

<body>

    <main>



        <section class="ticket-section section-padding">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-10 mx-auto">
                        <form class="custom-form ticket-form mb-5 mb-lg-0" action="{{ route('pembayaran.upload') }}" method="post" role="form" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <h2 class="text-center mb-4">Bukti Pembayaran</h2>

                            <div class="ticket-form-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Peserta" required>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <input type="email" name="temail" id="temail" class="form-control" placeholder="Email Peserta" required>
                                    </div>
                                </div>
                                <div class="form-group mb-2 col-md-12">
                                    <label for="">Bukti Pembayaran <abbr title="" style="color: black">*</abbr> </label>
                                    <input id="inputImg" type="file" accept="image/*" name="bukti_pembayaran" class="form-control" />
                                    <img class="d-none w-25 h-25 my-2" id="previewImg" src="#" alt="Preview image">
                                </div>

                                

                                <div class="col-lg-4 col-md-10 col-8 mx-auto">
                                    <button type="submit" class="form-control">submit</button>
                                </div>
                            </div>
                        </form>
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