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
      <th>Tugas Pokok (Jabatan)</th>
      <th>Gaji Pokok</th>
      <th>Jenis Kelamin</th>
      <th>No. HP</th>
      <th>No. KTP</th>
      <th>Email</th>
  </tr>
  @foreach($data as $i => $d)
  <tr>
      <td>{{ $i + 1 }}</td>
      <td>
          {{$d->nama}}<br>
          ({{$d->nik}})
      </td>
      <td>
          - Penetap: {{$d->penetap_sk}} <br>
          - NO. {{$d->no_sk}} <br>
          - TGL. {{date("d/m/Y", strtotime($d->tgl_penetapan_sk))}} <br>
          - TMT. {{date("d/m/Y", strtotime($d->tgl_mulai_tugas))}}
      </td>
      <td>{{$d->jabatan}}</td>
      <td>Rp. {{number_format($d->gaji_pokok,2,',','.')}}</td>
      <td>{{$d->jenis_kelamin}}</td>
      <td>{{$d->no_hp}}</td>
      <td>{{$d->no_ktp ? "($d->no_ktp)" : ""}}</td>
      <td>{{$d->email}}</td>
  </tr>
  @endforeach
</table>