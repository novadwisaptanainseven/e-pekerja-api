<?php

namespace App\Exports;

use App\Models\Admin\MasaKerja;
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

    public function view(): View
    {
        return view('exports.masa-kerja', [
            'data' => MasaKerja::getAllForPrint()
        ]);
    }

    public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Set Title
                $currentDate = formatTanggalIndonesia(date('Y-m-d'));
                $title = "Daftar Nama - Nama PNS Berdasarkan Masa Kerja Seluruhnya";
                $subTitle = "Dinas Perumahan dan Kawasan Permukiman Samarinda";
                $subTitle2 = "Keadaan $currentDate[tgl] $currentDate[bulan] $currentDate[tahun]"; 
                $event->sheet->mergeCells('A2:N2');
                $event->sheet->mergeCells('A3:N3');
                $event->sheet->mergeCells('A4:N4');
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
                $event->sheet->getStyle('A6:N6')->applyFromArray([
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
                $event->sheet->getStyle('A6:N100')->applyFromArray([
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
        $drawing->setCoordinates('E2');
        $drawing->setOffsetX(30);

        return $drawing;
    }
}
