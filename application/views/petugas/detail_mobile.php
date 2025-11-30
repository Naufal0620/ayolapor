<div class="row mb-4">
    <div class="col-12">
        <a href="<?= base_url('petugas/dashboard') ?>" class="btn btn-sm btn-light mb-3 shadow-sm rounded-pill px-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3">
            <img src="<?= base_url($row->foto_bukti) ?>" class="w-100" onclick="previewImage(this.src)">
        </div>
    </div>

    <div class="col-12">
        <h5 class="fw-bold mb-1">Lokasi Kerusakan</h5>
        <p class="text-muted mb-3"><?= $row->lokasi_text ?></p>
        
        <div class="bg-white p-3 rounded-3 shadow-sm border mb-3">
            <label class="small text-uppercase text-muted fw-bold">Deskripsi Pelapor</label>
            <p class="mb-0"><?= $row->keterangan_pengaduan ?></p>
        </div>

        <?php if($row->keterangan_admin): ?>
        <div class="alert alert-info border-0 shadow-sm">
            <strong><i class="fas fa-info-circle"></i> Catatan Admin:</strong><br>
            <?= $row->keterangan_admin ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="col-12 mt-2">
        <div class="d-grid gap-2">
            <a href="https://www.google.com/maps/dir/?api=1&destination=<?= $row->latitude ?>,<?= $row->longitude ?>" 
               target="_blank" 
               class="btn btn-outline-primary btn-action-lg">
               <i class="fas fa-directions me-2"></i> Buka Rute (Maps)
            </a>

            <button onclick="selesaikanTugas(<?= $row->id_pengaduan ?>)" 
                    class="btn btn-success btn-action-lg text-white shadow-sm">
                <i class="fas fa-check-circle me-2"></i> Tandai Selesai
            </button>
        </div>
    </div>
</div>