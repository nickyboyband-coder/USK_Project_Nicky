@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h3 class="fw-bold mb-4">Detail User</h3>

        <table class="table table-bordered">
            <tr><th width="200">NIK</th><td>{{ $user->nik ?? '-' }}</td></tr>
            <tr><th>Nama</th><td>{{ $user->name }}</td></tr>
            <tr><th>Email</th><td>{{ $user->email }}</td></tr>
            <tr><th>Nomor Telepon</th><td>{{ $user->no_hp ?? '-' }}</td></tr>
            <tr>
                <th>Skema Sertifikasi</th>
                <td>
                    @if ($user->skema)
                        {{ $user->skema->kode_skema }} - {{ $user->skema->nama_skema }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr><th>Terdaftar</th><td>{{ $user->created_at?->format('d-m-Y H:i') ?? '-' }}</td></tr>
        </table>

        <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('peserta.edit', $user) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection