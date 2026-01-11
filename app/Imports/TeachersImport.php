<?php

namespace App\Imports;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // 1. Buat User baru berdasarkan NIP (username)
        $user = User::firstOrCreate(
            ['username' => $row['nip']],
            [
                'name'     => $row['nama'],
                'password' => Hash::make('123456'), // Password default
                'role'     => 2, // Role 2 untuk Guru
            ]
        );

        // 2. Buat data Guru dengan user_id yang baru dibuat
        return new Teacher([
            'name'      => $row['nama'],
            'nip'       => $row['nip'],
            'address'   => $row['alamat'],
            'gender'    => $row['jenis_kelamin'],
            'user_id'   => $user->id,
        ]);
    }
}
