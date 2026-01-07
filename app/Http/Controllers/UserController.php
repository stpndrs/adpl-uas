<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    /**
     * TAMPIL DATA & PENCARIAN
     * Sesuai diagram 'view data akun' & 'Pencarian data akun'
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Logika pencarian berdasarkan nama atau username
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('username', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(10); // Sesuai getAllAkun(10)
        return view('user.index', compact('users'));
    }

    /**
     * SIMPAN AKUN BARU
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'     => 'required|string|max:255',
                'username' => 'required|string|unique:users,username',
                'password' => 'required|min:6',
                'role'     => 'required|in:admin,teacher,student',
            ]);

            User::create([
                'name'     => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password), // Enkripsi password
                'role'     => $request->role,
            ]);

            return redirect()->route('users.index')
                ->with('success', 'Akun berhasil dibuat');
        } catch (Throwable $th) {
            // Sesuai alur 'Failed Akun Controller'
            return back()->withInput()->with('error', 'Gagal membuat akun: ' . $th->getMessage());
        }
    }

    /**
     * UPDATE DATA AKUN
     * Sesuai diagram 'Edit Data Akun'
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'name'     => 'required|string|max:255',
                'username' => 'required|unique:users,username,' . $id,
                'role'     => 'required',
            ]);

            $data = $request->only(['name', 'username', 'role']);

            // Update password hanya jika diisi
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

            return redirect()->route('users.index')
                ->with('success', 'Data akun berhasil diperbarui');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal memperbarui akun');
        }
    }

    /**
     * HAPUS AKUN
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')
                ->with('success', 'Akun berhasil dihapus');
        } catch (Throwable $th) {
            return back()->with('error', 'Gagal menghapus akun');
        }
    }
}
