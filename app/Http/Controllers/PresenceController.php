<?php

namespace App\Http\Controllers;

use App\Models\Presences;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Throwable;

class PresenceController extends Controller
{
    /**
     * LIHAT PRESENSI (Sesuai diagram 'Lihat Presensi')
     */
    public function index()
    {
        $presences = Presences::with('monitoring.student')->latest()->get();
        return view('presence.index', compact('presences'));
    }

    /**
     * MENGISI PRESENSI / CHECK-IN (Sesuai diagram 'Mengisi presensi')
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'monitoring_id' => 'required|exists:monitorings,id',
                'location'      => 'required', // Koordinat atau Nama Tempat
                'notes'         => 'nullable|string',
            ]);

            Presences::create([
                'monitoring_id' => $request->monitoring_id,
                'date'          => Carbon::now()->toDateString(),
                'checkin_time'  => Carbon::now()->toTimeString(),
                'status'        => 'hadir',
                'location'      => $request->location,
                'notes'         => $request->notes,
            ]);

            return redirect()->route('presences.index')
                ->with('success', 'Presensi berhasil disimpan');
        } catch (Throwable $th) {
            // Penanganan error sesuai objek 'Failed Presensi Controller'
            return back()->withInput()->with('error', 'Gagal melakukan presensi: ' . $th->getMessage());
        }
    }

    /**
     * KONFIRMASI KEPULANGAN / CHECK-OUT (Sesuai diagram 'Konfirmasi kepulangan')
     */
    public function update(Request $request, $id)
    {
        try {
            $presence = Presences::findOrFail($id);

            $presence->update([
                'checkout_time' => Carbon::now()->toTimeString(),
            ]);

            return redirect()->route('presences.index')
                ->with('success', 'Kepulangan berhasil dikonfirmasi');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal konfirmasi kepulangan');
        }
    }

    /**
     * LIHAT LOKASI & DETAIL (Sesuai diagram 'Lihat Lokasi Presensi')
     */
    public function show($id)
    {
        $presence = Presences::with('monitoring.student')->findOrFail($id);
        return view('presence.show', compact('presence'));
    }
}
