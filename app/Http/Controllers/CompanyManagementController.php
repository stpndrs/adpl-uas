<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Monitoring;
use App\Models\Report;
use App\Models\Company;
use App\Models\Presences;
use Illuminate\Http\Request;
use Throwable;

class CompanyManagementController extends Controller
{
    private function getCompany()
    {
        return Company::where('user_id', auth()->id())->first();
    }

    /**
     * INDEX: Daftar Siswa Aktif di Instansi
     */
    public function index(Request $request)
    {
        try {
            $company = $this->getCompany();
            $query = Monitoring::with(['student', 'teacher'])
                ->where('company_id', $company->id);

            if ($request->search) {
                $query->whereHas('student', function ($q) use ($request) {
                    $q->where('name', 'like', "%{$request->search}%");
                });
            }

            $monitorings = $query->paginate(10)->withQueryString();
            return view('company.monitoring.index', compact('monitorings'));
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal memuat daftar siswa.');
        }
    }

    /**
     * SHOW: Detail Aktivitas Siswa
     */
    public function show($id)
    {
        try {
            $monitoring = Monitoring::with(['student', 'teacher'])->findOrFail($id);
            $attendances = Presences::where('monitoring_id', $id)->latest()->get();
            $reports = Report::where('monitoring_id', $id)->latest()->get();

            return view('company.monitoring.show', compact('monitoring', 'attendances', 'reports'));
        } catch (Throwable $th) {
            return back()->with('error', 'Data tidak ditemukan.');
        }
    }
}
