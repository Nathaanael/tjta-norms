@extends('layouts.app')

@section('title', 'Skoring ' . $user->name)

@section('content')
<div class="page-head">
    <div class="shell">
        <div class="breadcrumbs"><a href="{{ route('landing') }}">Beranda</a><span>/</span><a href="{{ route('users.choose') }}">Peserta</a><span>/</span><span>Skoring</span></div>
        <h1>Ruang skoring</h1>
        <p class="muted">Masukkan skor mentah setiap skala untuk membentuk profil temperamen individu dalam asesmen pernikahan.</p>
    </div>
</div>

<div class="shell workspace">
    <aside class="sticky-card">
        <div class="card subject-card">
            <div class="subject-top">
                <span class="subject-label">Peserta aktif</span>
                <div class="subject-name">{{ $user->name }}</div>
                <div class="subject-meta">{{ $user->gender === 'male' ? 'Laki-laki · Norma pria' : 'Perempuan · Norma wanita' }}</div>
            </div>
            <div class="subject-body">
                <div class="progress-head"><span>Kelengkapan skala</span><span>{{ $completedScales }}/9</span></div>
                <div class="progress-track" aria-label="{{ $completedScales }} dari 9 skala terisi"><span style="width: {{ ($completedScales / 9) * 100 }}%"></span></div>
                <p class="subject-note">Lengkapi skala A hingga I agar profil temperamen anggota pasangan dapat ditinjau secara utuh.</p>
                <a class="btn btn-primary btn-block js-pdf-download" href="{{ route('reports.user', $user->id) }}">
                    <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M7 3h7l4 4v14H7V3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M14 3v5h4M10 13h5m-5 3h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    Unduh laporan PDF
                </a>
                <a class="btn btn-secondary btn-block" href="{{ route('users.edit', $user->id) }}">
                    <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="m14 5 5 5M4 20l3.5-.7L19 7.8a2.1 2.1 0 0 0-3-3L4.7 16.3 4 20Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    Edit peserta
                </a>
                <a class="btn btn-secondary btn-block" href="{{ route('users.choose') }}">Ganti peserta</a>
            </div>
        </div>
    </aside>

    <section class="card scoring-card">
        <div class="card-body">
            <div class="scoring-head">
                <div><p class="eyebrow">Profil individu pasangan</p><h2>Input skor TJTA</h2><p>Pilih skala temperamen dan masukkan skor mentah pada rentang 0–40.</p></div>
            </div>

            @if (session('success'))
                <div class="alert alert-success" role="status"><svg viewBox="0 0 24 24" fill="none"><path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="2"/><path d="m8 12 2.5 2.5L16 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg><span>{{ session('success') }}</span></div>
            @endif
            @if ($errors->any())
                <div class="alert alert-error" role="alert">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M12 9v4m0 4h.01M10.3 4.2 2.6 17.5A2 2 0 0 0 4.3 20h15.4a2 2 0 0 0 1.7-2.5L13.7 4.2a2 2 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('input.lookup') }}" method="POST">
                @csrf
                <div class="score-fields">
                    <div class="field">
                        <label for="letter">Skala temperamen <span class="required">*</span></label>
                        <select class="select" id="letter" name="letter" required>
                            <option value="" disabled {{ old('letter') ? '' : 'selected' }}>Pilih skala A–I</option>
                            @foreach ($scales as $key => $scale)
                                <option value="{{ $key }}" data-label="{{ $scale['label'] }}" {{ old('letter') === $key ? 'selected' : '' }}>{{ $scale['code'] }} — {{ $scale['label'] }}</option>
                            @endforeach
                        </select>
                        <div class="select-detail" id="scale-detail">Pilih satu dari sembilan skala TJTA.</div>
                    </div>
                    <div class="field">
                        <label for="raw_score">Skor mentah <span class="required">*</span></label>
                        <input class="input" type="number" id="raw_score" name="raw_score" min="0" max="40" step="1" value="{{ old('raw_score') }}" placeholder="0–40" inputmode="numeric" required>
                        <p class="field-hint">Bilangan bulat 0 sampai 40.</p>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit"><svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M4 19V9m5 10V5m5 14v-7m5 7V3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg> Konversi & simpan</button>
            </form>

            <div class="results-section">
                <div class="results-head"><h3>Profil temperamen peserta</h3><span class="result-count">{{ $user->results->count() }} hasil tersimpan</span></div>
                @if($user->results->count() > 0)
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>Skala</th><th>Skor mentah</th><th>Persentil</th><th>Waktu input</th><th class="action-column">Aksi</th></tr></thead>
                            <tbody>
                                @foreach ($user->results as $result)
                                    @php($scale = $scales[$result->letter] ?? ['code' => '?', 'label' => ucfirst(str_replace('_', ' ', $result->letter))])
                                    <tr>
                                        <td><div class="scale-cell"><span class="scale-code">{{ $scale['code'] }}</span><span>{{ $scale['label'] }}</span></div></td>
                                        <td>{{ $result->raw_score }}</td>
                                        <td><span class="percentile">P{{ $result->value }}</span></td>
                                        <td>{{ $result->created_at->format('d M Y, H:i') }}</td>
                                        <td>
                                            <div class="row-actions">
                                                <a class="icon-btn" href="{{ route('results.edit', $result->id) }}" title="Edit hasil" aria-label="Edit hasil {{ $scale['code'] }}">
                                                    <svg viewBox="0 0 24 24" fill="none"><path d="m14 5 5 5M4 20l3.5-.7L19 7.8a2.1 2.1 0 0 0-3-3L4.7 16.3 4 20Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                </a>
                                                <form action="{{ route('results.destroy', $result->id) }}" method="POST" onsubmit="return confirm('Hapus hasil skala {{ $scale['code'] }} dengan skor mentah {{ $result->raw_score }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="icon-btn icon-btn-danger" type="submit" title="Hapus hasil" aria-label="Hapus hasil {{ $scale['code'] }}">
                                                        <svg viewBox="0 0 24 24" fill="none"><path d="M4 7h16m-10 4v5m4-5v5m-7 4h10l1-13H6l1 13Zm3-13V4h4v3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-results"><strong>Belum ada hasil tersimpan</strong>Hasil konversi pertama akan muncul di sini.</div>
                @endif

                <div class="scale-key">
                    <strong>Referensi skala TJTA</strong>
                    <div class="scale-key-grid">
                        @foreach ($scales as $scale)<span><b>{{ $scale['code'] }}</b> · {{ $scale['label'] }}</span>@endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    const scaleSelect = document.getElementById('letter');
    const scaleDetail = document.getElementById('scale-detail');
    function updateScaleDetail() {
        const option = scaleSelect.options[scaleSelect.selectedIndex];
        scaleDetail.textContent = option?.dataset.label ? `Skala terpilih: ${option.dataset.label}` : 'Pilih satu dari sembilan skala TJTA.';
    }
    scaleSelect.addEventListener('change', updateScaleDetail);
    updateScaleDetail();
</script>
@endpush
