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

            <button type="button"
                    data-bs-toggle="modal" 
                    data-bs-target="#modalSelesai"
                    class="btn btn-success btn-action-lg text-white shadow-sm">
                <i class="fas fa-check-circle me-2"></i> Lapor Selesai
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSelesai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-bottom-sheet">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Laporan Pengerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formSelesai" enctype="multipart/form-data">
                    <input type="hidden" name="id_pengaduan" value="<?= $row->id_pengaduan ?>">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Foto Bukti Perbaikan <span class="text-danger">*</span></label>
                        <input type="file" name="foto_selesai" class="form-control" accept="image/*" required>
                        <div class="form-text text-xs">Pastikan foto terlihat jelas.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Keterangan Pengerjaan <span class="text-danger">*</span></label>
                        <textarea name="keterangan_admin" class="form-control" rows="3" placeholder="Contoh: Jalan sudah ditambal aspal hotmix..." required></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-bold py-2">
                            KIRIM LAPORAN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>