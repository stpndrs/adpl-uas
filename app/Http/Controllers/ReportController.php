<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ReportController extends Controller
{
    /**
     * TAMPILKAN DAFTAR LAPORAN
     */
    public function index()
    {
        // Mengambil laporan beserta data monitoring terkait
        $reports = Report::with('monitoring.student')->latest()->get();
        return view('report.index', compact('reports'));
    }

    /**
     * FORM TAMBAH LAPORAN
     */
    public function create()
    {
        $monitorings = Monitoring::all(); // Untuk pilihan monitoring_id
        return view('report.create', compact('monitorings'));
    }

    /**
     * SIMPAN LAPORAN BARU
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'monitoring_id' => 'required|exists:monitorings,id',
                'date'          => 'required|date',
                'file'          => 'required|file|mimes:pdf,docx,jpg,png|max:2048',
                'comment'       => 'nullable|string',
                'status'        => 'required|in:pending,approved,rejected',
            ]);

            $data = $request->all();

            // Logika upload file
            if ($request->hasFile('file')) {
                $data['file'] = $request->file('file')->store('reports', 'public');
            }

            Report::create($data);

            return redirect()->route('reports.index')
                ->with('success', 'Laporan berhasil dikirim');
        } catch (Throwable $th) {
            return back()->withInput()->with('error', 'Gagal menyimpan laporan: ' . $th->getMessage());
        }
    }

    /**
     * FORM EDIT LAPORAN
     */
    public function edit(string $id)
    {
        $report = Report::findOrFail($id);
        $monitorings = Monitoring::all();
        return view('report.edit', compact('report', 'monitorings'));
    }

    /**
     * UPDATE LAPORAN
     */
    public function update(Request $request, string $id)
    {
        try {
            $report = Report::findOrFail($id);

            $request->validate([
                'date'    => 'required|date',
                'file'    => 'nullable|file|max:2048',
                'status'  => 'required',
            ]);

            $data = $request->all();

            // Jika ada file baru, hapus file lama dan simpan yang baru
            if ($request->hasFile('file')) {
                if ($report->file) {
                    Storage::disk('public')->delete($report->file);
                }
                $data['file'] = $request->file('file')->store('reports', 'public');
            }

            $report->update($data);

            return redirect()->route('reports.index')
                ->with('success', 'Laporan berhasil diperbarui');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal memperbarui laporan');
        }
    }

    /**
     * HAPUS LAPORAN
     */
    public function destroy(string $id)
    {
        try {
            $report = Report::findOrFail($id);

            // Hapus file fisik dari storage jika ada
            if ($report->file) {
                Storage::disk('public')->delete($report->file);
            }

            $report->delete();

            return redirect()->route('reports.index')
                ->with('success', 'Laporan berhasil dihapus');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal menghapus laporan');
        }
    }
}
