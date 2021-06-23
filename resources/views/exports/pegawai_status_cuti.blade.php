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
    <th>Nama/NIP/NIPTB/NIK</th>
    <th>Jenis Cuti</th>
    <th>Status Cuti</th>
    <th>Pemberitahuan</th>
    <th>Tgl. Mulai Cuti</th>
    <th>Tgl. Selesai Cuti</th>
    <th>Keterangan</th>
  </tr>
  @foreach($data as $i => $item)
  <tr>
    <td align="center">{{$i + 1}}</td>
    <td>{{$item->nama}} <br>{{ $item->id_status_pegawai == 2 ? $item->nik : $item->nip }}</td>
    <td>{{$item->jenis_cuti}}</td>
    <td>{{$item->status_cuti}}</td>
    <td>{{getPemberitahuanCuti($item)}}</td>
    <td align="center">{{date("d/m/Y", strtotime($item->tgl_mulai))}}</td>
    <td align="center">{{date("d/m/Y", strtotime($item->tgl_selesai))}}</td>
    <td>{{ $item->keterangan }}</td>
</tr>
  @endforeach
</table>