<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Throwable;

class TeacherController extends Controller
{
    /**
     * TAMPILKAN DATA & PENCARIAN (Sesuai diagram Pencarian)
     */
    public function index(Request $request)
    {
        $query = Teacher::with('user');

        // Logika Pencarian berdasarkan Nama atau NIP
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('nip', 'like', '%' . $request->search . '%');
        }

        $teachers = $query->get();
        return view('teacher.index', compact('teachers'));
    }

    /**
     * FORM TAMBAH
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * SIMPAN DATA BARU
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'    => 'required|string|max:255',
                'nip'     => 'required|unique:teachers,nip',
                'address' => 'required',
                'gender'  => 'required',
                'user_id' => 'required|exists:users,id'
            ]);

            Teacher::create($request->all());

            return redirect()->route('teachers.index')
                ->with('success', 'Data guru berhasil disimpan');
        } catch (Throwable $th) {
            // Penanganan error (Sesuai 'Failed Controller')
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $th->getMessage());
        }
    }

    /**
     * FORM EDIT
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teacher.edit', compact('teacher'));
    }

    /**
     * UPDATE DATA (Sesuai diagram 'Edit Data')
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name'    => 'required',
                'nip'     => 'required|unique:teachers,nip,' . $id,
                'address' => 'required',
                'gender'  => 'required',
            ]);

            $teacher = Teacher::findOrFail($id);
            $teacher->update($request->all());

            return redirect()->route('teachers.index')
                ->with('success', 'Data guru berhasil diperbarui');
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
            $teacher = Teacher::findOrFail($id);
            $teacher->delete();

            return redirect()->route('teachers.index')
                ->with('success', 'Data guru berhasil dihapus');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal menghapus data guru');
        }
    }
}
