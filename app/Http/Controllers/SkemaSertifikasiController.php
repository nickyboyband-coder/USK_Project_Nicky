<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;

class SkemaSertifikasiController extends Controller
{
    // Daftar skema untuk Admin
    public function index()
    {
        $skema = SkemaSertifikasi::latest()->paginate(10);

        return view('skema.index', compact('skema'));
    }

    // Daftar skema untuk User
    public function userIndex()
    {
        return $this->index();
    }

    // Form tambah skema (Admin)
    public function create()
    {
        return view('skema.create');
    }

    // Simpan skema (Admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_skema' => 'required|string|max:50|unique:skema,kode_skema',
            'nama_skema' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        SkemaSertifikasi::create($validated);

        return redirect()
            ->route('skema.index')
            ->with('success', 'Skema sertifikasi berhasil ditambahkan.');
    }

    // Detail skema
    public function show(SkemaSertifikasi $skema)
    {
        $skema->loadCount('users');

        return view('skema.show', compact('skema'));
    }

    // Detail skema untuk User
    public function userShow(SkemaSertifikasi $skema)
    {
        return $this->show($skema);
    }

    // Form edit skema (Admin)
    public function edit(SkemaSertifikasi $skema)
    {
        return view('skema.edit', compact('skema'));
    }

    // Update skema (Admin)
    public function update(Request $request, SkemaSertifikasi $skema)
    {
        $validated = $request->validate([
            'kode_skema' => 'required|string|max:50|unique:skema,kode_skema,' . $skema->id,
            'nama_skema' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $skema->update($validated);

        return redirect()
            ->route('skema.index')
            ->with('success', 'Skema sertifikasi berhasil diperbarui.');
    }

    // Hapus skema (Admin)
    public function destroy(SkemaSertifikasi $skema)
    {
        if ($skema->users()->exists()) {
            return redirect()
                ->route('skema.index')
                ->with('error', 'Skema tidak dapat dihapus karena masih dipilih oleh user.');
        }

        $skema->delete();

        return redirect()
            ->route('skema.index')
            ->with('success', 'Skema sertifikasi berhasil dihapus.');
    }
}