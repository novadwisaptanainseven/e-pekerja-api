@include('templates.header')

    <!-- End of Header -->

    <p><b>Pegawai : </b> {{$pegawai}}</p>
    <p><b>Tanggal : </b> {{$date}}</p>

    <h2 style="font-family: Arial, Helvetica, sans-serif">{{$title}}</h2>

    <!-- Content -->

    @switch($jenis)
    @case('keluarga')
    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>NIK/NIP</th>
            <th>Nama</th>
            <th>Hubungan</th>
            <th>TTL</th>
            <th>Pekerjaan</th>
            <th>Agama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Telepon</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>
                {{$d->nik_nip}}
            </td>
            <td>{{$d->nama}}</td>
            <td>{{$d->hubungan}}</td>
            <td>{{$d->tempat_lahir . ", " . date("d/m/Y", strtotime($d->tgl_lahir))}}</td>
            <td>{{$d->pekerjaan}}</td>
            <td>{{$d->agama}}</td>
            <td>{{$d->jenis_kelamin}}</td>
            <td>{{$d->alamat}}</td>
            <td>{{$d->telepon}}</td>
        </tr>
        @endforeach
    </table>
    @break

    @case('pendidikan')
    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>Nama Akademi</th>
            <th>Jurusan</th>
            <th>Jenjang</th>
            <th>Tahun Lulus</th>
            <th>No. Ijazah</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{$d->nama_akademi}}</td>
            <td>{{$d->jurusan}}</td>
            <td>{{$d->jenjang}}</td>
            <td>{{$d->tahun_lulus}}</td>
            <td>{{$d->no_ijazah}}</td>
        </tr>
        @endforeach
    </table>
    @break

    @case('diklat')
    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>Nama Diklat</th>
            <th>Jenis Diklat</th>
            <th>Penyelenggara</th>
            <th>Tahun Diklat</th>
            <th>Jumlah Jam</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{$d->nama_diklat}}</td>
            <td>{{$d->jenis_diklat}}</td>
            <td>{{$d->penyelenggara}}</td>
            <td>{{$d->tahun_diklat}}</td>
            <td>{{$d->jumlah_jam}}</td>
        </tr>
        @endforeach
    </table>
    @break

    @case('riwayat-kerja')
    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>Kantor Lama</th>
            <th>Jabatan Lama</th>
            <th>Tgl. Masuk Kerja</th>
            <th>Tgl. Keluar Kerja</th>
            <th>Keterangan</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{$d->kantor}}</td>
            <td>{{$d->jabatan}}</td>
            <td>{{date("d/m/Y", strtotime($d->tgl_masuk))}}</td>
            <td>{{date("d/m/Y", strtotime($d->tgl_keluar))}}</td>
            <td>{{$d->keterangan}}</td>
        </tr>
        @endforeach
    </table>
    @break

    @case('penghargaan')
    <table class="my-table" cellpadding="5" border="1">
        <tr class="bg-orange">
            <th>Nama Penghargaan</th>
            <th>Pemberi</th>
            <th>Tgl. Penghargaan</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{$d->nama_penghargaan}}</td>
            <td>{{$d->pemberi}}</td>
            <td>{{date("d/m/Y", strtotime($d->tgl_penghargaan))}}</td>
        </tr>
        @endforeach
    </table>
    @break

    @default

    @endswitch

    <!-- End of Content -->

    @include('templates.ttd')

</body>

</html>