@include('templates.header')

    <p><b>Tanggal : </b> {{$date}}</p>

    <h2 style="font-family: Arial, Helvetica, sans-serif">{!!$title!!}</h2>
    <h3 style="text-align: center">Keadaan {{$keadaan["tgl"] . " " . $keadaan["bulan"] . " " . $keadaan["tahun"]}}</h3>

    <!-- Content -->

    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>No</th>
            <th>Nama/NIP</th>
            <th>Gol/TMT</th>
            <th>MK Golongan</th>
            <th>Jabatan</th>
            <th>TMT</th>
            <th>MK Jabatan</th>
            <th>Eselon</th>
            <th>Latihan Jabatan</th>
            <th>Pendidikan</th>
            <th>Tgl. Lahir</th>
            <th>TMT CPNS</th>
            <th>MK Sebelum CPNS</th>
            <th>MK Seluruhnya</th>
        </tr>
        @foreach($data as $i => $item)
        <tr>
            <td>{{$i + 1}}</td>
            <td>
                {{$item->nama}} <br>
                {{$item->nip}}
            </td>
            <td>
                {{$item->golongan}} <br>
                {{date("d/m/Y", strtotime($item->tmt_golongan))}}
            </td>
            <td>{{$item->mk_golongan}}</td>
            <td>{{$item->jabatan}}</td>
            <td> {{date("d/m/Y", strtotime($item->tmt_jabatan))}}</td>
            <td>{{$item->mk_jabatan}}</td>
            <td>{{$item->eselon}}</td>
            <td>
                <ul style="padding-left: 10px">
                    @foreach($item->diklat as $diklat)
                    <li>
                        {{$diklat->nama_diklat}} ({{$diklat->tahun_diklat}})
                    </li>
                    @endforeach
                </ul>
            </td>
            <td>{{$item->pendidikan->nama_akademi}} Thn. {{$item->pendidikan->tahun_lulus}}</td>
            <td> {{date("d/m/Y", strtotime($item->tgl_lahir))}}</td>
            <td> {{date("d/m/Y", strtotime($item->tmt_cpns))}}</td>
            <td>{{$item->mk_sebelum_cpns}}</td>
            <td>{{$item->mk_seluruhnya}}</td>

        </tr>
        @endforeach
    </table>

    @include('templates.ttd')

</body>

</html>