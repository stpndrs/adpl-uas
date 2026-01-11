@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="fw-bold" style="color: #f97316;">Tambah Data Siswa</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="font-size: 12px;">
                    <li class="breadcrumb-item"><a href="{{ route('students.index') }}" class="text-decoration-none">Data
                            Siswa</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Siswa</li>
                </ol>
            </nav>
        </div>

        <div class="card p-5 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name"
                        class="form-control form-control-custom @error('name') is-invalid @enderror" placeholder="Nama"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="text" name="nisn"
                        class="form-control form-control-custom @error('nisn') is-invalid @enderror" placeholder="NISN"
                        value="{{ old('nisn') }}" required>
                    @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <textarea name="address" class="form-control form-control-custom @error('address') is-invalid @enderror"
                        placeholder="Alamat" rows="3" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <select name="gender" class="form-select form-control-custom @error('gender') is-invalid @enderror"
                        required>
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="1" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="2" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="text" name="class"
                        class="form-control form-control-custom @error('class') is-invalid @enderror"
                        placeholder="Nama Kelas" value="{{ old('class') }}" required>
                    @error('class')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-5 fw-bold" style="border-radius: 10px;">Simpan</button>
                    <a href="{{ route('students.index') }}" class="btn px-5 fw-bold"
                        style="border-radius: 10px; background-color: #dbeafe; color: #2563eb;">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
