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

        <?php foreach($riwayat as $row): ?>
        <div class="col-12 mb-3 item-riwayat">
            <div class="card border-0 shadow-sm p-2" style="border-radius: 15px;">
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