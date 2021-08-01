@include('templates.header_portrait')

    <p><b>Tanggal : </b> {{$date}}</p>

    <h2 style="font-family: Arial, Helvetica, sans-serif">{{$title}}</h2>

    <!-- Content -->
    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>No</th>
            <th>NIP/Nama</th>
            <th>Pangkat Golongan</th>
            <th>Kenaikan Pangkat</th>
            <th>TMT. Kenaikan Pangkat</th>
            <th>Status</th>
            <th>Pemberitahuan</th>
        </tr>
        @foreach($data as $i => $item)
        <tr>
            <td align="center">{{$i + 1}}</td>
            <td>
                {{$item->nama}} <br>
                {{$item->nip}}
            </td>
            <td>{{$item->keterangan}} ({{ $item->golongan }})</td>
            <td>{{$item->pangkat_baru}}</td>
            <td align="center">{{$item->tmt_kenaikan_pangkat ? date('d/m/Y', strtotime($item->tmt_kenaikan_pangkat)) : ""}}</td>
            <td align="center">{{ getStatusKP($item) }}</td>
            <td>{{ getPemberitahuanKP($item) }}</td>
        </tr>
        @endforeach
    </table>

    @include('templates.ttd')

</body>

</html>