@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h3 class="fw-bold mb-4" style="color: #f97316;">Status Pengajuan PKL</h3>

        <div class="card p-5 border-0 shadow-sm text-center" style="border-radius: 15px;">
            <div class="mb-4">
                <i class="bi bi-send-check text-orange" style="font-size: 3rem; color: #f97316;"></i>
            </div>

            <h5>Anda telah mengajukan PKL ke:</h5>
            <h3 class="fw-bold mb-3">{{ $submission->company->name }}</h3>

            <div
                class="d-inline-block px-4 py-2 rounded-pill fw-bold 
            @if ($submission->is_accepted == 0) bg-light text-warning 
            @elseif($submission->is_accepted == 1) bg-light text-success 
            @else bg-light text-danger @endif">
                Status:
                @if ($submission->is_accepted == 0)
                    <i class="bi bi-clock-history me-1"></i> Menunggu Konfirmasi
                @elseif($submission->is_accepted == 1)
                    <i class="bi bi-check-circle me-1"></i> Pengajuan Diterima
                @else
                    <i class="bi bi-x-circle me-1"></i> Pengajuan Ditolak
                @endif
            </div>

            <p class="mt-4 text-muted small">
                @if ($submission->is_accepted == 1)
                    Silahkan cek menu <b>Presensi & Kegiatan</b> untuk memulai aktivitas PKL.
                @else
                    Mohon tunggu informasi lebih lanjut dari pihak sekolah atau instansi terkait.
                @endif
            </p>
        </div>
    </div>
@endsection
