<?php

namespace App\Exports;

use App\Models\Admin\Pegawai\PNS;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;

class PnsExport implements FromView, ShouldAutoSize, WithStyles
{
    use Exportable;

     public function view(): View
    {
        return view('exports.pns', [
            'data' => PNS::getAll()
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle()->getFont()->setBold(true);
    }

}
