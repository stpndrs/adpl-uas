<?php

namespace App\Http\Controllers;

use App\Imports\MonitoringsImport;
use App\Models\Monitoring;
use App\Models\Student;
use App\Models\Company;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class MonitoringController extends Controller
{
    /**
     * TAMPIL DATA & PENCARIAN
     */
    public function index(Request $request)
    {
        // Eager loading relasi agar tidak berat (N+1 Problem)
        $query = Monitoring::with(['student', 'company', 'teacher']);

        // Logika Pencarian berdasarkan nama siswa atau perusahaan
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })->orWhereHas('company', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }

        // Paginasi 10 data dengan tetap membawa query string search
        $monitorings = $query->paginate(10)->withQueryString();

        return view('monitoring.index', compact('monitorings'));
    }

    /**
     * FORM TAMBAH DATA
     */
    public function create()
    {
        // Mengambil data pendukung untuk dropdown di form
        $students = Student::all();
        $companies = Company::all();
        $teachers = Teacher::all();

        return view('monitoring.create', compact('students', 'companies', 'teachers'));
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

            return redirect()->route('monitoring.index')
                ->with('success', 'Data monitoring berhasil disimpan');
        } catch (Throwable $th) {
            // Sesuai alur 'Failed Monitoring Controller'
            return back()->withInput()->with('error', 'Gagal menyimpan: ' . $th->getMessage());
        }
    }

    /**
     * FORM EDIT DATA
     */
    public function edit($id)
    {
        try {
            $monitoring = Monitoring::findOrFail($id);
            $students = Student::all();
            $companies = Company::all();
            $teachers = Teacher::all();

            return view('monitoring.edit', compact('monitoring', 'students', 'companies', 'teachers'));
        } catch (Throwable $th) {
            return redirect()->route('monitoring.index')->with('error', 'Data tidak ditemukan');
        }
    }

    /**
     * UPDATE DATA (Sesuai diagram 'Edit Data Monitoring')
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'company_id' => 'required|exists:companies,id',
                'teacher_id' => 'required|exists:teachers,id',
                'start_date' => 'required|date',
                'end_date'   => 'required|date|after_or_equal:start_date',
            ]);

            $monitoring = Monitoring::findOrFail($id);
            $monitoring->update($request->all());

            return redirect()->route('monitoring.index')
                ->with('success', 'Data monitoring berhasil diperbarui');
        } catch (Throwable $th) {
            return back()->withInput()->with('error', 'Gagal memperbarui: ' . $th->getMessage());
        }
    }

    /**
     * HAPUS DATA
     */
    public function destroy($id)
    {
        try {
            $monitoring = Monitoring::findOrFail($id);
            $monitoring->delete();

            return redirect()->route('monitoring.index')
                ->with('success', 'Data monitoring berhasil dihapus');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal menghapus data: ' . $th->getMessage());
        }
    }

    /**
     * TAMPILKAN HALAMAN IMPORT
     */
    public function importView()
    {
        return view('monitoring.import');
    }

    /**
     * PROSES IMPORT DATA
     */
    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            Excel::import(new MonitoringsImport, $request->file('file'));

            return redirect()->route('monitoring.index')
                ->with('success', 'Data monitoring berhasil diimport! (Data yang tidak cocok dilewati)');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal mengimport data: ' . $th->getMessage());
        }
    }

    /**
     * LIHAT PRESENSI SISWA
     */
    public function attendance($id)
    {
        try {
            // Eager load data siswa dan presensinya
            $monitoring = Monitoring::with(['student', 'company', 'attendances'])->findOrFail($id);

            return view('monitoring.attendance', compact('monitoring'));
        } catch (Throwable $th) {
            return redirect()->route('monitoring.index')->with('error', 'Data tidak ditemukan');
        }
    }

    /**
     * LIHAT LAPORAN / LOGBOOK SISWA
     */
    public function report($id)
    {
        try {
            // Eager load data siswa dan laporan hariannya
            $monitoring = Monitoring::with(['student', 'company', 'reports'])->findOrFail($id);

            return view('monitoring.report', compact('monitoring'));
        } catch (Throwable $th) {
            return redirect()->route('monitoring.index')->with('error', 'Data tidak ditemukan');
        }
    }
}
