<div class="container-fluid">
    <a onclick="window.location=document.referrer;" class="btn btn-info btn-icon-split mb-3 ">
        <span class="icon text-white-50">
            <i class="fas fa-caret-square-left"></i>
        </span>
        <span class="text">Kembali</span>
    </a>

    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h6 class="m-0 font-weight-bold text-dark-100">Edit Penambahan Hari</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('Database_spk/edit_penambahan_hari') ?>"
                        class="form-horizontal">
                        <div class="row mb-3">

                            <label for="" class="col-sm-12 col-form-label">Hari</label>
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" name="id_table_spk"
                                    value="<?php echo $tampil->id_table_spk?>">
                                <input type="number" class="form-control" name="penambahan_hari"
                                    value="<?php echo $tampil->penambahan_hari?>">
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2 offset-sm-0">
                                <button type="submit" class="btn btn-info btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-save"></i>
                                    </span>
                                    <span class="text">
                                        SIMPAN
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>