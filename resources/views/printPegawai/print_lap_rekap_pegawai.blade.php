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
            font-size: 0.9em;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .header {
            display: flex;
            height: 120px;
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
        h2, h3 {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }
        h2, h3 {
            font-size: 1.5em;
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

    <!-- End of Header -->

    <p><b>Tanggal : </b> {{$date}}</p>

    <h2 >{{$title}}</h2>
    <h3 >Keadaan {{ $tanggal["bulan"] }} {{ $tanggal["tahun"] }}</h3>

    <!-- Content -->

    <table class="my-table" border="1">
        <tr>   
            <th colspan="6">Klasifikasi PNS Berdasarkan Golongan / Eselon / Pendidikan</th>    
        </tr>
        <tr>
            <th colspan="2">Golongan</th>
            <th colspan="2">Eselon</th>
            <th colspan="2">Pendidikan</th>
        </tr>      
        <tr>
            <th>Gol</th>
            <th>Jumlah</th>
            <th>Eselon</th>
            <th>Jumlah</th>
            <th>Jenjang</th>
            <th>Jumlah</th>
        </tr>
        {{-- Rekap Golongan PNS --}}
        @php
            $x = 0;
            $i = 0;
            $j = 0;
            // dd($data2["rekap_golongan"]);
            $totGolongan = count($data2["rekap_golongan"]);
            $totEselon = count($data2["rekap_eselon"]);
            $totJenjang = count($data2["rekap_jenjang"]);
            $totDataGolongan = $data2["rekap_golongan"][$totGolongan - 1]["value"];
            $totDataEselon = $data2["rekap_eselon"][$totEselon - 1]["value"];
            $totDataJenjang = $data2["rekap_jenjang"][$totJenjang - 1]["value"];
        @endphp
        @foreach ($data2["rekap_golongan"] as $key => $value)
           <tr>
               {{-- Tampilkan total data jika telah mencapai baris paling akhir --}}
                @if ($key == $totGolongan - 1)
                    <td align="center" style="font-weight: bold">Total</td>
                    <td align="center" style="font-weight: bold">{{ $totDataGolongan }}</td>
                    <td align="center" style="font-weight: bold"></td>
                    <td align="center" style="font-weight: bold">{{ $totDataEselon }}</td>
                    <td align="center" style="font-weight: bold"></td>
                    <td align="center" style="font-weight: bold">{{ $totDataJenjang }}</td>
                    @break;
                @endif
                <td align="center">{{ $value["key"] }}</td>
                <td align="center">{{ $value["value"] }}</td>

                {{-- Rekap Eselon --}}
                @if ($i < count($data2["rekap_eselon"]) - 1)
                    <td align="center">{{ $data2["rekap_eselon"][$i]["key"] }}</td>      
                    <td align="center">{{ $data2["rekap_eselon"][$i]["value"] }}</td>
                    {{ $i++ }}
                @else
                <td></td>      
                <td></td>
                @endif
                {{-- Rekap Jenjang Pendidikan --}}
                @if ($j < count($data2["rekap_jenjang"]) - 1)
                    <td align="center">{{ $data2["rekap_jenjang"][$j]["key"] }}</td>      
                    <td align="center">{{ $data2["rekap_jenjang"][$j]["value"] }}</td>
                    {{ $j++ }}
                @else
                <td></td>      
                <td></td>
                @endif
            </tr>
        @endforeach

        
    </table>

    <!-- End of Content -->

    @include('templates.ttd')

</body>

</html>