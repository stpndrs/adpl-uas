@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold text-orange" style="color: #f97316;">Manajemen Data</h3>
            <small class="text-muted">> Data Master > <b>List Data</b></small>
        </div>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Action</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('students.create') }}">Tambah Data</a></li>
                <li><a class="dropdown-item" href="{{ route('students.import.view') }}">Import Excel</a></li>
                <li><a class="dropdown-item" href="{{ route('students.import.download') }}">Download Template Excel</a></li>
            </ul>
        </div>
    </div>

    <div class="card p-4">
        <form action="{{ url()->current() }}" method="GET" class="d-flex justify-content-center mb-4">
            <div class="input-group w-50 border rounded-pill overflow-hidden">
                <input type="text" name="search" class="form-control border-0 px-3"
                    placeholder="Cari berdasarkan Nama atau NISN..." value="{{ request('search') }}"> <button type="submit"
                    class="btn btn-primary px-4">
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
                        <th>Nama</i></th>
                        <th>Alamat</i></th>
                        <th>NISN</i></th>
                        <th>Jenis Kelamin</i></th>
                        <th>Kelas</i></th>
                        <th class="text-center">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->address }}</td>
                            <td>{{ $student->nisn }}</td>
                            <td>{{ $student->gender == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $student->class }}</td>
                            <td class="text-center">
                                <a href="{{ url()->current() . '/' . $student->id . '/edit' }}"
                                    class="btn btn-sm btn-outline-warning text-warning"><i class="bi bi-pencil"></i></a>
                                <form action="{{ url()->current() . '/' . $student->id }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus data?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $students->links() }}
        </div>
    </div>
@endsection
