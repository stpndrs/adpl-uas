@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="fw-bold" style="color: #f97316;">Ubah Data Instansi</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="font-size: 12px;">
                    <li class="breadcrumb-item"><a href="{{ route('companies.index') }}" class="text-decoration-none">Data
                            Instansi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah Data Instansi</li>
                </ol>
            </nav>
        </div>

        <div class="card p-5 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ route('companies.update', $company->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label small text-muted">Nama Instansi</label>
                    <input type="text" name="name"
                        class="form-control form-control-custom @error('name') is-invalid @enderror"
                        value="{{ old('name', $company->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Alamat</label>
                    <textarea name="address" class="form-control form-control-custom @error('address') is-invalid @enderror" rows="3"
                        required>{{ old('address', $company->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Nomor Telepon</label>
                    <input type="text" name="phone"
                        class="form-control form-control-custom @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $company->phone) }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Kuota Siswa (Limit)</label>
                    <input type="number" name="limit"
                        class="form-control form-control-custom @error('limit') is-invalid @enderror"
                        value="{{ old('limit', $company->limit) }}" required>
                    @error('limit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-5 fw-bold" style="border-radius: 10px;">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('companies.index') }}" class="btn px-5 fw-bold"
                        style="border-radius: 10px; background-color: #dbeafe; color: #2563eb;">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
