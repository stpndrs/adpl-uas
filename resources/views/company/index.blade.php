@extends('layouts.app')
@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h2 class="page-title">Manajemen Data Siswa</h2>
            <p class="breadcrumb">> Data Siswa > <b>Manajemen Data Siswa</b></p>
        </div>
        <button
            style="background:var(--primary-blue); color:white; border:none; padding:10px 20px; border-radius:6px; cursor:pointer;">Action
            ▾</button>
    </div>

    <div class="card">
        <div class="search-container">
            <div class="search-box">
                <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search">
                <button onclick="searchTable()">Search</button>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nama ↕</th>
                    <th>Alamat ↕</th>
                    <th>NISN ↕</th>
                    <th>Jenis Kelamin ↕</th>
                    <th>Kelas ↕</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $s)
                    <tr>
                        <td>{{ $s->name }}</td>
                        <td>{{ $s->address }}</td>
                        <td>{{ $s->nisn }}</td>
                        <td>{{ $s->gender }}</td>
                        <td>{{ $s->class }}</td>
                        <td>
                            <button class="btn-action btn-edit">✎</button>
                            <button class="btn-action btn-delete" onclick="return confirmDelete()">🗑</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-info">
            <p>Showing 1 to 10 of {{ count($students) }} result</p>
            <p>1 2 3 4 5 6 ></p>
        </div>
    </div>
@endsection
