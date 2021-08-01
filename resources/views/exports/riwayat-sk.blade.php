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
  @if ($pegawai->id_status_pegawai == 2)
    <tr>
        <th>No</th>
        <th>No. SK</th>
        <th>Penetap SK</th>
        <th>Tgl. Penetapan SK</th>
        <th>Tgl. Mulai Tugas</th>
        <th>Tugas Pokok (Jabatan)</th>
        <th>Gaji Pokok</th>
    </tr>
    @foreach($data as $i => $item)
    <tr>
        <td>{{$i + 1}}</td>
        <td>{{ $item->no_sk }}</td>
        <td>{{ $item->penetap_sk }}</td>
        <td align="center">{{ date("d/m/Y", strtotime($item->tgl_penetapan_sk)) }}</td>
        <td align="center">{{ $item->tgl_mulai_tugas }}</td>
        <td>{{ $item->nama_jabatan }}</td>
        <td>Rp {{ number_format($item->gaji_pokok, 2, ',', '.') }}</td>
    </tr>
    @endforeach

  @else
    <tr>
        <th>No</th>
        <th>No. SK</th>
        <th>Penetap SK</th>
        <th>Tgl. Penetapan SK</th>
        <th>Tgl. Mulai Tugas</th>
        <th>Kontrak Ke</th>
        <th>Masa Kerja</th>
        <th>Tugas Pokok (Jabatan)</th>
        <th>Gaji Pokok</th>
    </tr>
    @foreach($data as $i => $item)
    <tr>
        <td>{{$i + 1}}</td>
        <td>{{ $item->no_sk }}</td>
        <td>{{ $item->penetap_sk }}</td>
        <td align="center">{{ date("d/m/Y", strtotime($item->tgl_penetapan_sk)) }}</td>
        <td align="center">{{ $item->tgl_mulai_tugas }}</td>
        <td align="center">{{ $item->kontrak_ke }}</td>
        <td align="center">{{ $item->masa_kerja }}</td>
        <td>{{ $item->nama_jabatan }}</td>
        <td>Rp {{ number_format($item->gaji_pokok, 2, ',', '.') }}</td>
    </tr>
    @endforeach
  @endif
  
</table>