<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login/Signup - AyoLaporr</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    text-decoration: none;
    list-style: none;
}

body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #30edf0;
background: linear-gradient(0deg, rgba(48, 237, 240, 1) 0%, rgba(11, 70, 230, 1) 100%);
}

.container{
    position: relative;
    width: 850px;
    height: 550px;
    background: #fff;
    margin: 20px;
    border-radius: 30px;
    box-shadow: 0 0 30px rgba(0, 0, 0, .2);
    overflow: hidden;
}

.container h1{
  font-size: 36px;
  margin: -10px 0;
  }

.container p{
  font-size: 14.5px;
  margin: 15px 0;
  }

form{ width: 100%; }

.form-box{
    position: absolute;
    right: 0;
    width: 50%;
    height: 100%;
    background: #fff;
    display: flex;
    align-items: center;
    color: #333;
    text-align: center;
    padding: 40px;
    z-index: 1;
    transition: .6s ease-in-out 1.2s, visibility 0s 1s;
}

  .container.active .form-box{ right: 50%; }

  .form-box.register{ visibility: hidden; }
  .container.active .form-box.register{ visibility: visible; }

.input-box{
    position: relative;
    margin: 30px 0;
}

.input-box input{
    width: 100%;
    padding: 13px 50px 13px 20px;
    background: #eee;
    border-radius: 8px;
    border: none;
    outline: none;
    font-size: 16px;
    color: #333;
    font-weight: 500;
    }

.input-box input::placeholder{
  color: #888;
  font-weight: 400;
}
    
.input-box i{
  position: absolute;
  right: 20px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 20px;
    }

.forgot-link{ margin: -15px 0 15px; }
    .forgot-link a{
        font-size: 14.5px;
        color: #333;
    }

.btn{
    width: 100%;
    height: 48px;
    background: #0B46E6;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    border: none;
    cursor: pointer;
    font-size: 16px;
    color: #fff;
    font-weight: 600;
}

.social-icons{
    display: flex;
    justify-content: center;
}

.social-icons a{
  display: inline-flex;
  padding: 10px;
  border: 2px solid #ccc;
  border-radius: 8px;
  font-size: 24px;
  color: #333;
  margin: 0 8px;
      }

.toggle-box{
    position: absolute;
    width: 100%;
    height: 100%;
}

 .toggle-box::before{
    content: '';
    position: absolute;
    left: -250%;
    width: 300%;
    height: 100%;
    background: linear-gradient(0deg, rgba(48, 237, 240, 1) 0%, rgba(11, 70, 230, 1) 100%);
    border-radius: 150px;
    z-index: 2;
    transition: 1.8s ease-in-out;
   }

        .container.active .toggle-box::before{ left: 50%; }

.toggle-panel{
    position: absolute;
    width: 50%;
    height: 100%;
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    z-index: 2;
    transition: .6s ease-in-out;
}

    .toggle-panel.toggle-left{ 
        left: 0;
        transition-delay: 1.2s; 
    }
        .container.active .toggle-panel.toggle-left{
            left: -50%;
            transition-delay: .6s;
        }

    .toggle-panel.toggle-right{ 
        right: -50%;
        transition-delay: .6s;
    }
        .container.active .toggle-panel.toggle-right{
            right: 0;
            transition-delay: 1.2s;
        }

    .toggle-panel p{ margin-bottom: 20px; }

    .toggle-panel .btn{
        width: 160px;
        height: 46px;
        background: transparent;
        border: 2px solid #fff;
        box-shadow: none;
    }

@media screen and (max-width: 650px){
    .container{ height: calc(100vh - 40px); }

    .form-box{
        bottom: 0;
        width: 100%;
        height: 70%;
    }

        .container.active .form-box{
            right: 0;
            bottom: 30%;
        }

    .toggle-box::before{
        left: 0;
        top: -270%;
        width: 100%;
        height: 300%;
        border-radius: 20vw;
    }

        .container.active .toggle-box::before{
            left: 0;
            top: 70%;
        }

        .container.active .toggle-panel.toggle-left{
            left: 0;
            top: -30%;
        }

    .toggle-panel{ 
        width: 100%;
        height: 30%;
    }
        .toggle-panel.toggle-left{ top: 0; }
        .toggle-panel.toggle-right{
            right: 0;
            bottom: -30%;
        }

            .container.active .toggle-panel.toggle-right{ bottom: 0; }
}

