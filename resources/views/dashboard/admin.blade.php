@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="mb-4">
    <h1 class="fw-bold">Dashboard Admin</h1>
    <p class="text-muted">
        Selamat datang, <strong>{{ $user->name }}</strong>
        <span class="badge bg-primary">Admin</span>
    </p>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total User Terdaftar</h6>
                <h1 class="fw-bold text-primary">{{ $totalUser }}</h1>
                <a href="{{ route('peserta.index') }}" class="btn btn-primary">Kelola User</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Skema</h6>
                <h1 class="fw-bold text-success">{{ $totalSkema }}</h1>
                <a href="{{ route('skema.index') }}" class="btn btn-success">Kelola Skema</a>
            </div>
        </div>
    </div>
</div>

@endsection