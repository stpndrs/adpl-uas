<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\Student;
use App\Models\Company;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Throwable;

class MonitoringController extends Controller
{
    /**
     * TAMPIL DATA & PENCARIAN (Sesuai diagram 'Pencarian data Monitoring')
     */
    public function index(Request $request)
    {
        // Eager loading relasi agar tidak berat (N+1 Problem)
        $query = Monitoring::with(['student', 'company', 'teacher']);

        // Logika Pencarian (Misal berdasarkan nama siswa atau perusahaan)
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })->orWhereHas('company', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }

        $monitorings = $query->paginate(10); // Sesuai getAllMonitoring(10) di diagram
        return view('monitoring.index', compact('monitorings'));
    }

    /**
     * SIMPAN DATA (Sesuai diagram 'Tambah data Monitoring')
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'company_id' => 'required|exists:companies,id',
                'teacher_id' => 'required|exists:teachers,id',
                'start_date' => 'required|date',
                'end_date'   => 'required|date|after_or_equal:start_date',
            ]);

            Monitoring::create($request->all());

            return redirect()->route('monitorings.index')
                ->with('success', 'Data monitoring berhasil disimpan');
        } catch (Throwable $th) {
            // Sesuai alur 'Failed Monitoring Controller'
            return back()->withInput()->with('error', 'Gagal menyimpan: ' . $th->getMessage());
        }
    }

    /**
     * UPDATE DATA (Sesuai diagram 'Edit Data Monitoring')
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'start_date' => 'required|date',
                'end_date'   => 'required|date',
            ]);

            $monitoring = Monitoring::findOrFail($id);
            $monitoring->update($request->all());

            return redirect()->route('monitorings.index')
                ->with('success', 'Data monitoring berhasil diperbarui');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal memperbarui data');
        }
    }
}
