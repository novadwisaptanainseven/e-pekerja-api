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
      <th>Tgl. Mutasi</th>
      <th>Status</th>
      <th>Keterangan</th>
  </tr>
  @php
  $status = "";
  @endphp
  @foreach($data as $i => $item)
  @php
  $tsCurrent = time();
  $tsTglMutasi = strtotime($item->tgl_mutasi);
  $status = $tsCurrent > $tsTglMutasi ? 'Mutasi' : 'Akan Mutasi';
  @endphp
  <tr>
      <td>{{$i + 1}}</td>
      <td>(
          @if($item->nip)
          {{$item->nip}}
          @else
          {{$item->nik}}
          @endif
      )
      </td>
      <td>{{$item->nama}}</td>
      <td>{{date('d/m/Y', strtotime($item->tgl_mutasi))}}</td>
      <td>{{$status}}</td>
      <td>{{$item->keterangan}}</td>
  </tr>
  @endforeach

</table>