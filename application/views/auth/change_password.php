<?php $this->load->view('t/top'); ?>
<div class="container-fluid">
    <div id="infoMessage"><?php echo $message;?></div>

    <div class="card shadow">
        <div class="card-header" style="background-color: #17a2b8;">
            <h6 class="m-0 font-weight-bold text-gray-100">Ganti Password</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url("Auth/change_password") ?>" method="post" class="form-horizontal">
                <div class="row mb-3">
                    <label for="old_password" class="col-sm-2 col-form-label">Password lama</label>
                    <div class="col-sm-6">
                        <input type="password" name="old" id="old_password" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="new_password" class="col-sm-2 col-form-label">Password baru</label>
                    <div class="col-sm-6">
                        <input type="password" name="new" id="new_password" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="new_password_confirm" class="col-sm-2 col-form-label">Password baru (Konformasi)</label>
                    <div class="col-sm-6">
                        <input type="password" name="new_confirm" id="new_password_confirm" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-8 offset-2">
                        <button type="submit" id="simpan_password" class="btn btn-info btn-icon-split mb-3">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text">SIMPAN</span>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php $this->load->view('t/bottom'); ?>