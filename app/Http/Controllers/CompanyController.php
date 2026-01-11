<?php

namespace App\Http\Controllers;

use App\Exports\CompanyTemplateExport;
use App\Imports\CompaniesImport;
use App\Models\Company;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class CompanyController extends Controller
{
    /**
     * TAMPILKAN DATA (Sesuai diagram 'View Data Akun')
     * Mengambil semua data menggunakan Eloquent all()
     */
    public function index(Request $request)
    {
        $query = Company::with('user');

        // Logika Pencarian berdasarkan Nama atau NIP
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
        }

        $companies = $query->paginate(10);
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

    public function importView()
    {
        return view('company.import');
    }

    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls|max:2048'
        ]);

        try {
            // Logika import di sini (misal menggunakan Excel::import)
            Excel::import(new CompaniesImport, $request->file('file'));

            return redirect()->route('companies.index')->with('success', 'Data siswa berhasil diimport');
        } catch (\Throwable $th) {
            // Sesuai alur 'Failed Controller' pada diagram Anda
            return back()->with('error', 'Gagal mengimport data: ' . $th->getMessage());
        }
    }

    public function downloadTemplate()
    {
        return Excel::download(new CompanyTemplateExport, 'template_import_instansi.xlsx');
    }
}
