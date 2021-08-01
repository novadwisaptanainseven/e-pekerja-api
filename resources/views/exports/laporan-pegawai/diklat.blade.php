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
    <th>Nama Diklat</th>
    <th>Jenis Diklat</th>
    <th>Penyelenggara</th>
    <th>Tahun Diklat</th>
    <th>Jumlah Jam</th>
    </tr>
    @foreach($data as $d)
    <tr>
        <td>{{$d->nama_diklat}}</td>
        <td>{{$d->jenis_diklat}}</td>
        <td>{{$d->penyelenggara}}</td>
        <td align="center">{{$d->tahun_diklat}}</td>
        <td align="center">{{$d->jumlah_jam}}</td>
    </tr>
@endforeach
</table>