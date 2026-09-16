<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Profil TJTA - {{ $participant->name }}</title>
    <style>
        @page { margin: 34px 42px 42px; }
        * { box-sizing: border-box; }
        body { margin: 0; color: #17332f; font-family: DejaVu Sans, sans-serif; font-size: 10px; line-height: 1.45; }
        .page { position: relative; min-height: 1010px; }
        .page-break { page-break-before: always; }
        .header { width: 100%; border-collapse: collapse; border-bottom: 2px solid #1e665d; }
        .header td { padding: 0 0 15px; vertical-align: middle; }
        .header .brand-col { width: 70%; }
        .brand { display: inline-block; vertical-align: middle; }
        .mark { width: 36px; height: 36px; display: inline-block; margin-right: 9px; color: white; background: #1e665d; border-radius: 8px; font-size: 19px; font-weight: bold; line-height: 36px; text-align: center; vertical-align: middle; }
        .brand-copy { display: inline-block; vertical-align: middle; }
        .brand-copy strong { display: block; font-size: 14px; letter-spacing: .5px; }
        .brand-copy span { color: #667975; font-size: 8px; letter-spacing: .8px; text-transform: uppercase; }
        .doc-meta { color: #667975; font-size: 8px; text-align: right; }
        .sample-banner { margin: 16px 0 0; padding: 7px; color: #8b5b36; background: #fff1e7; border: 1px solid #edcdb6; font-size: 8px; font-weight: bold; letter-spacing: 1px; text-align: center; text-transform: uppercase; }
        .hero { padding: 22px 0 18px; }
        .eyebrow { margin-bottom: 6px; color: #1e665d; font-size: 8px; font-weight: bold; letter-spacing: 1.3px; text-transform: uppercase; }
        h1 { margin: 0 0 6px; font-family: DejaVu Serif, serif; font-size: 25px; font-weight: bold; line-height: 1.15; }
        .lead { width: 78%; margin: 0; color: #5f726e; font-size: 9px; }
        .identity { width: 100%; margin-bottom: 18px; padding: 14px 16px; background: #f1f6f3; border-radius: 8px; }
        .identity td { padding: 2px 8px 2px 0; }
        .identity .label { color: #6b7e79; font-size: 7px; font-weight: bold; letter-spacing: .7px; text-transform: uppercase; }
        .identity .value { font-size: 10px; font-weight: bold; }
        .section-title { margin: 18px 0 9px; font-family: DejaVu Serif, serif; font-size: 14px; }
        .status { float: right; padding: 4px 8px; color: #1e665d; background: #e8f3ef; border-radius: 12px; font-family: DejaVu Sans, sans-serif; font-size: 7px; font-weight: bold; }
        .profile-table { width: 100%; border-collapse: collapse; }
        .profile-table th { padding: 7px 8px; color: #5d706c; background: #f4f6f3; border-bottom: 1px solid #d8e2dd; font-size: 7px; letter-spacing: .5px; text-align: left; text-transform: uppercase; }
        .profile-table td { padding: 7px 8px; border-bottom: 1px solid #e3e9e6; vertical-align: middle; }
        .code { width: 23px; height: 23px; display: inline-block; color: #1e665d; background: #e8f3ef; border-radius: 5px; font-weight: bold; line-height: 23px; text-align: center; }
        .score { font-weight: bold; }
        .missing { color: #9aa8a4; font-style: italic; }
        .bar-track { width: 155px; height: 8px; background: #e8eeeb; border-radius: 4px; }
        .bar-fill { height: 8px; background: #1e665d; border-radius: 4px; }
        .chart { width: 100%; padding: 12px 14px; border: 1px solid #d8e2dd; border-radius: 8px; }
        .chart-row { width: 100%; margin-bottom: 6px; }
        .chart-label { width: 125px; display: inline-block; font-size: 8px; }
        .chart-track { width: 390px; height: 9px; display: inline-block; background: #edf1ef; vertical-align: middle; }
        .chart-fill { height: 9px; background: #dd8e58; }
        .chart-value { width: 35px; display: inline-block; padding-left: 7px; font-size: 8px; font-weight: bold; }
        .guide-grid { width: 100%; border-collapse: separate; border-spacing: 8px; margin: 0 -8px; }
        .guide-card { width: 33.33%; padding: 12px; background: #f4f7f4; border: 1px solid #dfe7e3; border-radius: 7px; vertical-align: top; }
        .guide-card strong { display: block; margin-bottom: 5px; color: #1e665d; font-size: 9px; }
        .guide-card p { margin: 0; color: #60736f; font-size: 8px; }
        .scale-list { width: 100%; margin-top: 8px; border-collapse: collapse; }
        .scale-list td { width: 33.33%; padding: 8px; border: 1px solid #e0e7e4; }
        .scale-list b { color: #1e665d; }
        .notes { height: 145px; padding: 12px; border: 1px solid #cfdad5; border-radius: 8px; }
        .notes span { color: #879793; font-size: 8px; }
        .signature { width: 100%; margin-top: 20px; }
        .signature td { width: 50%; vertical-align: top; }
        .signature-box { width: 190px; padding-top: 50px; border-bottom: 1px solid #758681; }
        .signature-label { padding-top: 4px; color: #70817d; font-size: 8px; }
        .notice { margin-top: 18px; padding: 11px 13px; color: #6c5a4d; background: #fff6ed; border-left: 3px solid #dd8e58; font-size: 8px; }
        .footer { position: absolute; bottom: 0; left: 0; width: 100%; padding-top: 8px; color: #7a8b87; border-top: 1px solid #dfe6e3; font-size: 7px; }
        .footer .right { float: right; }
    </style>
</head>
<body>
    <div class="page">
        <!-- <div class="header">
            <div class="brand"><span class="mark">T</span><span class="brand-copy"><strong>TJTA</strong><span>Asesmen Pernikahan</span></span></div>
            <div class="doc-meta">LAPORAN PROFIL INDIVIDU<br>Dibuat {{ $generatedAt->format('d/m/Y H:i') }}</div>
        </div> -->

        @if ($isSample)<div class="sample-banner">Data contoh - bukan hasil asesmen nyata</div>@endif

        <div class="hero">
            <div class="eyebrow">Profil temperamen individu</div>
            <h1>Laporan Hasil TJTA</h1>
            <p class="lead">Ringkasan konversi skor mentah ke persentil berdasarkan norma {{ $participant->gender === 'male' ? 'pria' : 'wanita' }}. Laporan ini disiapkan sebagai bahan asesmen relasi dan pernikahan.</p>
        </div>

        <table class="identity">
            <tr>
                <td><div class="label">Nama / kode peserta</div><div class="value">{{ $participant->name }}</div></td>
                <td><div class="label">Jenis kelamin</div><div class="value">{{ $participant->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</div></td>
                <td><div class="label">ID peserta</div><div class="value">{{ $participant->id }}</div></td>
                <td><div class="label">Kelengkapan</div><div class="value">{{ $completedCount }} dari 9 skala</div></td>
            </tr>
        </table>

        <h2 class="section-title">Profil persentil <span class="status">{{ $completedCount === 9 ? 'LENGKAP' : 'DRAF - BELUM LENGKAP' }}</span></h2>
        <div class="chart">
            @foreach ($reportRows as $row)
                <div class="chart-row">
                    <span class="chart-label"><b>{{ $row['code'] }}</b> &nbsp;{{ $row['label'] }}</span>
                    <span class="chart-track"><span class="chart-fill" style="display:block;width:{{ $row['percentile'] ?? 0 }}%"></span></span>
                    <span class="chart-value">{{ $row['percentile'] !== null ? 'P'.$row['percentile'] : '-' }}</span>
                </div>
            @endforeach
        </div>

        <h2 class="section-title">Rincian skor</h2>
        <table class="profile-table">
            <thead><tr><th>Skala</th><th>Dimensi</th><th>Skor mentah</th><th>Persentil</th><th>Status</th></tr></thead>
            <tbody>
                @foreach ($reportRows as $row)
                    <tr>
                        <td><span class="code">{{ $row['code'] }}</span></td>
                        <td>{{ $row['label'] }}</td>
                        <td class="score">{{ $row['raw_score'] ?? '-' }}</td>
                        <td class="score">{{ $row['percentile'] !== null ? 'P'.$row['percentile'] : '-' }}</td>
                        <td class="{{ $row['percentile'] === null ? 'missing' : '' }}">{{ $row['percentile'] === null ? 'Belum diisi' : 'Tersimpan' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer"><span>RAHASIA - Dokumen asesmen psikologis</span><span class="right">Halaman 1 dari 2</span></div>
    </div>

    <div class="page page-break">
        <table class="header"><tr>
            <td class="brand-col"><div class="brand"><span class="mark">T</span><span class="brand-copy"><strong>TJTA</strong><span>Asesmen Pernikahan</span></span></div></td>
            <td class="doc-meta">{{ $participant->name }}<br>ID {{ $participant->id }}</td>
        </tr></table>

        <!-- <h2 class="section-title">Panduan membaca laporan</h2>
        <table class="guide-grid">
            <tr>
                <td class="guide-card"><strong>Persentil bukan nilai benar</strong><p>P75 berarti posisi skor berada pada atau di atas sekitar 75 persen kelompok norma, bukan berarti peserta menjawab 75 persen dengan benar.</p></td>
                <td class="guide-card"><strong>Tinggi tidak selalu lebih baik</strong><p>Posisi tinggi atau rendah pada suatu skala tidak dapat dinilai sebagai baik atau buruk tanpa melihat konteks individu dan relasinya.</p></td>
                <td class="guide-card"><strong>Bukan skor kecocokan</strong><p>Profil ini tidak menentukan apakah seseorang cocok menikah. Interpretasi perlu dipadukan dengan wawancara dan asesmen profesional lainnya.</p></td>
            </tr>
        </table> -->

        <h2 class="section-title">Referensi skala</h2>
        <table class="scale-list">
            <tr>
                @foreach ($reportRows->take(3) as $row)<td><b>{{ $row['code'] }}</b> &nbsp;{{ $row['label'] }}</td>@endforeach
            </tr>
            <tr>
                @foreach ($reportRows->slice(3, 3) as $row)<td><b>{{ $row['code'] }}</b> &nbsp;{{ $row['label'] }}</td>@endforeach
            </tr>
            <tr>
                @foreach ($reportRows->slice(6, 3) as $row)<td><b>{{ $row['code'] }}</b> &nbsp;{{ $row['label'] }}</td>@endforeach
            </tr>
        </table>

        <h2 class="section-title">Catatan pemeriksa</h2>
        <div class="notes"><span>Area untuk rangkuman observasi, hasil wawancara, konteks relasi, dan rekomendasi tindak lanjut.</span></div>

        <table class="signature">
            <tr>
                <td><div class="signature-box"></div><div class="signature-label">Nama dan tanda tangan pemeriksa</div></td>
                <td style="text-align:right"><div class="signature-box" style="margin-left:auto"></div><div class="signature-label">Tanggal pemeriksaan</div></td>
            </tr>
        </table>

        <div class="notice"><b>Catatan penggunaan:</b> Laporan ini merupakan alat bantu skoring. Interpretasi hasil TJTA harus dilakukan oleh tenaga profesional yang kompeten dan mengacu pada manual serta norma yang berlaku. Dokumen tidak boleh digunakan sebagai satu-satunya dasar pengambilan keputusan pernikahan.</div>

        <div class="footer"><span>RAHASIA - Simpan dan bagikan secara terbatas</span><span class="right">Halaman 2 dari 2</span></div>
    </div>
</body>
</html>
