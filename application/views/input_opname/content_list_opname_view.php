<a onclick="location.href = '<?php echo site_url('Database_spk/spk_by_perumahan_opname/'.$id_perumahan) ?>'"
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
                    <?php
                    if(!empty($list)) {
                    ?>
                    <div class="card-header bg-cyan">
                        <h4 class="card-title">Opname Standar</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped">
                                <thead>
                                    <tr class="bg-light m-0 font-weight-bold text-dark-100">
                                        <th class=" border-right text-nowrap ">No</th>
                                        <th class=" border-right text-nowrap ">Perumahan</th>
                                        <th class=" border-right text-nowrap ">Block</th>
                                        <th class=" border-right text-nowrap ">Opini</th>
                                        <th class=" border-right text-nowrap ">Di Approve Oleh </th>
                                        <th class=" border-right text-nowrap ">Tanggal Approve</th>

                                        <th class=" border-right text-nowrap ">Aksi</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    //data loopingan 
                                $no = 0;  
                                foreach ($list as $l) {
                            
                                    $no++ ;
                                    $opini = $l->opini; // Nilai opini
                                    $persentase = '';
                                if ($opini == 3) {
                                    $persentase = '30%';
                                } elseif ($opini == 7) {
                                    $persentase = '70%';
                                } elseif ($opini == 10) {
                                    $persentase = '100%';
                                } elseif ($opini == 11) {
                                    $persentase = 'Retensi';
                                } 
                                
                                    ?>

                                    <tr>
                                        <td class="text-nowrap"><?php echo $no; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_perumahan; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_blok; ?></td>
                                        <td class="text-nowrap"><?php echo $persentase; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_pengapprove_opname; ?></td>
                                        <td class="text-nowrap"><?php echo $l->tanggal_approve_opname; ?></td>



                                        <td>
                                            <a href="<?= site_url('Database_spk/print_opname/') . $l->id_opname_spk; ?>"
                                                class="btn-sm btn-primary btn-block">Print<i></i></a>
                                        </td>

                                    </tr>
                                    <?php } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <br>
                <?php
                    if(!empty($list_hpp)) {
                    ?>
                <div class="card shadow">
                    <div class="card-header bg-cyan">
                        <h4 class="card-title">Opname HPP </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped">
                                <thead>
                                    <tr class="bg-light m-0 font-weight-bold text-dark-100">
                                        <th class=" border-right text-nowrap ">No</th>
                                        <th class=" border-right text-nowrap ">Perumahan</th>
                                        <th class=" border-right text-nowrap ">Block</th>
                                        <th class=" border-right text-nowrap ">Di Approve Oleh </th>
                                        <th class=" border-right text-nowrap ">Tanggal Approve</th>
                                        <th class=" border-right text-nowrap ">Nilai Pencairan</th>
                                        <th class=" border-right text-nowrap ">Aksi</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
              //data loopingan
                                $no = 0; 
                                foreach ($list_hpp as $l) {
                            
                                    $no++ ;
                                    ?>

                                    <tr>
                                        <td class="text-nowrap"><?php echo $no; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_perumahan; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_blok; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_pengapprove_opname; ?></td>
                                        <td class="text-nowrap"><?php echo $l->tanggal_approve_opname; ?></td>
                                        <td class="text-nowrap">
                                            <?php echo  $this->pitih->formatrupiah("$l->pencairan"); ?></td>
                                        <td>
                                            <a href="<?= site_url('Database_spk/print_opname_hpp/') . $l->id_opname_hpp_spk; ?>"
                                                class="btn-sm btn-primary btn-block">Print<i></i></a>
                                        </td>

                                    </tr>
                                    <?php } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <br>
                <?php
                    if(!empty($list_lain2)) {
                    ?>
                <div class="card shadow">
                    <div class="card-header bg-cyan">
                        <h4 class="card-title">Opname lain-lain </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped">
                                <thead>
                                    <tr class="bg-light m-0 font-weight-bold text-dark-100">
                                        <th class=" border-right text-center ">No</th>
                                        <th class=" border-right text-center ">Perumahan</th>
                                        <th class=" border-right text-center ">Block</th>

                                        <th class=" border-right text-center ">Di Approve Oleh </th>
                                        <th class=" border-right text-center ">Tanggal Approve</th>

                                        <th class=" border-right text-center ">Aksi</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
              //data loopingan
                                $no = 0; 
                                foreach ($list_lain2 as $l) {
                            
                                    $no++ ;
                                  
                                
                                    ?>

                                    <tr>
                                        <td class="text-center"><?php echo $no; ?></td>
                                        <td class="text-center"><?php echo $l->nama_perumahan; ?></td>
                                        <td class="text-center"><?php echo $l->nama_blok; ?></td>

                                        <td class="text-center"><?php echo $l->nama_pengapprove_opname; ?></td>
                                        <td class="text-center"><?php echo $l->tanggal_approve_opname; ?></td>



                                        <td class="text-center">
                                            <a href="<?= site_url('Database_spk/print_opname_lain2_view/') . $l->id_opname_lain2_spk_view; ?>"
                                                class="btn-sm btn-primary ">Print<i></i></a>
                                        </td>

                                    </tr>
                                    <?php } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>