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
      <th>NIP/NIK</th>
      <th>Nama</th>
      <th>Status Pegawai</th>
      <th>Tgl. Berhenti</th>
      <th>Status</th>
      <th>Keterangan</th>
  </tr>
 
  @foreach($data as $i => $item)
  <tr>
      <td>{{$i + 1}}</td>
      <td>({{ $item->nip }})</td>
      <td>{{$item->nama}}</td>
      <td>{{$item->status_pegawai}}</td>
      <td>{{date('d/m/Y', strtotime($item->tgl_berhenti))}}</td>
      <td>{{$item->status_berhenti == "akan-berhenti" ? "Akan Berhenti" : "Berhenti"}}</td>
      <td>{{$item->keterangan}}</td>
  </tr>
  @endforeach

</table>