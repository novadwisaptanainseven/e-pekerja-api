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
            <th>Nama / NIP</th>
            <th>Status KGB</th>
            <th>Pemberitahuan</th>
            <th>TMT Kenaikan Gaji</th>
            <th>Gaji Pokok Lama</th>
            <th>Gaji Pokok Baru</th>
            <th>Kenaikan Gaji YAD</th>
        </tr>
        @foreach($data as $i => $item)
        <tr>
            <td align="center">{{$i + 1}}</td>
            <td>{{$item->nama}} <br>{{ $item->nip }}</td>
            <td>{{getStatusKGB($item)}}</td>
            <td>{{getPemberitahuan($item)}}</td>
            <td align="center">{{date("d/m/Y", strtotime($item->tmt_kenaikan_gaji))}}</td>
            <td>Rp. {{number_format($item->gaji_pokok_lama, 2, ',','.')}}</td>
            <td>Rp. {{number_format($item->gaji_pokok_baru, 2, ',','.')}}</td>
            <td align="center">{{date("d/m/Y", strtotime($item->kenaikan_gaji_yad))}}</td>
        </tr>
        @endforeach
    </table>

    @include('templates.ttd')