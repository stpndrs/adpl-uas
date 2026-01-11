@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h3 class="fw-bold" style="color: #f97316;">Ubah Data Pengajuan</h3>

        <div class="card p-5 border-0 shadow-sm" style="border-radius: 15px;">
            <form action="{{ route('submissions.update', $submission->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label small text-muted">Siswa</label>
                    <input type="text" class="form-control" value="{{ $submission->student->name }}" disabled>
                    <input type="hidden" name="student_id" value="{{ $submission->student_id }}">
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Perusahaan</label>
                    <select name="company_id" class="form-select">
                        @foreach ($companies as $c)
                            <option value="{{ $c->id }}" {{ $submission->company_id == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label small text-muted">Status</label>
                    <select name="is_accepted" class="form-select">
                        <option value="0" {{ $submission->is_accepted == 0 ? 'selected' : '' }}>Menunggu (Pending)
                        </option>
                        <option value="1" {{ $submission->is_accepted == 1 ? 'selected' : '' }}>Diterima</option>
                        <option value="2" {{ $submission->is_accepted == 2 ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary px-5 fw-bold" style="border-radius: 10px;">Simpan
                    Perubahan</button>
                <a href="{{ route('submissions.index') }}" class="btn btn-light px-5 fw-bold"
                    style="border-radius: 10px;">Kembali</a>
            </form>
        </div>
    </div>
@endsection
