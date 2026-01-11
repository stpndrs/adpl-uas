@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold text-orange" style="color: #f97316;">Manajemen Data Guru</h3>
            <small class="text-muted">> Data Master > <b>List Guru</b></small>
        </div>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Action</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('teachers.create') }}">Tambah Data</a></li>
                <li><a class="dropdown-item" href="{{ route('teachers.import.view') }}">Import Excel</a></li>
                <li><a class="dropdown-item" href="{{ route('teachers.import.download') }}">Download Template Excel</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="card p-4">
        <form action="{{ url()->current() }}" method="GET" class="d-flex justify-content-center mb-4">
            <div class="input-group w-50 border rounded-pill overflow-hidden">
                <input type="text" name="search" class="form-control border-0 px-3"
                    placeholder="Cari berdasarkan Nama atau NIP..." value="{{ request('search') }}">

                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-search"></i>
                </button>

                @if (request('search'))
                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary px-3">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>NIP</th>
                        <th>Jenis Kelamin</th>
                        <th class="text-center">#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->address }}</td>
                            <td>{{ $teacher->nip }}</td>
                            <td>{{ $teacher->gender == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td class="text-center">
                                <a href="{{ route('teachers.edit', $teacher->id) }}"
                                    class="btn btn-sm btn-outline-warning text-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Hapus data guru ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Data guru tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
@endsection
