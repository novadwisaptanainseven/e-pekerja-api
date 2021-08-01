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
    <th>Nama Penghargaan</th>
    <th>Pemberi</th>
    <th>Tgl. Penghargaan</th>
  </tr>
    @foreach($data as $d)
    <tr>
        <td>{{$d->nama_penghargaan}}</td>
        <td>{{$d->pemberi}}</td>
        <td>{{date("d/m/Y", strtotime($d->tgl_penghargaan))}}</td>
    </tr>
@endforeach
</table>