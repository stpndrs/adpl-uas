<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\Presences;
use App\Models\Report;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentActivityController extends Controller
{
    private function getMonitoring()
    {
        $student = Student::where('user_id', auth()->id())->first();
        return Monitoring::where('student_id', $student->id)->first();
    }

    public function index()
    {
        $monitoring = $this->getMonitoring();

        // Perbaikan Error: Jika monitoring belum ada, buat view penjelasannya
        if (!$monitoring) {
            return view('student.activities.no_monitoring');
        }

        $attendances = Presences::where('monitoring_id', $monitoring->id)->latest()->paginate(10);
        return view('student.activities.index', compact('attendances', 'monitoring'));
    }

    public function reportIndex()
    {
        $monitoring = $this->getMonitoring();
        if (!$monitoring) return view('student.activities.no_monitoring');

        $reports = Report::where('monitoring_id', $monitoring->id)->latest()->paginate(10);
        return view('student.activities.report_index', compact('reports', 'monitoring'));
    }

    public function attendanceCreate()
    {
        return view('student.activities.attendance_create');
    }
}
