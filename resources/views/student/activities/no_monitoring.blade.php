@extends('layouts.app')
@section('content')
    <div class="p-5 text-center">
        <div class="card border-0 shadow-sm p-5" style="border-radius: 15px;">
            <i class="bi bi-exclamation-circle text-orange display-1 mb-4"></i>
            <h4 class="fw-bold">Akses Dibatasi</h4>
            <p class="text-muted">Menu ini hanya tersedia jika pengajuan PKL Anda telah <b>Diterima</b> oleh sekolah dan
                instansi.</p>
            <a href="{{ route('student.submissions.index') }}" class="btn btn-primary px-4 mt-3">Cek Status Pengajuan</a>
        </div>
    </div>
@endsection
