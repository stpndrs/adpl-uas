<?php

namespace App\Imports;

use App\Models\Monitoring;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Company;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class MonitoringsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // 1. Cari ID berdasarkan identitas unik dari Excel
        $student = Student::where('nisn', $row['nisn'])->first();
        $teacher = Teacher::where('nip', $row['nip'])->first();
        $company = Company::where('name', $row['nama_perusahaan'])->first();

        // 2. Jika ketiga data master ditemukan, baru simpan data monitoring
        if ($student && $teacher && $company) {
            return new Monitoring([
                'student_id' => $student->id,
                'teacher_id' => $teacher->id,
                'company_id' => $company->id,
                'start_date' => $this->transformDate($row['tanggal_mulai']),
                'end_date'   => $this->transformDate($row['tanggal_selesai']),
            ]);
        }

        // Jika ada salah satu data tidak ditemukan, baris ini akan dilewati (null)
        return null;
    }

    /**
     * Helper untuk mengubah format tanggal Excel menjadi format Database (Y-m-d)
     */
    private function transformDate($value)
    {
        try {
            // Jika formatnya angka (Excel date), ubah ke Carbon
            if (is_numeric($value)) {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('Y-m-d');
            }
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
