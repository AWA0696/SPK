<a onclick="location.href = '<?php echo site_url('Database_spk/spk_by_perumahan/'.$id_perumahan) ?>'"
    class="btn btn-info btn-icon-split ml-4 mb-3">
    <span class="icon text-white-50">
        <i class="fas fa-caret-square-left"></i>
    </span>
    <span class="text">Kembali</span>
</a>
<div class="card card-default">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header bg-cyan">
                        <h4 class="card-title">Detail Retensi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped">
                                <thead>
                                    <tr class="bg-light m-0 font-weight-bold text-dark-100">
                                        <th class=" border-right text-nowrap ">No</th>
                                        <th class=" border-right text-nowrap ">Rincian</th>
                                        <th class=" border-right text-nowrap ">Tanggal Input</th>
                                        <th class=" border-right text-nowrap ">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
              //data loopingan
                                $no = 0;  
                                foreach ($list_pengurangan_retensi as $l) {
                            
                                    $no++ ;
                                  
                                
                                    ?>

                                    <tr>
                                        <td class="text-nowrap"><?php echo $no; ?></td>
                                        <td class="text-nowrap"><?php echo $l->rincian_retensi; ?></td>
                                        <td class="text-nowrap"><?php echo $l->tanggal_input_retensi; ?></td>
                                        <td>
                                            <a href="<?= site_url('Database_spk/detail_retensi/') . $l->id_table_spk; ?>"
                                                class="btn-sm btn-primary btn-block">Print<i></i></a>
                                        </td>

                                    </tr>
                                    <?php } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>