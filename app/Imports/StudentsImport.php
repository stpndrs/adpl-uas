<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // 1. Buat User baru atau ambil jika sudah ada berdasarkan username (NISN)
        $user = User::firstOrCreate(
            ['username' => $row['nisn']],
            [
                'name'     => $row['nama'],
                'password' => Hash::make('123456'), // Password default
                'role'     => 1,
            ]
        );

        // 2. Buat data Siswa dengan user_id yang dinamis
        return new Student([
            'name'     => $row['nama'],
            'nisn'     => $row['nisn'],
            'address'  => $row['alamat'],
            'gender'   => $row['jenis_kelamin'],
            'class'    => $row['kelas'],
            'user_id'  => $user->id, // Dinamis dari tabel users
        ]);
    }
}
