<table style="border: 1px solid black">
  <thead>
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
      <th>NIP</th>
      <th>Golongan</th>
      <th>Jabatan</th>
      <th>Eselon</th>
      <th>Bidang</th>
      <th>Jenis Kelamin</th>
      <th>No. HP</th>
      <th>No. KTP</th>
      <th>Email</th>
  </tr>
  </thead>
  <tbody>
  @foreach($data as $i => $d)
      <tr>
          <td>{{ $i + 1 }}</td>
          <td>{{ $d->nama }}</td>
          <td>{{ $d->nip }}</td>
          <td>{{ $d->ket_golongan . "(" . $d->golongan . ")" }}</td>
          <td>{{ $d->jabatan }}</td>
          <td>{{ $d->eselon }}</td>
          <td>{{ $d->bidang }}</td>
          <td>{{ $d->jenis_kelamin }}</td>
          <td>{{ $d->no_hp }}</td>
          <td>'{{ $d->no_ktp }}</td>
          <td>{{ $d->email }}</td>
      </tr>
  @endforeach
  </tbody>
</table>