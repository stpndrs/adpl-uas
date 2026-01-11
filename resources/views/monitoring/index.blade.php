@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold text-orange" style="color: #f97316;">Data Monitoring PKL</h3>
            <small class="text-muted">> Data Master > <b>Monitoring</b></small>
        </div>
        <a href="{{ route('monitorings.create') }}" class="btn btn-primary">Tambah Monitoring</a>
    </div>

    <div class="card p-4">
        <form action="{{ url()->current() }}" method="GET" class="d-flex justify-content-center mb-4">
            <div class="input-group w-50 border rounded-pill overflow-hidden">
                <input type="text" name="search" class="form-control border-0 px-3" placeholder="Cari Nama Siswa..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Siswa</th>
                        <th>Instansi</th>
                        <th>Pembimbing</th>
                        <th>Periode</th>
                        <th class="text-center">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monitorings as $item)
                        <tr>
                            <td><b>{{ $item->student->name }}</b><br><small>{{ $item->student->nisn }}</small></td>
                            <td>{{ $item->company->name }}</td>
                            <td>{{ $item->teacher->name }}</td>
                            <td><span class="badge bg-light text-dark">{{ $item->start_date }} s/d
                                    {{ $item->end_date }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('monitoring.attendance', $item->id) }}"
                                    class="btn btn-sm btn-outline-primary" title="Lihat Presensi">
                                    <i class="bi bi-calendar-check"></i>
                                </a>

                                <a href="{{ route('monitoring.report', $item->id) }}" class="btn btn-sm btn-outline-info"
                                    title="Lihat Laporan">
                                    <i class="bi bi-file-earmark-text"></i>
                                </a>

                                <a href="{{ route('monitoring.edit', $item->id) }}"
                                    class="btn btn-sm btn-outline-warning text-warning"><i class="bi bi-pencil"></i></a>

                                <form action="{{ route('monitoring.destroy', $item->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $monitorings->links() }}
        </div>
    </div>
@endsection
