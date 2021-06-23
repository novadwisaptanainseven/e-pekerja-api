@include('templates.header')

<p><b>Tanggal : </b> {{$date}}</p>

    <h2 style="font-family: Arial, Helvetica, sans-serif; margin-bottom: 15px">{!!$title!!}</h2>
    @if ($keadaan)
    <h3>Keadaan {{ $keadaan['bulan'] . ' ' . $keadaan['tahun'] }}</h3>
    @endif

    <!-- Content -->

    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>No</th>
            <th>Nama/NIP/NIPTB/NIK</th>
            <th>Jenis Cuti</th>
            <th>Status Cuti</th>
            <th>Pemberitahuan</th>
            <th>Tgl. Mulai Cuti</th>
            <th>Tgl. Selesai Cuti</th>
            <th>Keterangan</th>
        </tr>
        @foreach($data as $i => $item)
        <tr>
            <td align="center">{{$i + 1}}</td>
            <td>{{$item->nama}} <br>{{ $item->id_status_pegawai == 2 ? $item->nik : $item->nip }}</td>
            <td>{{$item->jenis_cuti}}</td>
            <td>{{$item->status_cuti}}</td>
            <td>{{getPemberitahuanCuti($item)}}</td>
            <td align="center">{{date("d/m/Y", strtotime($item->tgl_mulai))}}</td>
            <td align="center">{{date("d/m/Y", strtotime($item->tgl_selesai))}}</td>
            <td>{{ $item->keterangan }}</td>
        </tr>
        @endforeach
    </table>

    @include('templates.ttd')