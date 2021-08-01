<?php

namespace App\Exports;

use App\Models\Admin\Pegawai\PNS;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class RekapPegawaiExport implements FromView, ShouldAutoSize, WithDrawings, WithColumnWidths, WithEvents
{
    use Exportable;

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 30,
            'E' => 20,
            'F' => 20,
        ];
    }

    public function view(): View
    {
        $output_data = PNS::getRekapPegawai();

        // PNS
        // For Loop Rekap Golongan
        $arr_rekap_golongan = [];
        foreach ($output_data["pns"]["rekap_golongan"] as $key => $value) {
            array_push($arr_rekap_golongan, ["key" => $key, "value" => $value]);
        }
        // For Loop Rekap Eselon
        $arr_rekap_eselon = [];
        foreach ($output_data["pns"]["rekap_eselon"] as $key => $value) {
            array_push($arr_rekap_eselon, ["key" => $key, "value" => $value]);
        }
        // For Loop Rekap Jenjang  Pendidikan
        $arr_rekap_jenjang = [];
        foreach ($output_data["pns"]["rekap_jenjang_pendidikan"] as $key => $value) {
            array_push($arr_rekap_jenjang, ["key" => $key, "value" => $value]);
        }

        // PTTB
        $arr_rekap_jenjang_pttb = [];
        foreach ($output_data["pttb"]["rekap_jenjang_pendidikan"] as $key => $value) {
            array_push($arr_rekap_jenjang_pttb, ["key" => $key, "value" => $value]);
        }
        $arr_rekap_jenis_kelamin_pttb = [];
        foreach ($output_data["pttb"]["rekap_jenis_kelamin"] as $key => $value) {
            array_push($arr_rekap_jenis_kelamin_pttb, ["key" => $key, "value" => $value]);
        }

        // PTTH
        $arr_rekap_jenjang_ptth = [];
        foreach ($output_data["ptth"]["rekap_jenjang_pendidikan"] as $key => $value) {
            array_push($arr_rekap_jenjang_ptth, ["key" => $key, "value" => $value]);
        }
        $arr_rekap_jenis_kelamin_ptth = [];
        foreach ($output_data["ptth"]["rekap_jenis_kelamin"] as $key => $value) {
            array_push($arr_rekap_jenis_kelamin_ptth, ["key" => $key, "value" => $value]);
        }

        // Total Pegawai berdasarkan Status
        $arr_jumlah_pegawai = [
            [
                "key" => "PNS",
                "value" => $output_data["jumlah_pns"],
            ],
            [
                "key" => "PTTB",
                "value" => $output_data["jumlah_pttb"],
            ],
            [
                "key" => "PTTH",
                "value" => $output_data["jumlah_ptth"],
            ],
        ];
        // Total Pegawai berdasarkan Bidang
        $arr_jumlah_pegawai_bidang = [];
        foreach ($output_data["total_per_bidang"] as $key => $value) {
            array_push($arr_jumlah_pegawai_bidang, ["key" => $key, "value" => $value]);
        }

        $output_data2 = [
            "rekap_golongan" => $arr_rekap_golongan,
            "rekap_eselon" => $arr_rekap_eselon,
            "rekap_jenjang" => $arr_rekap_jenjang,
            "rekap_jenjang_pttb" => $arr_rekap_jenjang_pttb,
            "rekap_jenis_kelamin_pttb" => $arr_rekap_jenis_kelamin_pttb,
            "rekap_jenjang_ptth" => $arr_rekap_jenjang_ptth,
            "rekap_jenis_kelamin_ptth" => $arr_rekap_jenis_kelamin_ptth,
            "total_pegawai_bidang" => $arr_jumlah_pegawai_bidang,
            "total_pegawai_status" => $arr_jumlah_pegawai
        ];

        $data = [
            "data" => $output_data,
            "data2" => $output_data2,
            "tanggal" => formatTanggalIndonesia(date('Y-m-d')),
            "ttd" => PNS::getDataKadis()
        ];

        return view('exports.rekap-pegawai', $data);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                // Set Title
                $currentDate = formatTanggalIndonesia(date("Y-m-d"));
                $title = "Rekapitulasi Pegawai";
                $subTitle = "Dinas Perumahan dan Kawasan Permukiman Samarinda";
                $subTitle2 = "Keadaan $currentDate[tgl] $currentDate[bulan] $currentDate[tahun]";

                $event->sheet->mergeCells('A2:F2');
                $event->sheet->mergeCells('A3:F3');
                $event->sheet->mergeCells('A4:F4');

                $event->sheet->getStyle('A2:A4')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ]);
                $event->sheet->getStyle('A2')->getFont()->setBold(true)->setSize(24);
                $event->sheet->setCellValue('A2', $title);

                $event->sheet->getStyle('A3')->getFont()->setSize(18);
                $event->sheet->setCellValue('A3', $subTitle);

                $event->sheet->getStyle('A4')->getFont()->setSize(16);
                $event->sheet->setCellValue('A4', $subTitle2);
                // End of Set Title

                // Set Content
                $event->sheet->getStyle('A6:F8')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ],
                ]);
                // Add borders
                $event->sheet->getStyle('A6:F70')->applyFromArray([
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_TOP
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);
                $event->sheet->getStyle('A6:F8')->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFe69d30');
                $event->sheet->getStyle('A28:F29')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => [
                            'argb' => 'FFe69d30'
                        ]
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);
                $event->sheet->getStyle('A36:F38')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => [
                            'argb' => 'FFe69d30'
                        ]
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);
                $event->sheet->getStyle('A49:F50')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => [
                            'argb' => 'FFe69d30'
                        ]
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);
                $event->sheet->getStyle('A61:F62')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => [
                            'argb' => 'FFe69d30'
                        ]
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);
                $event->sheet->getStyle('D')
                    ->getAlignment()
                    ->setWrapText(true);
                $event->sheet->getStyle('A68:F68')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);
                $event->sheet->getStyle('A34:F34')
                    ->getFont()
                    ->setBold(true);
                // End of Set Content
            },
        ];
    }



    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo Kota Samarinda');
        $drawing->setPath(storage_path('app/logo-kota-samarinda.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A2');
        $drawing->setOffsetX(40);

        return $drawing;
    }
}
