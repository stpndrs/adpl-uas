@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="fw-bold" style="color: #f97316;">Aktivitas PKL Saya</h3>
            <p class="text-muted">Instansi: <b>{{ $monitoring->company->name }}</b> | Pembimbing:
                <b>{{ $monitoring->teacher->name }}</b></p>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">Log Presensi</h5>
                        <a href="{{ route('student.activities.create', ['type' => 'attendance']) }}"
                            class="btn btn-sm btn-primary px-3">Isi Presensi</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $at)
                                    <tr>
                                        <td>{{ $at->date }}</td>
                                        <td>{{ $at->check_in }}</td>
                                        <td><span class="badge bg-primary">{{ $at->status }}</span></td>
                                        <td><a href="{{ route('student.activities.show', [$at->id, 'type' => 'attendance']) }}"
                                                class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">Laporan Harian</h5>
                        <a href="{{ route('student.activities.create', ['type' => 'report']) }}"
                            class="btn btn-sm btn-primary px-3">Buat Laporan</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Aktivitas</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $rp)
                                    <tr>
                                        <td>{{ $rp->date }}</td>
                                        <td>{{ \Str::limit($rp->activity, 30) }}</td>
                                        <td><span class="badge bg-secondary">{{ $rp->status }}</span></td>
                                        <td><a href="{{ route('student.activities.show', [$rp->id, 'type' => 'report']) }}"
                                                class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
