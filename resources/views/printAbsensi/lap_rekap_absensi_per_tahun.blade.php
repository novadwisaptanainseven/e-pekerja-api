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
            /* margin: 15px 15px 10px 15px; */
        }

        td {
            text-align: center;
        }

        .bg-orange {
            background-color: orange;
        }
        .bg-grey {
            background-color: #bbb;
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
    <p><b>Pegawai : </b> {{$pegawai->nama}}</p>

    <h2 style="font-family: Arial, Helvetica, sans-serif">{{$title}}</h2>


    <!-- Content -->

    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>No</th>
            <th>Tahun</th>
            <th>Hadir</th>
            <th>Izin</th>
            <th>Sakit</th>
            <th>Cuti</th>
            <th>Tanpa Keterangan</th>
        </tr>
        @php
        {{
            $totHadir = 0;
            $totIzin = 0;
            $totSakit = 0;
            $totCuti = 0;
            $totTK = 0;
        }}
        @endphp

        @foreach($data as $i => $item)
        @php
        $totHadir += $item->hadir;
        $totIzin += $item->izin;
        $totSakit += $item->sakit;
        $totCuti += $item->cuti;
        $totTK += $item->tanpa_keterangan;
        @endphp
        <tr>
            <td>{{$i + 1}}</td>
            <td>{{$item->tahun}}</td>
            <td>{{$item->hadir}}</td>
            <td>{{$item->izin}}</td>
            <td>{{$item->sakit}}</td>
            <td>{{$item->cuti}}</td>
            <td>{{$item->tanpa_keterangan}}</td>
        </tr>
        @endforeach

        <tr class="bg-grey">
            <td colspan="2"><b>Total</b></td>
            <td>{{$totHadir}}</td>
            <td>{{$totIzin}}</td>
            <td>{{$totSakit}}</td>
            <td>{{$totCuti}}</td>
            <td>{{$totTK}}</td>
        </tr>

    </table>


    @include('templates.ttd')

</body>

</html>