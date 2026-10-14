@extends('layouts.app')

@section('title', 'Data User')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Data User</h3>
        <p class="text-muted mb-0">Semua user yang terdaftar sebagai peserta sertifikasi.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('peserta.index') }}" method="GET" class="row g-2 mb-4">
                <div class="col-md-10">
                    <input type="text" name="keyword" class="form-control"
                           placeholder="Cari nama, NIK, atau email..." value="{{ $keyword }}">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-secondary">Cari</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th width="60">No.</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Skema</th>
                            <th width="210">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $item)
                            <tr>
                                <td>{{ $users->firstItem() + $loop->index }}</td>
                                <td>{{ $item->nik ?? '-' }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_hp ?? '-' }}</td>
                                <td>{{ $item->skema->nama_skema ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('peserta.show', $item) }}"
                                           class="btn btn-info btn-sm text-white">Detail</a>
                                        <a href="{{ route('peserta.edit', $item) }}"
                                           class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('peserta.destroy', $item) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Belum ada user terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">{{ $users->links() }}</div>
        </div>
    </div>
</div>
@endsection