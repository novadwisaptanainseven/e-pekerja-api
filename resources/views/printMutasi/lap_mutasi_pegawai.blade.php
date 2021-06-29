@include('templates.header_portrait')

    <p><b>Tanggal : </b> {{$date}}</p>

    <h2 style="font-family: Arial, Helvetica, sans-serif">{{$title}}</h2>

    @if ($keadaan)
    <h3>Keadaan {{ $keadaan['bulan'] . ' ' . $keadaan['tahun'] }}</h3>
    @endif

    <!-- Content -->

    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>No</th>
            <th>NIP/NIK</th>
            <th>Nama</th>
            <th>Tgl. Mutasi</th>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>
        @php
        $status = "";
        @endphp
        @foreach($data as $i => $item)
        @php
        $tsCurrent = time();
        $tsTglMutasi = strtotime($item->tgl_mutasi);
        $status = $tsCurrent >= $tsTglMutasi ? 'Mutasi' : 'Akan Mutasi';
        @endphp
        <tr>
            <td align="center">{{$i + 1}}</td>
            <td>
                @if($item->nip)
                {{$item->nip}}
                @else
                {{$item->nik}}
                @endif
            </td>
            <td>{{$item->nama}}</td>
            <td>{{date('d/m/Y', strtotime($item->tgl_mutasi))}}</td>
            <td>{{$status}}</td>
            <td>{{$item->keterangan}}</td>
        </tr>
        @endforeach

    </table>


    @include('templates.ttd')

</body>

</html>