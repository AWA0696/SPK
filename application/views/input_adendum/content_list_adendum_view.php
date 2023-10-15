<a onclick="location.href = '<?php echo site_url('Database_spk/spk_by_perumahan_adendum/'.$id_perumahan) ?>'"
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
                        <h4 class="card-title">List Adendum</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped">
                                <thead>
                                    <tr class="bg-light m-0 font-weight-bold text-dark-100">
                                        <th class=" border-right text-nowrap ">No</th>
                                        <th class=" border-right text-nowrap ">Nama Konsumen</th>
                                        <th class=" border-right text-nowrap ">Perumahan</th>
                                        <th class=" border-right text-nowrap ">Block</th>
                                        <th class=" border-right text-nowrap ">Tanggal</th>
                                        <th class=" border-right text-nowrap ">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
              //data loopingan
                                $no = 0;  
                                foreach ($list_adendum as $l) {
                            
                                    $no++ ;
                                  
                                
                                    ?>

                                    <tr>
                                        <td class="text-nowrap"><?php echo $no; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_konsumen; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_perumahan; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_blok; ?></td>
                                        <td class="text-nowrap"><?php echo $l->tanggal_input_adendum; ?></td>
                                        <td>
                                            <a href="<?= site_url('Database_spk/print_adendum/') . $l->id_table_adendum; ?>"
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