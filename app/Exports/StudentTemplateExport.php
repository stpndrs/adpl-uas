<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentTemplateExport implements WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'NISN',
            'Alamat',
            'Jenis Kelamin',
            'Nama Kelas',
        ];
    }
}
