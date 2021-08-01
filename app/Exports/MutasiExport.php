<?php

namespace App\Exports;

use App\Models\Admin\Pegawai\Mutasi;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class MutasiExport implements FromView, ShouldAutoSize, WithEvents, WithDrawings, WithColumnWidths
{
    use Exportable;

    public function __construct($req)
    {
        $this->req = $req;
    }

    public function view(): View
    {
        return view('exports.mutasi', [
            'data' => Mutasi::getAll($this->req)
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'E' => 20,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                // Number Formats
                $event->sheet->getStyle('B')->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_TEXT);
                // End of Number Formats

                // Set column alignment
                $event->sheet->getStyle('E')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('D')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                // End of set column alignment

                // Set Title
                $title = "Laporan Data Mutasi Pegawai";
                $subTitle = "Dinas Perumahan dan Kawasan Permukiman Samarinda";
                if (!$this->req->bulan || !$this->req->tahun) {
                    $subTitle2 = "";
                } else {
                    $tgl = $this->req->tahun . "-" . $this->req->bulan . "-" . 1;

                    $keadaan = formatTanggalIndonesia($tgl);

                    $subTitle2 = "Keadaan {$keadaan['bulan']} {$keadaan['tahun']}";
                }
                $currentDate = date("d/m/Y");

                $event->sheet->mergeCells('A1:F1');
                $event->sheet->mergeCells('A2:F2');
                $event->sheet->mergeCells('A3:F3');
                $event->sheet->getStyle('A1:A3')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ]);
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(24);
                $event->sheet->setCellValue('A1', $title);

                $event->sheet->getStyle('A2')->getFont()->setSize(18);
                $event->sheet->setCellValue('A2', $subTitle);

                $event->sheet->getStyle('A3')->getFont()->setSize(16);
                $event->sheet->setCellValue('A3', $subTitle2);
                $event->sheet->getRowDimension('3')->setRowHeight(30);

                $event->sheet->getStyle('B4')->getFont()->setBold(true);
                $event->sheet->getStyle('B4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $event->sheet->setCellValue('B4', 'Tanggal: ' . $currentDate);
                // End of Set Title

                // Set Content

                // Styling Table Heading
                $event->sheet->getStyle('A6:F6')->applyFromArray([
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
                $event->sheet->getStyle('A6:F100')->applyFromArray([
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
        $drawing->setCoordinates('B1');
        $drawing->setOffsetX(30);
        $drawing->setOffsetY(10);

        return $drawing;
    }
}
