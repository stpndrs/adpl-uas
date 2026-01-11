@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold" style="color: #f97316;">Detail Aktivitas Siswa</h3>
                <p class="mb-0 text-muted">Siswa: <b>{{ $monitoring->student->name }} ({{ $monitoring->student->nisn }})</b>
                </p>
            </div>
            <a href="{{ route(auth()->user()->role == 2 ? 'teacher.monitoring.index' : 'company.monitoring.index') }}"
                class="btn btn-outline-primary px-4 fw-bold">Kembali</a>
        </div>

        <div class="card p-4 border-0 shadow-sm mb-4" style="border-radius: 15px;">
            <h5 class="fw-bold mb-3"><i class="bi bi-calendar-check me-2"></i>Log Presensi & Kegiatan</h5>
            <div class="table-responsive">
                <table class="table align-middle text-center table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $at)
                            <tr>
                                <td>{{ $at->date }}</td>
                                <td>{{ $at->check_in }}</td>
                                <td>{{ $at->check_out ?? '-' }}</td>
                                <td><span class="badge bg-primary rounded-pill px-3">{{ $at->status }}</span></td>
                                <td class="text-muted small">{{ $at->notes ?? '-' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" title="Lihat Foto & Lokasi"><i
                                            class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
            <h5 class="fw-bold mb-3"><i class="bi bi-file-earmark-text me-2"></i>Laporan Harian / Logbook</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width: 150px;">Tanggal</th>
                            <th>Uraian Kegiatan / Laporan</th>
                            <th>Komentar Guru</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $rp)
                            <tr>
                                <td class="text-center">{{ $rp->date }}</td>
                                <td>{{ \Str::limit($rp->activity, 100) }}</td>
                                <td class="text-muted italic small">{{ $rp->comment ?? 'Belum ada komentar' }}</td>
                                <td class="text-center">
                                    @if (auth()->user()->role == 2)
                                        <button class="btn btn-sm btn-warning fw-bold text-white" data-bs-toggle="modal"
                                            data-bs-target="#commentModal{{ $rp->id }}">Komentar</button>
                                    @endif
                                    <button class="btn btn-sm btn-outline-info"><i class="bi bi-download"></i></button>
                                </td>
                            </tr>

                            {{-- Modal Komentar khusus Guru --}}
                            @if (auth()->user()->role == 2)
                                <div class="modal fade" id="commentModal{{ $rp->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <form action="{{ route('teacher.report.comment', $rp->id) }}" method="POST"
                                            class="modal-content border-0" style="border-radius: 15px;">
                                            @csrf
                                            <div class="modal-body p-4">
                                                <h5 class="fw-bold mb-3 text-center">Beri Komentar Revisi</h5>
                                                <textarea name="comment" class="form-control bg-light border-0 mb-3" rows="4"
                                                    placeholder="Tulis catatan untuk siswa...">{{ $rp->comment }}</textarea>
                                                <div class="d-flex gap-2">
                                                    <button type="submit"
                                                        class="btn btn-primary w-100 fw-bold">Simpan</button>
                                                    <button type="button" class="btn btn-light w-100"
                                                        data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
