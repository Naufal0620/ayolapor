<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'AyoLapor' ?></title>
    <style>
        /* --- CSS LANDING PAGE --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: linear-gradient(0deg, rgba(48, 237, 240, 1) 0%, rgba(11, 70, 230, 1) 100%);
            overflow-x: hidden;
        }
        /* Navbar */
        .navbar {
            background: rgba(11, 70, 230, 0.9); backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); position: fixed;
            top: 0; left: 0; right: 0; z-index: 100;
        }
        .nav-container {
            max-width: 1200px; margin: 0 auto; display: flex;
            background: transparent; justify-content: space-between;
            align-items: center; padding: 15px 20px;
        }
        .logo {
            display: flex; align-items: center; gap: 10px; font-size: 24px;
            font-weight: bold; color: #fff; text-decoration: none;
        }
        .logo-icon {
            width: 40px; height: 40px; border: 1px solid #fff; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: bold; font-size: 20px;
        }
        .nav-links { display: flex; gap: 15px; align-items: center; }
        .nav-btn {
            padding: 10px 25px; font-size: 14px; font-weight: 600; border: none;
            border-radius: 6px; cursor: pointer; transition: all 0.3s ease;
            text-decoration: none;
        }
        .btn-masuk { background: transparent; color: #fff; border: 2px solid #fff; }
        .btn-masuk:hover { background: #fff; color: rgba(11, 70, 230, 1); transform: translateY(-2px); }
        .btn-daftar { background: #fff; color: rgba(11, 70, 230, 1); border: 2px solid #fff; }
        .btn-daftar:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(255,255,255,0.3); }
        
        /* Hero Section */
        .hero-section {
            display: flex; align-items: center; justify-content: space-between;
            max-width: 1200px; margin: 100px auto 0; padding: 60px 40px; gap: 60px;
        }
        .hero-content { flex: 1; max-width: 550px; }
        .hero-content h1 { font-size: 48px; color: white; line-height: 1.2; margin-bottom: 20px; font-weight: 700; }
        .hero-content p { font-size: 16px; color: rgba(255, 255, 255, 0.9); line-height: 1.6; margin-bottom: 30px; }
        
        .main-button {
            padding: 15px 35px; font-size: 16px; font-weight: 600;
            color: rgba(11, 70, 230, 1); background: white; border: none;
            border-radius: 30px; cursor: pointer; transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .main-button:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3); }

        /* Image Area */
        .hero-image { flex: 1; position: relative; display: flex; justify-content: center; }
        .placeholder-image {
            width: 400px; height: 400px; border-radius: 50%; overflow: hidden;
            border: 4px solid rgba(255,255,255,0.3); position: relative; z-index: 2;
        }
        .placeholder-image img { width: 100%; height: 100%; object-fit: cover; }
        
        /* Decorative Elements */
        .circle-1 {
            position: absolute; width: 120%; height: 120%;
            border: 2px dashed rgba(255, 255, 255, 0.2); border-radius: 50%;
            top: -10%; left: -10%; z-index: 1; animation: spin 20s linear infinite;
        }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        /* Popup */
        .overlay {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6); z-index: 999; backdrop-filter: blur(5px);
        }
        .overlay.active { display: block; }
        .popup {
            display: none; position: fixed; top: 50%; left: 50%;
            transform: translate(-50%, -50%) scale(0.9); background: white;
            padding: 40px; border-radius: 20px; box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            z-index: 1000; min-width: 350px; text-align: center;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .popup.active { display: block; transform: translate(-50%, -50%) scale(1); }
        .popup-buttons { display: flex; flex-direction: column; gap: 15px; margin-top: 20px; }
        .popup-btn { padding: 12px; border-radius: 10px; font-weight: bold; cursor: pointer; border: none; }
        .btn-login { background: rgba(11, 70, 230, 1); color: white; }
        .btn-register { background: white; border: 2px solid rgba(11, 70, 230, 1); color: rgba(11, 70, 230, 1); }
        .close-btn { position: absolute; top: 15px; right: 15px; font-size: 24px; cursor: pointer; border: none; background: none; }

        /* Mobile */
        .hamburger { display: none; cursor: pointer; flex-direction: column; gap: 5px; }
        .hamburger span { width: 25px; height: 3px; background: white; }
        
        @media (max-width: 768px) {
            .hero-section { flex-direction: column; text-align: center; margin-top: 50px; }
            .nav-links { display: none; } /* Simplifikasi mobile menu */
            .hamburger { display: flex; }
            .placeholder-image { width: 300px; height: 300px; margin-top: 30px; }
            .nav-links.active {
                display: flex; flex-direction: column; position: absolute;
                top: 70px; right: 20px; background: white; padding: 20px;
                border-radius: 10px; width: 200px;
            }
            .nav-btn { width: 100%; color: #333 !important; border-color: #333 !important; }
            .btn-masuk { background: #333 !important; color: white !important; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="<?= base_url() ?>" class="logo">
                <div class="logo-icon">!!!</div>
                <span>AyoLapor</span>
            </a>
            
            <div class="hamburger" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </div>
            
            <div class="nav-links" id="navLinks">
                <button class="nav-btn btn-masuk" onclick="goToLogin()">Masuk</button>
                <button class="nav-btn btn-daftar" onclick="goToRegister()">Daftar</button>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="hero-content">
            <h1>Layanan Pengaduan Jalan Rusak</h1>
            <p>Sampaikan laporan Anda dengan mudah dan cepat. Kami siap membantu memperbaiki kondisi jalan di kota Medan untuk kenyamanan bersama.</p>
            <button class="main-button" onclick="openPopup()">Laporkan Sekarang</button>
        </div>

        <div class="hero-image">
            <div class="placeholder-image">
               <img src="https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?q=80&w=1000&auto=format&fit=crop" alt="Hero Image">
            </div>
            <div class="circle-1"></div>
        </div>
    </section>

    <div class="overlay" id="overlay" onclick="closePopup()"></div>
    <div class="popup" id="popup">
        <button class="close-btn" onclick="closePopup()">&times;</button>
        <h2>Selamat Datang!</h2>
        <p style="color:#666; margin-bottom:10px;">Silakan masuk untuk mulai melapor</p>
        <div class="popup-buttons">
            <button class="popup-btn btn-login" onclick="goToLogin()">Sudah Punya Akun</button>
            <button class="popup-btn btn-register" onclick="goToRegister()">Belum Punya Akun</button>
        </div>
    </div>

    <script>
        function toggleMenu() {
            document.getElementById('navLinks').classList.toggle('active');
        }

        function openPopup() {
            document.getElementById('overlay').classList.add('active');
            document.getElementById('popup').classList.add('active');
        }

        function closePopup() {
            document.getElementById('overlay').classList.remove('active');
            document.getElementById('popup').classList.remove('active');
        }

        // --- FUNGSI NAVIGASI PENTING ---
        // Ini menghubungkan tombol beranda dengan Controller Auth (masuk.php)
        
        function goToLogin() {
            // Arahkan ke Auth, otomatis di tab Login
            window.location.href = '<?= base_url("auth") ?>';
        }

        function goToRegister() {
            // Arahkan ke Auth, trigger hash #registerForm untuk membuka tab Daftar
            window.location.href = '<?= base_url("auth#registerForm") ?>';
        }
    </script>
</body>
</html>