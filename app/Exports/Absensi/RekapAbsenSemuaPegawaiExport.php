<?php

namespace App\Exports\Absensi;

use App\Models\Admin\Pegawai\Absensi;
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

class RekapAbsenSemuaPegawaiExport implements FromView, ShouldAutoSize, WithEvents, WithDrawings
{
    use Exportable;

    private $req;
    private $filter;

    public function __construct($req, $filter)
    {
        $this->req = $req;
        $this->filter = $filter;
    }

    public function view(): View
    {
        $outputData = "";

        if($this->filter == "tahun")
        {
            $outputData = Absensi::getAllRekapAbsensiPerTahun($this->req);
        }
        else if($this->filter == "tanggal")
        {
            $outputData = Absensi::getRekapAbsensiByDate($this->req);
        }

        return view('exports.absensi.rekap-absen-semua-pegawai', [
            'data' => $outputData
        ]);
    }

    public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                 // Set column alignment
                 $event->sheet->getStyle('A')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                 $event->sheet->getStyle('D')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                 $event->sheet->getStyle('E')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                 $event->sheet->getStyle('F')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                 $event->sheet->getStyle('G')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                 $event->sheet->getStyle('H')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                 // End of set column alignment

                // Set Title
                $reqTahun = $this->req->tahun ? $this->req->tahun : date("Y");

                $title = "Laporan Rekap Absensi PNS, PTTB, dan PTTH";
                $subTitle = "Dinas Perumahan dan Kawasan Permukiman Samarinda";

                $subTitle2 = "";
                if($this->filter == "tahun")
                {
                    $subTitle2 = "Keadaan Tahun " . $reqTahun;
                }
                else if($this->filter == "tanggal")
                {
                    $currentTahun = date("Y");
                    $currentBulan = date("m");

                    $firstDate = $this->req->first_date ? $this->req->first_date : "$currentTahun-$currentBulan-1";
                    $lastDate = $this->req->last_date ? $this->req->last_date : "$currentTahun-$currentBulan-31";
                    $firstDate2 = date("d/m/Y", strtotime($firstDate));
                    $lastDate2 = date("d/m/Y", strtotime($lastDate));

                    $subTitle2 = "Dari tanggal: $firstDate2 - $lastDate2";
                }
                
                $currentDate = date("d/m/Y");

                $event->sheet->mergeCells('A1:H1');
                $event->sheet->mergeCells('A2:H2');
                $event->sheet->mergeCells('A3:H3');
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
        $drawing->setCoordinates('B1');
        $drawing->setOffsetX(40);
        $drawing->setOffsetY(10);

        return $drawing;
    }
}
