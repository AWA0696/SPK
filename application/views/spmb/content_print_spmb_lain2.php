<a href="<?= base_url('Database_spk/list_spmb/' . $id_table_spk->id_table_spk) ?>"
    class="btn btn-info btn-icon-split ml-4">
    <span class="icon text-white-50">
        <i class="fas fa-caret-square-left"></i>
    </span>
    <span class="text">Kembali</span>
</a>
<div id="div1" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <img src="<?= base_url('assets/') ?>img/dofla-logo-2.png">
                        </h4>

                        <h3>
                            <strong style=" text-align: right; font-family: 'Times New Roman' , Times, serif;">Detail
                                SPMB</strong>
                        </h3>
                        <hr style="border-top: 3px solid black; margin: 20px 0;">

                        <div class="row">

                            <?php 
                          
                            foreach ($data_spk as $ds) {  
                                    $tanggal_awal_spk = $ds->tanggal_awal_spk; 
                                    $tanggal_akhir_spk = $ds->tanggal_akhir_spk;
                                    $penambahan_hari = $ds->penambahan_hari; 
                                    $nba = $ds->nilai_borongan;
                               
                                    $tanggal_awal_spk_obj = new DateTime($tanggal_awal_spk);
                                    $tanggal_akhir_spk_obj = new DateTime($tanggal_akhir_spk);
                                 
                                    $tanggal_akhir_spk_obj->modify('+' . $penambahan_hari . ' days');
                                   
                                    $tanggal_akhir_spk_sebenarnya = $tanggal_akhir_spk_obj->format('d M Y');
                                    
                                   

                                    ?>

                            <div class="col">
                                <address style=" text-align: left; font-family: 'Times New Roman' , Times, serif;">
                                    <?php echo "Nama Perumahan: $ds->nama_perumahan"; ?><br>

                                    <?php echo "Kontraktor: <strong> $ds->nama_kontraktor </strong> "; ?><br>
                                    <?php echo "Tanggal Akhir SPK: <strong>" . date('d M Y', strtotime($tanggal_akhir_spk_sebenarnya)) . "</strong>"; ?><br>
                                </address>
                            </div>
                            <div class="col">
                                <strong>
                                    <address style=" text-align: right; font-family: 'Times New Roman' , Times, serif;">
                                        <?php echo "Nilai Borongan: " . $this->pitih->formatrupiah($ds->nilai_borongan); ?>
                                    </address>
                                </strong>
                            </div>
                            <?php } ?>
                        </div>

                        <h5>
                            <strong style=" text-align: left; font-family: 'Times New Roman' , Times, serif;">
                                Rincian:</strong>
                        </h5>
                    </div>
                </div>


                <h6 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                    <strong>Pencairan</strong>
                </h6>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table name="tabel_biaya" class="table table-bordered table-width"
                            style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 10%;">Pencairan</th>
                                    <th style="width: 10%;">Tanggal Opname</th>
                                    <th style="width: 10%;">Rincian</th>
                                    <th style="width: 20%;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                   
                                    $no = 0;
                                    $total_pencairan = 0; 
                                  
                                  
                                    foreach ($pencairan_opname_lain2 as $po) {
                                        $no++;
                                        $opini = $po->opini; 
                                        $persentase = '';
                                       
                                           
                                      
                                        if ($opini == 3) {
                                            $persentase = '30%';
                                        } elseif ($opini == 7) {
                                            $persentase = '70%';
                                        } elseif ($opini == 10) {
                                            $persentase = '100%';
                                            
                                        } elseif ($opini == 11) {
                                            $persentase = 'Retensi';
                                            $tanggal_approve = strtotime($po->tanggal_approve_opname);
                                            $tanggal_akhir_spk = strtotime($tanggal_akhir_spk_sebenarnya);

                                            if ($tanggal_approve > $tanggal_akhir_spk) {
                                                $selisih_hari = floor(($tanggal_approve - $tanggal_akhir_spk) / (60 * 60 * 24));
                                               
                                            }
                                           
                                         } 
                                    ?>
                                <?php
                                    
                                    ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <!-- <td>
                                        <a href="<?= site_url('Database_spk/tampil_input_tanggal_pencairan/') . $po->id_opname_spk; ?>"
                                            class="btn-sm btn-info btn-block">Input<i></i></a>
                                    </td> -->
                                    <td><?= $persentase ?></td>
                                    <td class="text-nowrap">
                                        <?php echo date('d M Y', strtotime($po->tanggal_approve_opname)); ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <?php echo $po->rincian_opname_lain2; ?>
                                    </td>
                                    <td>
                                        <?=$this->pitih->formatrupiah($po->pencairan );?>
                                    </td>

                                </tr>
                                <?php
                                        $total_pencairan += $po->pencairan;
                                    }
                                    $sisa_pencairan = $nba - $total_pencairan;
                                  
                                    ?>

                                <tr>
                                    <td colspan="4" style="text-align: right;">Penambahan Hari:</td>
                                    <td><?= $ds->penambahan_hari ?> Hari</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: right;">Keterlambatan:</td>
                                    <td><?php if (!empty($selisih_hari)) { echo $selisih_hari . ' Hari'; } else { echo '0 Hari'; } ?>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>

                <address style=" text-align: right; font-family: 'Times New Roman' , Times, serif;">
                    Padang Pariaman, <?=date('d M Y'); ?>
                </address>

                <div class=" table-responsive">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row no-print">
    <div class="col-12">
        <button onclick="printContent('div1')" target="_blank" class="btn btn-primary btn-lg ml-4"><i
                class="fas fa-print"></i> Print</button>
    </div>
</div>


<script>
function printContent(el) {
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>