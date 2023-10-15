<a href="<?= base_url('Database_spk/list_spmb_view/' . $id_table_spk->id_table_spk) ?>"
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
                            <?php foreach ($data_spk as $ds) {   
                                  $total_retensi = 0;
                                  $total_adendum = 0;
                                  $total_biaya_spk= 0;
                                  $nilai_borongan = $ds->nilai_borongan;
                                  $nilai_borongan_biaya_spk = $nilai_borongan;
                                    $tanggal_awal_spk = $ds->tanggal_awal_spk; 
                                    $tanggal_akhir_spk = $ds->tanggal_akhir_spk;
                                    if (!empty($ds->total_penambahan_hari)) {
                                        $penambahan_hari = $ds->total_penambahan_hari; }
                                        else{$penambahan_hari = 0;}
                               
                                    $tanggal_awal_spk_obj = new DateTime($tanggal_awal_spk);
                                    $tanggal_akhir_spk_obj = new DateTime($tanggal_akhir_spk);
                                 
                                    $tanggal_akhir_spk_obj->modify('+' . $penambahan_hari . ' days');
                                   
                                    $tanggal_akhir_spk_sebenarnya = $tanggal_akhir_spk_obj->format('d M Y');
                                  
                                   

                                    
                                    ?>


                            <div class="col">
                                <address style=" text-align: left; font-family: 'Times New Roman' , Times, serif;">
                                    <?php echo "Nama Perumahan: $ds->nama_perumahan"; ?><br>
                                    <?php echo "Nama Blok: $ds->nama_blok"; ?><br>
                                    <?php echo "Type Rumah: $ds->type_perumahan"; ?><br>
                                    <?php echo "Kontraktor: <strong> $ds->nama_kontraktor" ."</strong>"; ?><br>
                                    <?php echo "Tanggal Akhir SPK:<strong> " . date('d M Y', strtotime($tanggal_akhir_spk_sebenarnya))."</strong>"?><br>
                                </address>
                            </div>
                            <div class="col">
                                <strong>
                                    <address style=" text-align: right; font-family: 'Times New Roman' , Times, serif;">
                                        <?php echo "Nilai Borongan Awal: " . $this->pitih->formatrupiah($ds->nilai_borongan); ?>
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

                <?php
                    if (!empty($biaya_spk)) {
                        
                        ?>
                <h6 style=" text-align: left; font-family: 'Times New Roman' , Times, serif;">
                    <strong> Penambahan/Pengurangan</strong>
                </h6>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table name="tabel_biaya" class="table table-bordered table-width"
                            style=" text-align: center; font-family: 'Times New Roman' , Times, serif;">
                            <thead>
                                <tr>
                                    <th style="width: 20%;">No</th>
                                    <th style="width: 20%;">Penambahan / Pengurangan</th>
                                    <th style="width: 20%;">Keterangan</th>
                                    <th style="width: 20%;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                              
                                $no = 0;
                                $total_biaya_spk = 0; 
                               

                                foreach ($biaya_spk as $bs) {
                                    $no++;

                                    if ($bs->koreksi == 1) {
                                        // Penambahan
                                        $nilai_borongan_biaya_spk += $bs->jumlah;
                                        $total_biaya_spk += $bs->jumlah;
                                    } else {
                                        // Pengurangan
                                        $nilai_borongan_biaya_spk -= $bs->jumlah;
                                        $total_biaya_spk -= $bs->jumlah;
                                    }
                                  
                                    ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?php
                                        if ($bs->koreksi == 1) {
                                            echo "Penambahan";
                                        } else {
                                            echo "Pengurangan";
                                        }
                                        ?>
                                    </td>
                                    <td><?= $bs->keterangan ?></td>
                                    <td>
                                        <?php
                                        if ($bs->koreksi == 1) {
                                            echo $this->pitih->formatrupiah("$bs->jumlah");
                                        } else {
                                            echo "(" . $this->pitih->formatrupiah("$bs->jumlah") . ")";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php } ?>

                                <tr>
                                    <td colspan="3" style="text-align: right;">Total:</td>
                                    <td><?= $this->pitih->formatrupiah("$total_biaya_spk") ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
                }

                ?>
                <div class="col">
                    <strong>
                        <address style=" text-align: right; font-family: 'Times New Roman' , Times, serif;">
                            <?php echo "Nilai Borongan Akhir: " . $this->pitih->formatrupiah($nilai_borongan_biaya_spk); ?>
                        </address>
                    </strong>
                </div>
                <?php
            if ( !empty($adendum_spk)) {
            ?>
                <h6 style=" text-align: left; font-family: 'Times New Roman' , Times, serif;">
                    <strong> Adendum</strong>
                </h6>

                <div class="row">
                    <div class="col-12 table-responsive">
                        <table name="tabel_adendum" class="table table-bordered table-width"
                            style=" text-align: center; font-family: 'Times New Roman' , Times, serif;">
                            <thead>
                                <tr>
                                    <th style="width: 20%;">No</th>
                                    <th style="width: 20%;">Penambahan / Pengurangan</th>
                                    <th style="width: 20%;">Keterangan</th>
                                    <th style="width: 20%;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 0;
                                    
                                    $total_penambahan = 0;
                                    $total_pengurangan = 0;
                                    
                                    if(!empty($nilai_borongan_biaya_spk)){
                                    $nilai_borongan_ahkir_adendum = $nilai_borongan_biaya_spk;
                                    }else{
                                        $nilai_borongan_ahkir_adendum = $ds->nilai_borongan;
                                    }
                                    foreach ($adendum_spk as $as) {
                                        $no++;
                                        ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?php
                                        if ($as->koreksi_adendum == 1) {
                                            echo "Penambahan";
                                            $total_adendum += $as->jumlah_adendum;
                                            $nilai_borongan_ahkir_adendum += $as->jumlah_adendum;
                                        } else { 
                                            echo "Pengurangan";
                                            $total_adendum -= $as->jumlah_adendum;
                                            $nilai_borongan_ahkir_adendum -= $as->jumlah_adendum;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $as->keterangan_adendum ?></td>
                                    <td>
                                        <?php
                                        if ($as->koreksi_adendum == 1) {
                                            echo $this->pitih->formatrupiah("$as->jumlah_adendum");
                                        } else {
                                            echo "(" . $this->pitih->formatrupiah("$as->jumlah_adendum") . ")";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="3" style="text-align: right;">Total:</td>
                                    <td><?= $this->pitih->formatrupiah("$total_adendum") ?></td>
                                </tr>
                                <!-- <tr>
                                    <td colspan="3" style="text-align: right;">Nilai Borongan:</td>
                                    <td><?= $this->pitih->formatrupiah("$nilai_borongan_ahkir_adendum") ?></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                    } 
                    
                ?>


                <?php
                if (!empty($retensi_spk)) {
                    ?>
                <h6 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                    <strong>Retensi</strong>
                </h6>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table name="tabel_adendum" class="table table-bordered"
                            style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                            <thead>
                                <tr>
                                    <th style="width: 20%;">No</th>
                                    <th style="width: 20%;">Penambahan / Pengurangan</th>
                                    <th style="width: 20%;">Keterangan</th>
                                    <th style="width: 20%;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $no = 0;
                           
                            $total_penambahan = 0;
                            $total_pengurangan = 0;

                            foreach ($retensi_spk as $as) {
                                $no++;

                                // Menampilkan informasi pada $retensi_spk
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?php
                                        if ($as->koreksi_retensi == 1) {
                                            echo "Penambahan";
                                            $total_penambahan += $as->jumlah_retensi;
                                            $total_retensi += $as->jumlah_retensi;
                                        } else {
                                            echo "Pengurangan";
                                            $total_pengurangan += $as->jumlah_retensi;
                                            $total_retensi -= $as->jumlah_retensi;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $as->keterangan_retensi ?></td>
                                    <td>
                                        <?php
                                        if ($as->koreksi_retensi == 2) {
                                            echo "(" . $this->pitih->formatrupiah($as->jumlah_retensi) . ")";
                                        } else {
                                            echo $this->pitih->formatrupiah($as->jumlah_retensi);
                                        }
                                        ?>
                                    </td>
                                <tr>
                                    <td colspan="3" style="text-align: right;">Total:</td>
                                    <td>
                                        <?php
                                    if($total_retensi<0){
                                        $tot_ret_tab = abs($total_retensi); 
                                    echo "(".$this->pitih->formatrupiah("$tot_ret_tab").")" ;
                                    }else{

                                        echo $this->pitih->formatrupiah("$tot_ret_tab");
                                    }
                                    ?>

                                    </td>
                                </tr>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                    }
                ?>

                <?php
                $tot_nba=$nilai_borongan+$total_adendum+$total_biaya_spk
                ?>

                <h6 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                    <strong>Pencairan</strong>
                </h6>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table name="tabel_biaya" class="table table-bordered table-width"
                            style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                            <thead>
                                <tr>
                                    <th style="width: 1%;">No</th>
                                    <th style="width: 4%;">Pencairan</th>
                                    <th style="width: 5%;">Tanggal Opname</th>
                                    <th style="width: 10%;">Adendum</th>
                                    <th style="width: 10%;">Denda</th>
                                    <th style="width: 13%;">Retensi</th>
                                    <th style="width: 20%;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                   
                                    $no = 0; 
                                    $total_pencairan = 0; 
                                    $total_denda = 0; 
                                    $denda=0;
                                  
                                    foreach ($pencairan_opname as $po) {
                                        $no++;
                                        $opini = $po->opini; 
                                        $persentase = '';

                                        if (!empty($nilai_borongan_ahkir_adendum) && !empty($nilai_borongan_biaya_spk)) {
                                            $nba = $nilai_borongan_ahkir_adendum;
                                        
                                        } elseif (!empty($nilai_borongan_ahkir_adendum)) {
                                            $nba = $nilai_borongan_ahkir_adendum;
                                            
                                        } elseif  (!empty($nilai_borongan_biaya_spk)) {
                                            $nba = $nilai_borongan_biaya_spk;
                                        } else {
                                            $nba = $ds->nilai_borongan;
                                        }

                                        if ($opini == 3) {
                                            $persentase = '30%';
                                        } elseif ($opini == 7) {
                                            $persentase = '70%';
                                        } elseif ($opini == 10) {
                                            $persentase = '100%';
                                            $tanggal_approve = strtotime($po->tanggal_approve_opname);
                                            $tanggal_akhir_spk = strtotime($tanggal_akhir_spk_sebenarnya);

                                            if ($tanggal_approve > $tanggal_akhir_spk) {
                                                $selisih_hari = floor(($tanggal_approve - $tanggal_akhir_spk) / (60 * 60 * 24));
                                                $denda = $selisih_hari * (0.005 * $tot_nba);
                                                $total_denda += $denda;
                                            }
                                            
                                        } elseif ($opini == 11) {
                                            $persentase = 'Retensi';
                                            
                                           
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
                                        <?php
                                        
                                        if($opini==10 && !empty($adendum_spk)){
                                           echo $this->pitih->formatrupiah($total_adendum );
                                        }else{

                                            echo $this->pitih->formatrupiah(0);  
                                        }

                                        ?>

                                    </td>
                                    <td class="text-nowrap">
                                        <?php
                                        
                                        if($opini==10) {
                                           echo $this->pitih->formatrupiah(-$total_denda );
                                        }else{

                                            echo $this->pitih->formatrupiah(0);  
                                        }

                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        
                                        if($opini==11) {
                                           echo $this->pitih->formatrupiah($total_retensi );
                                        }else{

                                            echo $this->pitih->formatrupiah(0);  
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $pencairan = 0; // Variabel untuk menyimpan hasil perkalian

                                        if ($opini == 3) {
                                            $pencairan = $nilai_borongan_biaya_spk * 0.3; // Pencairan = nilai_borongan * 30%
                                        } elseif ($opini == 7) {
                                            $pencairan = $nilai_borongan_biaya_spk * 0.4; // Pencairan = nilai_borongan * 40%
                                        } elseif ($opini == 10) {
                                            $pencairan = $nilai_borongan_biaya_spk * 0.25+$total_adendum-$total_denda; // Pencairan = nilai_borongan * 25%
                                        } elseif ($opini == 11) {
                                            $pencairan = $nilai_borongan_biaya_spk * 0.05+$total_retensi; // Pencairan = nilai_borongan * opini / 5%
                                        }


                                        echo $this->pitih->formatrupiah($pencairan);


                                        ?>
                                    </td>
                                </tr>
                                <?php
                                        $total_pencairan += $pencairan;
                                       
                                    }


                                    $sisa_pencairan = $tot_nba-$total_pencairan-$total_denda;
                                    
                                    if($total_retensi<0)
                                    {
                                    
                                        $sisa_pencairan-=abs($total_retensi);

                                    }elseif($total_retensi>0){
                                        $sisa_pencairan+=$total_retensi;
                                    }                
                
                                    ?>

                                <tr>
                                    <td colspan="6" style="text-align: right;">Penambahan Hari:</td>
                                    <td>
                                        <?php if ($ds->id_table_spk !== null) { ?>
                                        <a
                                            href="<?= base_url('Database_spk/rincian_penambahan_hari/') . $ds->id_table_spk ?>">
                                            <?= $penambahan_hari ?> Hari
                                        </a>
                                        <?php } else { ?>
                                        <span><?= $penambahan_hari ?> Hari</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right;">Keterlambatan:</td>
                                    <td><?php if (!empty($selisih_hari)) { echo $selisih_hari . ' Hari'; } else { echo '0 Hari'; } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right;">Denda:</td>
                                    <td><?= "(" .  $this->pitih->formatrupiah($total_denda ). ")" ?></td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right;">Retensi:</td>
                                    <td><?= "(" .  $this->pitih->formatrupiah($total_retensi ). ")" ?></td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right;">Saldo Hutang:</td>
                                    <td><?= $this->pitih->formatrupiah("$sisa_pencairan") ?></td>
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