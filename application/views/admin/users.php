<style>
    th {
        white-space: nowrap;
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
                        <!-- <a class="btn btn-success"><i class="fas fa-print"></i> Cetak Data</a> -->
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="card-title">Tabel User</div>
                    </div>
                    <div class="card-body w-100 overflow-auto">
                        <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="table-users" class="table table-bordered table-hover dataTable dtr-inline"
                                        aria-describedby="datatables_info">
                                        <thead>
                                            <tr class="table-header">
                                                <th>#</th>
                                                <th>Nama Lengkap</th>
                                                <th>Email</th>
                                                <th>No. Telp</th>
                                                <th>Role</th>
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

<div class="modal fade" id="modal-users">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-capitalize"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-users">
                    <div class="card-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                placeholder="Masukkan Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan Password">
                            <p class="text-muted text-sm mt-1 d-none" id="text-password">
                                Biarkan kosong jika tidak ingin diubah
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="no_telp" class="form-control" id="no_telp" name="no_telp"
                                placeholder="Masukkan Nomor Telepon">
                        </div>
                        <div class="form-group">
                            <label for="role">Role <span class="text-danger">*</span></label>
                            <select class="form-control" id="role" name="role">
                                <option value="" hidden selected>-- Pilih --</option>
                                <option value="admin">admin</option>
                                <option value="petugas">petugas</option>
                                <option value="user">user</option>
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