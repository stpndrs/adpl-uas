@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="fw-bold" style="color: #f97316;">Tambah User Baru</h3>
        </div>

        <div class="card p-5 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="small text-muted">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="small text-muted">Username (NISN/NIP/Slug)</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                        value="{{ old('username') }}" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="small text-muted">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="small text-muted">Role User</label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="1">Siswa</option>
                        <option value="2">Guru</option>
                        <option value="3">Instansi</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-5 fw-bold">Simpan</button>
                    <a href="{{ route('users.index') }}" class="btn btn-light px-5 fw-bold">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
