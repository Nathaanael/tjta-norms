@extends('layouts.app')

@section('title', 'Daftar Peserta')

@section('content')
<div class="page-head">
    <div class="shell page-head-row">
        <div>
            <div class="breadcrumbs"><a href="{{ route('landing') }}">Beranda</a><span>/</span><span>Daftar peserta</span></div>
            <h1>Daftar peserta</h1>
            <p class="muted">Seluruh peserta TJTA ditampilkan dalam satu tabel dan diurutkan berdasarkan nama.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('users.create') }}"><svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg> Tambah peserta</a>
    </div>
</div>

<div class="shell">
    @if (session('success'))
        <div class="alert alert-success"><svg viewBox="0 0 24 24" fill="none"><path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="2"/><path d="m8 12 2.5 2.5L16 9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg><span>{{ session('success') }}</span></div>
    @endif

    <div class="card directory-card">
        <div class="directory-toolbar">
            <form class="directory-search" action="{{ route('users.choose') }}" method="GET">
                <div class="search-wrap">
                    <svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/><path d="m20 20-4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    <input class="input" type="search" name="search" value="{{ $search }}" placeholder="Cari nama peserta..." aria-label="Cari peserta">
                </div>
                <input type="hidden" name="sort" value="{{ $sort }}">
                <button class="btn btn-secondary" type="submit">Cari</button>
                @if ($search !== '')<a class="text-link" href="{{ route('users.choose', ['sort' => $sort]) }}">Reset</a>@endif
            </form>
            <div class="directory-meta">
                <span>{{ $names->total() }} peserta</span>
                <a class="sort-button" href="{{ route('users.choose', ['search' => $search ?: null, 'sort' => $sort === 'asc' ? 'desc' : 'asc']) }}" title="Ubah urutan nama">
                    Nama {{ $sort === 'asc' ? 'A–Z' : 'Z–A' }}
                    <svg viewBox="0 0 24 24" fill="none"><path d="M8 7h8M8 12h6M8 17h4m7-2-3 3-3-3M16 18V6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>

        <div class="table-wrap directory-table-wrap">
            <table class="participant-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama peserta</th>
                        <th>Jenis kelamin</th>
                        <th>Hasil tersimpan</th>
                        <th>Terakhir diperbarui</th>
                        <th class="action-column">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($names as $person)
                        <tr>
                            <td class="row-number">{{ $names->firstItem() + $loop->index }}</td>
                            <td>
                                <a class="table-person" href="{{ route('input.input', $person->id) }}">
                                    <span class="avatar">{{ strtoupper(substr(trim($person->name), 0, 2)) }}</span>
                                    <span>{{ $person->name }}</span>
                                </a>
                            </td>
                            <td><span class="gender-badge {{ $person->gender === 'male' ? 'male' : 'female' }}">{{ $person->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</span></td>
                            <td><strong>{{ $person->results_count }}</strong> hasil</td>
                            <td>{{ $person->updated_at->format('d M Y, H:i') }}</td>
                            <td>
                                <div class="row-actions">
                                    <a class="icon-btn js-pdf-download" href="{{ route('reports.user', $person->id) }}" title="Unduh laporan PDF" aria-label="Unduh laporan PDF {{ $person->name }}">
                                        <svg viewBox="0 0 24 24" fill="none"><path d="M7 3h7l4 4v14H7V3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M14 3v5h4M10 13h5m-5 3h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                                    </a>
                                    <a class="icon-btn" href="{{ route('input.input', $person->id) }}" title="Buka skoring" aria-label="Buka skoring {{ $person->name }}">
                                        <svg viewBox="0 0 24 24" fill="none"><path d="M4 19V9m5 10V5m5 14v-7m5 7V3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                                    </a>
                                    <a class="icon-btn" href="{{ route('users.edit', $person->id) }}" title="Edit peserta" aria-label="Edit {{ $person->name }}">
                                        <svg viewBox="0 0 24 24" fill="none"><path d="m14 5 5 5M4 20l3.5-.7L19 7.8a2.1 2.1 0 0 0-3-3L4.7 16.3 4 20Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </a>
                                    <form action="{{ route('users.destroy', $person->id) }}" method="POST" onsubmit="return confirm('Hapus peserta ini beserta seluruh riwayat hasilnya?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="icon-btn icon-btn-danger" type="submit" title="Hapus peserta" aria-label="Hapus {{ $person->name }}">
                                            <svg viewBox="0 0 24 24" fill="none"><path d="M4 7h16m-10 4v5m4-5v5m-7 4h10l1-13H6l1 13Zm3-13V4h4v3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state table-empty">
                                    <span class="empty-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M15 19v-1.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 3 17.5V19M9 10a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm9-2v6m-3-3h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
                                    <h3>{{ $search ? 'Nama tidak ditemukan' : 'Belum ada peserta' }}</h3>
                                    <p>{{ $search ? 'Coba gunakan kata pencarian lain.' : 'Tambahkan peserta pertama untuk memulai skoring TJTA.' }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($names->hasPages())
            <nav class="pagination" aria-label="Navigasi halaman">
                <span>Menampilkan {{ $names->firstItem() }}–{{ $names->lastItem() }} dari {{ $names->total() }}</span>
                <div class="pagination-links">
                    @if ($names->onFirstPage())
                        <span class="page-button disabled">Sebelumnya</span>
                    @else
                        <a class="page-button" href="{{ $names->previousPageUrl() }}">Sebelumnya</a>
                    @endif
                    @foreach ($names->getUrlRange(max(1, $names->currentPage() - 2), min($names->lastPage(), $names->currentPage() + 2)) as $page => $url)
                        <a class="page-button {{ $page === $names->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
                    @endforeach
                    @if ($names->hasMorePages())
                        <a class="page-button" href="{{ $names->nextPageUrl() }}">Berikutnya</a>
                    @else
                        <span class="page-button disabled">Berikutnya</span>
                    @endif
                </div>
            </nav>
        @endif
    </div>
</div>
@endsection
