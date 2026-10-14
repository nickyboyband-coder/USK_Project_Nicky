@extends('layouts.app')

@section('title', 'Edit Data')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h3 class="fw-bold mb-4">{{ $withPassword ? 'Edit Data Saya' : 'Edit User' }}</h3>

        <form action="{{ $action }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nama lengkap</label>
                    <input type="text" name="name" id="name" class="form-control"
                           value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                           value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control"
                           value="{{ old('nik', $user->nik) }}" inputmode="numeric"
                           pattern="[0-9]{16}" maxlength="16" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="no_hp" class="form-label">Nomor telepon</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control"
                           value="{{ old('no_hp', $user->no_hp) }}" inputmode="numeric"
                           pattern="[0-9]{10,15}" maxlength="15" required>
                </div>

                <div class="col-12 mb-3">
                    <label for="skema_id" class="form-label">Skema sertifikasi</label>
                    <select name="skema_id" id="skema_id" class="form-select" required>
                        <option value="">-- Pilih skema --</option>
                        @foreach ($skema as $item)
                            <option value="{{ $item->id }}" @selected(old('skema_id', $user->skema_id) == $item->id)>
                                {{ $item->kode_skema }} - {{ $item->nama_skema }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if ($withPassword)
                    <div class="col-12">
                        <hr>
                        <p class="text-muted small mb-2">Kosongkan jika tidak ingin mengganti password.</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password baru</label>
                        <input type="password" name="password" id="password" class="form-control" minlength="8">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi password baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control" minlength="8">
                    </div>
                @endif
            </div>

            <a href="{{ $back }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection