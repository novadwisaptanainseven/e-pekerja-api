<?php

namespace App\Exports;

use App\Models\Admin\Pegawai\Berkas;
use App\Models\Admin\Pegawai\Diklat;
use App\Models\Admin\Pegawai\Keluarga;
use App\Models\Admin\Pegawai\Pendidikan;
use App\Models\Admin\Pegawai\Penghargaan;
use App\Models\Admin\Pegawai\RiwayatKerja;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
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

class LaporanPegawaiExport implements FromView, ShouldAutoSize, WithEvents
{
    use Exportable;

    private $id_pegawai;
    private $data;

    public function __construct($id_pegawai, $data)
    {
        $this->id_pegawai = $id_pegawai;
        $this->data = $data;
    }

    public function view(): View
    {
        $output_data = "";
        $view = "";

        switch ($this->data) {
            case 'keluarga':
                $output_data = Keluarga::getAll($this->id_pegawai);
                $view = "keluarga";
                break;
            case 'pendidikan':
                $output_data = Pendidikan::getAll($this->id_pegawai);
                $view = "pendidikan";
                break;
            case 'diklat':
                $output_data = Diklat::getAll($this->id_pegawai);
                $view = "diklat";
                break;
            case 'riwayat-kerja':
                $output_data = RiwayatKerja::getAll($this->id_pegawai);
                $view = "riwayat-kerja";
                break;
            case 'penghargaan':
                $output_data = Penghargaan::getAll($this->id_pegawai);
                $view = "penghargaan";
                break;
            case 'berkas':
                $output_data = Berkas::getAll($this->id_pegawai);
                $view = "berkas";
                break;
            default:
                break;
        }

        return view("exports.laporan-pegawai.$view", [
            'data' => $output_data
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                // Number Formats
                $event->sheet->getStyle('A')->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_TEXT);
                // End of Number Formats

                // Set column alignment
                //  $event->sheet->getStyle('E')->getAlignment()
                //     ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                // End of set column alignment

                // Mengatasi column agar dinamis mengikuti jenis data laporan
                $jenisData = "";
                $rangeColumn = "";
                $rangeColumn2 = "";
                $rangeColumn3 = "";
                switch ($this->data) {
                    case 'keluarga':
                        $rangeColumn = "A1:I1";
                        $rangeColumn2 = "A2:I2";
                        $rangeColumn3 = "A6:I6";
                        $rangeColumn4 = "A6:I100";
                        $jenisData = "Keluarga";
                        break;
                    case 'pendidikan':
                        $rangeColumn = "A1:E1";
                        $rangeColumn2 = "A2:E2";
                        $rangeColumn3 = "A6:E6";
                        $rangeColumn4 = "A6:E100";
                        $jenisData = "Pendidikan";
                        break;
                    case 'diklat':
                        $rangeColumn = "A1:E1";
                        $rangeColumn2 = "A2:E2";
                        $rangeColumn3 = "A6:E6";
                        $rangeColumn4 = "A6:E100";
                        $jenisData = "Diklat";
                        break;
                    case 'riwayat-kerja':
                        $rangeColumn = "A1:E1";
                        $rangeColumn2 = "A2:E2";
                        $rangeColumn3 = "A6:E6";
                        $rangeColumn4 = "A6:E100";
                        $jenisData = "Riwayat Kerja";
                        break;
                    case 'penghargaan':
                        $rangeColumn = "A1:C1";
                        $rangeColumn2 = "A2:C2";
                        $rangeColumn3 = "A6:C6";
                        $rangeColumn4 = "A6:C100";
                        $jenisData = "Penghargaan";
                        break;
                    case 'berkas':
                        $rangeColumn = "A1:I1";
                        $rangeColumn2 = "A2:I2";
                        $rangeColumn3 = "A6:I6";
                        $rangeColumn4 = "A6:I100";
                        $jenisData = "Berkas";
                        break;
                    default:
                        break;
                }

                // End

                // Set Title
                $title = "Laporan Data $jenisData";
                $subTitle = "Dinas Perumahan dan Kawasan Permukiman Samarinda";
                $currentDate = date("d/m/Y");
                $pegawai = DB::table("pegawai")
                    ->where("id_pegawai", "=", $this->id_pegawai)
                    ->first();

                $event->sheet->mergeCells($rangeColumn);
                $event->sheet->mergeCells($rangeColumn2);
                $event->sheet->getStyle('A1:A2')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ]);
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(24);
                $event->sheet->setCellValue('A1', $title);

                $event->sheet->getStyle('A2')->getFont()->setSize(18);
                $event->sheet->getStyle('A2')->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
                $event->sheet->setCellValue('A2', $subTitle);

                $event->sheet->getStyle('A3')->getFont()->setBold(true);
                $event->sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $event->sheet->setCellValue('A3', 'Tanggal: ' . $currentDate);
                $event->sheet->getStyle('A4')->getFont()->setBold(true);
                $event->sheet->getStyle('A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $event->sheet->setCellValue('A4', 'Pegawai: ' . $pegawai->nama);
                $event->sheet->getRowDimension('2')
                    ->setRowHeight(30);
                // End of Set Title

                // Set Content

                // Styling Table Heading
                $event->sheet->getStyle($rangeColumn3)->applyFromArray([
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
                $event->sheet->getStyle($rangeColumn4)->applyFromArray([
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
}
