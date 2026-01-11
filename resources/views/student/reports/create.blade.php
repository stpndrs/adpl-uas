@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h3 class="fw-bold mb-4" style="color: #f97316;">Tulis Laporan Harian</h3>

        <div class="card p-5 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ route('student.reports.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Tanggal Laporan</label>
                    <input type="text" class="form-control bg-light border-0" value="{{ now()->format('d F Y') }}"
                        disabled>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Uraian Kegiatan</label>
                    <p class="text-muted small">Jelaskan secara detail tugas atau pekerjaan yang Anda selesaikan hari ini.
                    </p>
                    <textarea name="activity" class="form-control bg-light border-0 @error('activity') is-invalid @enderror" rows="8"
                        placeholder="Contoh: Melakukan perbaikan jaringan lokal, maintenance server, dll..." required>{{ old('activity') }}</textarea>
                    @error('activity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-5 fw-bold" style="border-radius: 10px;">Simpan
                        Laporan</button>
                    <a href="{{ route('student.reports.index') }}" class="btn btn-light px-5"
                        style="border-radius: 10px;">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
