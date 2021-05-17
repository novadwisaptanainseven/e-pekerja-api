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
    <th>Kantor Lama</th>
    <th>Jabatan Lama</th>
    <th>Tgl. Masuk Kerja</th>
    <th>Tgl. Keluar Kerja</th>
    <th>Keterangan</th>
    </tr>
    @foreach($data as $d)
    <tr>
        <td>{{$d->kantor}}</td>
        <td>{{$d->jabatan}}</td>
        <td align="center">{{date("d/m/Y", strtotime($d->tgl_masuk))}}</td>
        <td align="center">{{date("d/m/Y", strtotime($d->tgl_keluar))}}</td>
        <td>{{$d->keterangan}}</td>
    </tr>
    @endforeach
</table>