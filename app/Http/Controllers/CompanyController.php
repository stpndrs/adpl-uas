<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Throwable;

class CompanyController extends Controller
{
    /**
     * TAMPILKAN DATA (Sesuai diagram 'View Data Akun')
     * Mengambil semua data menggunakan Eloquent all()
     */
    public function index()
    {
        $companies = Company::all();
        return view('company.index', compact('companies'));
    }

    /**
     * FORM TAMBAH DATA
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * SIMPAN DATA BARU
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'limit' => 'required',
                'user_id' => 'required'
            ]);

            Company::create($request->all());

            return redirect()->route('companies.index')
                ->with('success', 'Data perusahaan berhasil disimpan');
        } catch (Throwable $th) {
            // Menangani Error (Sesuai diagram 'Failed Controller')
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $th->getMessage());
        }
    }

    /**
     * DETAIL DATA
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id);
        return view('company.show', compact('company'));
    }

    /**
     * FORM EDIT (Menampilkan data yang akan diubah)
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        return view('company.edit', compact('company'));
    }

    /**
     * UPDATE DATA (Sesuai diagram 'Edit Data Akun')
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'limit' => 'required',
            ]);

            $company = Company::findOrFail($id);
            $company->update($request->all());

            return redirect()->route('companies.index')
                ->with('success', 'Data berhasil diperbarui');
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
            $company = Company::findOrFail($id);
            $company->delete();

            return redirect()->route('companies.index')
                ->with('success', 'Data berhasil dihapus');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal menghapus data');
        }
    }

    /**
     * CUSTOM METHOD: UPDATE STATUS (Sesuai diagram 'Ubah Status Data')
     */
    public function updateStatus($id)
    {
        try {
            $company = Company::findOrFail($id);
            // Contoh logika toggle status
            $company->update(['status' => !$company->status]);

            return back()->with('success', 'Status berhasil diperbarui');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal mengubah status');
        }
    }
}
