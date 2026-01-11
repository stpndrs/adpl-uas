@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h3 class="fw-bold text-orange mb-4" style="color: #f97316;">Isi Presensi & Kegiatan</h3>
        <div class="card p-5 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ route('student.attendance.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="small text-muted">Upload Foto Kegiatan</label>
                    <input type="file" name="photo" class="form-control bg-light border-0">
                </div>
                <div class="mb-3">
                    <label class="small text-muted">Keterangan Kegiatan</label>
                    <textarea name="notes" class="form-control bg-light border-0" rows="4" placeholder="Keterangan Kegiatan"></textarea>
                </div>
                <div class="mb-4">
                    <label class="small text-muted">Pilih Status Presensi</label>
                    <select name="status" class="form-select bg-light border-0">
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-5 fw-bold">Simpan</button>
                    <a href="{{ route('student.attendance.index') }}"
                        class="btn btn-outline-primary px-5 fw-bold">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
