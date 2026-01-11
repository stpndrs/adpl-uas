@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <div class="d-flex align-items-center">
                <div style="width: 15px; height: 5px; background-color: #2563eb; border-radius: 10px; margin-right: 10px;">
                </div>
                <h3 class="fw-bold mb-0" style="color: #f97316;">Import Data Monitoring</h3>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="font-size: 12px; margin-left: 25px;">
                    <li class="breadcrumb-item"><a href="{{ route('monitoring.index') }}"
                            class="text-decoration-none text-muted">Data Monitoring</a></li>
                    <li class="breadcrumb-item active fw-bold" aria-current="page" style="color: #000;">Import</li>
                </ol>
            </nav>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-5">
                <form action="{{ route('monitoring.import.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold">Pilih File Excel</label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                            style="padding: 15px; background-color: #f8fafc; border-radius: 10px;">

                        <div class="alert alert-info mt-3" style="font-size: 13px;">
                            <strong>Perhatian!</strong> Pastikan kolom header pada Excel Anda bernama: <br>
                            <code>nisn</code>, <code>nip</code>, <code>nama_perusahaan</code>, <code>tanggal_mulai</code>,
                            <code>tanggal_selesai</code>
                        </div>

                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-5 fw-bold" style="border-radius: 8px;">Mulai
                            Import</button>
                        <a href="{{ route('monitoring.index') }}" class="btn btn-light px-5 fw-bold"
                            style="border-radius: 8px;">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
