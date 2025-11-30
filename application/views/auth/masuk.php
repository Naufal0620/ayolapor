<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?></title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/auth_user.css') ?>">
</head>
<body>
    <div class="container">
        <div class="form-box login">
            <form id="loginForm">
                <h1>Masuk</h1>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Masukkan Email Anda" required />
                    <i class="bx bxs-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Masukkan Password Anda" required />
                    <i class="bx bxs-lock-alt"></i>
                </div>
                
                <button type="submit" class="btn" id="loginBtn">Login</button>
            </form>
        </div>

        <div class="form-box register">
            <form id="registerForm">
                <h1>Pendaftaran</h1>
                <div class="input-box">
                    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required />
                    <i class="bx bxs-user"></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required />
                    <i class="bx bxs-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="tel" name="no_telp" placeholder="No. Telepon" required />
                    <i class="bx bxs-phone"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password (Min. 6 karakter)" required />
                    <i class="bx bxs-lock-alt"></i>
                </div>
                <button type="submit" class="btn" id="registerBtn">Daftar</button>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Halo, Selamat Datang</h1>
                <p>Belum Punya Akun? Ayo Daftar</p>
                <button class="btn register-btn">Daftar</button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Halo, Selamat Datang</h1>
                <p>Sudah Punya Akun? Ayo Masuk</p>
                <button class="btn login-btn">Masuk</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>const BASE_URL = '<?= base_url() ?>';</script>
    <script src="<?= base_url('assets/libjs/auth/user_auth.js') ?>"></script>
</body>
</html>