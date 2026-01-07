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
                    <input type="text" name="name" class="form-control form-control-custom"
                        value="{{ old('name', $student->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">NISN</label>
                    <input type="text" name="nisn" class="form-control form-control-custom"
                        value="{{ old('nisn', $student->nisn) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Alamat</label>
                    <textarea name="address" class="form-control form-control-custom" rows="3" required>{{ old('address', $student->address) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Jenis Kelamin</label>
                    <select name="gender" class="form-select form-control-custom" required>
                        <option value="Laki-laki" {{ $student->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $student->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Nama Kelas</label>
                    <input type="text" name="class" class="form-control form-control-custom"
                        value="{{ old('class', $student->class) }}" required>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-5 fw-bold" style="border-radius: 10px;">Simpan
                        Perubahan</button>
                    <a href="{{ route('students.index') }}" class="btn px-5 fw-bold"
                        style="border-radius: 10px; background-color: #dbeafe; color: #2563eb;">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
