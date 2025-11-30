<div class="row">
    <?php if(empty($tugas)): ?>
        <div class="col-12 text-center" style="margin-top: 30vh;">
            <img src="<?= base_url('assets/dist/img/no-data.png') ?>" width="150" class="mb-3">
            <h6 class="text-muted">Hore! Tidak ada jalan rusak.</h6>
        </div>
    <?php else: ?>
        
        <?php foreach($tugas as $row): ?>
        <div class="col-12">
            <a href="<?= base_url('petugas/detail/'.$row->id_pengaduan) ?>" class="text-decoration-none text-dark">
                <div class="task-card">
                    <div class="task-img-box">
                        <img src="<?= base_url($row->foto_bukti) ?>" alt="Jalan Rusak">
                        <span class="status-badge">PERLU PERBAIKAN</span>
                    </div>
                    <div class="p-3">
                        <h6 class="mb-1 fw-bold"><?= character_limiter($row->lokasi_text, 30) ?></h6>
                        <small class="text-muted">
                            <i class="far fa-clock me-1"></i> <?= date('d M Y, H:i', strtotime($row->tgl_pengaduan)) ?>
                        </small>
                        <p class="mt-2 text-secondary small mb-0">
                            <?= character_limiter($row->keterangan_pengaduan, 60) ?>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>

    <?php endif; ?>
</div>