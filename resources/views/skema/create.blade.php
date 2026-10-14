@extends('layouts.app')

@section('title', 'Tambah Skema')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h2 class="fw-bold mb-4">
            Tambah Skema Sertifikasi
        </h2>

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('skema.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Kode Skema
                </label>

                <input
                    type="text"
                    name="kode_skema"
                    class="form-control"
                    placeholder="Contoh: JWD-001"
                    value="{{ old('kode_skema') }}"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Nama Skema
                </label>

                <input
                    type="text"
                    name="nama_skema"
                    class="form-control"
                    placeholder="Contoh: Junior Web Developer"
                    value="{{ old('nama_skema') }}"
                    required>

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Deskripsi
                </label>

                <textarea
                    name="deskripsi"
                    class="form-control"
                    rows="4"
                    placeholder="Deskripsi skema...">{{ old('deskripsi') }}</textarea>

            </div>

            <a href="{{ route('skema.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

            <button class="btn btn-primary">
                Simpan Skema
            </button>

        </form>

    </div>

</div>

@endsection