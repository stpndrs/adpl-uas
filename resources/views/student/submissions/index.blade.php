@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="fw-bold" style="color: #f97316;">Pilih Instansi PKL</h3>
            <p class="text-muted">Silahkan pilih instansi tujuan untuk memulai pengajuan PKL Anda.</p>
        </div>

        <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ route('student.submissions.index') }}" method="GET" class="d-flex justify-content-center mb-4">
                <div class="input-group w-50 border rounded-pill overflow-hidden">
                    <input type="text" name="search" class="form-control border-0 px-3" placeholder="Cari Instansi..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th class="text-start">Nama Instansi</th>
                            <th>Alamat</th>
                            <th>Sisa Kuota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $c)
                            <tr>
                                <td class="text-start"><b>{{ $c->name }}</b></td>
                                <td>{{ $c->address }}</td>
                                <td>{{ $c->limit ?? '0' }} Orang</td>
                                <td>
                                    <form action="{{ route('student.submissions.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="company_id" value="{{ $c->id }}">
                                        <button type="submit" class="btn btn-sm btn-outline-primary px-4 fw-bold"
                                            onclick="return confirm('Ajukan PKL ke {{ $c->name }}?')">Ajukan</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
