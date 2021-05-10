<table style="border: 1px solid black">
  <thead>
  <tr>
      <th><b>Nama</b></th>
      <th><b>NIP</b></th>
  </tr>
  </thead>
  <tbody>
  @foreach($data as $d)
      <tr>
          <td>{{ $d->nama }}</td>
          <td>{{ $d->nip }}</td>
      </tr>
  @endforeach
  </tbody>
</table>