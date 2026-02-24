<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor.in - Sistem Pengaduan Sarana Sekolah</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            padding: 15px 0;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-nav img {
            height: 50px;
            width: auto;
        }

        .logo-nav span {
            font-size: 24px;
            font-weight: 700;
            color: #2d5a7b;
        }

        .nav-menu {
            display: flex;
            gap: 30px;
            list-style: none;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-menu a:hover {
            color: #4fb3bf;
        }

        .btn-login {
            background: linear-gradient(135deg, #4fb3bf 0%, #2d5a7b 100%);
            color: white !important;
            padding: 10px 25px;
            border-radius: 25px;
            transition: transform 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #4fb3bf 0%, #2d5a7b 100%);
            padding: 150px 30px 100px;
            color: white;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 40px;
            opacity: 0.95;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: white;
            color: #4fb3bf;
            padding: 15px 40px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            padding: 15px 40px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            border: 2px solid white;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: white;
            color: #4fb3bf;
        }

        /* Features Section */
        .features {
            padding: 80px 30px;
            background: #f8f9fa;
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 36px;
            color: #2d5a7b;
            margin-bottom: 15px;
        }

        .section-title p {
            font-size: 18px;
            color: #666;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }

        .feature-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(79, 179, 191, 0.2);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4fb3bf 0%, #2d5a7b 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 36px;
        }

        .feature-card h3 {
            font-size: 24px;
            color: #2d5a7b;
            margin-bottom: 15px;
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
        }

        /* How It Works Section */
        .how-it-works {
            padding: 80px 30px;
            background: white;
        }

        .steps-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .step {
            text-align: center;
            padding: 30px;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4fb3bf 0%, #2d5a7b 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 700;
            margin: 0 auto 20px;
        }

        .step h3 {
            font-size: 20px;
            color: #2d5a7b;
            margin-bottom: 10px;
        }

        .step p {
            color: #666;
            line-height: 1.6;
        }

        /* Stats Section */
        .stats {
            background: linear-gradient(135deg, #4fb3bf 0%, #2d5a7b 100%);
            padding: 60px 30px;
            color: white;
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            text-align: center;
        }

        .stat-item h3 {
            font-size: 48px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .stat-item p {
            font-size: 18px;
            opacity: 0.9;
        }

        /* CTA Section */
        .cta {
            padding: 80px 30px;
            background: #f8f9fa;
            text-align: center;
        }

        .cta-content {
            max-width: 700px;
            margin: 0 auto;
        }

        .cta h2 {
            font-size: 36px;
            color: #2d5a7b;
            margin-bottom: 20px;
        }

        .cta p {
            font-size: 18px;
            color: #666;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        /* Footer */
        .footer {
            background: #2d5a7b;
            color: white;
            padding: 60px 30px 30px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 30px;
        }

        .footer-section h3 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .footer-section p,
        .footer-section ul {
            font-size: 14px;
            line-height: 1.8;
            opacity: 0.9;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .footer-section a:hover {
            opacity: 0.7;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .menu-toggle span {
            width: 25px;
            height: 3px;
            background: #2d5a7b;
            margin: 3px 0;
            transition: 0.3s;
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
                position: absolute;
                top: 80px;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 20px;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            }

            .nav-menu.active {
                display: flex;
            }

            .menu-toggle {
                display: flex;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero p {
                font-size: 16px;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .section-title h2 {
                font-size: 28px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .steps-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo-nav">
                <span>Lapor.in</span>
            </div>
            <div class="menu-toggle" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-menu" id="navMenu">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#features">Fitur</a></li>
                <li><a href="#how-it-works">Cara Kerja</a></li>
                <li><a href="#contact">Kontak</a></li>
                <li><a href="{{ route('login') }}" class="btn-login">Masuk</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Sampaikan Aspirasi Anda dengan Mudah</h1>
            <p>Platform pengaduan sarana dan prasarana sekolah yang efektif dan efisien. Bantu wujudkan lingkungan belajar yang lebih baik untuk semua.</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn-primary">Mulai Lapor</a>
                <a href="#how-it-works" class="btn-secondary">Pelajari Lebih Lanjut</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="features-container">
            <div class="section-title">
                <h2>Fitur Unggulan</h2>
                <p>Kemudahan dalam menyampaikan dan mengelola pengaduan</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📝</div>
                    <h3>Mudah Digunakan</h3>
                    <p>Interface yang sederhana dan intuitif memudahkan siswa untuk menyampaikan pengaduan dengan cepat.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔔</div>
                    <h3>Notifikasi Real-time</h3>
                    <p>Dapatkan update langsung tentang status pengaduan Anda melalui sistem notifikasi terintegrasi.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Tracking Status</h3>
                    <p>Pantau perkembangan pengaduan Anda dari mulai pengajuan hingga penyelesaian.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💬</div>
                    <h3>Umpan Balik</h3>
                    <p>Terima tanggapan dan umpan balik dari admin untuk setiap pengaduan yang disampaikan.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Responsive Design</h3>
                    <p>Akses dari berbagai perangkat, kapan saja dan dimana saja dengan tampilan yang optimal.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Aman & Terpercaya</h3>
                    <p>Data pengaduan Anda terjaga keamanannya dengan sistem enkripsi yang handal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works" id="how-it-works">
        <div class="steps-container">
            <div class="section-title">
                <h2>Cara Kerja</h2>
                <p>Proses pengaduan yang sederhana dan transparan</p>
            </div>
            <div class="steps-grid">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Login ke Sistem</h3>
                    <p>Masuk menggunakan NIS untuk siswa atau akun admin untuk mengakses sistem pengaduan.</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Buat Pengaduan</h3>
                    <p>Isi form pengaduan dengan detail masalah sarana yang ditemukan.</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Pantau Status</h3>
                    <p>Lihat status pengaduan Anda dan tunggu respon dari admin sekolah.</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Terima Umpan Balik</h3>
                    <p>Dapatkan informasi tindak lanjut dan hasil penyelesaian pengaduan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-container">
            <div class="stat-item">
                <h3>500+</h3>
                <p>Pengaduan Terselesaikan</p>
            </div>
            <div class="stat-item">
                <h3>95%</h3>
                <p>Tingkat Kepuasan</p>
            </div>
            <div class="stat-item">
                <h3>1000+</h3>
                <p>Pengguna Aktif</p>
            </div>
            <div class="stat-item">
                <h3>24/7</h3>
                <p>Layanan Tersedia</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="cta-content">
            <h2>Siap Menyampaikan Aspirasi Anda?</h2>
            <p>Bergabunglah dengan ribuan siswa lain yang telah mempercayai Lapor.in untuk mewujudkan lingkungan sekolah yang lebih baik.</p>
            <a href="{{ route('login') }}" class="btn-primary">Masuk Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Lapor.in</h3>
                <p>Platform pengaduan sarana dan prasarana sekolah yang efektif dan efisien.</p>
            </div>
            <div class="footer-section">
                <h3>Menu</h3>
                <ul>
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#features">Fitur</a></li>
                    <li><a href="#how-it-works">Cara Kerja</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Bantuan</h3>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Panduan Penggunaan</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Kontak</h3>
                <ul>
                    <li>Email: info@laporin.sch.id</li>
                    <li>Telp: (021) 1234-5678</li>
                    <li>Alamat: Jakarta, Indonesia</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Lapor.in. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('active');
        }

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const navMenu = document.getElementById('navMenu');
            const menuToggle = document.querySelector('.menu-toggle');
            
            if (!navMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                navMenu.classList.remove('active');
            }
        });
    </script>
</body>
</html>