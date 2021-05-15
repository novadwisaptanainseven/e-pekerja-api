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
      <th>Lama Cuti</th>
      <th>Tgl. Mulai Cuti</th>
      <th>Tgl. Selesai Cuti</th>
      <th>Status Cuti</th>
  </tr>
  @foreach($data as $i => $item)
  <tr>
      <td>{{$i + 1}}</td>
      <td>{{ $item->lama_cuti }}</td>
      <td align="center">{{ date("d/m/Y", strtotime($item->tgl_mulai)) }}</td>
      <td align="center">{{ date("d/m/Y", strtotime($item->tgl_selesai)) }}</td>
      <td>
          @if ($dateNow >= $item->tgl_mulai && $dateNow <= $item->tgl_selesai)
              Sedang Cuti
          @else
              Masa Cuti Selesai
          @endif
      </td>
  </tr>
  @endforeach
</table>