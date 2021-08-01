@php
  $dateNow = date("Y-m-d");
@endphp

<table>
  <tr>
    <td></td>
  </tr>
  <tr>
      <td></td>
  </tr>
  <tr>
      <td></td>
  </tr>
  <tr>
      <td></td>
  </tr>
  <tr>
      <td></td>
  </tr>
  <tr>
      <th>No</th>
      <th>Jenis Cuti</th>
      <th>Tgl. Mulai Cuti</th>
      <th>Tgl. Selesai Cuti</th>
      <th>Status Cuti</th>
      <th>Keterangan</th>
  </tr>
  @foreach($data as $i => $item)
  <tr>
      <td>{{$i + 1}}</td>
      <td>{{ $item->jenis_cuti }}</td>
      <td align="center">{{ date("d/m/Y", strtotime($item->tgl_mulai)) }}</td>
      <td align="center">{{ date("d/m/Y", strtotime($item->tgl_selesai)) }}</td>
      <td>
        @if ($dateNow >= $item->tgl_mulai && $dateNow <= $item->tgl_selesai)
            Sedang Cuti
        @elseif($dateNow < $item->tgl_mulai)
            Akan Cuti
        @else
            Masa Cuti Selesai
        @endif
      </td>
      <td>{{ $item->keterangan }}</td>
  </tr>
  @endforeach
</table>