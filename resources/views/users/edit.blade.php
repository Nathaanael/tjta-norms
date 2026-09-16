@extends('layouts.app')

@section('title', 'Edit Peserta')

@section('content')
<div class="page-head">
    <div class="shell">
        <div class="breadcrumbs"><a href="{{ route('landing') }}">Beranda</a><span>/</span><a href="{{ route('users.choose') }}">Peserta</a><span>/</span><span>Edit</span></div>
        <h1>Edit peserta</h1>
        <p class="muted">Perbarui identitas dan norma yang digunakan untuk profil {{ $user->name }}.</p>
    </div>
</div>

<div class="shell">
    <div class="card form-shell">
        <div class="card-body">
            <div class="form-intro">
                <span class="form-intro-icon"><svg viewBox="0 0 24 24" fill="none"><path d="m14 5 5 5M4 20l3.5-.7L19 7.8a2.1 2.1 0 0 0-3-3L4.7 16.3 4 20Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                <div><h3>Identitas peserta</h3><p>Jika jenis kelamin diubah, seluruh persentil lama akan dihitung ulang secara otomatis.</p></div>
            </div>

            @if ($errors->any())
                <div class="alert alert-error" role="alert"><svg viewBox="0 0 24 24" fill="none"><path d="M12 9v4m0 4h.01M10.3 4.2 2.6 17.5A2 2 0 0 0 4.3 20h15.4a2 2 0 0 0 1.7-2.5L13.7 4.2a2 2 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg><span>Periksa kembali data yang Anda masukkan.</span></div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="field">
                    <label for="name">Nama lengkap <span class="required">*</span></label>
                    <input class="input" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required autofocus>
                    @error('name')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label>Jenis kelamin <span class="required">*</span></label>
                    <div class="choice-grid">
                        <div class="choice">
                            <input type="radio" name="gender" value="male" id="male" {{ old('gender', $user->gender) === 'male' ? 'checked' : '' }} required>
                            <label for="male"><span class="choice-dot">L</span><span><strong>Laki-laki</strong><small>Gunakan norma pria</small></span></label>
                        </div>
                        <div class="choice">
                            <input type="radio" name="gender" value="female" id="female" {{ old('gender', $user->gender) === 'female' ? 'checked' : '' }} required>
                            <label for="female"><span class="choice-dot">P</span><span><strong>Perempuan</strong><small>Gunakan norma wanita</small></span></label>
                        </div>
                    </div>
                    @error('gender')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-actions">
                    <a class="btn btn-secondary" href="{{ route('input.input', $user->id) }}">Batal</a>
                    <button class="btn btn-primary" type="submit">Simpan perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
