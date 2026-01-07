@extends('layouts.app')
@section('content')
    <h2 class="page-title">Tambah Data Instansi</h2>
    <p class="breadcrumb">> Data Instansi > <b>Tambah Data Instansi</b></p>

    <form action="{{ route('companies.store') }}" method="POST" class="form-container">
        @csrf
        <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Nama Instansi"></div>
        <div class="form-group"><input type="text" name="address" class="form-control" placeholder="Alamat"></div>
        <div class="form-group"><input type="text" name="phone" class="form-control" placeholder="Nomor Telepon"></div>
        <div class="form-group"><input type="number" name="limit" class="form-control" placeholder="Kuota"></div>
        <div class="form-group"><input type="hidden" name="user_id" value="{{ auth()->id() }}"></div>

        <div style="margin-top: 30px; display: flex; gap: 10px;">
            <button type="submit" class="btn-simpan">Simpan</button>
            <a href="{{ route('companies.index') }}" class="btn-kembali">Kembali</a>
        </div>
    </form>
@endsection
