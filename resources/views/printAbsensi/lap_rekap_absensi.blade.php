<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>

    <style>
        body {
            font-size: 0.8em;
            font-family: Arial, Helvetica, sans-serif;
        }

        .my-table {
            width: 100%;
            font-size: 0.7em;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .header {
            display: flex;
            height: 125px;
        }

        .logo {
            width: 90px;
            margin-left: 70px;
        }

        /* .logo-container {
            border: 1px solid black;
            width: 150px;
        } */

        .deskripsi-container {
            margin-left: 100px;
            width: 80%;
            text-align: center;
        }

        h1,
        h2 {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }

        .deskripsi-teks {
            margin: 0;
            font-weight: bold;
            padding: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .line1 {
            background-color: black;
            height: 4px;
        }

        .line2 {
            margin-top: 2px;
            background-color: black;
            height: 2px;
        }

        @page {
            margin: 15px 15px 10px 15px;
        }

        td.colCenter {
            text-align: center;
        }

        .bg-orange {
            background-color: orange;
        }
    </style>

</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="logo-container">
            <img class="logo" src="{{storage_path('/app/public/logo-kota-samarinda.png')}}" alt="logo">
        </div>
        <div class="deskripsi-container">
            <h2>PEMERINTAH KOTA SAMARINDA</h2>
            <h1>DINAS PERUMAHAN DAN KAWASAN PERMUKIMAN</h1>
            <p class="deskripsi-teks">
                Jl. D.I Panjaitan Kel. Gn. Lingai Kec. Sungai Pinang, Samarinda 75117 <br>
                Website : disperkim.samarindakota.go.id Email : DPP_SMD@yahoo.com
            </p>
        </div>
    </div>
    <div class="line1"></div>
    <div class="line2"></div>

    <p><b>Tanggal : </b> {{$date}}</p>

    <h2 style="font-family: Arial, Helvetica, sans-serif">{{$title}}</h2>
    @if(!empty($tahun))
    <h3 style="font-family: Arial, Helvetica, sans-serif; text-align:center">Keadaan Tahun {{$tahun}}</h3>
    @else
    <h3 style="font-family: Arial, Helvetica, sans-serif; text-align:center">Dari Tanggal: {{$filterTanggal["first_date"]}} - {{$filterTanggal["last_date"]}}</h3>
    @endif

    <!-- Content -->

    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>No</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Hadir</th>
            <th>Izin</th>
            <th>Sakit</th>
            <th>Cuti</th>
            <th>Tanpa Keterangan</th>
        </tr>

        @foreach($data as $i => $item)
        <tr>
            <td align="center">{{$i + 1}}</td>
            <td>
                {{$item->nama}} <br>
            </td>
            <td>{{$item->jabatan}}</td>
            <td class="colCenter">{{$item->hadir}}</td>
            <td class="colCenter">{{$item->izin}}</td>
            <td class="colCenter">{{$item->sakit}}</td>
            <td class="colCenter">{{$item->cuti}}</td>
            <td class="colCenter">{{$item->tanpa_keterangan}}</td>
        </tr>
        @endforeach

    </table>


    @include('templates.ttd')

</body>

</html>