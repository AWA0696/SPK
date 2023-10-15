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
                    <?php
                    if(!empty($list)) {
                    ?>
                    <div class="card-header bg-cyan">
                        <h4 class="card-title">SPMB Rumah</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped">
                                <thead>
                                    <tr class="bg-light m-0 font-weight-bold text-dark-100">
                                        <th class=" border-right text-nowrap ">No</th>
                                        <th class=" border-right text-nowrap ">Perumahan</th>
                                        <th class=" border-right text-nowrap ">Block</th>
                                        <th class=" border-right text-nowrap ">Nilai Borongan </th>
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
                                        <td class="text-nowrap">
                                            <?php echo  $this->pitih->formatrupiah("$l->nilai_borongan"); ?></td>

                                        <td>
                                            <a href="<?= site_url('Database_spk/print_spmb/') . $l->id_table_spk; ?>"
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
                    if(!empty($list_spmb_hpp)) {
                    ?>
                <div class="card shadow">
                    <div class="card-header bg-cyan">
                        <h4 class="card-title">SPMB HPP </h4>
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
                                        <th class=" border-right text-nowrap ">Nilai Borongan </th>
                                        <th class=" border-right text-nowrap ">Aksi</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                //data loopingan
                                $no = 0; 
                                foreach ($list_spmb_hpp as $l) {
                            
                                    $no++ ;
                                
                                    ?>

                                    <tr>
                                        <td class="text-nowrap"><?php echo $no; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_perumahan; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_blok; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_pengaprove; ?></td>
                                        <td class="text-nowrap"><?php echo $l->tanggal_approve_opname; ?></td>

                                        <td class="text-nowrap">
                                            <?php echo  $this->pitih->formatrupiah("$l->nilai_borongan"); ?></td>

                                        <td>
                                            <a href="<?= site_url('Database_spk/print_spmb_hpp/') . $l->id_table_spk; ?>"
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
                    if(!empty($list_spmb_lain2)) {
                    ?>
                <div class="card shadow">
                    <div class="card-header bg-cyan">
                        <h4 class="card-title">SPMB lain-lain </h4>
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
                                        <th class=" border-right text-nowrap ">Nilai Borongan </th>
                                        <th class=" border-right text-nowrap ">Aksi</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
              //data loopingan
                                $no = 0; 
                                foreach ($list_spmb_lain2 as $l) {
                            
                                    $no++ ;
                                    $opini = $l->opini; // Nilai opini
                                    $persentase = $opini * 10 . '%';
                                
                                    ?>

                                    <tr>
                                        <td class="text-nowrap"><?php echo $no; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_perumahan; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_blok; ?></td>
                                        <td class="text-nowrap"><?php echo $persentase; ?></td>
                                        <td class="text-nowrap"><?php echo $l->nama_pengapprove_opname; ?></td>
                                        <td class="text-nowrap"><?php echo $l->tanggal_approve_opname; ?></td>

                                        <td class="text-nowrap">
                                            <?php echo  $this->pitih->formatrupiah("$l->nilai_borongan"); ?></td>

                                        <td>
                                            <a href="<?= site_url('Database_spk/print_spmb_lain2/') . $l->id_table_spk; ?>"
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
            </div>
        </div>
    </div>