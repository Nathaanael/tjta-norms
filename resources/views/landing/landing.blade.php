<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <title>Home</title>
</head>
<body>
    <!-- NAVBAR -->
    <div class="container-navbar" id="navbar">
        <nav>
            <div class="icon">
                <img src="logounika2.png" alt="Logo">
            </div>
        
            <div class="navbar-container">
                <ul class="ul-navbar">
                    <li class="li-navbar"><a href="" class="a-navbar">About Us</a></li>
                    <li class="li-navbar"><a href="" class="a-navbar">Team</a></li>
                    <li class="li-navbar"><a href="" class="a-navbar">Pendaftaran</a></li>
                </ul>
            </div>
            <div class="home">
                <img src="{{ asset('images/SCUIC.png') }}" alt="">
            </div>
        </nav>
    </div>
    <!-- NAVBAR END -->

    <!-- BANNER -->
    <div class="banner">
        <img src="{{ asset('images/6.jpg') }}" alt="">
        <img src="{{ asset('images/6.jpg') }}" alt="">
        <img src="{{ asset('images/8.jpg') }}" alt="">
    </div>
    <!-- BANNER END -->

    <!-- ISI -->
    <div class="dashboard">
        <div class="box" onclick="navigateTo('{{ route('users.create') }}')">
            <h2>Pendaftaran Nama</h2>
            <img src="longitude.png" alt="Longitude Image">
        </div>
        <div class="box" onclick="navigateTo('{{ route('users.choose') }}')">
            <h2>Pemilihan Nama</h2>
            <img src="latitude.png" alt="Latitude Image">
        </div>
    </div>
    <!-- ISI END -->

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <img src="logo3.png" alt="Logo UNIKA">
                <address>
                    <p>Jl. Pawiyatan Luhur IV No.1, Bendan Duwur,</p>
                    <p>Kec. Gajahmungkur, Kota Semarang, Jawa Tengah 50234</p>
                </address>
            </div>
            <div class="footer-section">
                <img src="logo3.png" alt="Logo UNIKA">
                <address>
                    <p>Jl. Rm. Hadisoebeno Sosro Wardoyo,</p>
                    <p>Jatibarang, Kec. Mijen, Kota Semarang, Jawa Tengah</p>
                </address>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="{{ route('users.create') }}">Pendaftaran Nama</a></li>
                    <li><a href="{{ route('users.choose') }}">Pemilihan Nama</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->

    <script>
        document.getElementById('button-lonceng').addEventListener('click', function() {
            // Ganti URL dengan route atau alamat yang sesuai
            window.location.href = "";
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            const elementsToAnimate = document.querySelectorAll('.scroll-animate');
            elementsToAnimate.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentImageIndex = 0;
            const images = document.querySelectorAll('.banner img');
            const totalImages = images.length;

            function showNextImage() {
                images[currentImageIndex].classList.remove('active');
                currentImageIndex = (currentImageIndex + 1) % totalImages;
                images[currentImageIndex].classList.add('active');
            }

            // Tampilkan gambar pertama saat memulai
            images[currentImageIndex].classList.add('active');

            setInterval(showNextImage, 1000); // Ganti gambar setiap 3 detik
        });

        function navigateTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
