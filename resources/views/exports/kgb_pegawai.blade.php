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
      <th>Nama / NIP</th>
      <th>Status KGB</th>
      <th>Pemberitahuan</th>
      <th>TMT. Kenaikan Gaji</th>
      <th>Gaji Pokok Lama</th>
      <th>Gaji Pokok Baru</th>
      <th>Kenaikan Gaji YAD</th>
  </tr>
  @foreach($data as $i => $item)
  <tr>
      <td>{{$i + 1}}</td>
      <td>{{$item->nama}} <br>{{ $item->nip }}</td>
      <td>{{ getStatusKGB($item)}}</td>
      <td>{{getPemberitahuan($item)}}</td>
      <td>{{date("d/m/Y", strtotime($item->tmt_kenaikan_gaji))}}</td>
      <td>Rp. {{number_format($item->gaji_pokok_lama, 2, ',','.')}}</td>
      <td>Rp. {{number_format($item->gaji_pokok_baru, 2, ',','.')}}</td>
      <td>{{date("d/m/Y", strtotime($item->kenaikan_gaji_yad))}}</td>
  </tr>
  @endforeach
</table>