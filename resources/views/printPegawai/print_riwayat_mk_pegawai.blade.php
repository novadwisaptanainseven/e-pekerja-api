@include('templates.header')

    <p><b>Tanggal : </b> {{$date}}</p>
    <p><b>Pegawai : </b>{{$pegawai->nama}}</p>

    <h2 style="font-family: Arial, Helvetica, sans-serif">{!!$title!!}</h2>
    
    <!-- Content -->
    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>No</th>
            <th>Tgl. Pembaruan</th>
            <th>MK. Golongan</th>
            <th>MK. Jabatan</th>
            <th>MK. Sebelum CPNS</th>
            <th>MK. Seluruhnya</th>
        </tr>
        @foreach($data as $i => $item)
        <tr>
            <td align="center">{{$i + 1}}</td>
            <td align="center">{{ date("d/m/Y", strtotime($item->tanggal)) }}</td>
            <td align="center">{{ $item->mk_golongan }}</td>
            <td align="center">{{ $item->mk_jabatan }}</td>
            <td align="center">{{ $item->mk_sebelum_cpns }}</td>
            <td align="center">{{ $item->mk_seluruhnya }}</td>
        </tr>
        @endforeach
    </table>
    {{-- End Of Content --}}

@include('templates.ttd')

</body>

</html>