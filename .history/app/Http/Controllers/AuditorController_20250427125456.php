<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuditorController extends Controller
{
    public function index()
    {
        $jenisUnitKerja = UnitKerja::select('jenis_unit_kerja')
                        ->distinct()
                        ->orderBy('jenis_unit_kerja', 'asc')
                        ->pluck('jenis_unit_kerja');

        $unitKerjas = UnitKerja::all();
        $auditors = User::role('auditor')
            ->orderBy('created_at', 'desc')
            ->withTrashed()
            ->get();

        return view('auditor.index', [
            'auditors' => $auditors,
            'unitKerjas' => $unitKerjas,
            'jenisUnitKerja' => $jenisUnitKerja,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username|max:255',
            'no_hp' => 'required|numeric',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.unique' => 'Username sudah digunakan.',
            'username.max' => 'Username maksimal 255 karakter.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('Auditor');

        return response()->json([
            'message' => 'auditor berhasil ditambahkan!',
            'data' => $user
        ]);
    }

    public function edit(User $auditor)
    {
        if (!$auditor) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $auditor]);
    }

    public function update(Request $request, User $auditor)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $auditor->id,
            'username' => 'required|string|max:255|unique:users,username,' . $auditor->id,
            'no_hp' => 'required|numeric',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username maksimal 255 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $auditor->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);

        return response()->json([
            'message' => 'Auditor berhasil diperbarui!',
            'data' => $auditor
        ]);
    }

    public function destroy(User $auditor)
    {
        try {
            $auditor->syncRoles([]);
            $auditor->delete();
            return response()->json([
                'message' => 'Auditor berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Auditor!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroySelected(Request $request)
    {
        try {
            $ids = $request->ids;
            $users = User::whereIn('id', $ids)->get();
            foreach ($users as $user) {
                $user->syncRoles([]);
                $user->delete();
            }

            return response()->json([
                'message' => 'Auditor terpilih berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Auditor terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $auditor = User::withTrashed()->findOrFail($id);
        $auditor->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Auditor berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $auditor = User::withTrashed()->findOrFail($id);

            if (!$auditor->trashed()) {
                return response()->json([
                    'message' => 'Auditor belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $auditor->forceDelete();

            return response()->json([
                'message' => 'Auditor berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Auditor permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
