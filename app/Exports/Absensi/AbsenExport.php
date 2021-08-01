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

class AbsenExport implements FromView, ShouldAutoSize, WithEvents, WithColumnWidths, WithDrawings
{
    use Exportable;
    
    private $jenis;

    public function __construct($jenis)
    {
        $this->jenis = $jenis;
    }

    public function view(): View
    {
        return view('exports.absensi.absen', [
            'data' => Absensi::getByStatusPegawai($this->jenis)
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'D' => 10,
            'E' => 10,
            'F' => 10,
            'G' => 10,
        ];
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
                $jenisPegawai = "";
                switch($this->jenis)
                {
                    case 'pns' : 
                        $jenisPegawai = "Pegawai Negeri Sipil (PNS)";
                        break;
                    case 'ptth' :
                        $jenisPegawai = "Pegawai Tidak Tetap Harian (PTTH)";
                        break;
                    case 'pttb' :
                        $jenisPegawai = "Pegawai Tidak Tetap Bulanan (PTTB)";
                        break;
                    default: 
                        break;
                }
                $title = "Laporan Rekap Absensi $jenisPegawai";
                $subTitle = "Dinas Perumahan dan Kawasan Permukiman Samarinda";
                $subTitle2 = "Keadaan Tahun " . date("Y");
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

                $event->sheet->getStyle('B5')->getFont()->setBold(true);
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
        $drawing->setOffsetX(0);
        $drawing->setOffsetY(10);

        return $drawing;
    }
}
