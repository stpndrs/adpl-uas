@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h3 class="fw-bold text-orange mb-4" style="color: #f97316;">Detail Laporan Siswa</h3>

        <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
            <table class="table align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Tanggal</th>
                        <th>Komentar Revisi</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $rp)
                        <tr>
                            <td class="text-center">{{ $rp->date }}</td>
                            <td>{{ $rp->comment ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge {{ $rp->status == 'Final' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $rp->status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#commentModal{{ $rp->id }}">
                                    Tambah Komentar
                                </button>
                                <button class="btn btn-sm btn-outline-info">Lihat Dokumen</button>
                            </td>
                        </tr>

                        <div class="modal fade" id="commentModal{{ $rp->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0" style="border-radius: 15px;">
                                    <div class="modal-body p-4 text-center">
                                        <h5 class="fw-bold mb-3">Masukkan Komentar</h5>
                                        <form action="{{ route('teacher.report.comment', $rp->id) }}" method="POST">
                                            @csrf
                                            <textarea name="comment" class="form-control bg-light border-0 mb-3" rows="5"
                                                placeholder="Masukkan komentar revisi..."></textarea>
                                            <button type="submit" class="btn btn-primary w-100 fw-bold">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
