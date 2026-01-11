<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['name' => 'Dina Santoso', 'address' => 'Jl. Dahlia', 'gender' => 2, 'class' => 'XII AN 1', 'nisn' => '12345688'],
            ['name' => 'Maya Wijaya', 'address' => 'Jl. Bungtomo', 'gender' => 2, 'class' => 'XII AN 1', 'nisn' => '12345689'],
            ['name' => 'Fitri Ramadhan', 'address' => 'Jl. Mangga Buah', 'gender' => 2, 'class' => 'XII AN 1', 'nisn' => '12345690'],
            ['name' => 'Maya Fadhillah', 'address' => 'Jl. Melati', 'gender' => 2, 'class' => 'XII AN 1', 'nisn' => '12345691'],
            ['name' => 'Tari Putra', 'address' => 'Jl. Dahlia', 'gender' => 2, 'class' => 'XII AN 1', 'nisn' => '12345692'],
            ['name' => 'Agus Lestari', 'address' => 'Jl. Nangka', 'gender' => 1, 'class' => 'XII AN 1', 'nisn' => '12345693'],
            ['name' => 'Fauzan Saputra', 'address' => 'Jl. Melati', 'gender' => 1, 'class' => 'XII AN 1', 'nisn' => '12345694'],
            ['name' => 'Fauzan Nurhaliza', 'address' => 'Jl. Cempaka', 'gender' => 1, 'class' => 'XII AN 1', 'nisn' => '12345695'],
            ['name' => 'Vauzan Saputra', 'address' => 'Jl. Tunjungan', 'gender' => 1, 'class' => 'XII AN 1', 'nisn' => '12345696'],
            ['name' => 'Siti Salsabila', 'address' => 'Jl. Anggrek', 'gender' => 2, 'class' => 'XII AN 1', 'nisn' => '12345697'],
            ['name' => 'Dewi Permata', 'address' => 'Jl. Merdeka', 'gender' => 2, 'class' => 'XII AN 1', 'nisn' => '12345698'],
            ['name' => 'Dina Nurhaliza', 'address' => 'Jl. Anggrek', 'gender' => 2, 'class' => 'XII AN 1', 'nisn' => '12345699'],
            ['name' => 'Dina Santoso', 'address' => 'Jl. Cempaka', 'gender' => 2, 'class' => 'XII AN 1', 'nisn' => '12345700'],
            ['name' => 'Lestari Lestari', 'address' => 'Jl. Nangka', 'gender' => 2, 'class' => 'XII AN 1', 'nisn' => '12345701'],
            ['name' => 'Maya Lestari', 'address' => 'Jl. Srikaya', 'gender' => 2, 'class' => 'XII DKV 1', 'nisn' => '12345702'],
            ['name' => 'Budi Amelia', 'address' => 'Jl. Ir Soekarno', 'gender' => 1, 'class' => 'XII DKV 1', 'nisn' => '12345703'],
            ['name' => 'Fitri Permata', 'address' => 'Jl. Nangka', 'gender' => 2, 'class' => 'XII DKV 1', 'nisn' => '12345704'],
            ['name' => 'Niko Lestari', 'address' => 'Jl. Pahlawan', 'gender' => 1, 'class' => 'XII DKV 1', 'nisn' => '12345705'],
            ['name' => 'Fitri Kusuma', 'address' => 'Jl. Srikaya', 'gender' => 2, 'class' => 'XII DKV 1', 'nisn' => '12345706'],
            ['name' => 'Putri Santoso', 'address' => 'Jl. Bungtomo', 'gender' => 2, 'class' => 'XII DKV 1', 'nisn' => '12345707'],
            ['name' => 'Dimas Awido', 'address' => 'Jl. Cempaka', 'gender' => 1, 'class' => 'XII DKV 1', 'nisn' => '12345708'],
            ['name' => 'Indra Ramadhan', 'address' => 'Jl. Nangka', 'gender' => 1, 'class' => 'XII DKV 1', 'nisn' => '12345709'],
            ['name' => 'Indra Kusuma', 'address' => 'Jl. Kenanga', 'gender' => 1, 'class' => 'XII DKV 2', 'nisn' => '12345710'],
            ['name' => 'Fajar Putra', 'address' => 'Jl. Tunjungan', 'gender' => 1, 'class' => 'XII DKV 2', 'nisn' => '12345711'],
            ['name' => 'Nadia Wijaya', 'address' => 'Jl. Tunjungan', 'gender' => 2, 'class' => 'XII DKV 2', 'nisn' => '12345712'],
            ['name' => 'Agus Lestari', 'address' => 'Jl. Anggrek', 'gender' => 1, 'class' => 'XII DKV 2', 'nisn' => '12345713'],
            ['name' => 'Dewi Pratama', 'address' => 'Jl. Dahlia', 'gender' => 2, 'class' => 'XII DKV 2', 'nisn' => '12345714'],
            ['name' => 'Maya Amelia', 'address' => 'Jl. Margorejo', 'gender' => 2, 'class' => 'XII DKV 2', 'nisn' => '12345715'],
            ['name' => 'Putri Putri', 'address' => 'Jl. Mawar', 'gender' => 2, 'class' => 'XII DKV 2', 'nisn' => '12345716'],
            ['name' => 'Andi Saputra', 'address' => 'Jl. Margorejo', 'gender' => 1, 'class' => 'XII PPLG 1', 'nisn' => '12345717'],
            ['name' => 'Rina Lestari', 'address' => 'Jl. Pahlawan', 'gender' => 2, 'class' => 'XII PPLG 1', 'nisn' => '12345718'],
            ['name' => 'Bayu Lestari', 'address' => 'Jl. Kenanga', 'gender' => 1, 'class' => 'XII PPLG 1', 'nisn' => '12345719'],
            ['name' => 'Andi Amelia', 'address' => 'Jl. Nangka', 'gender' => 1, 'class' => 'XII PPLG 1', 'nisn' => '12345720'],
            ['name' => 'Siti Maulida', 'address' => 'Jl. Nangka', 'gender' => 2, 'class' => 'XII PPLG 1', 'nisn' => '12345721'],
            ['name' => 'Ayu Amelia', 'address' => 'Jl. Melati', 'gender' => 2, 'class' => 'XII PPLG 1', 'nisn' => '12345722'],
            ['name' => 'Ilham Santoso', 'address' => 'Jl. Melati', 'gender' => 1, 'class' => 'XII PPLG 1', 'nisn' => '12345723'],
            ['name' => 'Rian Amelia', 'address' => 'Jl. Mawar', 'gender' => 1, 'class' => 'XII PPLG 1', 'nisn' => '12345724'],
            ['name' => 'Tari Lestari', 'address' => 'Jl. Merdeka', 'gender' => 2, 'class' => 'XII PPLG 2', 'nisn' => '12345725'],
            ['name' => 'Agus Santoso', 'address' => 'Jl. Cempaka', 'gender' => 1, 'class' => 'XII PPLG 2', 'nisn' => '12345726'],
            ['name' => 'Tari Kusuma', 'address' => 'Jl. Merdeka', 'gender' => 2, 'class' => 'XII PPLG 2', 'nisn' => '12345727'],
            ['name' => 'Tari Putra', 'address' => 'Jl. Anggrek', 'gender' => 2, 'class' => 'XII PPLG 2', 'nisn' => '12345728'],
            ['name' => 'Bayu Ramadhan', 'address' => 'Jl. Dahlia', 'gender' => 1, 'class' => 'XII PPLG 2', 'nisn' => '12345729'],
            ['name' => 'Indra Nurhaliza', 'address' => 'Jl. Margorejo', 'gender' => 1, 'class' => 'XII PPLG 2', 'nisn' => '12345730'],
            ['name' => 'Rian Saputra', 'address' => 'Jl. Melati', 'gender' => 1, 'class' => 'XII PPLG 2', 'nisn' => '12345731'],
            ['name' => 'Bayu Kusuma', 'address' => 'Jl. Cempaka', 'gender' => 1, 'class' => 'XII TJKT 1', 'nisn' => '12345732'],
            ['name' => 'Anisa Lestari', 'address' => 'Jl. Nangka', 'gender' => 2, 'class' => 'XII TJKT 1', 'nisn' => '12345733'],
            ['name' => 'Siti Saputra', 'address' => 'Jl. Pahlawan', 'gender' => 2, 'class' => 'XII TJKT 1', 'nisn' => '12345734'],
            ['name' => 'Joko Salsabila', 'address' => 'Jl. Cempaka', 'gender' => 1, 'class' => 'XII TJKT 1', 'nisn' => '12345735'],
            ['name' => 'Dewi Lestari', 'address' => 'Jl. Pahlawan', 'gender' => 2, 'class' => 'XII TJKT 1', 'nisn' => '12345736'],
            ['name' => 'Intan Ramadhan', 'address' => 'Jl. Pahlawan', 'gender' => 2, 'class' => 'XII TJKT 2', 'nisn' => '12345737'],
            ['name' => 'Salsa Saputra', 'address' => 'Jl. Kenanga', 'gender' => 2, 'class' => 'XII TJKT 2', 'nisn' => '12345738'],
            ['name' => 'Rizky Amelia', 'address' => 'Jl. Kenanga', 'gender' => 1, 'class' => 'XII TJKT 2', 'nisn' => '12345739'],
            ['name' => 'Ilham Ramadhan', 'address' => 'Jl. Kenanga', 'gender' => 1, 'class' => 'XII TJKT 2', 'nisn' => '12345740'],
            ['name' => 'Fitri Putra', 'address' => 'Jl. Dahlia', 'gender' => 2, 'class' => 'XII TJKT 2', 'nisn' => '12345741'],
            ['name' => 'Lestari Putra', 'address' => 'Jl. Nangka', 'gender' => 2, 'class' => 'XII TJKT 3', 'nisn' => '12345742'],
            ['name' => 'Andi Pratama', 'address' => 'Jl. Mawar', 'gender' => 1, 'class' => 'XII TJKT 3', 'nisn' => '12345743'],
            ['name' => 'Agus Awido', 'address' => 'Jl. Bungtomo', 'gender' => 1, 'class' => 'XII TJKT 3', 'nisn' => '12345744'],
            ['name' => 'Nia Wijaya', 'address' => 'Jl. Cempaka', 'gender' => 2, 'class' => 'XII TJKT 3', 'nisn' => '12345745'],
        ];

        foreach ($students as $data) {
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['nisn'],
                'password' => '12345678',
                'role' => 4,
            ]);

            Student::create([
                'name' => $data['name'],
                'nisn' => $data['nisn'],
                'address' => $data['address'],
                'gender' => $data['gender'],
                'class' => $data['class'],
                'user_id' => $user->id,
            ]);
        }
    }
}
