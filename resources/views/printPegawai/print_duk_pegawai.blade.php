@include('templates.header')

    <p><b>Tanggal : </b> {{$date}}</p>

    <h2 style="font-family: Arial, Helvetica, sans-serif">{{$title}}</h2>

    <!-- Content -->

    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th rowspan="2">No</th>
            <th rowspan="2">Nama / NIP</th>
            <th colspan="2">Pangkat</th>
            <th colspan="2">Jabatan</th>
            <th rowspan="2">Masa Kerja Golongan Pada Pangkat</th>
            <th colspan="3">Latihan Jabatan</th>
            <th colspan="3">Pendidikan</th>
            <th rowspan="2">Usia Tgl/Bln/Thn Lahir</th>
            <th rowspan="2">Catatan Mutasi Kepegawaian</th>
            <th rowspan="2">Keterangan Tgl/Bln/Thn Diangkat Menjadi Capeg</th>
        </tr>
        <tr class="bg-orange">
            <th>Gol/Ruang</th>
            <th>TMT</th>
            <th>Nama</th>
            <th>TMT</th>
            <!-- <th>Tahun</th> -->
            <!-- <th>Bulan</th> -->
            <th>Nama</th>
            <th>Jumlah Bln/Th</th>
            <th>Jumlah Jam</th>
            <th>Nama</th>
            <th>Lulus Tahun</th>
            <th>Tingkat Ijazah</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{$d->no}}</td>
            <td>
                {{$d->nama}} <br>
                {{$d->nip}}
            </td>
            <td>{{$d->golongan}}</td>
            <td>{{date("d/m/Y", strtotime($d->tmt_golongan))}}</td>
            <td>
                {{$d->nama_jabatan}} <br>
                (Eselon {{$d->eselon}})
            </td>
            <td>{{date("d/m/Y", strtotime($d->tmt_jabatan))}}</td>
            <td>{{$d->mk_golongan}}</td>
            <td valign="top" colspan="3">
                <ul style="padding-left: 10px">
                    @foreach($d->diklat as $item)
                    <li>
                        {{$item->nama_diklat}} ({{$item->tahun_diklat}}) ({{$item->jumlah_jam}})
                    </li>
                    @endforeach
                </ul>
            </td>

            <td>{{$d->pendidikan->nama_akademi}}</td>
            <td>{{$d->pendidikan->tahun_lulus}}</td>
            <td>{{$d->pendidikan->jenjang}}</td>
            <td>{{date("d/m/Y", strtotime($d->tgl_lahir))}}</td>
            <td>{{$d->catatan_mutasi}}</td>
            <td>{{date("d/m/Y", strtotime($d->tmt_cpns))}}</td>

        </tr>
        @endforeach

    </table>


    @include('templates.ttd')

</body>

</html>