// File: assets/libjs/user/laporan_logic.js

var map, marker;
var selectedLat, selectedLng;

$(document).ready(function() {
    
    // --- 1. Navigation Logic (Switch Tabs) ---
    
    function showSection(sectionId) {
        $('.app-card').removeClass('active'); // Sembunyikan semua
        $(sectionId).addClass('active');      // Tampilkan yang dipilih
        
        // Fix Leaflet Map Render Issue (Maps sering error kalau di-load dalam elemen hidden)
        if(sectionId === '#section-form') {
            setTimeout(function() {
                if(!map) { initMap(); }
                else { map.invalidateSize(); }
            }, 200);
        }
    }

    // Event Listeners Navigasi
    $('#btnBuatLaporan').click(function() { showSection('#section-form'); });
    $('#btnLihatRiwayat, #navHistoryBtn').click(function() { 
        showSection('#section-riwayat'); 
        loadRiwayat(); // Load data saat buka tab
    });
    $('.btn-back').click(function() { showSection('#section-welcome'); });

    // --- 2. Image Preview Logic ---
    
    $('#triggerFile').click(function() { $('#photoInput').click(); });

    $('#photoInput').change(function() {
        const file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#previewImage').attr('src', event.target.result).show();
                $('#fileNameDisplay').text(file.name);
                $('.custom-file-upload').css('border-style', 'solid'); // Indikator visual
            }
            reader.readAsDataURL(file);
        }
    });

    // --- 3. Map & Geolocation Logic ---

    function initMap() {
        // Default: Pusat kota Medan (sesuaikan jika perlu)
        let defaultLoc = [3.5952, 98.6722]; 
        
        map = L.map('map').setView(defaultLoc, 13);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Event Klik Peta
        map.on('click', function(e) {
            setMarker(e.latlng.lat, e.latlng.lng);
        });
    }

    function setMarker(lat, lng) {
        if(marker) map.removeLayer(marker);
        marker = L.marker([lat, lng], {draggable: true}).addTo(map);
        
        // Update input hidden
        $('#inputLat').val(lat);
        $('#inputLng').val(lng);

        // Event jika marker digeser user
        marker.on('dragend', function(e) {
            let position = marker.getLatLng();
            $('#inputLat').val(position.lat);
            $('#inputLng').val(position.lng);
        });
    }

    // Tombol GPS
    $('#btnGps').click(function() {
        let btn = $(this);
        btn.html('<i class="fas fa-spinner animate-spin"></i> Mencari lokasi...');
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                let lat = position.coords.latitude;
                let lng = position.coords.longitude;
                
                map.setView([lat, lng], 17);
                setMarker(lat, lng);
                btn.html('<i class="fas fa-check"></i> Lokasi Ditemukan').removeClass('btn-success').addClass('btn-dark');
            }, function() {
                alert("Gagal mendapatkan lokasi GPS. Pastikan GPS aktif.");
                btn.html('<i class="fas fa-crosshairs"></i> Coba Lagi');
            });
        }
    });

    // --- 4. Submit Form Logic (AJAX) ---

    $('#formLaporan').on('submit', function(e) {
        e.preventDefault();

        // Validasi Manual JS
        if(!$('#inputLat').val()) {
            Swal.fire('Eits!', 'Silakan pilih lokasi jalan rusak di peta dulu ya.', 'warning');
            return;
        }

        // Tampilkan Loading
        Swal.fire({
            title: 'Mengirim Laporan...',
            html: 'Mohon tunggu sebentar.',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading() }
        });

        let formData = new FormData(this);

        $.ajax({
            url: BASE_URL + 'users/submit_laporan', // Sesuai Controller Tahap 1
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(response) {
                if(response.status) {
                    Swal.fire('Berhasil!', response.message, 'success').then(() => {
                        // Reset Form
                        $('#formLaporan')[0].reset();
                        $('#previewImage').hide();
                        $('#fileNameDisplay').text('Ketuk untuk ambil foto');
                        if(marker) map.removeLayer(marker);
                        
                        // Kembali ke menu utama
                        showSection('#section-welcome');
                    });
                } else {
                    Swal.fire('Gagal', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan jaringan.', 'error');
            }
        });
    });

    // --- 5. Load Riwayat Logic ---

    function loadRiwayat() {
        $.ajax({
            url: BASE_URL + 'users/riwayat_json',
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let html = '';
                
                if(data.length === 0) {
                    html = `
                        <div class="text-center py-5">
                            <img src="${BASE_URL}assets/dist/img/no-data.png" width="100" class="mb-3 opacity-50">
                            <p class="text-muted">Belum ada laporan.</p>
                        </div>`;
                } else {
                    $.each(data, function(i, item) {
                        // Badge Status Class
                        let badgeClass = 'status-pending';
                        let statusText = 'Menunggu';
                        
                        if(item.status === 'Proses') { badgeClass = 'status-proses'; statusText = 'Sedang Diperbaiki'; }
                        else if(item.status === 'Selesai') { badgeClass = 'status-selesai'; statusText = 'Selesai'; }
                        else if(item.status === 'Tolak') { badgeClass = 'status-tolak'; statusText = 'Ditolak'; }

                        html += `
                        <div class="history-item ${badgeClass}">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted">${formatDate(item.tgl_pengaduan)}</small>
                                <span class="badge bg-secondary">${statusText}</span>
                            </div>
                            <h6 class="fw-bold mb-1">${item.lokasi_text}</h6>
                            <p class="small text-muted mb-0 text-truncate">${item.keterangan_pengaduan}</p>
                        </div>`;
                    });
                }
                
                $('#riwayatListContainer').html(html);
            },
            error: function() {
                $('#riwayatListContainer').html('<p class="text-center text-danger">Gagal memuat data.</p>');
            }
        });
    }

    // Helper Date Format
    function formatDate(dateString) {
        let date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'});
    }

});