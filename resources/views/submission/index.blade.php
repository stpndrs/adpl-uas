@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold text-orange" style="color: #f97316;">Daftar Pengajuan (Submission)</h3>
                <small class="text-muted">> Monitoring > <b>Status Pengajuan</b></small>
            </div>
            <a href="{{ route('submissions.create') }}" class="btn btn-primary px-4 fw-bold" style="border-radius: 10px;">
                <i class="bi bi-plus-lg"></i> Tambah Pengajuan
            </a>
        </div>

        <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ url()->current() }}" method="GET" class="d-flex justify-content-center mb-4">
                <div class="input-group w-50 border rounded-pill overflow-hidden">
                    <input type="text" name="search" class="form-control border-0 px-3"
                        placeholder="Cari Nama Siswa atau Perusahaan..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    @if (request('search'))
                        <a href="{{ url()->current() }}" class="btn btn-outline-secondary px-3"><i
                                class="bi bi-x-lg"></i></a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Siswa</th>
                            <th>Perusahaan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi Persetujuan</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($submissions as $sub)
                            <tr>
                                <td>
                                    <b>{{ $sub->student->name }}</b><br>
                                    <small class="text-muted">{{ $sub->student->nisn }}</small>
                                </td>
                                <td>{{ $sub->company->name }}</td>
                                <td class="text-center">
                                    @if ($sub->is_accepted == 0)
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif($sub->is_accepted == 1)
                                        <span class="badge bg-success">Diterima</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($sub->is_accepted == 0)
                                        <div class="d-flex justify-content-center gap-2">
                                            <form action="{{ route('submissions.approve', $sub->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" class="btn btn-sm btn-success px-3"
                                                    onclick="return confirm('Terima pengajuan ini?')">
                                                    <i class="bi bi-check-circle"></i> Terima
                                                </button>
                                            </form>
                                            <form action="{{ route('submissions.approve', $sub->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="2">
                                                <button type="submit" class="btn btn-sm btn-outline-danger px-3"
                                                    onclick="return confirm('Tolak pengajuan ini?')">
                                                    <i class="bi bi-x-circle"></i> Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <small class="text-muted italic">Sudah Diproses</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('submissions.edit', $sub->id) }}"
                                        class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('submissions.destroy', $sub->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus data?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted p-4">Data pengajuan tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
