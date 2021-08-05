<?php

namespace App\Exports;

use App\Models\Admin\Pegawai\PNS;
use App\Models\Admin\PembaruanSK;
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

class PembaruanSKExport implements FromView, ShouldAutoSize, WithEvents, WithDrawings
{
    use Exportable;

    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('exports.riwayat-sk', [
            'data' => PembaruanSK::getAll($this->id),
            'pegawai' => PNS::getById($this->id)
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                // Set column alignment
                $event->sheet->getStyle('A')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('B')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('E')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('F')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                // End of set column alignment

                // Cek Status Pegawai
                $pegawai = PNS::getById($this->id);
                if ($pegawai->id_status_pegawai == 2) {
                    $rangeCol = "H";
                } else {
                    $rangeCol = "J";
                }

                // Set Title

                $title = "Riwayat SK Pegawai Negeri Sipil";
                $subTitle = "Dinas Perumahan dan Kawasan Permukiman Samarinda";
                $currentDate = date("d/m/Y");

                $event->sheet->mergeCells("A1:$rangeCol" . "1");
                $event->sheet->mergeCells("A2:$rangeCol" . "2");
                $event->sheet->getStyle("A1:$rangeCol" . "3")->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_TOP
                    ]
                ]);
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(24);
                $event->sheet->setCellValue('A1', $title);

                $event->sheet->getStyle('A2')->getFont()->setSize(18);
                $event->sheet->setCellValue('A2', $subTitle);
                $event->sheet->getRowDimension('2')->setRowHeight(50);

                $event->sheet->getStyle('B3')->getFont()->setBold(true);
                $event->sheet->getStyle('B3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $event->sheet->setCellValue('B3', 'Tanggal: ' . $currentDate);

                $event->sheet->getStyle('B4')->getFont()->setBold(true);
                $event->sheet->getStyle('B4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $event->sheet->setCellValue('B4', 'Pegawai: ' . $pegawai->nama);
                // End of Set Title

                // Set Content

                // Styling Table Heading
                $event->sheet->getStyle("A6:$rangeCol" . "6")->applyFromArray([
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
                $event->sheet->getStyle("A6:$rangeCol" . "100")->applyFromArray([
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
        $drawing->setCoordinates('A1');
        $drawing->setOffsetX(30);
        $drawing->setOffsetY(10);

        return $drawing;
    }
}
