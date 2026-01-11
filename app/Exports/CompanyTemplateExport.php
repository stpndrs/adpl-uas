<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CompanyTemplateExport implements WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'Nama Instansi',
            'Alamat',
            'Telepon',
        ];
    }
}
