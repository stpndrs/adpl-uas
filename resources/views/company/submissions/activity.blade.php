@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-orange" style="color: #f97316;">Aktivitas: {{ $monitoring->student->name }}</h3>
            <a href="{{ route('company.students.index') }}" class="btn btn-sm btn-outline-primary px-4">Kembali</a>
        </div>

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
                    <h5 class="fw-bold mb-3">Log Presensi</h5>
                    <table class="table table-sm align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Masuk</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $at)
                                <tr>
                                    <td>{{ $at->date }}</td>
                                    <td>{{ $at->check_in }}</td>
                                    <td><span class="badge bg-primary">{{ $at->status }}</span></td>
                                    <td>{{ $at->notes ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
