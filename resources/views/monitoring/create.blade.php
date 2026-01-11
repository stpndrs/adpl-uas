@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="fw-bold" style="color: #f97316;">Tambah Data Monitoring</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="font-size: 12px;">
                    <li class="breadcrumb-item"><a href="{{ route('monitorings.index') }}" class="text-decoration-none">Data
                            Monitoring</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Monitoring</li>
                </ol>
            </nav>
        </div>

        <div class="card p-5 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ route('monitorings.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label small text-muted">Siswa (Berdasarkan NISN)</label>
                    <select name="student_id"
                        class="form-select form-control-custom @error('student_id') is-invalid @enderror" required>
                        <option value="" disabled selected>-- Pilih Siswa --</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->name }} ({{ $student->nisn }})
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Instansi / Perusahaan</label>
                    <select name="company_id"
                        class="form-select form-control-custom @error('company_id') is-invalid @enderror" required>
                        <option value="" disabled selected>-- Pilih Instansi --</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Guru Pembimbing (Berdasarkan NIP)</label>
                    <select name="teacher_id"
                        class="form-select form-control-custom @error('teacher_id') is-invalid @enderror" required>
                        <option value="" disabled selected>-- Pilih Guru --</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }} ({{ $teacher->nip }})
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small text-muted">Tanggal Mulai PKL</label>
                        <input type="date" name="start_date"
                            class="form-control form-control-custom @error('start_date') is-invalid @enderror"
                            value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label small text-muted">Tanggal Selesai PKL</label>
                        <input type="date" name="end_date"
                            class="form-control form-control-custom @error('end_date') is-invalid @enderror"
                            value="{{ old('end_date') }}" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-5 fw-bold" style="border-radius: 10px;">Simpan
                        Data</button>
                    <a href="{{ route('monitorings.index') }}" class="btn px-5 fw-bold"
                        style="border-radius: 10px; background-color: #dbeafe; color: #2563eb;">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
