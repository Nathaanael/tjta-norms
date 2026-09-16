@extends('layouts.app')

@section('title', 'Edit Hasil')

@section('content')
<div class="page-head">
    <div class="shell">
        <div class="breadcrumbs"><a href="{{ route('landing') }}">Beranda</a><span>/</span><a href="{{ route('users.choose') }}">Peserta</a><span>/</span><a href="{{ route('input.input', $result->user_id) }}">Skoring</a><span>/</span><span>Edit hasil</span></div>
        <h1>Edit hasil</h1>
        <p class="muted">Perbarui skor temperamen milik {{ $result->user->name }}. Persentil akan dihitung ulang secara otomatis.</p>
    </div>
</div>

<div class="shell">
    <div class="card form-shell">
        <div class="card-body">
            <div class="form-intro">
                <span class="form-intro-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 19V9m5 10V5m5 14v-7m5 7V3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
                <div><h3>Data hasil TJTA</h3><p>Norma {{ $result->user->gender === 'male' ? 'pria' : 'wanita' }} akan digunakan untuk konversi.</p></div>
            </div>

            @if ($errors->any())
                <div class="alert alert-error" role="alert"><svg viewBox="0 0 24 24" fill="none"><path d="M12 9v4m0 4h.01M10.3 4.2 2.6 17.5A2 2 0 0 0 4.3 20h15.4a2 2 0 0 0 1.7-2.5L13.7 4.2a2 2 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif

            <form action="{{ route('results.update', $result->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="field">
                    <label for="letter">Skala temperamen <span class="required">*</span></label>
                    <select class="select" id="letter" name="letter" required>
                        @foreach ($scales as $key => $scale)
                            <option value="{{ $key }}" {{ old('letter', $result->letter) === $key ? 'selected' : '' }}>{{ $scale['code'] }} — {{ $scale['label'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="raw_score">Skor mentah <span class="required">*</span></label>
                    <input class="input" type="number" id="raw_score" name="raw_score" min="0" max="40" step="1" value="{{ old('raw_score', $result->raw_score) }}" required>
                    <p class="field-hint">Persentil saat ini: P{{ $result->value }}. Nilai baru ditentukan setelah disimpan.</p>
                </div>
                <div class="form-actions">
                    <a class="btn btn-secondary" href="{{ route('input.input', $result->user_id) }}">Batal</a>
                    <button class="btn btn-primary" type="submit">Hitung ulang & simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
