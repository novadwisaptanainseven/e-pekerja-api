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
      <th>Tahun</th>
      <th>Hadir</th>
      <th>Izin</th>
      <th>Sakit</th>
      <th>Cuti</th>
      <th>Tanpa Keterangan</th>
  </tr>
  @php
  {{
      $totHadir = 0;
      $totIzin = 0;
      $totSakit = 0;
      $totCuti = 0;
      $totTK = 0;
  }}
  @endphp

  @foreach($data as $i => $item)
  @php
  $totHadir += $item->hadir;
  $totIzin += $item->izin;
  $totSakit += $item->sakit;
  $totCuti += $item->cuti;
  $totTK += $item->tanpa_keterangan;
  @endphp
  <tr>
      <td>{{$i + 1}}</td>
      <td>{{$item->tahun}}</td>
      <td>{{$item->hadir}}</td>
      <td>{{$item->izin}}</td>
      <td>{{$item->sakit}}</td>
      <td>{{$item->cuti}}</td>
      <td>{{$item->tanpa_keterangan}}</td>
  </tr>
  @endforeach

  <tr>
      <td colspan="2"><b>Total</b></td>
      <td>{{$totHadir}}</td>
      <td>{{$totIzin}}</td>
      <td>{{$totSakit}}</td>
      <td>{{$totCuti}}</td>
      <td>{{$totTK}}</td>
  </tr>

</table>