<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdministratorController extends Controller
{
    public function index()
    {
        $administrators = User::role('administrator')
            ->orderBy('created_at', 'desc')
            ->withTrashed()
            ->get();

        return view('administrator.index', [
            'administrators' => $administrators
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
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
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('Administrator');

        return response()->json([
            'message' => 'Administrator berhasil ditambahkan!',
            'data' => $user
        ]);
    }

    public function edit(User $administrator)
    {
        if (!$administrator) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $administrator]);
    }

    public function update(Request $request, User $administrator)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $administrator->id,
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $administrator->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json([
            'message' => 'Administrator berhasil diperbarui!',
            'data' => $administrator
        ]);
    }

    public function destroy(User $administrator)
    {
        try {
            $administrator->syncRoles([]);
            $administrator->delete();
            return response()->json([
                'message' => 'Administrator berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Administrator!',
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
                'message' => 'Administrator terpilih berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Administrator terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $administrator = User::withTrashed()->findOrFail($id);
        $administrator->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Administrator berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $administrator = User::withTrashed()->findOrFail($id);

            if (!$administrator->trashed()) {
                return response()->json([
                    'message' => 'Administrator belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $administrator->forceDelete();

            return response()->json([
                'message' => 'Administrator berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Administrator permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
