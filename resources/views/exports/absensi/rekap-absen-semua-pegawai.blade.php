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
      <th>Nama</th>
      <th>Jabatan</th>
      <th>Hadir</th>
      <th>Izin</th>
      <th>Sakit</th>
      <th>Cuti</th>
      <th>Tanpa Keterangan</th>
  </tr>

  @foreach($data as $i => $item)
  <tr>
      <td align="center">{{$i + 1}}</td>
      <td>
          {{$item->nama}}
      </td>
      <td>{{$item->jabatan}}</td>
      <td>{{$item->hadir}}</td>
      <td>{{$item->izin}}</td>
      <td>{{$item->sakit}}</td>
      <td>{{$item->cuti}}</td>
      <td>{{$item->tanpa_keterangan}}</td>
  </tr>
  @endforeach

</table>