<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Pegawai Negeri Sipil</title>

    <style>
        .my-table {
            border-collapse: collapse;
        }
    </style>

</head>

<body>
    <h1>{{$title}}</h1>

    <p>{{$date}}</p>

    <hr>

    <table class="my-table" cellpadding="8" border="1">
        <tr>
            <th>Nama</th>
            <th>NIP</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{$d->nama}}</td>
            <td>{{$d->nip}}</td>
            <td>{{$d->jenis_kelamin}}</td>
            <td>{{$d->jabatan}}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>