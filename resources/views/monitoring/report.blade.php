@extends('layouts.app')
@section('content')
    <div class="mb-4">
        <h3 class="fw-bold" style="color: #f97316;">Laporan Harian: {{ $monitoring->student->name }}</h3>
        <small class="text-muted">Instansi: <b>{{ $monitoring->company->name }}</b></small>
    </div>

    <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 150px;">Tanggal</th>
                        <th>Aktivitas / Pekerjaan</th>
                        <th style="width: 150px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($monitoring->reports as $laporan)
                        <tr>
                            <td>{{ $laporan->date }}</td>
                            <td>{{ $laporan->activity }}</td>
                            <td>
                                @if ($laporan->status == 'Verified')
                                    <span class="text-success small fw-bold"><i class="bi bi-check-circle-fill"></i>
                                        Terverifikasi</span>
                                @else
                                    <span class="text-muted small">Pending</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada laporan harian</td>
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
