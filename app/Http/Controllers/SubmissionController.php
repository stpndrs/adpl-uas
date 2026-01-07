<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Throwable;

class SubmissionController extends Controller
{
    /**
     * LIHAT STATUS PENGAJUAN (Sesuai diagram 'Lihat Status pengajuan')
     * Menampilkan semua data pengajuan dengan relasi student dan company
     */
    public function index(Request $request)
    {
        $query = Submission::with(['student', 'company']);

        // Logika Pencarian (Sesuai diagram 'Pencarian data')
        if ($request->has('search')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->orWhereHas('company', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $submissions = $query->get();
        return view('submission.index', compact('submissions'));
    }

    /**
     * FORM PENGAJUAN (Opsional, untuk menampilkan form)
     */
    public function create()
    {
        return view('submission.create');
    }

    /**
     * MELAKUKAN PENGAJUAN (Sesuai diagram 'Melakukan pengajuan')
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'company_id' => 'required|exists:companies,id',
            ]);

            // Default 'is_accepted' biasanya null atau 0 (pending)
            Submission::create([
                'student_id' => $request->student_id,
                'company_id' => $request->company_id,
                'is_accepted' => 0
            ]);

            return redirect()->route('submissions.index')
                ->with('success', 'Pengajuan berhasil dikirim');
        } catch (Throwable $th) {
            // Menangani Error (Sesuai objek 'Failed Controller' di diagram)
            return back()->withInput()->with('error', 'Gagal melakukan pengajuan: ' . $th->getMessage());
        }
    }

    /**
     * MELAKUKAN PERSETUJUAN (Sesuai diagram 'Melakukan Persetujuan' & 'Ubah Status')
     * Mengubah kolom 'is_accepted'
     */
    public function approve(Request $request, $id)
    {
        try {
            $submission = Submission::findOrFail($id);

            // Logika: 1 untuk Setuju, 2 untuk Tolak (tergantung kebutuhan Anda)
            $status = $request->status; // Mengambil input status dari view

            $submission->update([
                'is_accepted' => $status
            ]);

            $message = $status == 1 ? 'Persetujuan berhasil' : 'Pengajuan ditolak';

            return back()->with('success', $message);
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal memproses persetujuan');
        }
    }

    /**
     * EDIT & UPDATE DATA (Sesuai diagram 'Edit Data Akun')
     */
    public function edit($id)
    {
        $submission = Submission::findOrFail($id);
        return view('submission.edit', compact('submission'));
    }

    public function update(Request $request, $id)
    {
        try {
            $submission = Submission::findOrFail($id);
            $submission->update($request->all());

            return redirect()->route('submissions.index')
                ->with('success', 'Berhasil memperbarui data pengajuan');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal memperbarui data');
        }
    }

    /**
     * HAPUS PENGAJUAN
     */
    public function destroy($id)
    {
        try {
            $submission = Submission::findOrFail($id);
            $submission->delete();

            return back()->with('success', 'Pengajuan berhasil dihapus');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal menghapus data');
        }
    }
}
