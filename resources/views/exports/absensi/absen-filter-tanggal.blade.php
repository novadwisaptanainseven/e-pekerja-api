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
      <th>Tanggal</th>
      <th>Hari</th>
      <th>Absen</th>
      <th>Keterangan</th>
  </tr>

  @foreach($data as $i => $item)
  <tr>
      <td>{{$i + 1}}</td>
      <td>
          {{date('d/m/Y', strtotime($item->tgl_absen))}}
      </td>
      <td>{{ucfirst($item->hari)}}</td>
      <td>
          @switch($item->absen)
          @case (1)
          Hadir
          @break

          @case (2)
          Izin
          @break

          @case (3)
          Sakit
          @break

          @case (4)
          Cuti
          @break

          @case (5)
          Tanpa Keterangan

          @break
          @default
          @endswitch
      </td>
      <td>{{$item->keterangan}}</td>
  </tr>
  @endforeach

</table>