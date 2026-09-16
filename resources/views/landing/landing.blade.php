@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<section class="hero">
    <div class="shell hero-grid">
        <div class="hero-copy">
            <p class="eyebrow">Asesmen relasi dan pernikahan</p>
            <h1>Pahami profil temperamen dalam hubungan pernikahan.</h1>
            <p>TJTA membantu menggambarkan karakteristik temperamen setiap anggota pasangan. Masukkan skor sembilan skala untuk memperoleh profil persentil sebagai bahan asesmen pranikah maupun konseling pernikahan.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('users.create') }}">
                    Tambah anggota pasangan
                    <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <a class="btn btn-secondary" href="{{ route('users.choose') }}">Lanjutkan penilaian</a>
            </div>
        </div>

        <div class="hero-panel" aria-label="Pratinjau sembilan skala TJTA">
            <div class="hero-panel-head"><span>Profil temperamen · 9 skala</span><i class="status-dot"></i></div>
            <div class="scale-preview">
                <div><strong>A</strong><small>Nervous</small></div>
                <div><strong>B</strong><small>Depressive</small></div>
                <div><strong>C</strong><small>Active Social</small></div>
                <div><strong>D</strong><small>Expressive</small></div>
                <div><strong>E</strong><small>Sympathetic</small></div>
                <div><strong>F</strong><small>Subjective</small></div>
                <div><strong>G</strong><small>Dominant</small></div>
                <div><strong>H</strong><small>Hostile</small></div>
                <div><strong>I</strong><small>Self-disciplined</small></div>
            </div>
            <div class="hero-panel-foot">
                <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="2"/><path d="m8 12 2.5 2.5L16 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Norma pria dan wanita diterapkan pada profil masing-masing anggota pasangan.
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="shell">
        <div class="section-heading">
            <p class="eyebrow">Alur kerja</p>
            <h2>Tiga langkah memahami profil pasangan</h2>
            <p class="muted">Skor setiap individu secara terpisah, kemudian gunakan profilnya sebagai bahan pembahasan bersama tenaga profesional.</p>
        </div>
        <div class="steps">
            <article class="step-card"><span class="step-no">01</span><h3>Daftarkan anggota pasangan</h3><p>Masukkan setiap individu secara terpisah agar norma pria atau wanita dapat diterapkan dengan tepat.</p></article>
            <article class="step-card"><span class="step-no">02</span><h3>Masukkan skor TJTA</h3><p>Pilih skala temperamen A–I lalu masukkan skor mentah dari lembar jawaban masing-masing individu.</p></article>
            <article class="step-card"><span class="step-no">03</span><h3>Tinjau profil temperamen</h3><p>Gunakan hasil persentil untuk membantu pembahasan pola interaksi, kekuatan, dan area penyesuaian pasangan.</p></article>
        </div>
    </div>
</section>
@endsection
