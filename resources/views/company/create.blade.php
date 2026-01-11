@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="fw-bold" style="color: #f97316;">Tambah Data Instansi</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="font-size: 12px;">
                    <li class="breadcrumb-item"><a href="{{ route('companies.index') }}" class="text-decoration-none">Data
                            Instansi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Instansi</li>
                </ol>
            </nav>
        </div>

        <div class="card p-5 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ route('companies.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label small text-muted">Nama Instansi</label>
                    <input type="text" name="name"
                        class="form-control form-control-custom @error('name') is-invalid @enderror"
                        placeholder="Masukkan Nama Instansi" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Alamat</label>
                    <textarea name="address" class="form-control form-control-custom @error('address') is-invalid @enderror"
                        placeholder="Masukkan Alamat Lengkap Instansi" rows="3" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Nomor Telepon</label>
                    <input type="text" name="phone"
                        class="form-control form-control-custom @error('phone') is-invalid @enderror"
                        placeholder="Contoh: 08123456789" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Kuota Siswa (Limit)</label>
                    <input type="number" name="limit"
                        class="form-control form-control-custom @error('limit') is-invalid @enderror"
                        placeholder="Jumlah maksimal siswa" value="{{ old('limit', 5) }}" required>
                    @error('limit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-5 fw-bold" style="border-radius: 10px;">Simpan</button>
                    <a href="{{ route('companies.index') }}" class="btn px-5 fw-bold"
                        style="border-radius: 10px; background-color: #dbeafe; color: #2563eb;">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
