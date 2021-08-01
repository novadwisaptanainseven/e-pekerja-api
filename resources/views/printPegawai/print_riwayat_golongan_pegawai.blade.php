@include('templates.header')

    <p><b>Tanggal : </b> {{$date}}</p>
    <p><b>Pegawai : </b>{{$pegawai->nama}}</p>

    <h2 style="font-family: Arial, Helvetica, sans-serif">{!!$title!!}</h2>

    <!-- Content -->
        <table class="my-table" cellpadding="5" border="1">
            <tr class="bg-orange">
                <th>No</th>
                <th>Golongan</th>
                <th>No. SK</th>
                <th>Masa Kerja</th>
                <th>TMT</th>
                <th>Status</th>
                <th>Jenis KP</th>
                <th>Pejabat Penetap</th>
                <th>Tanggal KP</th>
            </tr>
            @foreach($data["data"] as $i => $item)
            <tr>
                <td>{{$i + 1}}</td>
                <td>{{ $item->keterangan }} ({{ $item->golongan }})</td>
                <td align="left">{{ $item->no_sk }}</td>
                <td align="center">{{ $item->masa_kerja }}</td>
                <td align="center">{{ date("d/m/Y", strtotime($item->tmt_kenaikan_pangkat)) }}</td>
                <td align="center">{{ $item->pangkat_terkini == 1 ? "Terkini" : "" }}</td>
                <td align="center">{{ $item->jenis_kp }}</td>
                <td align="center">{{ $item->pejabat_penetap }}</td>
                <td align="center">{{ date("d/m/Y", strtotime($item->tanggal))}}</td>
            </tr>
            @endforeach
        </table>

@include('templates.ttd')

</body>

</html>