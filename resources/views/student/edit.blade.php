@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="fw-bold" style="color: #f97316;">Ubah Data Siswa</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="font-size: 12px;">
                    <li class="breadcrumb-item"><a href="{{ route('students.index') }}" class="text-decoration-none">Data
                            Siswa</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah Data Siswa</li>
                </ol>
            </nav>
        </div>

        <div class="card p-5 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ route('students.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label small text-muted">Nama Lengkap</label>
                    <input type="text" name="name"
                        class="form-control form-control-custom @error('name') is-invalid @enderror"
                        value="{{ old('name', $student->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">NISN</label>
                    <input type="text" name="nisn"
                        class="form-control form-control-custom @error('nisn') is-invalid @enderror"
                        value="{{ old('nisn', $student->nisn) }}" required>
                    @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Alamat</label>
                    <textarea name="address" class="form-control form-control-custom @error('address') is-invalid @enderror" rows="3"
                        required>{{ old('address', $student->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Jenis Kelamin</label>
                    <select name="gender" class="form-select form-control-custom @error('gender') is-invalid @enderror"
                        required>
                        <option value="1" {{ old('gender', $student->gender) == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki</option>
                        <option value="2" {{ old('gender', $student->gender) == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Nama Kelas</label>
                    <input type="text" name="class"
                        class="form-control form-control-custom @error('class') is-invalid @enderror"
                        value="{{ old('class', $student->class) }}" required>
                    @error('class')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-5 fw-bold" style="border-radius: 10px;">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('students.index') }}" class="btn px-5 fw-bold"
                        style="border-radius: 10px; background-color: #dbeafe; color: #2563eb;">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
