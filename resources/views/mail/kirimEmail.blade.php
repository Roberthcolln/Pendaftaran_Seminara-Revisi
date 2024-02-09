
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tagihan Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #invoice {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .invoice-header,
        .invoice-body,
        .invoice-footer {
            margin-bottom: 20px;
        }

        .invoice-header h2 {
            color: #333;
        }

        .invoice-body table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .invoice-body th,
        .invoice-body td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-footer p {
            text-align: right;
        }
    </style>
</head>

<div id="invoice">
    <div class="invoice-header">
        <header>
            
            <center><h1>{{$konf->instansi_setting}}</h1></center>
            <center><h5>J{{$kong->alamat_setting}}</h5></center>
            <hr style="border: 3px solid #a5cd7d" />
        </header>
        <center>
            <h2>INVOICE</h2>
        </center>
        <p>Name : NAruto Uchiha</p>
        <p>Institution : Hokage</p>
        <p>Category : Student Payment</p>
        <p>Status : Waiting</p>
    </div>

    <div class="invoice-body">
        <table>
            <thead>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Peserta</th>
                    <th>Email</th>
                    <th>Tanggal Kegiatan</th>
                    <th>Biaya Kegiatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kegiatan</td>
                    <td>Nama</td>
                    <td>Email</td>
                    <td>
                        Tanggal
                    </td>
                    <td>Biaya</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>biaya</td>
                    <td>total biaya</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="">

        <p>Please complete payment :</p>
        <p>Bank Mandiri KCP RSCM</p>
        <p>Account Name: YAYASAN GIPERTI JAYA</p>
        <p>Account Number : 122-00-0665580-0</p>
        <p>Complete Your Payment and upload payment proof here </p>
        <p>or click link :</p>
        <p>http://jnm2024.com/payment-proof-submit/?ep_token=cd52385e765a969bd1c41c9575c031cf</p>

        <br />
        <p>Link <a href="{{route('order.index')}}"> Pembayaran</a></p>
    </div>
</div>

</html>