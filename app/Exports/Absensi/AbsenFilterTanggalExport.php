<?php

namespace App\Exports\Absensi;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Admin\Pegawai\Absensi;
use App\Models\Admin\Pegawai\PNS;
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
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class AbsenFilterTanggalExport implements FromView, ShouldAutoSize, WithEvents, WithColumnWidths, WithDrawings
{
    use Exportable;

    private $req;
    private $idPegawai;

    public function __construct($req, $idPegawai)
    {
        $this->req = $req;
        $this->idPegawai = $idPegawai;
    }

    public function view(): View
    {
        return view('exports.absensi.absen-filter-tanggal', [
            'data' => Absensi::getAbsensiByFilter($this->req, $this->idPegawai)
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 30,
        ];
    }

    public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                 // Set column alignment
                 $event->sheet->getStyle('A')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                 $event->sheet->getStyle('B')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                 $event->sheet->getStyle('C')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                 $event->sheet->getStyle('D')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                 // End of set column alignment

                // Set Title
                $currentTahun = date("Y");
                $currentBulan = date("m");
        
                $firstDate = $this->req->first_date ? $this->req->first_date : "$currentTahun-$currentBulan-1";
                $lastDate = $this->req->last_date ? $this->req->last_date : "$currentTahun-$currentBulan-31";
                $firstDate2 = date("d/m/Y", strtotime($firstDate));
                $lastDate2 = date("d/m/Y", strtotime($lastDate));

                $title = "Laporan Rekap Absensi Pegawai";
                $subTitle = "Dinas Perumahan dan Kawasan Permukiman Samarinda";
                $subTitle2 = "Dari Tanggal $firstDate2 - $lastDate2";
                $currentDate = date("d/m/Y");
                $pegawai = PNS::getById($this->idPegawai);

                $event->sheet->mergeCells('A1:E1');
                $event->sheet->mergeCells('A2:E2');
                $event->sheet->mergeCells('A3:E3');
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

                $event->sheet->getStyle('B5')->getFont()->setBold(true);
                $event->sheet->getStyle('B5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $event->sheet->setCellValue('B5', 'Pegawai: ' . $pegawai->nama);
                // End of Set Title

                // Set Content

                // Styling Table Heading
                $event->sheet->getStyle('A6:E6')->applyFromArray([
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
                $event->sheet->getStyle('A6:E100')->applyFromArray([
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
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(10);

        return $drawing;
    }
}
