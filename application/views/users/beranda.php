<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AyoLaporr - Layanan Pengaduan Jalan Rusak</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: #30edf0;
            background: linear-gradient(0deg, rgba(48, 237, 240, 1) 0%, rgba(11, 70, 230, 1) 100%);
            overflow-x: hidden;
        }

        .navbar {
            background: rgba(11, 70, 230, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            background: rgba(11, 70, 230, 1);
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            border: 1px solid #fff;
            background: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }

        .nav-links {
            display: flex;
            gap: 15px;
            background: rgba(11, 70, 230, 1);
            align-items: center;
        }

        .nav-btn {
            padding: 10px 25px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            background: rgba(11, 70, 230, 1);
        }

        .btn-masuk {
            background: none;
            color: #fff;
            border: 2px solid #fff;
        }

        .btn-masuk:hover {
            background: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px #fff;
            color: rgba(11, 70, 230, 1);
        }

        .btn-daftar {
            background: none;
            color: white;
            border: 2px solid #fff;
        }

        .btn-daftar:hover {
            transform: translateY(-2px);
            background: #fff;
            color: rgba(11, 70, 230, 1);
            box-shadow: 0 4px 12px #fff;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 4px;
            cursor: pointer;
            padding: 5px;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: white;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        .hero-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 100px auto 0;
            padding: 60px 40px;
            gap: 60px;
        }

        .hero-content {
            flex: 1;
            max-width: 550px;
        }

        .hero-content h1 {
            font-size: 48px;
            color: white;
            line-height: 1.2;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .hero-content p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .cta-buttons {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .main-button {
            padding: 15px 35px;
            font-size: 16px;
            font-weight: 600;
            color: rgba(11, 70, 230, 1);
            background: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .main-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .secondary-info {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            font-size: 14px;
        }

        .phone-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .hero-links {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .hero-link-btn {
            padding: 12px 25px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-psychologist {
            background: white;
            color: rgba(11, 70, 230, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-psychologist:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-feedback {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .btn-feedback:hover {
            border-color: white;
            background: rgba(255, 255, 255, 0.3);
        }

        .hero-image {
            flex: 1;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-container {
            position: relative;
            width: 100%;
            max-width: 500px;
        }

        .main-image {
            width: 100%;
            height: auto;
            border-radius: 50%;
            position: relative;
            z-index: 2;
        }

        .decorative-circle {
            position: absolute;
            border-radius: 50%;
        }

        .circle-1 {
            width: 120%;
            height: 120%;
            border: 3px solid rgba(255, 255, 255, 0.2);
            top: -10%;
            left: -10%;
            z-index: 1;
        }

        .circle-2 {
            width: 60px;
            height: 60px;
            background: rgba(255, 234, 167, 0.8);
            top: 10%;
            right: -5%;
            z-index: 3;
        }

        .circle-3 {
            width: 40px;
            height: 40px;
            background: rgba(116, 185, 255, 0.8);
            bottom: 15%;
            left: -8%;
            z-index: 3;
        }

        .circle-4 {
            width: 50px;
            height: 50px;
            background: rgba(255, 118, 117, 0.8);
            top: 50%;
            right: -10%;
            z-index: 3;
        }

        .decorative-shape {
            position: absolute;
            z-index: 3;
        }

        .shape-1 {
            width: 80px;
            height: 80px;
            background: rgba(162, 155, 254, 0.8);
            border-radius: 20px;
            transform: rotate(15deg);
            bottom: -5%;
            right: 10%;
        }

        .shape-2 {
            width: 30px;
            height: 30px;
            border: 3px solid rgba(253, 121, 168, 0.8);
            border-radius: 50%;
            top: 5%;
            left: 5%;
        }

        .floating-element {
            position: absolute;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .placeholder-image {
            width: 100%;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            animation: fadeIn 0.3s ease;
        }

        .overlay.active {
            display: block;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.8);
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            min-width: 400px;
            animation: popupOpen 0.3s ease forwards;
        }

        .popup.active {
            display: block;
        }

        .popup-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .popup-header h2 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .popup-header p {
            color: #7f8c8d;
            font-size: 15px;
        }

        .popup-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .popup-btn {
            padding: 15px 30px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login {
            background: rgba(11, 70, 230, 1);
            color: white;
            box-shadow: 0 4px 15px rgba(11, 70, 230, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(11, 70, 230, 0.4);
        }

        .btn-register {
            background: white;
            color: rgba(11, 70, 230, 1);
            border: 2px solid rgba(11, 70, 230, 1);
        }

        .btn-register:hover {
            background: rgba(11, 70, 230, 1);
            color: white;
            transform: translateY(-3px);
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 28px;
            color: #bdc3c7;
            cursor: pointer;
            border: none;
            background: none;
            transition: color 0.3s ease;
        }

        .close-btn:hover {
            color: #2c3e50;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes popupOpen {
            to {
                transform: translate(-50%, -50%) scale(1);
            }
        }

        @media (max-width: 968px) {
            .hero-section {
                flex-direction: column;
                text-align: center;
                padding: 40px 20px;
            }

            .hero-content {
                max-width: 100%;
            }

            .hero-content h1 {
                font-size: 36px;
            }

            .cta-buttons {
                justify-content: center;
            }

            .hero-links {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                position: fixed;
                top: 70px;
                right: -100%;
                background: rgba(11, 70, 230, 1);
                backdrop-filter: blur(10px);
                flex-direction: column;
                width: 200px;
                padding: 20px;
                border-radius: 0 0 0 15px;
                box-shadow: -2px 2px 10px rgba(0, 0, 0, 0.1);
                transition: right 0.3s ease;
            }

            .nav-links.active {
                right: 0;
            }

            .hamburger {
                display: flex;
            }

            .nav-btn {
                width: 100%;
                text-align: center;
            }

            .popup {
                min-width: 90%;
                padding: 30px 20px;
            }

            .hero-content h1 {
                font-size: 32px;
            }

            .image-container {
                max-width: 350px;
            }
        }

        @media (max-width: 480px) {
            .nav-container {
                padding: 15px 20px;
            }

            .hero-content h1 {
                font-size: 28px;
            }

            .main-button {
                padding: 12px 25px;
                font-size: 14px;
            }

            .popup-header h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="<?php echo base_url('beranda'); ?>" class="logo">
                <div class="logo-icon">!!!</div>
                <span>LaporinJalanmu</span>
            </a>
            
            <div class="hamburger" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <div class="nav-links" id="navLinks">
                <button class="nav-btn btn-masuk" onclick="goToLogin()">Masuk</button>
                <button class="nav-btn btn-daftar" onclick="goToRegister()">Daftar</button>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="hero-content">
            <h1>Layanan pengaduan jalan rusak dikota medan.</h1>
            <p>Sampaikan laporan Anda dengan mudah dan cepat. Kami siap membantu memperbaiki kondisi jalan di kota Medan untuk kenyamanan bersama.</p>
            
            <div class="cta-buttons">
                <button class="main-button" onclick="openPopup()">Laporkan Sekarang</button>
            
            </div>

           
        </div>

        <div class="hero-image">
            <div class="image-container">
                <div class="placeholder-image">
                   <img src="https://chosen-silver-hsmu2c0dsg-yptijy79np.edgeone.dev/WhatsApp%20Image%202025-11-30%20at%2023.18.28_d4aae30f.jpg">
                </div>
                <div class="decorative-circle circle-1"></div>
                
            </div>
        </div>
    </section>

    <div class="overlay" id="overlay" onclick="closePopup()"></div>

    <div class="popup" id="popup">
        <button class="close-btn" onclick="closePopup()">&times;</button>
        <div class="popup-header">
            <h2>Selamat Datang!</h2>
            <p>Pilih opsi di bawah untuk melanjutkan</p>
        </div>
        <div class="popup-buttons">
            <button class="popup-btn btn-login" onclick="goToLogin()">
                Sudah Punya Akun
            </button>
            <button class="popup-btn btn-register" onclick="goToRegister()">
                Belum Punya Akun
            </button>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            const hamburger = document.querySelector('.hamburger');
            navLinks.classList.toggle('active');
            hamburger.classList.toggle('active');
        }

        function openPopup() {
            document.getElementById('overlay').classList.add('active');
            document.getElementById('popup').classList.add('active');
            document.getElementById('navLinks').classList.remove('active');
            document.querySelector('.hamburger').classList.remove('active');
        }

        function closePopup() {
            document.getElementById('overlay').classList.remove('active');
            document.getElementById('popup').classList.remove('active');
        }

        function goToLogin() {
            // Redirect ke auth (masuk.php) dengan hash #loginForm untuk menampilkan form login
            window.location.href = '<?php echo base_url("auth#loginForm"); ?>';
        }

        function goToRegister() {
            // Redirect ke auth (masuk.php) dengan hash #registerForm untuk menampilkan form register
            window.location.href = '<?php echo base_url("auth#registerForm"); ?>';
        }

        // Menutup popup dengan tombol ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePopup();
            }
        });

        // Menutup menu mobile saat klik di luar
        document.addEventListener('click', function(e) {
            const navLinks = document.getElementById('navLinks');
            const hamburger = document.querySelector('.hamburger');
            
            if (!e.target.closest('.nav-container')) {
                navLinks.classList.remove('active');
                hamburger.classList.remove('active');
            }
        });
    </script>
</body>
</html>