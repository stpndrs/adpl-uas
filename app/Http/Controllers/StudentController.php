<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
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

        $students = $query->get();
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
                'name'    => 'required|string|max:255',
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
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('student.edit', compact('student'));
    }

    /**
     * UPDATE DATA (Sesuai diagram 'Edit Data')
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name'    => 'required',
                'nisn'    => 'required|unique:students,nisn,' . $id,
                'address' => 'required',
                'gender'  => 'required',
                'class'   => 'required',
            ]);

            $student = Student::findOrFail($id);
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
    public function destroy(string $id)
    {
        try {
            $student = Student::findOrFail($id);
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
            // Excel::import(new StudentsImport, $request->file('file'));

            return redirect()->route('students.index')->with('success', 'Data siswa berhasil diimport');
        } catch (\Throwable $th) {
            // Sesuai alur 'Failed Controller' pada diagram Anda
            return back()->with('error', 'Gagal mengimport data: ' . $th->getMessage());
        }
    }
}
