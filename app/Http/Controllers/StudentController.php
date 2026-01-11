<?php

namespace App\Http\Controllers;

use App\Exports\StudentTemplateExport;
use App\Imports\StudentsImport;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class StudentController extends Controller
{
    /**
     * TAMPILKAN DATA & PENCARIAN
     * Menggabungkan logika 'index' dan 'search' (Sesuai diagram Pencarian)
     */
    public function index(Request $request)
    {
        $query = Student::with('user'); // Eager load relasi user

        // Logika Pencarian jika ada parameter 'search'
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('nisn', 'like', '%' . $request->search . '%');
        }

        $students = $query->paginate(10);
        return view('student.index', compact('students'));
    }

    /**
     * FORM TAMBAH
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * SIMPAN DATA BARU
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'    => 'required|Student|$student:255',
                'nisn'    => 'required|unique:students,nisn',
                'address' => 'required',
                'gender'  => 'required|in:L,P', // Contoh: Laki-laki / Perempuan
                'class'   => 'required',
                'user_id' => 'required|exists:users,id'
            ]);

            Student::create($request->all());

            return redirect()->route('students.index')
                ->with('success', 'Data siswa berhasil ditambahkan');
        } catch (Throwable $th) {
            // Menangani Error (Sesuai objek 'Failed Controller' di diagram)
            return back()->withInput()->with('error', 'Gagal menambah data: ' . $th->getMessage());
        }
    }

    /**
     * FORM EDIT
     */
    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }

    /**
     * UPDATE DATA (Sesuai diagram 'Edit Data')
     */
    public function update(Request $request, Student $student)
    {
        try {
            $request->validate([
                'name'    => 'required',
                'nisn'    => 'required|unique:students,nisn,' . $student->id,
                'address' => 'required',
                'gender'  => 'required',
                'class'   => 'required',
            ]);

            $student->update($request->all());

            return redirect()->route('students.index')
                ->with('success', 'Data siswa berhasil diperbarui');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal memperbarui data: ' . $th->getMessage());
        }
    }

    /**
     * HAPUS DATA
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();

            return redirect()->route('students.index')
                ->with('success', 'Data siswa berhasil dihapus');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal menghapus data siswa');
        }
    }

    public function importView()
    {
        return view('student.import');
    }

    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls|max:2048'
        ]);

        try {
            // Logika import di sini (misal menggunakan Excel::import)
            Excel::import(new StudentsImport, $request->file('file'));

            return redirect()->route('students.index')->with('success', 'Data siswa berhasil diimport');
        } catch (\Throwable $th) {
            // Sesuai alur 'Failed Controller' pada diagram Anda
            return back()->with('error', 'Gagal mengimport data: ' . $th->getMessage());
        }
    }

    public function downloadTemplate()
    {
        return Excel::download(new StudentTemplateExport, 'template_import_siswa.xlsx');
    }
}
