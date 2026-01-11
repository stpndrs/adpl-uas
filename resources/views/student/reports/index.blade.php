@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-orange" style="color: #f97316;">Laporan Harian PKL</h3>
                <small class="text-muted">Riwayat aktivitas dan logbook harian Anda</small>
            </div>
            <a href="{{ route('student.reports.create') }}" class="btn btn-primary px-4 fw-bold" style="border-radius: 10px;">
                <i class="bi bi-pencil-square me-2"></i> Buat Laporan Hari Ini
            </a>
        </div>

        <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width: 150px;">Tanggal</th>
                            <th>Ringkasan Kegiatan</th>
                            <th>Status</th>
                            <th>Komentar Guru</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $rp)
                            <tr>
                                <td class="text-center">{{ \Carbon\Carbon::parse($rp->date)->format('d M Y') }}</td>
                                <td>{{ \Str::limit($rp->activity, 80) }}</td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $rp->status == 'Final' ? 'bg-success' : 'bg-secondary' }} rounded-pill px-3">
                                        {{ $rp->status }}
                                    </span>
                                </td>
                                <td class="small text-muted text-center">
                                    {{ $rp->comment ? 'Ada Komentar' : '-' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('student.reports.show', $rp->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-5 text-muted">Belum ada laporan yang dibuat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $reports->links() }}</div>
        </div>
    </div>
@endsection
