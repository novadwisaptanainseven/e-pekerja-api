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
      <th>Tgl. Pembaruan</th>
      <th>MK. Golongan</th>
      <th>MK. Jabatan</th>
      <th>MK. Sebelum CPNS</th>
      <th>MK. Seluruhnya</th>
  </tr>
  @foreach($data as $i => $item)
  <tr>
      <td>{{$i + 1}}</td>
      <td>
          {{date("d/m/Y", strtotime($item->tanggal))}}
      </td>
      <td>{{$item->mk_golongan}}</td>
      <td>{{$item->mk_jabatan}}</td>
      <td>{{$item->mk_sebelum_cpns}}</td>
      <td>{{$item->mk_seluruhnya}}</td>
  </tr>
  @endforeach
</table>