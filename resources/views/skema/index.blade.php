@extends('layouts.app')

@section('title', 'Data Skema Sertifikasi')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Data Skema Sertifikasi</h3>
            <p class="text-muted mb-0">
                Daftar skema sertifikasi yang tersedia.
            </p>
        </div>

        <a href="{{ route('skema.create') }}" class="btn btn-primary">
            + Tambah Skema
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th width="60">No.</th>
                            <th>Kode Skema</th>
                            <th>Nama Skema</th>
                            <th>Deskripsi</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($skema as $item)
                            <tr>
                                <td>{{ $skema->firstItem() + $loop->index }}</td>
                                <td>{{ $item->kode_skema }}</td>
                                <td>{{ $item->nama_skema }}</td>
                                <td>{{ $item->deskripsi ?: '-' }}</td>

                                <td>
                                    <div class="d-flex gap-1 align-items-center">
                                        <a href="{{ route('skema.show', $item->id) }}"
                                           class="btn btn-info btn-sm text-white">
                                            Detail
                                        </a>

                                        <a href="{{ route('skema.edit', $item->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('skema.destroy', $item->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus skema ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    Belum ada data skema sertifikasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $skema->links() }}
        </div>
    </div>
</div>
@endsection