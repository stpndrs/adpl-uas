@extends('layouts.app')
@section('content')
    <h2 class="page-title">Data Monitoring</h2>
    <p class="breadcrumb">> Data Monitoring</p>

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
                    <th>NISN ↕</th>
                    <th>Kelas ↕</th>
                    <th>Bulan Mulai/Selesai ↕</th>
                    <th>Instansi ↕</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($monitorings as $m)
                    <tr>
                        <td>{{ $m->student->name }}</td>
                        <td>{{ $m->student->nisn }}</td>
                        <td>{{ $m->student->class }}</td>
                        <td>06/2025 — 01/12/2025</td>
                        <td>{{ $m->company->name }}</td>
                        <td style="display:flex; gap:5px;">
                            <button class="btn-action btn-blue-outline">Lihat Laporan</button>
                            <button class="btn-action btn-blue-outline">Lihat Presensi & Kegiatan</button>
                            <button class="btn-action btn-edit">✎</button>
                            <button class="btn-action btn-delete">🗑</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
