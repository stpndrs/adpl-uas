@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="fw-bold" style="color: #f97316;">Data Monitoring Siswa</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="font-size: 12px;">
                    <li class="breadcrumb-item active">Monitoring</li>
                </ol>
            </nav>
        </div>

        <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ url()->current() }}" method="GET" class="d-flex justify-content-center mb-4">
                <div class="input-group w-50 border rounded-pill overflow-hidden">
                    <input type="text" name="search" class="form-control border-0 px-3" placeholder="Cari nama siswa..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th class="text-start">Nama</th>
                            <th>NISN</th>
                            <th>Kelas</th>
                            <th>Periode PKL</th>
                            <th>{{ auth()->user()->role == 2 ? 'Instansi' : 'Pembimbing' }}</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($monitorings as $item)
                            <tr>
                                <td class="text-start"><b>{{ $item->student->name }}</b></td>
                                <td>{{ $item->student->nisn }}</td>
                                <td>{{ $item->student->class ?? 'XII' }}</td>
                                <td>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($item->start_date)->format('M Y') }} -
                                        {{ \Carbon\Carbon::parse($item->end_date)->format('M Y') }}
                                    </small>
                                </td>
                                <td>{{ auth()->user()->role == 2 ? $item->company->name : $item->teacher->name }}</td>
                                <td>
                                    <a href="{{ route(auth()->user()->role == 2 ? 'teacher.monitoring.show' : 'company.monitoring.show', $item->id) }}"
                                        class="btn btn-sm btn-primary px-4 fw-bold" style="border-radius: 8px;">
                                        Detail Aktivitas
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted p-4">Tidak ada data siswa ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $monitorings->links() }}
            </div>
        </div>
    </div>
@endsection
