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
            height: 105px;
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

    <!-- Content -->

    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th rowspan="2">No</th>
            <th rowspan="2">Nama / NIP</th>
            <th colspan="2">Pangkat</th>
            <th colspan="2">Jabatan</th>
            <th rowspan="2">Masa Kerja Golongan Pada Pangkat</th>
            <th colspan="3">Latihan Jabatan</th>
            <th colspan="3">Pendidikan</th>
            <th rowspan="2">Usia Tgl/Bln/Thn Lahir</th>
            <th rowspan="2">Catatan Mutasi Kepegawaian</th>
            <th rowspan="2">Keterangan Tgl/Bln/Thn Diangkat Menjadi Capeg</th>
        </tr>
        <tr class="bg-orange">
            <th>Gol/Ruang</th>
            <th>TMT</th>
            <th>Nama</th>
            <th>TMT</th>
            <!-- <th>Tahun</th> -->
            <!-- <th>Bulan</th> -->
            <th>Nama</th>
            <th>Jumlah Bln/Th</th>
            <th>Jumlah Jam</th>
            <th>Nama</th>
            <th>Lulus Tahun</th>
            <th>Tingkat Ijazah</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{$d->no}}</td>
            <td>
                {{$d->nama}} <br>
                {{$d->nip}}
            </td>
            <td>{{$d->golongan}}</td>
            <td>{{date("d/m/Y", strtotime($d->tmt_golongan))}}</td>
            <td>
                {{$d->nama_jabatan}} <br>
                (Eselon {{$d->eselon}})
            </td>
            <td>{{date("d/m/Y", strtotime($d->tmt_jabatan))}}</td>
            <td>{{$d->mk_golongan}}</td>
            <td valign="top" colspan="3">
                <ul style="padding-left: 10px">
                    @foreach($d->diklat as $item)
                    <li>
                        {{$item->nama_diklat}} ({{$item->tahun_diklat}}) ({{$item->jumlah_jam}})
                    </li>
                    @endforeach
                </ul>
            </td>

            <td>{{$d->pendidikan->nama_akademi}}</td>
            <td>{{$d->pendidikan->tahun_lulus}}</td>
            <td>{{$d->pendidikan->jenjang}}</td>
            <td>{{date("d/m/Y", strtotime($d->tgl_lahir))}}</td>
            <td>{{$d->catatan_mutasi}}</td>
            <td>{{date("d/m/Y", strtotime($d->tmt_cpns))}}</td>

        </tr>
        @endforeach

    </table>


    @include('templates.ttd')

</body>

</html>