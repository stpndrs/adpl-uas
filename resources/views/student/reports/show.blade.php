@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold" style="color: #f97316;">Detail Laporan</h3>
            <a href="{{ route('student.reports.index') }}" class="btn btn-outline-primary px-4">Kembali</a>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card p-4 border-0 shadow-sm mb-4" style="border-radius: 15px;">
                    <h6 class="text-muted mb-1">Tanggal: {{ \Carbon\Carbon::parse($report->date)->format('d F Y') }}</h6>
                    <hr>
                    <h5 class="fw-bold mb-3">Uraian Kegiatan:</h5>
                    <p style="white-space: pre-line; line-height: 1.8;">{{ $report->activity }}</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px; background-color: #fffaf0;">
                    <h6 class="fw-bold mb-3"><i class="bi bi-chat-left-text me-2 text-orange"></i> Feedback Guru</h6>
                    @if ($report->comment)
                        <p class="small text-dark">{{ $report->comment }}</p>
                        <hr>
                        <small class="text-muted">Status: <span class="badge bg-success">Sudah Direview</span></small>
                    @else
                        <p class="small text-muted italic">Belum ada komentar atau arahan dari guru pembimbing untuk laporan
                            ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
