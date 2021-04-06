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

    <!-- End of Header -->

    <p><b>Pegawai : </b> {{$pegawai}}</p>
    <p><b>Tanggal : </b> {{$date}}</p>

    <h2 style="font-family: Arial, Helvetica, sans-serif">{{$title}}</h2>

    <!-- Content -->

    @switch($jenis)
    @case('keluarga')
    <table class="my-table" cellpadding="5" border="1">
        <tr>
            <th>NIK/NIP</th>
            <th>Nama</th>
            <th>Hubungan</th>
            <th>TTL</th>
            <th>Pekerjaan</th>
            <th>Agama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Telepon</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>
                {{$d->nik_nip}}
            </td>
            <td>{{$d->nama}}</td>
            <td>{{$d->hubungan}}</td>
            <td>{{$d->tempat_lahir . ", " . date("d/m/Y", strtotime($d->tgl_lahir))}}</td>
            <td>{{$d->pekerjaan}}</td>
            <td>{{$d->agama}}</td>
            <td>{{$d->jenis_kelamin}}</td>
            <td>{{$d->alamat}}</td>
            <td>{{$d->telepon}}</td>
        </tr>
        @endforeach
    </table>
    @break

    @case('pendidikan')
    <table class="my-table" cellpadding="5" border="1">
        <tr>
            <th>Nama Akademi</th>
            <th>Jurusan</th>
            <th>Jenjang</th>
            <th>Tahun Lulus</th>
            <th>No. Ijazah</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{$d->nama_akademi}}</td>
            <td>{{$d->jurusan}}</td>
            <td>{{$d->jenjang}}</td>
            <td>{{$d->tahun_lulus}}</td>
            <td>{{$d->no_ijazah}}</td>
        </tr>
        @endforeach
    </table>
    @break

    @case('diklat')
    <table class="my-table" cellpadding="5" border="1">
        <tr>
            <th>Nama Diklat</th>
            <th>Jenis Diklat</th>
            <th>Penyelenggara</th>
            <th>Tahun Diklat</th>
            <th>Jumlah Jam</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{$d->nama_diklat}}</td>
            <td>{{$d->jenis_diklat}}</td>
            <td>{{$d->penyelenggara}}</td>
            <td>{{$d->tahun_diklat}}</td>
            <td>{{$d->jumlah_jam}}</td>
        </tr>
        @endforeach
    </table>
    @break

    @case('riwayat-kerja')
    <table class="my-table" cellpadding="5" border="1">
        <tr>
            <th>Kantor Lama</th>
            <th>Jabatan Lama</th>
            <th>Tgl. Masuk Kerja</th>
            <th>Tgl. Keluar Kerja</th>
            <th>Keterangan</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{$d->kantor}}</td>
            <td>{{$d->jabatan}}</td>
            <td>{{date("d/m/Y", strtotime($d->tgl_masuk))}}</td>
            <td>{{date("d/m/Y", strtotime($d->tgl_keluar))}}</td>
            <td>{{$d->keterangan}}</td>
        </tr>
        @endforeach
    </table>
    @break

    @case('penghargaan')
    <table class="my-table" cellpadding="5" border="1">
        <tr>
            <th>Nama Penghargaan</th>
            <th>Pemberi</th>
            <th>Tgl. Penghargaan</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{$d->nama_penghargaan}}</td>
            <td>{{$d->pemberi}}</td>
            <td>{{date("d/m/Y", strtotime($d->tgl_penghargaan))}}</td>
        </tr>
        @endforeach
    </table>
    @break

    @default

    @endswitch

    <!-- End of Content -->

    @include('templates.ttd')

</body>

</html>