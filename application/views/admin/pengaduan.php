<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<style>
    th {
        white-space: nowrap;
    }

    #map { 
        height: 250px; 
        width: 100%; 
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-bottom: 15px;
    }
</style>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="card-title">Opsi</div>
                    </div>
                    <div class="card-body">
                        <?= $add_btn ?>
                        <!-- <a class="btn btn-success btn-export-spreadsheet"><i class="far fa-file-excel"></i> Import Spreadsheet</a> -->
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="card-title">Tabel Pengaduan</div>
                    </div>
                    <div class="card-body w-100 overflow-auto">
                        <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="table-pengaduan" class="table table-bordered table-hover dataTable dtr-inline"
                                        aria-describedby="datatables_info">
                                        <thead>
                                            <tr class="table-header">
                                                <th>#</th>
                                                <th>Pengadu</th>
                                                <th>Tanggal Pengaduan</th>
                                                <th>Lokasi Spesifik</th>
                                                <th>Foto Bukti</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<div class="modal fade" id="modal-pengaduan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-capitalize"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-pengaduan">
                    <div class="card-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="id_user">Pengadu <span class="text-danger">*</span></label>
                            <select class="form-control" id="id_user" name="id_user">
                                <option value="" hidden selected>-- Pilih --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="lokasi_text">Alamat Spesifik <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="lokasi_text" name="lokasi_text"
                                placeholder="Masukkan Alamat Spesifik"></textarea>
                        </div>
                        <div id="map"></div>
                        <a class="btn btn-block btn-success mb-3 btn-lokasi-terkini"><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;&nbsp;Cari Lokasi Terkini</a>
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <div class="form-group">
                            <label for="foto_bukti">Foto Bukti <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input optional" id="foto_bukti" name="foto_bukti" accept=".jpg,.jpeg,.png">
                                    <label class="custom-file-label" for="foto_bukti" id="foto_bukti_filename">Pilih Foto</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <img id="foto_bukti_preview" class="rounded"
                                src="<?php echo base_url(); ?>assets/dist/img/none.png" width="80%"></img>
                        </div>
                        <div class="form-group">
                            <label for="foto_bukti_selesai">Foto Bukti Selesai</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input optional" id="foto_bukti_selesai" name="foto_bukti_selesai" accept=".jpg,.jpeg,.png">
                                    <label class="custom-file-label" for="foto_bukti_selesai" id="foto_bukti_selesai_filename">Pilih Foto</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <img id="foto_bukti_selesai_preview" class="rounded"
                                src="<?php echo base_url(); ?>assets/dist/img/none.png" width="80%"></img>
                        </div>
                        <div class="form-group">
                            <label for="keterangan_pengaduan">Keterangan Pengaduan <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="keterangan_pengaduan" name="keterangan_pengaduan"
                                placeholder="Masukkan Keterangan Pengaduan"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="keterangan_admin">Keterangan Admin</label>
                            <textarea class="form-control optional" id="keterangan_admin" name="keterangan_admin"
                                placeholder="Masukkan Keterangan Admin"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status">
                                <option value="" hidden selected>-- Pilih --</option>
                                <option value="Pending">Pending</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Tolak">Tolak</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-simpan">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-spreadsheet">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-capitalize"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-spreadsheet">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="spreadsheet_file" name="spreadsheet_file" accept=".xlsx,.xls">
                                    <label class="custom-file-label" for="spreadsheet_file" id="spreadsheet_filename">File Spreadsheet</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-simpan-spreadsheet">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>