@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h3 class="fw-bold mb-4" style="color: #f97316;">Isi {{ $type == 'attendance' ? 'Presensi' : 'Laporan Harian' }}</h3>

        <div class="card p-5 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ route('student.activities.store') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">

                @if ($type == 'attendance')
                    <div class="mb-3">
                        <label class="small text-muted">Status Kehadiran</label>
                        <select name="status" class="form-select bg-light border-0" required>
                            <option value="Hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted">Keterangan (Opsional)</label>
                        <textarea name="notes" class="form-control bg-light border-0" rows="3"></textarea>
                    </div>
                @else
                    <div class="mb-3">
                        <label class="small text-muted">Uraian Kegiatan Hari Ini</label>
                        <textarea name="activity" class="form-control bg-light border-0" rows="6"
                            placeholder="Apa yang Anda kerjakan hari ini?" required></textarea>
                    </div>
                @endif

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-5 fw-bold">Simpan Aktivitas</button>
                    <a href="{{ route('student.activities.index') }}" class="btn btn-light px-5">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
