<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::with('peserta.skema')->findOrFail(Auth::id());

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
            'user' => User::with('peserta')->findOrFail(Auth::id()),
            'skema' => SkemaSertifikasi::orderBy('nama_skema')->get(),
            'action' => route('user.profil.update'),
            'back' => route('dashboard'),
            'withPassword' => true,
        ]);
    }

    // Simpan perubahan data milik sendiri (user)
    public function updateProfil(Request $request)
    {
        $user = User::with('peserta')->findOrFail(Auth::id());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'nik' => ['required', 'digits:16', Rule::unique('peserta', 'nik')->ignore($user->peserta?->id)],
            'no_hp' => 'required|digits_between:10,15',
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

        $akun = ['name' => $validated['name'], 'email' => $validated['email']];
        if (!empty($validated['password'])) {
            $akun['password'] = $validated['password'];
        }

        DB::transaction(function () use ($user, $akun, $validated) {
            $user->update($akun);

            $user->peserta()->updateOrCreate([], [
                'nik' => $validated['nik'],
                'no_hp' => $validated['no_hp'],
                'skema_id' => $validated['skema_id'],
            ]);
        });

        return redirect()
            ->route('dashboard')
            ->with('success', 'Data kamu berhasil diperbarui.');
    }
}