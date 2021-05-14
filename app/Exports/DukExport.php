<?php

namespace App\Exports;

use App\Models\Admin\DUK;
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

class DukExport implements FromView, ShouldAutoSize, WithEvents, WithDrawings
{
    use Exportable;

    public function view(): View
    {
        return view('exports.duk', [
            'data' => DUK::getAllForPrint()
        ]);
    }
    public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Set Title
                $title = "Daftar Urut Kepangkatan Pegawai Negeri Sipil";
                $subTitle = "Dinas Perumahan dan Kawasan Permukiman Samarinda";
                $event->sheet->mergeCells('A3:P3');
                $event->sheet->mergeCells('A4:P4');
                $event->sheet->getStyle('A3:A4')->applyFromArray([
                    'alignment' => [
                      'horizontal' => Alignment::HORIZONTAL_CENTER,
                      'vertical' => Alignment::VERTICAL_CENTER
                    ]
                  ]);
                $event->sheet->getStyle('A3')->getFont()->setBold(true)->setSize(24);
                $event->sheet->setCellValue('A3', $title);

                $event->sheet->getStyle('A4')->getFont()->setSize(18);
                $event->sheet->setCellValue('A4', $subTitle);
                // End of Set Title
                
                // Set Content
                $event->sheet->getStyle('A6:P7')->applyFromArray([
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
                $event->sheet->getStyle('G6')
                    ->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);
                // Add borders
                $event->sheet->getStyle('A6:P100')->applyFromArray([
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
                $event->sheet->getStyle('C')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('D')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('F')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('G')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('L')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('M')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('N')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('P')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('O')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                // End of column alignment

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
        $drawing->setCoordinates('G3');
        $drawing->setOffsetX(70);

        return $drawing;
    }
}
