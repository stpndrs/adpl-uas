<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            ['name' => 'Agus Setiawan', 'address' => 'Jl. Jeruk', 'gender' => 1, 'nip' => '10203040502'],
            ['name' => 'Dinda Puspita', 'address' => 'Jl. Melati', 'gender' => 2, 'nip' => '10203040503'],
            ['name' => 'Farhan Ramadhan', 'address' => 'Jl. Mangga', 'gender' => 1, 'nip' => '10203040504'],
            ['name' => 'Nisa Kurniawati', 'address' => 'Jl. Bungtomo', 'gender' => 2, 'nip' => '10203040505'],
            ['name' => 'Fajar Pratama', 'address' => 'Jl. Sucipto', 'gender' => 1, 'nip' => '10203040506'],
            ['name' => 'Farras Muhammad', 'address' => 'Jl. AM Sangaji', 'gender' => 1, 'nip' => '10203040507'],
            ['name' => 'Alia Putri', 'address' => 'Jl. Bersama Mantan', 'gender' => 2, 'nip' => '10203040508'],
            ['name' => 'Rahmad Nurfajri', 'address' => 'Jl. Sisa Kenangan', 'gender' => 1, 'nip' => '10203040509'],
            ['name' => 'Zidan Akbar', 'address' => 'Jl. Pantai Lamaru', 'gender' => 1, 'nip' => '10203040510'],
        ];

        foreach ($teachers as $data) {
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['nip'],
                'password' => '12345678',
                'role' => 2,
            ]);

            Teacher::create([
                'name' => $data['name'],
                'address' => $data['address'],
                'gender' => $data['gender'],
                'nip' => $data['nip'],
                'user_id' => $user->id,
            ]);
        }
    }
}