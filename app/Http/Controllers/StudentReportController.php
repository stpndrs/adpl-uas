<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\Report;
use App\Models\Student;
use Illuminate\Http\Request;
use Throwable;

class StudentReportController extends Controller
{
    private function getMonitoring()
    {
        $student = Student::where('user_id', auth()->id())->first();
        return Monitoring::where('student_id', $student->id)->first();
    }

    /**
     * INDEX: Daftar Riwayat Laporan
     */
    public function index()
    {
        $monitoring = $this->getMonitoring();
        if (!$monitoring) {
            return view('student.reports.no_monitoring');
        }

        $reports = Report::where('monitoring_id', $monitoring->id)
            ->latest()
            ->paginate(10);

        return view('student.reports.index', compact('reports'));
    }

    /**
     * CREATE: Form Input Laporan Harian
     */
    public function create()
    {
        return view('student.reports.create');
    }

    /**
     * STORE: Simpan Laporan ke Database
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity' => 'required|min:10',
        ], [
            'activity.required' => 'Uraian kegiatan tidak boleh kosong.',
            'activity.min' => 'Uraian kegiatan minimal 10 karakter.',
        ]);

        try {
            $monitoring = $this->getMonitoring();

            Report::create([
                'monitoring_id' => $monitoring->id,
                'date' => now()->format('Y-m-d'),
                'activity' => $request->activity,
                'status' => 'Draft' // Status awal
            ]);

            return redirect()->route('student.reports.index')->with('success', 'Laporan hari ini berhasil disimpan.');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal menyimpan laporan: ' . $th->getMessage());
        }
    }

    /**
     * SHOW: Detail Laporan & Komentar Guru
     */
    public function show($id)
    {
        try {
            $report = Report::findOrFail($id);
            return view('student.reports.show', compact('report'));
        } catch (Throwable $th) {
            return redirect()->route('student.reports.index')->with('error', 'Laporan tidak ditemukan.');
        }
    }
}
