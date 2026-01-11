@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="fw-bold" style="color: #f97316;">Ubah Data Akun User</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="font-size: 12px;">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-decoration-none">Daftar
                            User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah User</li>
                </ol>
            </nav>
        </div>

        <div class="card p-5 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label small text-muted">Nama Lengkap</label>
                    <input type="text" name="name"
                        class="form-control form-control-custom @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Username (NISN/NIP/Identitas)</label>
                    <input type="text" name="username"
                        class="form-control form-control-custom @error('username') is-invalid @enderror"
                        value="{{ old('username', $user->username) }}" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Role / Hak Akses</label>
                    <select name="role" class="form-select form-control-custom @error('role') is-invalid @enderror"
                        required>
                        <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Siswa</option>
                        <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }}>Guru</option>
                        <option value="3" {{ old('role', $user->role) == 3 ? 'selected' : '' }}>Instansi</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4 text-muted">

                <div class="mb-3">
                    <label class="form-label small text-muted">Password Baru (Kosongkan jika tidak ingin mengganti)</label>
                    <input type="password" name="password"
                        class="form-control form-control-custom @error('password') is-invalid @enderror"
                        placeholder="********">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-5 fw-bold" style="border-radius: 10px;">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('users.index') }}" class="btn px-5 fw-bold"
                        style="border-radius: 10px; background-color: #dbeafe; color: #2563eb;">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
