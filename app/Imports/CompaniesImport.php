<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompaniesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Membuat username unik dari nama instansi (contoh: Animax Studio -> animaxstudio)
        $username = Str::slug($row['nama'], '');

        // 1. Buat User baru untuk Instansi
        $user = User::firstOrCreate(
            ['username' => $username],
            [
                'name'     => $row['nama'],
                'password' => Hash::make('123456'), // Password default
                'role'     => 3, // Role 3 untuk Instansi
            ]
        );

        // 2. Buat data Instansi
        return new Company([
            'name'    => $row['nama'],
            'address' => $row['alamat'],
            'phone'   => $row['telepon'],
            'limit'   => $row['kuota'] ?? 5, // Mengambil kolom kuota atau default 5
            'user_id' => $user->id,
        ]);
    }
}
