@extends('layouts.app')
@section('content')
    <h3 class="text-orange fw-bold" style="color: #f97316;">Dashboard</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="font-size: 12px;">
            <li class="breadcrumb-item active">> Dashboard</li>
        </ol>
    </nav>

    <div class="row g-3 mb-4">
        @foreach ([['Presensi Hari Ini', '50 Data', '5 Siswa Izin', '45 Siswa Hadir'], ['Jumlah Siswa PKL', '50 Siswa'], ['Jumlah Guru', '50 Guru'], ['Instansi', '50 Instansi']] as $item)
            <div class="col-md-3">
                <div class="card p-4 text-center">
                    <small class="text-muted">{{ $item[0] }}</small>
                    <h1 class="display-5 fw-bold text-primary">{{ explode(' ', $item[1])[0] }} <small
                            class="fs-5 text-dark">{{ explode(' ', $item[1])[1] }}</small></h1>
                    @if (isset($item[2]))
                        <div class="d-flex justify-content-center gap-1 mt-2">
                            <span class="badge bg-primary">{{ $item[2] }}</span>
                            <span class="badge bg-primary">{{ $item[3] }}</span>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="card p-4">
        <h5 class="mb-4">Presensi dan Kegiatan Terbaru</h5>
        @for ($i = 0; $i < 4; $i++)
            <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                <div>
                    <h6 class="mb-0 fw-bold">Stevan Andreas</h6>
                    <small class="text-muted" style="font-size: 10px;">03/07/2025</small>
                    <p class="mb-0 text-muted small">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                </div>
                <button class="btn btn-sm btn-outline-primary">Lihat Gambar</button>
            </div>
        @endfor
    </div>
@endsection
