@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold text-orange" style="color: #f97316;">Manajemen Akun User</h3>
            <small class="text-muted">> Pengaturan > <b>Daftar User</b></small>
        </div>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Action</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('users.create') }}">Tambah User</a></li>
            </ul>
        </div>
    </div>

    <div class="card p-4">
        <form action="{{ url()->current() }}" method="GET" class="d-flex justify-content-center mb-4">
            <div class="input-group w-50 border rounded-pill overflow-hidden">
                <input type="text" name="search" class="form-control border-0 px-3"
                    placeholder="Cari Nama atau Username..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                @if (request('search'))
                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary px-3"><i class="bi bi-x-lg"></i></a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th class="text-center">#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td><code class="text-primary">{{ $user->username }}</code></td>
                            <td>
                                @if ($user->role == 1)
                                    <span class="badge bg-success">Admin</span>
                                @elseif($user->role == 2)
                                    <span class="badge bg-info">Guru</span>
                                @elseif($user->role == 3)
                                    <span class="badge bg-warning text-dark">Instansi</span>
                                @else
                                    <span class="badge bg-secondary">Siswa</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning"><i
                                        class="bi bi-pencil"></i></a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus akun ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">User tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">{{ $users->links() }}</div>
        </div>
    </div>
@endsection
