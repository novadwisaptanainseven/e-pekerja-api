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
      <th>NIP/NIK</th>
      <th>Jabatan</th>
      <th>Status Pegawai</th>
      <th>Bidang</th>
      <th>Jenis Kelamin</th>
      <th>No. HP</th>
  </tr>
  @foreach($data as $i => $d)
  <tr>
      <td>{{ $i + 1 }}</td>
      <td>{{$d->nama}}</td>
      <td>{{$d->nip ? $d->nip : $d->nik}}</td>
      <td>{{$d->jabatan}}</td>
      <td align="center">{{$d->status_pegawai}}</td>
      <td>{{$d->bidang}}</td>
      <td>{{$d->jenis_kelamin}}</td>
      <td>{{$d->no_hp}}</td>
  </tr>
  @endforeach
</table>