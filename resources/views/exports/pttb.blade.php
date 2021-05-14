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
        <th>Nama/NIP</th>
        <th>Penetap SK, No. SK, Tanggal, TMT</th>
        <th>Kontrak Ke</th>
        <th>Masa Kerja</th>
        <th>Gaji Pokok</th>
        <th>Tugas</th>
        <th>Jenis Kelamin</th>
        <th>No. HP</th>
    </tr>
    @foreach($data as $i => $d)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>
            {{$d->nama}}<br>
            ({{$d->nip}})
        </td>
        <td>
            - Penetap: {{$d->penetap_sk}} <br>
            - NO. {{$d->no_sk}} <br>
            - TGL. {{date("d/m/Y", strtotime($d->tgl_penetapan_sk))}} <br>
            - TMT. {{date("d/m/Y", strtotime($d->tgl_mulai_tugas))}}
        </td>
        <td style="text-align: center;">Ke-{{$d->kontrak_ke}}</td>
        <td>{{$d->masa_kerja}}</td>
        <td>Rp. {{number_format($d->gaji_pokok,2,',','.')}}</td>
        <td>{{$d->jabatan}}</td>
        <td>{{$d->jenis_kelamin}}</td>
        <td>{{$d->no_hp}}</td>
    </tr>
    @endforeach
  </table>