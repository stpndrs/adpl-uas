<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Monitoring;
use App\Models\Presences;
use App\Models\Report;
use Illuminate\Http\Request;
use Throwable;

class TeacherMonitoringController extends Controller
{
    private function getTeacher()
    {
        return Teacher::where('user_id', auth()->id())->first();
    }

    /**
     * INDEX: Daftar Siswa Bimbingan
     */
    public function index(Request $request)
    {
        try {
            $teacher = $this->getTeacher();
            $query = Monitoring::with(['student', 'company'])
                ->where('teacher_id', $teacher->id);

            if ($request->search) {
                $query->whereHas('student', function ($q) use ($request) {
                    $q->where('name', 'like', "%{$request->search}%");
                });
            }

            $monitorings = $query->paginate(10)->withQueryString();
            return view('teacher.monitoring.index', compact('monitorings'));
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal memuat data monitoring.');
        }
    }

    /**
     * SHOW: Detail Aktivitas (Presensi & Laporan)
     */
    public function show($id)
    {
        try {
            $monitoring = Monitoring::with(['student', 'company'])->findOrFail($id);
            $attendances = Presences::where('monitoring_id', $id)->latest()->get();
            $reports = Report::where('monitoring_id', $id)->latest()->get();

            return view('teacher.monitoring.show', compact('monitoring', 'attendances', 'reports'));
        } catch (Throwable $th) {
            return back()->with('error', 'Data aktivitas tidak ditemukan.');
        }
    }

    /**
     * Update Status/Komentar tetap menggunakan method khusus
     */
    public function addComment(Request $request, $id)
    {
        try {
            $report = Report::findOrFail($id);
            $report->update(['comment' => $request->comment]);
            return back()->with('success', 'Komentar berhasil ditambahkan.');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal menambahkan komentar.');
        }
    }
}
