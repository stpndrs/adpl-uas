@extends('layouts.app')
@section('content')
    <div class="mb-4">
        <h3 class="fw-bold" style="color: #f97316;">Data Presensi: {{ $monitoring->student->name }}</h3>
        <small class="text-muted">Instansi: <b>{{ $monitoring->company->name }}</b></small>
    </div>

    <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($monitoring->attendances as $presensi)
                        <tr>
                            <td>{{ $presensi->date }}</td>
                            <td>{{ $presensi->check_in }}</td>
                            <td>
                                <span class="badge {{ $presensi->status == 'Hadir' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $presensi->status }}
                                </span>
                            </td>
                            <td>{{ $presensi->notes ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data presensi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <a href="{{ route('monitoring.index') }}" class="btn btn-light px-4">Kembali</a>
        </div>
    </div>
@endsection
