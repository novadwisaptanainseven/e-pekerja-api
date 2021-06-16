<?php

namespace App\Exports;

use App\Models\Admin\MasaKerja;
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
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class MasaKerjaExport implements FromView, ShouldAutoSize, WithEvents, WithDrawings
{
    use Exportable;

    private $id_pegawai;
    private $data;
    private $tanggal;

    public function __construct($id_pegawai = null, $data = null, $tanggal = null)
    {
        $this->id_pegawai = $id_pegawai;
        $this->data = $data;
        $this->tanggal = $tanggal;
    }

    public function view(): View
    {
        if ($this->id_pegawai && $this->data == "riwayat-masa-kerja") {
            return view('exports.riwayat-masa-kerja', [
                'data' => MasaKerja::getAllRiwayatMasaKerja($this->id_pegawai)
            ]);
        } else {
            return view('exports.masa-kerja', [
                'data' => MasaKerja::getAllForPrint()
            ]);
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Set Title
                if ($this->tanggal) {
                    $currentDate = formatTanggalIndonesia($this->tanggal);
                } else {

                    $currentDate = formatTanggalIndonesia(date('Y-m-d'));
                }
                $title = "Daftar Nama - Nama PNS Berdasarkan Masa Kerja Seluruhnya";
                $subTitle = "Dinas Perumahan dan Kawasan Permukiman Samarinda";
                $subTitle2 = "Keadaan $currentDate[tgl] $currentDate[bulan] $currentDate[tahun]";

                // Mengatasi column agar dinamis mengikuti jenis data laporan
                $rangeColumn2 = "";
                $rangeColumn3 = "";

                if ($this->id_pegawai && $this->data) {
                    $title = "Riwayat Masa Kerja Pegawai";
                    // Get pegawai by id
                    $pegawai = PNS::getById($this->id_pegawai);
                    $subTitle = "";
                    $subTitle2 = $pegawai->nama;
                    $rangeColumn2 = "A2:F2";
                    $rangeColumn3 = "A3:F3";
                    $rangeColumn4 = "A4:F4";
                    $rangeColumn5 = "A6:F6";
                    $rangeColumn6 = "A6:F100";
                } else {
                    // $title = "Daftar Nama - Nama PNS Berdasarkan Masa Kerja Seluruhnya";
                    $rangeColumn2 = "A2:N2";
                    $rangeColumn3 = "A3:N3";
                    $rangeColumn4 = "A4:N4";
                    $rangeColumn5 = "A6:N6";
                    $rangeColumn6 = "A6:N100";
                }

                $event->sheet->mergeCells($rangeColumn2);
                $event->sheet->mergeCells($rangeColumn3);
                $event->sheet->mergeCells($rangeColumn4);
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
                // Styling Table Heading
                $event->sheet->getStyle($rangeColumn5)->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => [
                            'argb' => 'FFe69d30'
                        ]
                    ]
                ]);
                // End of styling heading table

                // Add borders
                $event->sheet->getStyle($rangeColumn6)->applyFromArray([
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_TOP
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);
                // End of add borders

                // Set column alignment
                $event->sheet->getStyle('A')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('D')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('F')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('G')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('H')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('K')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('L')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('M')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('N')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                // End of set column alignment

                // End of set content
            }
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
        $drawing->setOffsetX(30);

        return $drawing;
    }
}
