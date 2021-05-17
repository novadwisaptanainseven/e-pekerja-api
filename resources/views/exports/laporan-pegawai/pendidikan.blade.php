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
    <th>Nama Akademi</th>
    <th>Jurusan</th>
    <th>Jenjang</th>
    <th>Tahun Lulus</th>
    <th>No. Ijazah</th>
    </tr>
    @foreach($data as $d)
    <tr>
        <td>{{$d->nama_akademi}}</td>
        <td>{{$d->jurusan}}</td>
        <td align="center">{{$d->jenjang}}</td>
        <td align="center">{{$d->tahun_lulus}}</td>
        <td align="center">{{$d->no_ijazah}}</td>
    </tr>
    @endforeach
</table>