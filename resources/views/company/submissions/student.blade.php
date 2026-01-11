@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="fw-bold text-orange" style="color: #f97316;">Daftar Siswa PKL Aktif</h3>
        </div>

        <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Nama Siswa</th>
                            <th>NISN</th>
                            <th>Guru Pembimbing</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $item)
                            <tr>
                                <td class="fw-bold">{{ $item->student->name }}</td>
                                <td class="text-center">{{ $item->student->nisn }}</td>
                                <td class="text-center">{{ $item->teacher->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('company.student.activity', $item->id) }}"
                                        class="btn btn-sm btn-primary px-3">
                                        Pantau Aktivitas
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
