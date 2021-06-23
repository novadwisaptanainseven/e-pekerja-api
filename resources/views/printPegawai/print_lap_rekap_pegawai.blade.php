@include('templates.header_portrait')

    <!-- End of Header -->

    <p><b>Tanggal : </b> {{$date}}</p>

    <h2>{{$title}}</h2>
    <h3>Keadaan {{ $tanggal["bulan"] }} {{ $tanggal["tahun"] }}</h3>

    <!-- Content -->

    <table class="my-table" border="1">
        <tr class="bg-orange">
            <th colspan="6">Klasifikasi PNS Berdasarkan Golongan / Eselon / Pendidikan</th>
        </tr>
        <tr class="bg-orange">
            <th colspan="2">Golongan</th>
            <th colspan="2">Eselon</th>
            <th colspan="2">Pendidikan</th>
        </tr>
        <tr class="bg-orange">
            <th>Gol</th>
            <th>Jumlah</th>
            <th>Eselon</th>
            <th>Jumlah</th>
            <th>Jenjang</th>
            <th>Jumlah</th>
        </tr>
        
        @php
        // Indexing
        $x = 0;
        $y = 0;
        $z = 0;
        $i = 0;
        $j = 0;
        $k = 0;
        $totGolongan = count($data2["rekap_golongan"]);
        $totEselon = count($data2["rekap_eselon"]);
        $totJenjang = count($data2["rekap_jenjang"]);
        $totPegawaiByStatus = count($data2["total_pegawai_status"]);
        $totPegawaiByBidang = count($data2["total_pegawai_bidang"]);
        $totJenjangPTTB = count($data2["rekap_jenjang_pttb"]);
        $totJenisKelaminPTTB = $data2["rekap_jenis_kelamin_pttb"][0]["value"] + $data2["rekap_jenis_kelamin_pttb"][0]["value"];
        $totJenjangPTTH = count($data2["rekap_jenjang_ptth"]);
        $totJenisKelaminPTTH = $data2["rekap_jenis_kelamin_ptth"][0]["value"] + $data2["rekap_jenis_kelamin_ptth"][1]["value"];
        $totDataGolongan = $data2["rekap_golongan"][$totGolongan - 1]["value"];
        $totDataEselon = $data2["rekap_eselon"][$totEselon - 1]["value"];
        $totDataJenjang = $data2["rekap_jenjang"][$totJenjang - 1]["value"];
        $totDataJenjangPTTB = $data2["rekap_jenjang_pttb"][$totJenjangPTTB - 1]["value"];
        $totDataJenjangPTTH = $data2["rekap_jenjang_ptth"][$totJenjangPTTH - 1]["value"];
        $totDataPegawaiByBidang = 
        array_reduce($data2["total_pegawai_bidang"], function($carry, $item) {
            return $carry + $item["value"];
        }, 0);
        // dd($totDataPegawaiByBidang);
        @endphp

        {{-- Rekap PNS --}}
        @foreach ($data2["rekap_golongan"] as $key => $value)
        <tr>
            {{-- Tampilkan total data jika telah mencapai baris paling akhir --}}
            @if ($key == $totGolongan - 1)
            <td class="bg-grey" align="center" style="font-weight: bold">Total</td>
            <td class="bg-grey" align="center" style="font-weight: bold">{{ $totDataGolongan }}</td>
            <td class="bg-grey" align="center" style="font-weight: bold"></td>
            <td class="bg-grey" align="center" style="font-weight: bold">{{ $totDataEselon }}</td>
            <td class="bg-grey" align="center" style="font-weight: bold"></td>
            <td class="bg-grey" align="center" style="font-weight: bold">{{ $totDataJenjang }}</td>
            @break
            @endif
            <td align="center">{{ $value["key"] }}</td>
            <td align="center">{{ $value["value"] }}</td>

            {{-- Rekap Eselon --}}
            @if ($i < count($data2["rekap_eselon"]) - 1) \
                <td align="center">{{ $data2["rekap_eselon"][$i]["key"] }}</td>
                <td align="center">{{ $data2["rekap_eselon"][$i]["value"] }}</td>
                {{ $i++ }}
            @else
                <td></td>
                <td></td>
            @endif
            {{-- Rekap Jenjang Pendidikan --}}
             @if ($j < count($data2["rekap_jenjang"]) - 1) <td align="center">{{ $data2["rekap_jenjang"][$j]["key"] }}</td>
                <td align="center">{{ $data2["rekap_jenjang"][$j]["value"] }}</td>
                {{ $j++ }}
             @else
                <td></td>
                <td></td>
             @endif
        </tr>
        @endforeach

        <tr class="bg-orange">
            <th align="center" colspan="6">Rincian Jumlah PNS Berdasarkan Golongan dan Jenis Kelamin</th>
        </tr>
        <tr class="bg-orange">
            <th align="center" colspan="3">Golongan (Romawi)</th>
            <th align="center" colspan="3">Jenis Kelamin</th>
        </tr>
        <tr class="bg-orange">
            <th align="center">Gol</th>
            <th align="center" colspan="2">Jumlah</th>
            <th align="center">Jenis Kelamin</th>
            <th align="center" colspan="2">Jumlah</th>
        </tr>
        <tr>
            <td align="center">IV</td>
            <td align="center" colspan="2">{{ $data["pns"]["rekap_golongan_romawi"]->IV }}</td>
            <td align="center">Pria</td>
            <td align="center" colspan="2">{{ $data["pns"]["rekap_jenis_kelamin"]["pria"] }}</td>

        </tr>
        <tr>
            <td align="center">III</td>
            <td align="center" colspan="2">{{ $data["pns"]["rekap_golongan_romawi"]->III }}</td>
            <td align="center">Wanita</td>
            <td align="center" colspan="2">{{ $data["pns"]["rekap_jenis_kelamin"]["wanita"] }}</td>
        </tr>
        <tr>
            <td align="center">II</td>
            <td align="center" colspan="2">{{ $data["pns"]["rekap_golongan_romawi"]->II }}</td>
            <td align="center"></td>
            <td align="center" colspan="2"></td>
        </tr>
        <tr>
            <td align="center">I</td>
            <td align="center" colspan="2">{{ $data["pns"]["rekap_golongan_romawi"]->I }}</td>
            <td align="center"></td>
            <td align="center" colspan="2"></td>
        </tr>
        <tr class="bg-grey">
            <th align="center">Total</th>
            <th align="center" colspan="2">{{ $data["pns"]["rekap_golongan_romawi"]->Total }}</th>
            <th align="center"></th>
            <th align="center" colspan="2">{{ $data["pns"]["rekap_jenis_kelamin"]["pria"] + $data["pns"]["rekap_jenis_kelamin"]["wanita"] }}</th>
        </tr>

        <tr class="bg-orange">
            <th align="center" colspan="6">Rincian Jumlah PTTB / PTTH Berdasarkan Pendidikan dan Jenis Kelamin</th>
        </tr>

        {{-- Rekap PTTB --}}
        <tr class="bg-orange">
            <th align="center" colspan="6">PTTB</th>
        </tr>
        <tr class="bg-orange">
            <th align="center" colspan="3">Pendidikan</th>
            <th align="center" colspan="3">Jenis Kelamin</th>
        </tr>
        @foreach ($data2["rekap_jenjang_pttb"] as $key => $value)
            <tr>
                {{-- Tampilkan total data jika telah mencapai baris paling akhir --}}
                @if ($key == $totJenjangPTTB - 1)
                    <td class="bg-grey" align="center" style="font-weight: bold">Total</td>
                    <td class="bg-grey" colspan="2" align="center" style="font-weight: bold">{{ $totDataJenjangPTTB }}</td>
                    <td class="bg-grey"></td>
                    <td class="bg-grey" colspan="2" align="center" style="font-weight: bold">{{ $totJenisKelaminPTTB }}</td>
                    @break
                @endif
                <td align="center">{{ $value["key"] }}</td>
                <td colspan="2" align="center">{{ $value["value"] }}</td>

                {{-- Rekap Jenis Kelamin PTTB --}}
                @if ($k < count($data2["rekap_jenis_kelamin_pttb"]))
                    <td align="center">
                        {{ ucfirst($data2["rekap_jenis_kelamin_pttb"][$k]["key"]) }}
                    </td>
                    <td align="center" colspan="2">
                        {{ $data2["rekap_jenis_kelamin_pttb"][$k]["value"] }}
                    </td>
                    {{ $k++ }}
                @else 
                    <td></td>
                    <td colspan="2"></td>
                @endif
            </tr>
        @endforeach
        
    </table>

    <br><br><br>
    {{-- Page 2 of PDF--}}
    <table class="my-table" border="1">
        {{-- Rekap PTTH --}}
        <tr class="bg-orange">
            <th align="center" colspan="6">PTTH</th>
        </tr>
        <tr class="bg-orange">
            <th align="center" colspan="3">Pendidikan</th>
            <th align="center" colspan="3">Jenis Kelamin</th>
        </tr>
        @foreach ($data2["rekap_jenjang_ptth"] as $key => $value)
            <tr>
                {{-- Tampilkan total data jika telah mencapai baris paling akhir --}}
                @if ($key == $totJenjangPTTH - 1)
                    <td class="bg-grey" align="center" style="font-weight: bold">Total</td>
                    <td class="bg-grey" colspan="2" align="center" style="font-weight: bold">{{ $totDataJenjangPTTH }}</td>
                    <td class="bg-grey"></td>
                    <td class="bg-grey" colspan="2" align="center" style="font-weight: bold">{{ $totJenisKelaminPTTH }}</td>
                    @break
                @endif
                <td align="center">{{ $value["key"] }}</td>
                <td colspan="2" align="center">{{ $value["value"] }}</td>

                {{-- Rekap Jenis Kelamin PTTB --}}
                @if ($y < count($data2["rekap_jenis_kelamin_ptth"]))
                    <td align="center">
                        {{ ucfirst($data2["rekap_jenis_kelamin_ptth"][$y]["key"]) }}
                    </td>
                    <td align="center" colspan="2">
                        {{ $data2["rekap_jenis_kelamin_ptth"][$y]["value"] }}
                    </td>
                    {{ $y++ }}
                @else 
                    <td></td>
                    <td colspan="2"></td>
                @endif
            </tr>
        @endforeach

        {{-- Total Pegawai berdasarkan Status dan Bidang --}}
        <tr class="bg-orange">
            <th align="center" colspan="6">Total Pegawai Berdasarkan Status Pegawai dan Bidang</th>
        </tr>
        <tr class="bg-orange">
            <th align="center" colspan="3">Status</th>
            <th align="center" colspan="3">Bidang</th>
        </tr>
        @foreach ($data2["total_pegawai_bidang"] as $key => $value)
            <tr>
               
                {{-- Total pegawai berdasarkan status --}}
                @if ($z < count($data2["total_pegawai_status"]))
                    <td align="center">
                        {{ $data2["total_pegawai_status"][$z]["key"] }}
                    </td>
                    <td align="center" colspan="2">
                        {{ $data2["total_pegawai_status"][$z]["value"] }}
                    </td>
                    {{ $z++ }}
                @else 
                    <td></td>
                    <td colspan="2"></td>
                @endif

                <td align="center">{{ $value["key"] }}</td>
                <td colspan="2" align="center">{{ $value["value"] }}</td>
            </tr>
        @endforeach

        <tr class="bg-grey">
            <th>Total</th>
            <th colspan="2">{{ $data["total_pegawai"] }}</th>
            <th></th>
            <th colspan="2">{{ $totDataPegawaiByBidang }}</th>
        </tr>
    </table>
    <!-- End of Content -->

    @include('templates.ttd')

</body>

</html>