@media screen and (max-width: 400px){
    .form-box { padding: 20px; }

    .toggle-panel h1{font-size: 30px; }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loading-overlay {
    display: none !important;
}

.loading-overlay.show {
    display: flex !important;
}

.message.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.message.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
</style>
</head>
<body>
    <div class="container">
        <!-- FORM LOGIN -->
        <div class="form-box login">
            <form id="loginForm">
                <h1>Masuk</h1>
                <div class="input-box">
                    <input type="email" name="email" id="loginEmail" placeholder="Masukkan Email Anda" required />
                    <i class="bx bxs-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="loginPassword" placeholder="Masukkan Password Anda" required />
                    <i class="bx bxs-lock-alt"></i>
                </div>
                
                <button type="submit" class="btn" id="loginBtn">Login</button>
                
                <div class="message" id="loginMessage" style="display: none; margin-top: 15px; padding: 10px; border-radius: 5px; text-align: center;"></div>
            </form>
        </div>

        <!-- FORM REGISTER -->
        <div class="form-box register">
            <form id="registerForm">
                <h1>Pendaftaran</h1>
                <div class="input-box">
                    <input type="text" name="nama_lengkap" id="registerNama" placeholder="Nama Lengkap" required />
                    <i class="bx bxs-user"></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" id="registerEmail" placeholder="Email" required />
                    <i class="bx bxs-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="tel" name="no_telp" id="registerTelp" placeholder="No. Telepon (08xxxxxxxxxx)" required />
                    <i class="bx bxs-phone"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="registerPassword" placeholder="Password (Min. 6 karakter)" required />
                    <i class="bx bxs-lock-alt"></i>
                </div>
                <button type="submit" class="btn" id="registerBtn">Daftar</button>
                
                <div class="message" id="registerMessage" style="display: none; margin-top: 15px; padding: 10px; border-radius: 5px; text-align: center;"></div>
            </form>
        </div>

        <!-- TOGGLE BOX -->
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

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
        <div style="background: white; padding: 30px; border-radius: 10px; text-align: center;">
            <div class="spinner" style="border: 4px solid #f3f3f3; border-top: 4px solid #667eea; border-radius: 50%; width: 50px; height: 50px; animation: spin 1s linear infinite; margin: 0 auto 15px;"></div>
            <p>Memproses...</p>
        </div>
    </div>

    <script>
        const container = document.querySelector('.container');
        const registerBtn = document.querySelector('.register-btn');
        const loginBtn = document.querySelector('.login-btn');

        // Toggle antara form login dan register
        registerBtn.addEventListener('click', () => {
            container.classList.add('active');
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove('active');
        });

        // Mengecek hash URL saat halaman dimuat
        function checkHash() {
            const hash = window.location.hash;
            const container = document.querySelector('.container');

            if (hash === '#registerForm') {
                container.classList.add('active'); // Tampilkan form register
            } else {
                container.classList.remove('active'); // Tampilkan form login
            }
        }

        // Panggil checkHash saat halaman dimuat
        window.addEventListener('load', checkHash);

        // AJAX untuk REGISTER FORM
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const loadingOverlay = document.getElementById('loadingOverlay');
            const messageDiv = document.getElementById('registerMessage');
            
            // Tampilkan loading
            loadingOverlay.classList.add('show');
            messageDiv.style.display = 'none';
            
            // Ambil data form
            const formData = new FormData(this);
            
            // Kirim data via AJAX ke controller Auth/register
            fetch('<?php echo base_url("auth/register"); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Sembunyikan loading
                loadingOverlay.classList.remove('show');
                
                // Tampilkan pesan
                messageDiv.style.display = 'block';
                messageDiv.textContent = data.message;
                
                if (data.success) {
                    messageDiv.classList.remove('error');
                    messageDiv.classList.add('success');
                    
                    // Reset form
                    document.getElementById('registerForm').reset();
                    
                    // Redirect ke login form setelah 2 detik
                    setTimeout(() => {
                        container.classList.remove('active');
                        messageDiv.style.display = 'none';
                    }, 2000);
                } else {
                    messageDiv.classList.remove('success');
                    messageDiv.classList.add('error');
                }
            })
            .catch(error => {
                loadingOverlay.classList.remove('show');
                messageDiv.style.display = 'block';
                messageDiv.classList.remove('success');
                messageDiv.classList.add('error');
                messageDiv.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
            });
        });

        // AJAX untuk LOGIN FORM
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const loadingOverlay = document.getElementById('loadingOverlay');
            const messageDiv = document.getElementById('loginMessage');
            
            // Tampilkan loading
            loadingOverlay.classList.add('show');
            messageDiv.style.display = 'none';
            
            // Ambil data form
            const formData = new FormData(this);
            
            // Kirim data via AJAX ke controller Auth/login
            fetch('<?php echo base_url("auth/login"); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Sembunyikan loading
                loadingOverlay.classList.remove('show');
                
                // Tampilkan pesan
                messageDiv.style.display = 'block';
                messageDiv.textContent = data.message;
                
                if (data.success) {
                    messageDiv.classList.remove('error');
                    messageDiv.classList.add('success');
                    
                    // Redirect ke app.php setelah 1 detik
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    messageDiv.classList.remove('success');
                    messageDiv.classList.add('error');
                }
            })
            .catch(error => {
                loadingOverlay.classList.remove('show');
                messageDiv.style.display = 'block';
                messageDiv.classList.remove('success');
                messageDiv.classList.add('error');
                messageDiv.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
            });
        });
    </script>
</body>
</html>