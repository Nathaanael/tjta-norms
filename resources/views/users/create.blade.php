@extends('layouts.app')

@section('title', 'Peserta Baru')

@section('content')
<div class="page-head">
    <div class="shell">
        <div class="breadcrumbs"><a href="{{ route('landing') }}">Beranda</a><span>/</span><span>Peserta baru</span></div>
        <h1>Tambahkan peserta</h1>
        <p class="muted">Tambahkan peserta sebelum memulai skoring TJTA pernikahan.</p>
    </div>
</div>

<div class="shell">
    <div class="card form-shell">
        <div class="card-body">
            <div class="form-intro">
                <span class="form-intro-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M15 19v-1.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 3 17.5V19M9 10a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm9-2v6m-3-3h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
                <div><h3>Identitas peserta</h3><p>Jenis kelamin digunakan untuk memilih tabel norma yang sesuai.</p></div>
            </div>

            @if ($errors->any())
                <div class="alert alert-error" role="alert">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M12 9v4m0 4h.01M10.3 4.2 2.6 17.5A2 2 0 0 0 4.3 20h15.4a2 2 0 0 0 1.7-2.5L13.7 4.2a2 2 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    <div>Periksa kembali data yang Anda masukkan.</div>
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="field">
                    <label for="name">Nama lengkap <span class="required">*</span></label>
                    <input class="input" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" autocomplete="name" required autofocus>
                    <p class="field-hint">Gunakan nama atau kode peserta yang mudah dikenali.</p>
                    @error('name')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label>Jenis kelamin <span class="required">*</span></label>
                    <div class="choice-grid">
                        <div class="choice">
                            <input type="radio" name="gender" value="male" id="male" {{ old('gender') === 'male' ? 'checked' : '' }} required>
                            <label for="male"><span class="choice-dot">L</span><span><strong>Laki-laki</strong><small>Gunakan norma pria</small></span></label>
                        </div>
                        <div class="choice">
                            <input type="radio" name="gender" value="female" id="female" {{ old('gender') === 'female' ? 'checked' : '' }} required>
                            <label for="female"><span class="choice-dot">P</span><span><strong>Perempuan</strong><small>Gunakan norma wanita</small></span></label>
                        </div>
                    </div>
                    @error('gender')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-actions">
                    <a class="btn btn-secondary" href="{{ route('landing') }}">Batal</a>
                    <button class="btn btn-primary" type="submit">Simpan & lanjutkan <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
