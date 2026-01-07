@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <div class="d-flex align-items-center">
                <div style="width: 15px; height: 5px; background-color: #2563eb; border-radius: 10px; margin-right: 10px;">
                </div>
                <h3 class="fw-bold mb-0" style="color: #f97316;">Import Data Siswa</h3>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="font-size: 12px; margin-left: 25px;">
                    <li class="breadcrumb-item"><a href="{{ route('students.index') }}"
                            class="text-decoration-none text-muted">Data Siswa</a></li>
                    <li class="breadcrumb-item active fw-bold" aria-current="page" style="color: #000;">Import Data Siswa
                    </li>
                </ol>
            </nav>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-5">
                <form action="{{ route('students.import.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="file" class="form-label d-none">Pilih File</label>
                        <input type="file" name="file" id="file"
                            class="form-control form-control-custom @error('file') is-invalid @enderror"
                            style="padding: 15px 20px; background-color: #f1f5f9; border: none; border-radius: 10px;"
                            required>
                        <div class="form-text mt-2 text-muted" style="font-size: 12px;">
                            * Gunakan format .xlsx atau .csv sesuai template yang disediakan.
                        </div>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
''
                    <div class="d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-5 fw-bold"
                            style="border-radius: 8px; background-color: #2563eb; border: none;">
                            Simpan
                        </button>
                        <a href="{{ route('students.index') }}" class="btn px-5 fw-bold"
                            style="border-radius: 8px; background-color: #dbeafe; color: #2563eb; border: none;">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
