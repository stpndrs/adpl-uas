@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="fw-bold text-orange" style="color: #f97316;">Detail Presensi & Kegiatan</h3>
            <p class="mb-0 small">Siswa: <b>{{ $monitoring->student->name }}</b> | Instansi:
                <b>{{ $monitoring->company->name }}</b></p>
        </div>

        <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
            <table class="table align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Status</th>
                        <th>Jam Keluar</th>
                        <th>Keterangan</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $at)
                        <tr>
                            <td>{{ $at->date }}</td>
                            <td>{{ $at->check_in }}</td>
                            <td><span class="badge bg-primary">Hadir</span></td>
                            <td>{{ $at->check_out ?? '-' }}</td>
                            <td>{{ $at->notes ?? '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" title="Lihat Gambar"><i
                                        class="bi bi-image"></i></button>
                                <button class="btn btn-sm btn-outline-info" title="Lihat Lokasi"><i
                                        class="bi bi-geo-alt"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('teacher.monitoring.index') }}" class="btn btn-primary mt-3 w-25">Kembali</a>
        </div>
    </div>
@endsection
