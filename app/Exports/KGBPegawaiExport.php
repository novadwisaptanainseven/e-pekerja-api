<?php

namespace App\Exports;

use App\Http\Controllers\Admin\KGBController;
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

class KgbPegawaiExport implements FromView, ShouldAutoSize, WithEvents, WithDrawings
{
    use Exportable;

    private $req;

    public function __construct($req)
    {
        $this->req = $req;
    }

    public function view(): View
    {
        return view('exports.kgb_pegawai', [
            'data' => KGBController::getKGBPegawaiForPrint($this->req)
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                // Set column alignment
                $event->sheet->getStyle('A')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('E')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('H')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('C')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                // End of set column alignment

                // Set Title
                $title = "Semua Kenaikan Gaji Berkala Pegawai Negeri Sipil";
                $subTitle = "Dinas Perumahan dan Kawasan Permukiman Samarinda";
                if (!$this->req->bulan || !$this->req->tahun) {
                    $subTitle2 = "";
                } else {
                    $tgl = $this->req->tahun . "-" . $this->req->bulan . "-" . 1;

                    $keadaan = formatTanggalIndonesia($tgl);
                    $subTitle2 = "Keadaan {$keadaan['bulan']} {$keadaan['tahun']}";
                }
                $currentDate = date("d/m/Y");

                $event->sheet->mergeCells('A1:H1');
                $event->sheet->mergeCells('A2:H2');
                $event->sheet->mergeCells('A3:H3');
                $event->sheet->getStyle('A1:A2')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_TOP
                    ]
                ]);
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(24);
                $event->sheet->setCellValue('A1', $title);

                $event->sheet->getStyle('A2')->getFont()->setSize(18);
                $event->sheet->setCellValue('A2', $subTitle);
                $event->sheet->getStyle('A3')->getFont()->setSize(18);
                $event->sheet->setCellValue('A3', $subTitle2);
                // $event->sheet->getRowDimension('3')->setRowHeight(50);

                $event->sheet->getStyle('B3')->getFont()->setBold(true);
                $event->sheet->getStyle('B3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $event->sheet->setCellValue('B3', 'Tanggal: ' . $currentDate);
                // End of Set Title

                // Set Content

                // Styling Table Heading
                $event->sheet->getStyle('A6:H6')->applyFromArray([
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
                $event->sheet->getStyle('A6:H100')->applyFromArray([
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
