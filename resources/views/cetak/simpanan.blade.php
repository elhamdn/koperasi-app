<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <style>
        body {
            height: 842px;
            width: 595px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .container1 {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .container1>div {
            width: 100%;
            text-align: center;
        }

        .container2 {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            padding-top: 20px;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .container3 {
            display: flex;
            justify-content: space-between;
            padding-left: 20px;
            padding-right: 20px;
        }

        .container3>div {
            border-top: 2px solid;
            border-bottom: 2px solid;
        }

        .baris {
            display: flex;
            align-items: baseline;
        }

        .baris>h5 {
            margin-left: 10px;
            width: 20%;
        }

        .baris>div {
            margin-left: 20px;
            border-bottom: 1px solid;
            width: 100%;
        }
    </style>

</head>


<body>
    <div class="container1">
        <img src=" https://www.gurupendidikan.co.id/wp-content/uploads/2020/04/Lambang-Koperasi-Baru.png" alt="Logo" srcset="" style="object-fit: contain; width: 150px;height:150px">
        <div>
            <h2>Kwitansi</h2>
        </div>
    </div>
    <div class="container2">
        <div class="baris">
            <h5>Pemberi</h5>
            <div>
                {{$data->nama_anggota}}
            </div>
        </div>
        <div class="baris">
            <h5>Jenis Simpanan</h5>
            <div>
                {{$data->jenis_simpanan}}
            </div>
        </div>
        <div class="baris">
            <h5>Keterangan</h5>
            <div>
                {{$data->keterangan}}
            </div>
        </div>
    </div>

    <div class="container3">
        <div>
            <h5>Jumlah Rp. {{$data->deposit}}</h5>
        </div>
        <div>
            <h5>Tanggal Deposit : {{$data->tgl_deposit}}</h5>
        </div>

    </div>
</body>
<script type="text/javascript">
    window.onload = function() {
        window.print();
    }
</script>

</html>