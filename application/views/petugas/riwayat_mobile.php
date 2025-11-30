<div class="row mb-3">
    <div class="col-12">
        <div class="input-group shadow-sm" style="border-radius: 12px; overflow: hidden; background: #fff;">
            <span class="input-group-text border-0 bg-white text-muted ps-3">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" id="searchInput" class="form-control border-0 py-2" placeholder="Cari lokasi jalan...">
        </div>
    </div>
</div>

<div class="row" id="listContainer">
    
    <?php if(empty($riwayat)): ?>
        <div class="col-12 text-center mt-5">
            <i class="fas fa-history fa-3x text-muted mb-3"></i>
            <p class="text-muted">Belum ada riwayat pekerjaan.</p>
        </div>
    <?php else: ?>

        <?php foreach($riwayat as $row): 
            // Kita encode data row menjadi JSON aman agar bisa dibaca JS
            $data_json = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
        ?>
        <div class="col-12 mb-3 item-riwayat">
            <div class="card border-0 shadow-sm p-2" 
                style="border-radius: 15px; cursor: pointer;"
                onclick="bukaDetail('<?= $data_json ?>')">
                
                <div class="d-flex align-items-center">
                    
                    <div style="width: 80px; height: 80px; flex-shrink: 0;">
                        <img src="<?= base_url($row->foto_bukti) ?>" 
                            class="w-100 h-100 rounded-3" 
                            style="object-fit: cover;"
                            alt="Bukti">
                    </div>

                    <div class="ms-3 flex-grow-1">
                        <h6 class="mb-1 fw-bold text-dark search-target">
                            <?= character_limiter($row->lokasi_text, 25) ?>
                        </h6>
                        
                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <small class="text-muted d-block" style="font-size: 11px;">
                                    <i class="far fa-calendar-check me-1"></i> Selesai:
                                </small>
                                <small class="fw-bold text-success" style="font-size: 12px;">
                                    <?= date('d M Y', strtotime($row->updated_at)) ?>
                                </small>
                            </div>
                            
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2">
                                <i class="fas fa-check-circle"></i> Selesai
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div style="height: 50px;"></div>

<div class="modal fade" id="modalDetailRiwayat" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Detail Pekerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <ul class="nav nav-pills nav-fill p-2 bg-light mx-3 rounded-3 mb-3" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active rounded-3 small fw-bold" id="tab-laporan" data-bs-toggle="pill" data-bs-target="#content-laporan" type="button">Sebelum</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link rounded-3 small fw-bold" id="tab-selesai" data-bs-toggle="pill" data-bs-target="#content-selesai" type="button">Sesudah</button>
                    </li>
                </ul>

                <div class="tab-content px-3 pb-3">
                    <div class="tab-pane fade show active" id="content-laporan">
                        <img id="detailFotoAwal" src="" class="w-100 rounded-3 mb-3 shadow-sm" style="height: 200px; object-fit: cover;">
                        
                        <div class="bg-light p-3 rounded-3 mb-2">
                            <label class="small text-muted fw-bold d-block">Pelapor:</label>
                            <span id="detailPelapor" class="fw-bold text-dark">User</span>
                        </div>

                        <label class="small text-muted fw-bold">Keterangan Kerusakan:</label>
                        <p id="detailKetAwal" class="small mb-0 text-dark"></p>
                    </div>
                    
                    <div class="tab-pane fade" id="content-selesai">
                        <img id="detailFotoSelesai" src="" class="w-100 rounded-3 mb-3 shadow-sm" style="height: 200px; object-fit: cover;">
                        
                        <div class="bg-success bg-opacity-10 p-3 rounded-3 mb-2 border border-success">
                            <label class="small text-success fw-bold d-block">Status:</label>
                            <span class="fw-bold text-success"><i class="fas fa-check-circle"></i> Selesai Dikerjakan</span>
                        </div>

                        <label class="small text-muted fw-bold">Laporan Pengerjaan Anda:</label>
                        <p id="detailKetAdmin" class="small mb-0 text-dark"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>