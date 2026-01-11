<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Company;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::where('user_id', auth()->id())->first();

        // Cek data pengajuan
        $submission = Submission::with('company')
            ->where('student_id', $student->id)
            ->first();

        // LOGIKA: Jika BELUM melamar, tampilkan daftar instansi (Create/Index Apply)
        if (!$submission) {
            $companies = Company::when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            })->paginate(10);

            return view('student.submissions.index', compact('companies'));
        }

        // LOGIKA: Jika SUDAH melamar, tampilkan view status
        return view('student.submissions.status', compact('submission'));
    }

    public function store(Request $request)
    {
        $student = Student::where('user_id', auth()->id())->first();

        Submission::create([
            'student_id' => $student->id,
            'company_id' => $request->company_id,
            'is_accepted' => 0 // 0 = Menunggu Konfirmasi
        ]);

        return redirect()->route('student.submissions.index')->with('success', 'Berhasil mengirim pengajuan.');
    }
}
