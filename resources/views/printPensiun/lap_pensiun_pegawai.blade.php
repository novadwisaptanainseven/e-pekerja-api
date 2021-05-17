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
            margin-left: 50px;
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
            <img class="logo" src="{{storage_path('/app/public/logo_disperkim.png')}}" alt="logo">
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

    <h3 style="font-family: Arial, Helvetica, sans-serif; text-align:center">Keadaan Tahun {{date('Y')}}</h3>

    <!-- Content -->

    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>No</th>
            <th>NIP/NIK</th>
            <th>Nama</th>
            <th>Tgl. Pensiun</th>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>
        @php
        $status = "";
        @endphp
        @foreach($data as $i => $item)
        @php
        $tsCurrent = time();
        $tsTglPensiun = strtotime($item->tgl_pensiun);
        $status = $tsCurrent > $tsTglPensiun ? 'Pensiun' : 'Akan Pensiun';
        @endphp
        <tr>
            <td>{{$i + 1}}</td>
            <td>
                @if($item->nip)
                {{$item->nip}}
                @else
                {{$item->nik}}
                @endif
            </td>
            <td>{{$item->nama}}</td>
            <td>{{date('d/m/Y', strtotime($item->tgl_pensiun))}}</td>
            <td>{{$status}}</td>
            <td>{{$item->keterangan}}</td>
        </tr>
        @endforeach

    </table>


    @include('templates.ttd')

</body>

</html>