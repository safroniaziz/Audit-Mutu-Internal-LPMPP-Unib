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
        $administrators = User::orderBy('created_at', 'desc')->get();

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

        return view('administrator.edit', [
            'administrator' => $administrator,
        ]);
    }

    public function update(Request $request, User $administrator)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $administrator->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $administrator->update([
            'name' => $request->name,
            'username' => $request->username,
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
            User::whereIn('id', $ids)->delete();

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
}
