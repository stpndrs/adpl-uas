@extends('layouts.app')
@section('content')
    <h2 class="page-title">Tambah Data Guru</h2>
    <p class="breadcrumb">> Data Guru > <b>Tambah Data Guru</b></p>

    <form action="{{ route('teachers.store') }}" method="POST" class="form-container">
        @csrf
        <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Nama Guru"></div>
        <div class="form-group"><input type="text" name="nip" class="form-control" placeholder="NIP"></div>
        <div class="form-group"><input type="text" name="address" class="form-control" placeholder="Alamat"></div>
        <div class="form-group"><input type="text" name="gender" class="form-control" placeholder="Jenis Kelamin"></div>
        <div class="form-group"><input type="hidden" name="user_id" value="{{ auth()->id() }}"></div>

        <div style="margin-top: 30px; display: flex; gap: 10px;">
            <button type="submit" class="btn-simpan">Simpan</button>
            <a href="{{ route('teachers.index') }}" class="btn-kembali">Kembali</a>
        </div>
    </form>
@endsection
