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
      <th>TMT Kenaikan Gaji</th>
      <th>Gaji Pokok Lama</th>
      <th>Gaji Pokok Baru</th>
      <th>Kenaikan Gaji YAD</th>
      <th>Tgl Pembuatan KGB</th>
      <th>Peraturan</th>
  </tr>
  @foreach($data as $i => $item)
  <tr>
      <td>{{$i + 1}}</td>
      <td>{{date("d/m/Y", strtotime($item->tmt_kenaikan_gaji))}}</td>
      <td>Rp. {{number_format($item->gaji_pokok_lama, 2, ',','.')}}</td>
      <td>Rp. {{number_format($item->gaji_pokok_baru, 2, ',','.')}}</td>
      <td>{{date("d/m/Y", strtotime($item->kenaikan_gaji_yad))}}</td>
      <td>{{date("d/m/Y", strtotime($item->created_at))}}</td>
      <td>{{$item->peraturan}}</td>
  </tr>
  @endforeach
</table>