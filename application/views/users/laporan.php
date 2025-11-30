<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'AyoLapor' ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/user_laporan.css') ?>">
</head>
<body>
    
    <nav class="navbar navbar-expand navbar-dark navbar-custom fixed-top">
        <div class="container-fluid justify-content-between">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="bg-white text-primary rounded px-2 py-1 fw-bold">!!!</div>
                <span class="brand-text">AyoLapor</span>
            </a>
            <div class="d-flex">
                <button class="btn btn-sm btn-outline-light me-2" id="navHistoryBtn">
                    <i class="fas fa-history"></i> Riwayat
                </button>
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-sm btn-light text-primary fw-bold" onclick="return confirm('Keluar dari aplikasi?');">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </nav>

    <div class="main-container" style="margin-top: 80px;">
        
        <div id="section-welcome" class="app-card active text-center">
            <div class="welcome-icon">🚧</div>
            <h3 class="fw-bold mb-2">Halo, <?= $user->nama_lengkap ?>!</h3>
            <p class="text-muted mb-4">Yuk bantu kota kita dengan melaporkan jalan rusak di sekitarmu.</p>
            
            <button class="btn btn-main-action btn-primary-custom" id="btnBuatLaporan">
                <i class="fas fa-camera me-2"></i> Buat Laporan Baru
            </button>
            <button class="btn btn-main-action btn-outline-custom" id="btnLihatRiwayat">
                <i class="fas fa-list me-2"></i> Riwayat Laporan Saya
            </button>
        </div>

        <div id="section-form" class="app-card">
            <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                <button class="btn btn-sm btn-light rounded-circle me-2 btn-back">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h5 class="m-0 fw-bold">Formulir Pengaduan</h5>
            </div>

            <form id="formLaporan" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Foto Bukti <span class="text-danger">*</span></label>
                    <div class="custom-file-upload" id="triggerFile">
                        <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                        <p class="m-0 text-muted small" id="fileNameDisplay">Ketuk untuk ambil foto</p>
                    </div>
                    <input type="file" name="photo" id="photoInput" accept="image/*" hidden required>
                    <img id="previewImage" src="" alt="Preview">
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi (Peta) <span class="text-danger">*</span></label>
                    <div id="map"></div>
                    <button type="button" class="btn btn-sm btn-success w-100 mt-2" id="btnGps">
                        <i class="fas fa-crosshairs me-1"></i> Ambil Lokasi Saya Sekarang
                    </button>
                    <small class="text-muted d-block mt-1">Geser marker merah ke titik jalan rusak.</small>
                    
                    <input type="hidden" name="latitude" id="inputLat">
                    <input type="hidden" name="longitude" id="inputLng">
                </div>

                <div class="mb-3">
                    <label class="form-label">Detail Alamat <span class="text-danger">*</span></label>
                    <input type="text" name="lokasi_text" class="form-control" placeholder="Cth: Jl. Sudirman No. 45, depan Alfamart" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan Kerusakan</label>
                    <textarea name="keterangan_pengaduan" class="form-control" rows="3" placeholder="Jelaskan kondisi lubang (dalam/lebar)..." required></textarea>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">
                        <i class="fas fa-paper-plane me-2"></i> KIRIM LAPORAN
                    </button>
                </div>
            </form>
        </div>

        <div id="section-riwayat" class="app-card">
            <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                <button class="btn btn-sm btn-light rounded-circle me-2 btn-back">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h5 class="m-0 fw-bold">Riwayat Laporan</h5>
            </div>
            
            <div id="riwayatListContainer">
                <div class="text-center py-5 text-muted">
                    <div class="spinner-border text-primary mb-2" role="status"></div>
                    <p>Memuat data...</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetailRiwayat" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Detail Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <ul class="nav nav-pills nav-fill p-2 bg-light mx-3 rounded-3 mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active rounded-3 small fw-bold" id="tab-laporan" data-bs-toggle="pill" data-bs-target="#content-laporan" type="button">Laporan Anda</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link rounded-3 small fw-bold" id="tab-selesai" data-bs-toggle="pill" data-bs-target="#content-selesai" type="button" disabled>Bukti Selesai</button>
                        </li>
                    </ul>

                    <div class="tab-content px-3 pb-3">
                        <div class="tab-pane fade show active" id="content-laporan">
                            <img id="detailFotoAwal" src="" class="w-100 rounded-3 mb-3 shadow-sm" style="height: 200px; object-fit: cover;">
                            <label class="small text-muted fw-bold">Keterangan Anda:</label>
                            <p id="detailKetAwal" class="small mb-0"></p>
                        </div>
                        
                        <div class="tab-pane fade" id="content-selesai">
                            <img id="detailFotoSelesai" src="" class="w-100 rounded-3 mb-3 shadow-sm" style="height: 200px; object-fit: cover;">
                            <label class="small text-muted fw-bold">Tanggapan Petugas:</label>
                            <p id="detailKetAdmin" class="small mb-0"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light rounded-bottom-4">
                    <span id="detailStatusBadge" class="badge bg-secondary p-2">Status</span>
                    <small class="text-muted ms-auto" id="detailTanggal">-</small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        const BASE_URL = "<?= base_url() ?>";
    </script>
    
    <script src="<?= base_url('assets/libjs/users/laporan_logic.js?v=' . time()) ?>"></script>

</body>
</html>