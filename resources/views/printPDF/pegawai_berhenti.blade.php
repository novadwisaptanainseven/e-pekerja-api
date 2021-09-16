@include('templates.header_portrait')

    <p><b>Tanggal : </b> {{$date}}</p>

    <h2 style="font-family: Arial, Helvetica, sans-serif">{{$title}}</h2>

    <!-- Content -->

    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>No</th>
            <th>NIP/NIK</th>
            <th>Nama</th>
            <th>Status Pegawai</th>
            <th>Tgl. Berhenti</th>
            <th>Status Berhenti</th>
            <th>Keterangan</th>
        </tr>
        
        @foreach($data as $i => $item)
        
        <tr>
            <td align="center">{{$i + 1}}</td>
            <td>{{ $item->nip }}</td>
            <td>{{$item->nama}}</td>
            <td>{{$item->status_pegawai}}</td>
            <td>{{date('d/m/Y', strtotime($item->tgl_berhenti))}}</td>
            <td>{{$item->status_berhenti == "akan-berhenti" ? "Akan Berhenti" : "Berhenti"}}</td>
            <td>{{$item->keterangan}}</td>
        </tr>
        @endforeach

    </table>


    @include('templates.ttd')

</body>

</html>