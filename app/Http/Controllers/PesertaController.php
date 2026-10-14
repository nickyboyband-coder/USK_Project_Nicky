<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $users = User::with('peserta.skema')
            ->where('role', 'user')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%")
                        ->orWhereHas('peserta', fn ($p) => $p->where('nik', 'like', "%{$keyword}%"));
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('peserta.index', compact('users', 'keyword'));
    }

    public function show(User $user)
    {
        $this->ensureParticipant($user);
        $user->load('peserta.skema');

        return view('peserta.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->ensureParticipant($user);
        $user->load('peserta');

        return view('peserta.edit', [
            'user' => $user,
            'skema' => SkemaSertifikasi::orderBy('nama_skema')->get(),
            'action' => route('peserta.update', $user),
            'back' => route('peserta.index'),
            'withPassword' => false,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->ensureParticipant($user);
        $user->load('peserta');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'nik' => ['required', 'digits:16', Rule::unique('peserta', 'nik')->ignore($user->peserta?->id)],
            'no_hp' => 'required|digits_between:10,15',
            'skema_id' => ['required', Rule::exists('skema', 'id')],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 angka.',
            'nik.unique' => 'NIK sudah digunakan.',
            'no_hp.digits_between' => 'Nomor telepon harus 10-15 angka.',
            'email.unique' => 'Email sudah digunakan.',
            'skema_id.exists' => 'Skema sertifikasi tidak ditemukan.',
        ]);

        DB::transaction(function () use ($user, $validated) {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            $user->peserta()->updateOrCreate([], [
                'nik' => $validated['nik'],
                'no_hp' => $validated['no_hp'],
                'skema_id' => $validated['skema_id'],
            ]);
        });

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    // Hapus user, data peserta ikut terhapus otomatis (cascadeOnDelete)
    public function destroy(User $user)
    {
        $this->ensureParticipant($user);

        $user->delete();

        return redirect()
            ->route('peserta.index')
            ->with('success', 'User berhasil dihapus.');
    }

    private function ensureParticipant(User $user): void
    {
        abort_if($user->role !== 'user', 404);
    }
}