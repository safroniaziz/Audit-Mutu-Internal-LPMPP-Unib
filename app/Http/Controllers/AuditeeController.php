<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AuditeeController extends Controller
{
    public function index()
    {
        $jenisUnitKerja = UnitKerja::select('jenis_unit_kerja')
            ->distinct()
            ->orderBy('jenis_unit_kerja', 'asc')
            ->pluck('jenis_unit_kerja');
        $unitKerjas = UnitKerja::all();

        $roleExists = Role::where('name', 'auditee')->where('guard_name', 'web')->exists();
        $auditees = $roleExists
            ? User::role('auditee')
            ->with(['unitKerja'])
            ->orderBy('created_at', 'desc')
            ->withTrashed()
            ->get()
            : collect();
        return view('data_auditee.index', [
            'auditees' => $auditees,
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
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
            'password' => 'required|min:6|confirmed',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
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
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'unit_kerja_id.required' => 'Unit kerja wajib diisi.',
            'unit_kerja_id.exists' => 'Unit kerja yang dipilih tidak valid.',
            'foto.required' => 'Foto profil wajib diupload.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle upload foto
        $folder = "foto/auditee";
        $file = $request->file('foto');
        $filePath = $file->store($folder, 'public');

        $user = User::create([
            'name' => $request->name,
            'unit_kerja_id' => $request->unit_kerja_id,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => $filePath,
        ]);

        $user->assignRole('Auditee');

        return response()->json([
            'message' => 'Auditee berhasil ditambahkan!',
            'data' => $user
        ]);
    }

    public function edit(User $auditee)
    {
        if (!$auditee) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $auditee->foto_url = $auditee->foto
            ? Storage::url($auditee->foto)
            : null;

        return response()->json(['success' => true, 'data' => $auditee]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'username' => 'required|string|unique:users,username,' . $id . '|max:255',
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'foto_remove' => 'nullable|string',
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
            'unit_kerja_id.required' => 'Unit kerja wajib diisi.',
            'unit_kerja_id.exists' => 'Unit kerja yang dipilih tidak valid.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $updateData = [
            'name' => $request->name,
            'unit_kerja_id' => $request->unit_kerja_id,
            'username' => $request->username,
            'email' => $request->email,
        ];

        // Handle foto upload/remove
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            // Upload foto baru
            $folder = "foto/auditee";
            $file = $request->file('foto');
            $filePath = $file->store($folder, 'public');
            $updateData['foto'] = $filePath;
        } elseif ($request->foto_remove == '1') {
            // Hapus foto jika diminta
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            $updateData['foto'] = null;
        }

        $user->update($updateData);

        return response()->json([
            'message' => 'Auditee berhasil diperbarui!',
            'data' => $user
        ]);
    }

    public function destroy(User $auditee)
    {
        try {
            $auditee->syncRoles([]);
            $auditee->delete();
            return response()->json([
                'message' => 'Auditee berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Auditee!',
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
                'message' => 'Auditee terpilih berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Auditee terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $auditee = User::withTrashed()->findOrFail($id);
        $auditee->restore();

        return response()->json(['message' => 'Auditee berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $auditee = User::withTrashed()->findOrFail($id);

            if (!$auditee->trashed()) {
                return response()->json([
                    'message' => 'Auditee belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $auditee->forceDelete();

            return response()->json([
                'message' => 'Auditee berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Auditee permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
