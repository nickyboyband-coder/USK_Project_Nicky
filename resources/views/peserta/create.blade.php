@extends('layouts.app')

@section('title', 'Tambah Peserta')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h2 class="fw-bold mb-4">
            Tambah Peserta
        </h2>

        @if($errors->any())
            <div class="alert alert-danger">

                <strong>Terjadi kesalahan:</strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif

        <form
            action="{{ route('peserta.store') }}"
            method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Nik
                </label>

                <input
                    type="text"
                    name="nik"
                    class="form-control"
                    value="{{ old('nik') }}"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    value="{{ old('nama') }}"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    No. HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    class="form-control"
                    value="{{ old('no_hp') }}">

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Alamat
                </label>

                <textarea
                    name="alamat"
                    class="form-control"
                    rows="3">{{ old('alamat') }}</textarea>

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Skema Sertifikasi
                </label>

                <select
                    name="skema_id"
                    class="form-select"
                    required>

                    <option value="">
                        -- Pilih Skema --
                    </option>

                    @foreach($skema as $item)

                        <option
                            value="{{ $item->id }}"
                            {{ old('skema_id') == $item->id ? 'selected' : '' }}>

                            {{ $item->kode_skema }}
                            -
                            {{ $item->nama_skema }}

                        </option>

                    @endforeach

                </select>

            </div>

            <a
                href="{{ route('peserta.index') }}"
                class="btn btn-secondary">
                Kembali
            </a>

            <button class="btn btn-primary">
                Simpan Peserta
            </button>

        </form>

    </div>

</div>

@endsection