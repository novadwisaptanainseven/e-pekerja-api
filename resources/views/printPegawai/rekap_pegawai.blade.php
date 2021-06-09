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
    <!-- End of Header -->

    <p><b>Tanggal</b> : {{$date}}</p>

    <h2 style="font-family: Arial, Helvetica, sans-serif">{{$title}}</h2>

    <!-- Content -->

    @switch($jenis)
    @case('pns')
    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>Nama/NIP</th>
            <th>Golongan</th>
            <th>Jabatan</th>
            <th>Eselon</th>
            <th>Bidang</th>
            <th>Jenis Kelamin</th>
            <th>No. HP</th>
            <th>No. KTP</th>
            <th>Email</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>
                {{$d->nama}}<br>
                ({{$d->nip}})
            </td>
            <td>{{$d->ket_golongan . "(" . $d->golongan . ")"}}</td>
            <td>{{$d->jabatan}}</td>
            <td>{{$d->ket_eselon . "(" . $d->eselon . ")"}}</td>
            <td>{{$d->bidang}}</td>
            <td>{{$d->jenis_kelamin}}</td>
            <td>{{$d->no_hp}}</td>
            <td>{{$d->no_ktp}}</td>
            <td>{{$d->email}}</td>
        </tr>
        @endforeach
    </table>
    @break

    @case('ptth')
    <table class="my-table" cellpadding="5" border="1">
        <tr>
            <th>Nama/NIP</th>
            <th>Penetap SK, No. SK, Tanggal, TMT</th>
            <!-- <th>Tgl. Penetapan SK</th>
            <th>No. SK</th>
            <th>Tgl. Mulai Tugas</th> -->
            <th>Tugas</th>
            <th>Gaji Pokok</th>
            <th>Jenis Kelamin</th>
            <th>No. HP</th>
            <th>No. KTP</th>
            <th>Email</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>
                {{$d->nama}}<br>
                ({{$d->nik}})
            </td>
            <td>
                - Penetap: {{$d->penetap_sk}} <br>
                - NO. {{$d->no_sk}} <br>
                - TGL. {{date("d/m/Y", strtotime($d->tgl_penetapan_sk))}} <br>
                - TMT. {{date("d/m/Y", strtotime($d->tgl_mulai_tugas))}}
            </td>
            <!-- <td>{{date("d/m/Y", strtotime($d->tgl_penetapan_sk))}}</td>
            <td>{{$d->no_sk}}</td>
            <td>{{date("d/m/Y", strtotime($d->tgl_mulai_tugas))}}</td> -->
            <td>{{$d->jabatan}}</td>
            <td>Rp. {{number_format($d->gaji_pokok,2,',','.')}}</td>
            <td>{{$d->jenis_kelamin}}</td>
            <td>{{$d->no_hp}}</td>
            <td>{{$d->no_ktp}}</td>
            <td>{{$d->email}}</td>
        </tr>
        @endforeach
    </table>
    @break

    @case('pttb')
    <table class="my-table" cellpadding="5" border="1">
        <tr>
            <th style="width: 150px;">Nama/NIP</th>
            <th>Penetap SK, No. SK, Tanggal, TMT</th>
            <!-- <th>Tgl. Penetapan SK</th>
            <th>No. SK</th>
            <th>Tgl. Mulai Tugas</th> -->
            <th>Kontrak Ke</th>
            <th>Masa Kerja</th>
            <th>Gaji Pokok</th>
            <th>Tugas</th>
            <th>Jenis Kelamin</th>
            <th>No. HP</th>
            <th>No. KTP</th>
            <th>Email</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>
                {{$d->nama}}<br>
                ({{$d->nip}})
            </td>
            <td>
                - Penetap: {{$d->penetap_sk}} <br>
                - NO. {{$d->no_sk}} <br>
                - TGL. {{date("d/m/Y", strtotime($d->tgl_penetapan_sk))}} <br>
                - TMT. {{date("d/m/Y", strtotime($d->tgl_mulai_tugas))}}
            </td>
            <!-- <td>{{date("d/m/Y", strtotime($d->tgl_penetapan_sk))}}</td>
            <td>{{$d->no_sk}}</td>
            <td>{{date("d/m/Y", strtotime($d->tgl_mulai_tugas))}}</td> -->
            <td style="text-align: center;">Ke-{{$d->kontrak_ke}}</td>
            <td>{{$d->masa_kerja}}</td>
            <td>Rp. {{number_format($d->gaji_pokok,2,',','.')}}</td>
            <td>{{$d->jabatan}}</td>
            <td>{{$d->jenis_kelamin}}</td>
            <td>{{$d->no_hp}}</td>
            <td>{{$d->no_ktp}}</td>
            <td>{{$d->email}}</td>
        </tr>
        @endforeach
    </table>
    @break
    
    @case('semua-pegawai')
    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th style="width: 150px;">Nama</th>
            <th>NIP/NIK</th>
            <th>Jabatan</th>
            <th>Status Pegawai</th>
            <th>Bidang</th>
            <th>Jenis Kelamin</th>
            <th>No. HP</th>
            <th>No. KTP</th>
            <th>Email</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{$d->nama}}</td>
            <td>({{$d->nip ? $d->nip : $d->nik}})</td>
            <td>{{$d->jabatan}}</td>
            <td align="center">{{$d->status_pegawai}}</td>
            <td>{{$d->bidang}}</td>
            <td>{{$d->jenis_kelamin}}</td>
            <td>{{$d->no_hp}}</td>
            <td>{{$d->no_ktp}}</td>
            <td>{{$d->email}}</td>
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