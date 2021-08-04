<?php

namespace App\Exports;

use App\Models\Admin\Pegawai\PTTB;
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

class PttbExport implements FromView, ShouldAutoSize, WithEvents, WithDrawings
{
    use Exportable;

    protected $req;

    public function __construct($req)
    {
        $this->req = $req;
    }

    public function view(): View
    {
        return view('exports.pttb', [
            'data' => PTTB::getAll($this->req)
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                // Set Title
                if ($this->req && $this->req->jenjang) {
                    $title = "Daftar Pegawai Tidak Tetap Bulanan (PTTB) Jenjang Pendidikan {$this->req->jenjang}";
                } elseif ($this->req && $this->req->kolom) {
                    $title = "Daftar Pegawai Tidak Tetap Bulanan (PTTB) Berdasarkan " . ucfirst($this->req->kolom);
                } else {
                    $title = "Daftar Pegawai Tidak Tetap Bulanan (PTTB)";
                }
                $subTitle = "Dinas Perumahan dan Kawasan Permukiman Samarinda";

                $event->sheet->mergeCells('A2:L2');
                $event->sheet->mergeCells('A3:L3');

                $event->sheet->getStyle('A2:A3')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ]);
                $event->sheet->getStyle('A2')->getFont()->setBold(true)->setSize(24);
                $event->sheet->setCellValue('A2', $title);

                $event->sheet->getStyle('A3')->getFont()->setSize(18);
                $event->sheet->setCellValue('A3', $subTitle);
                // End of Set Title

                // Set Content
                $event->sheet->getStyle('A6:L6')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ],
                ]);
                $event->sheet->getStyle('A6:L100')->applyFromArray([
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_TOP
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);
                $event->sheet->getStyle('A6:L6')->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFe69d30');

                $event->sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('E')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
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
        $drawing->setCoordinates('C2');
        $drawing->setOffsetX(120);

        return $drawing;
    }
}
