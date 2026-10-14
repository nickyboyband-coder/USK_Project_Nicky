<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::with('skema')->findOrFail(Auth::id());

        if ($user->isAdmin()) {
            $totalUser = User::where('role', 'user')->count();
            $totalSkema = SkemaSertifikasi::count();

            return view('dashboard.admin', compact('user', 'totalUser', 'totalSkema'));
        }

        return view('dashboard.user', compact('user'));
    }

    // Form edit data milik sendiri (user)
    public function editProfil()
    {
        return view('peserta.edit', [
            'user' => User::findOrFail(Auth::id()),
            'skema' => SkemaSertifikasi::orderBy('nama_skema')->get(),
            'action' => route('user.profil.update'),
            'back' => route('dashboard'),
            'withPassword' => true,
        ]);
    }

    // Simpan perubahan data milik sendiri (user)
    public function updateProfil(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => ['required', 'digits:16', Rule::unique('users', 'nik')->ignore($user->id)],
            'no_hp' => 'required|digits_between:10,15',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'skema_id' => ['required', Rule::exists('skema', 'id')],
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 angka.',
            'nik.unique' => 'NIK sudah digunakan.',
            'no_hp.digits_between' => 'Nomor telepon harus 10-15 angka.',
            'email.unique' => 'Email sudah digunakan.',
            'skema_id.exists' => 'Skema sertifikasi tidak ditemukan.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Data kamu berhasil diperbarui.');
    }
}