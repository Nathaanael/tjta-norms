<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#173f3a">
    <title>@yield('title', 'TJTA Pernikahan') · Pusat Asesmen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Newsreader:opsz,wght@6..72,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('head')
</head>
<body class="@yield('body-class')">
    <header class="site-header">
        <div class="shell header-inner">
            <a class="brand" href="{{ route('landing') }}" aria-label="TJTA Pernikahan - Beranda">
                <span class="brand-mark" aria-hidden="true">
                    <svg viewBox="0 0 32 32" fill="none"><path d="M9 9.5h14M16 6v20M10.5 14c0 3.1-1.8 5-4.5 5 0-2.6 1.8-5 4.5-5Zm11 0c0 3.1 1.8 5 4.5 5 0-2.6-1.8-5-4.5-5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M11 26h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </span>
                <span><strong>TJTA</strong><small>Asesmen Pernikahan</small></span>
            </a>

            <nav class="main-nav" aria-label="Navigasi utama">
                <a class="{{ request()->routeIs('landing') ? 'active' : '' }}" href="{{ route('landing') }}">Beranda</a>
                <a class="{{ request()->routeIs('users.choose') || request()->routeIs('input.*') ? 'active' : '' }}" href="{{ route('users.choose') }}">Daftar peserta</a>
                <a class="btn btn-sm btn-primary" href="{{ route('users.create') }}">
                    <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Tambah peserta
                </a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="shell footer-inner">
            <div>
                <strong>TJTA Asesmen Pernikahan</strong>
                <p>Alat bantu skoring profil temperamen untuk asesmen relasi dan pernikahan.</p>
            </div>
            <p class="footer-note">Hasil digunakan oleh tenaga profesional sebagai bahan memahami dinamika individu dan pasangan, bukan sebagai penentu tunggal keputusan pernikahan.</p>
        </div>
    </footer>
    <div class="download-toast" id="download-toast" role="status" aria-live="polite"></div>
    <script>
        (() => {
            const toast = document.getElementById('download-toast');
            let toastTimer;

            function showToast(message, type = 'success') {
                clearTimeout(toastTimer);
                toast.textContent = message;
                toast.className = `download-toast show ${type}`;
                toastTimer = setTimeout(() => {
                    toast.classList.remove('show');
                }, 3500);
            }

            function filenameFromResponse(response) {
                const disposition = response.headers.get('Content-Disposition') || '';
                const encoded = disposition.match(/filename\*=UTF-8''([^;]+)/i);
                const regular = disposition.match(/filename="?([^";]+)"?/i);

                if (encoded) return decodeURIComponent(encoded[1]);
                if (regular) return regular[1];
                return 'laporan-tjta.pdf';
            }

            document.addEventListener('click', async (event) => {
                const button = event.target.closest('.js-pdf-download');
                if (!button) return;

                event.preventDefault();
                if (button.classList.contains('is-loading')) return;

                const originalHtml = button.innerHTML;
                button.classList.add('is-loading');
                button.setAttribute('aria-busy', 'true');
                button.setAttribute('aria-disabled', 'true');
                if (button.classList.contains('btn')) {
                    button.innerHTML = '<span class="ajax-spinner" aria-hidden="true"></span><span>Menyiapkan PDF...</span>';
                }

                try {
                    const response = await fetch(button.href, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/pdf',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        credentials: 'same-origin'
                    });

                    if (!response.ok) {
                        throw new Error(`Gagal membuat laporan (${response.status})`);
                    }

                    const contentType = response.headers.get('Content-Type') || '';
                    if (!contentType.includes('application/pdf')) {
                        throw new Error('Respons laporan bukan berkas PDF.');
                    }

                    const blob = await response.blob();
                    const objectUrl = URL.createObjectURL(blob);
                    const downloadLink = document.createElement('a');
                    downloadLink.href = objectUrl;
                    downloadLink.download = filenameFromResponse(response);
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    downloadLink.remove();
                    setTimeout(() => URL.revokeObjectURL(objectUrl), 1000);

                    showToast('Laporan PDF berhasil diunduh.');
                } catch (error) {
                    console.error(error);
                    showToast('Laporan PDF gagal diunduh. Silakan coba kembali.', 'error');
                } finally {
                    button.innerHTML = originalHtml;
                    button.classList.remove('is-loading');
                    button.removeAttribute('aria-busy');
                    button.removeAttribute('aria-disabled');
                }
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
