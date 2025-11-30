$(document).ready(function() {
    
    // Toggle Login/Register Animation
    const container = $('.container');
    $('.register-btn').click(() => container.addClass('active'));
    $('.login-btn').click(() => container.removeClass('active'));

    // Hash Checker (jika url ada #registerForm)
    if(window.location.hash === '#registerForm') {
        container.addClass('active');
    }

    // --- PROSES LOGIN ---
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        
        // UI Loading
        let btn = $('#loginBtn');
        let originalText = btn.text();
        btn.prop('disabled', true).text('Memproses...');
        
        $.ajax({
            url: BASE_URL + 'auth/process_login',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function(res) {
                if(res.status) {
                    Swal.fire({
                        icon: 'success', title: 'Berhasil', text: res.message,
                        timer: 1500, showConfirmButton: false
                    }).then(() => { window.location.href = res.redirect; });
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            },
            error: function() { Swal.fire('Error', 'Terjadi kesalahan server.', 'error'); },
            complete: function() { btn.prop('disabled', false).text(originalText); }
        });
    });

    // --- PROSES REGISTER ---
    $('#registerForm').submit(function(e) {
        e.preventDefault();

        let btn = $('#registerBtn');
        let originalText = btn.text();
        btn.prop('disabled', true).text('Mendaftar...');

        $.ajax({
            url: BASE_URL + 'auth/process_register',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function(res) {
                if(res.status) {
                    Swal.fire('Berhasil', res.message, 'success').then(() => {
                        // Pindah ke panel login otomatis
                        container.removeClass('active');
                        $('#registerForm')[0].reset();
                    });
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            },
            error: function() { Swal.fire('Error', 'Terjadi kesalahan server.', 'error'); },
            complete: function() { btn.prop('disabled', false).text(originalText); }
        });
    });
});