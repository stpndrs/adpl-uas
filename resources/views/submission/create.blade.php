@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="fw-bold" style="color: #f97316;">Buat Pengajuan Baru</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="font-size: 12px;">
                    <li class="breadcrumb-item"><a href="{{ route('submissions.index') }}" class="text-decoration-none">Daftar
                            Pengajuan</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>
        </div>

        <div class="card p-5 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ route('submissions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small text-muted">Pilih Siswa</label>
                    <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                        <option value="" disabled selected>-- Pilih Siswa --</option>
                        @foreach ($students as $s)
                            <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->nisn }})</option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label small text-muted">Pilih Perusahaan Tujuan</label>
                    <select name="company_id" class="form-select @error('company_id') is-invalid @enderror" required>
                        <option value="" disabled selected>-- Pilih Perusahaan --</option>
                        @foreach ($companies as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-5 fw-bold" style="border-radius: 10px;">Kirim
                        Pengajuan</button>
                    <a href="{{ route('submissions.index') }}" class="btn btn-light px-5 fw-bold"
                        style="border-radius: 10px;">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
