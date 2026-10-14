@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold">Dashboard</h2>
    <p class="text-muted">
        Selamat datang, <strong>{{ $user->name }}</strong>
        <span class="badge bg-info">User</span>
    </p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Data Saya</h5>
        <a href="{{ route('user.profil.edit') }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil-square me-1"></i> Edit
        </a>
    </div>
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr><th width="200">Nama</th><td>{{ $user->name }}</td></tr>
            <tr><th>NIK</th><td>{{ $user->nik ?? '-' }}</td></tr>
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
        </table>
    </div>
</div>

@endsection 