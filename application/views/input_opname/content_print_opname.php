<a onclick="window.location=document.referrer;" class="btn btn-info btn-icon-split ml-4">
    <span class="icon text-white-50">
        <i class="fas fa-caret-square-left"></i>
    </span>
    <span class="text">Kembali</span>
</a>
<div id="div1" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Main content -->
            <div class="invoice mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">


                        <h4 style="text-align: center; font-family: 'Times New Roman', Times, serif;">

                            <strong>OPINI AUDITOR</strong><br>

                        </h4>
                        <hr style="border-top: 3px solid black; margin: 20px 0;">
                        <br>

                        <h5 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                            <?php
                           
                             $selisih_hari=0;
                             $total_retensi = 0;
                             $total_denda=0;
                            foreach ($opname_spk as $os) {
                                $opini = $os->opini; // Nilai opini
                                $persentase = '';
                                if ($opini == 3) {
                                    $persentase = '30%';
                                } elseif ($opini == 7) {
                                    $persentase = '70%';
                                } elseif ($opini == 10) { 
                                    $persentase = '100%';
                                } elseif ($opini == 11) {
                                    $persentase = 'Retensi';
                                } // Menghitung persentase
                                $nilai_borongan = $os->nilai_borongan; // Nilai borongan

                                $tanggal_awal_spk = $os->tanggal_awal_spk; 
                                $tanggal_akhir_spk = $os->tanggal_akhir_spk; 
                                $penambahan_hari = (!empty($pen_hari) && is_numeric($pen_hari[0]->penambahan_hari)) ? $pen_hari[0]->penambahan_hari : 0;
                                $denda = $os->denda;
                              
                            ?>
                            Dengan ini saya: <?= $os->pengaju_opname ?> <br>
                            Jabatan: Arsitek <br>
                            Kontraktor: <?="<strong>". $os->nama_kontraktor ."</strong>"?><br>
                            Tanggal Akhir SPK:
                            <?= "<strong>".date('d M Y', strtotime($tanggal_akhir_spk))."</strong>" ?><br>
                            <br>
                            <br>

                            Telah melakukan pengecekan pembangunan PT.Dofla Jaya Properti pada tanggal
                            <strong><?= $os->tanggal_input_opname ?></strong> untuk digunakan dalam rangka
                            pemberian
                            produk terbaik kepada konsumen. <br>
                            <br>

                            Dalam hal ini didapatkan Pembangunan rumah di<strong> <?= $os->nama_perumahan ?>
                                (<?= $os->nama_blok ?> <?= $persentase ?>)</strong> kesiapan bangunan <strong>
                                Wajar
                                Tanpa pengecualian</strong>. Dengan ini menyatakan bahwa pencairan dana sudah bisa
                            di
                            ajukan kasir kepada Pimpinan.
                            <?php } ?>
                        </h5>
                    </div> <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">

                    <!-- /.col -->

                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <br>
                        <br>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped"
                            style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                            <thead>
                                <tr>

                                    <th style="width: 5%;"> Perumahan</th>
                                    <th style="width: 20%;">Blok</th>
                                    <th style="width: 20%;">Type</th>
                                    <th style="width: 20%;">Nilai Borongan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($opname_spk as $osk) { ?>
                                <tr>

                                    <td><?= $osk->nama_perumahan ?></td>
                                    <td><?= $osk->nama_blok ?></td>
                                    <td><?= $osk->type_perumahan ?></td>
                                    <td><?= $this->pitih->formatrupiah("$osk->nilai_borongan") ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- /.col -->
                </div>
                <style>
                .rincian-text {
                    text-align: justify;
                    font-family: 'Times New Roman', Times, serif;
                }
                </style>

                <h6 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                    <strong> Rincian:</strong>
                </h6>

                <p class="rincian-text"><?= $osk->rincian ?></p>

                <?php
                   
                    $nilai_borongan_akhir = $nilai_borongan; // Inisialisasi nilai borongan akhir

                    if (!empty($biaya_spk)) {
                        // If $biaya_spk is not empty
                        ?>
                <h6 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                    <strong> Penambahan/Pengurangan</strong>
                </h6>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table name="tabel_biaya" class="table table-bordered"
                            style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 20%;">Penambahan / Pengurangan</th>
                                    <th style="width: 20%;">Keterangan</th>
                                    <th style="width: 20%;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // If $biaya_spk is not empty
                                $no = 0;
                                $total_biaya_spk = 0; 
                                foreach ($biaya_spk as $bs) {
                                    $no++;
                                    $opini = $os->opini; // Nilai opini

                                    if ($bs->koreksi == 1) {
                                        // Penambahan
                                        $nilai_borongan_akhir += $bs->jumlah;
                                        $total_biaya_spk += $bs->jumlah;
                                    } else {
                                        // Pengurangan
                                        $nilai_borongan_akhir -= $bs->jumlah;
                                        $total_biaya_spk -= $bs->jumlah;
                                    }

                                    // Menampilkan informasi pada $biaya_spk
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
                                <tr>
                                    <td colspan="3" style="text-align: right;">Total:</td>
                                    <td><?= $this->pitih->formatrupiah("$total_biaya_spk") ?></td>
                                </tr>

                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                // Inisialisasi nilai borongan akhir setelah biaya

                // Initialize the variable outside the condition
                <?php }  if ($opini == 10 && !empty($adendum_spk)) {
                    // If opini is 10 and $adendum_spk is not empty
                    ?>
                <h6 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                    <strong>Adendum</strong>
                </h6>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table name="tabel_adendum" class="table table-bordered"
                            style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 20%;">Penambahan / Pengurangan</th>
                                    <th style="width: 20%;">Keterangan</th>
                                    <th style="width: 20%;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                    $no = 0;
                    $total_adendum = 0;
                    $total_penambahan = 0;
                    $total_pengurangan = 0;

                    foreach ($adendum_spk as $as) {
                        $no++;

                        // Menampilkan informasi pada $adendum_spk
                        ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?php
                                if ($as->koreksi_adendum == 1) {
                                    echo "Penambahan";
                                    $total_penambahan += $as->jumlah_adendum;
                                    $total_adendum += $as->jumlah_adendum;
                                } else {
                                    echo "Pengurangan";
                                    $total_pengurangan += $as->jumlah_adendum;
                                    $total_adendum -= $as->jumlah_adendum;
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
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                    }
                    
                    $nilai_pencairan=$os->pencairan
                  
                ?>
                <?php
              
                $total_adendum=$os->total_adendum
             
               
                ?>

                <?php
                if ($opini == 11 && !empty($retensi_spk)) {
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
                                    <th style="width: 5%;">No</th>
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

                <h6 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                    Nilai Borongan Akhir:
                    <?= "<strong>". $this->pitih->formatrupiah("$nilai_borongan_akhir"). "</strong>" ?><br>
                    <br>
                    <?php
                         $tanggal_awal_spk_obj = new DateTime($tanggal_awal_spk);
                         $tanggal_akhir_spk_obj = new DateTime($tanggal_akhir_spk);
                      
                         $tanggal_akhir_spk_obj->modify('+' . $penambahan_hari . ' days');
                        
                         $tanggal_akhir_spk_sebenarnya = $tanggal_akhir_spk_obj->format('d M Y');

                         $tanggal_input_opname = strtotime($os->tanggal_input_opname);
                         $tanggal_akhir_spk = strtotime($tanggal_akhir_spk_sebenarnya);

                             if ($tanggal_input_opname > $tanggal_akhir_spk) {
                                 $selisih_hari = floor(($tanggal_input_opname - $tanggal_akhir_spk) / (60 * 60 * 24));
                             
                             }
                        ?>
                    Penambahan Hari:

                    <?= "<strong>". $penambahan_hari. ' Hari' . "</strong>"; ?><br>
                    <br>

                    Keterlambatan:

                    <?= "<strong>". $selisih_hari. ' Hari' ."</strong>";  ?><br>
                    <br>
                    Denda:
                    <?php if ($opini == 10) {
                            $denda_akhir=$denda;
                        } else{
                            $denda_akhir=0;

                        } ?>
                    <?= "<strong>". $this->pitih->formatrupiah("$denda_akhir") ."</strong>" ?> <br>
                    <br>
                    Retensi:
                    <?php
                        if ($opini == 11) {
                            $tot_ret = $total_retensi;
                            if ($tot_ret < 0) {
                                $tot_ret = abs($tot_ret); // Hilangkan tanda minus jika $tot_ret negatif
                                // Tampilkan $tot_ret dalam kurung
                                echo "<strong>(" . $this->pitih->formatrupiah("$tot_ret") . ")</strong><br>";
                            } else {
                                echo "<strong>" . $this->pitih->formatrupiah("$tot_ret") . "</strong><br>"; // Tampilkan $tot_ret jika positif atau nol
                            }
                        } else {
                            $tot_ret = 0;
                        }

                        
                        ?>
                    <br>
                    Nilai yang bisa dicairkan : (
                    <?php if ($opini == 3) {
                            echo '30%';
                        } elseif ($opini == 7) {
                            echo '40%';
                        } elseif ($opini == 10) { 
                            echo '25%';
                        } elseif ($opini == 11) {
                            echo '5%';
                        } ?> dari <?= "<strong>". $this->pitih->formatrupiah("$nilai_borongan_akhir"). "</strong>" ?>
                    <?php if($opini==10) { ?>
                    dikurangi denda <?= "<strong>".$this->pitih->formatrupiah("$denda") ."</strong>"?>
                    <?php } ?>
                    <?php if ($opini == 10 && !empty($adendum_spk)) { ?>
                    Adendum: <?= "<strong>". $this->pitih->formatrupiah("$total_adendum") ."</strong>" ?>
                    <?php } ?>
                    )
                    = <?= "<strong>". $this->pitih->formatrupiah("$nilai_pencairan") ."</strong>"?></strong>
                </h6>
                <br>





                <!-- /.row -->


                <!-- /.row -->


                <address style=" text-align: right; font-family: 'Times New Roman' , Times, serif;">
                    Padang Pariaman, <?=date('d M Y'); ?>
                </address>
                <br>
                <br>
                <div class=" table-responsive">


                </div>
                <!-- this row will not appear when printing -->
            </div><!-- /.row -->
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div style="display: flex; justify-content: space-between;">
        <!-- Foto-foto baris pertama -->
        <div style="text-align: center;">
            <div>
                <label for="" class="control-label col">Depan</label>
            </div>
            <div>
                <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $os->foto_depan) ?>"
                    style="max-height: 200px; width: 200px;">
            </div>
        </div>
        <div style="text-align: center;">
            <div>
                <label for="" class="control-label col">Belakang</label>
            </div>
            <div>
                <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $os->foto_belakang) ?>"
                    style="max-height: 200px; width: 200px;">
            </div>
        </div>
        <div style="text-align: center;">
            <div>
                <label for="" class="control-label col">Kanan</label>
            </div>
            <div>
                <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $os->foto_kanan) ?>"
                    style="max-height: 200px; width: 200px;">
            </div>
        </div>
        <div style="text-align: center;">
            <div>
                <label for="" class="control-label col">Kiri</label>
            </div>
            <div>
                <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $os->foto_kiri) ?>"
                    style="max-height: 200px; width: 200px;">
            </div>
        </div>
        <div style="text-align: center;">
            <div>
                <label for="" class="control-label col">Ruang Tamu</label>
            </div>
            <div>
                <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $os->foto_ruang_tamu) ?>"
                    style="max-height: 200px; width: 200px;">
            </div>
        </div>
    </div>
    <br>
    <div style="display: flex; justify-content: space-between;">
        <!-- Foto-foto baris pertama -->
        <div style="text-align: center;">
            <div>
                <label for="" class="control-label col">Kamar 1</label>
            </div>
            <div>
                <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $os->foto_kamar_1) ?>"
                    style="max-height: 200px; width: 200px;">
            </div>
        </div>
        <div style="text-align: center;">
            <div>
                <label for="" class="control-label col">Kamar 2</label>
            </div>
            <div>
                <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $os->foto_kamar_2) ?>"
                    style="max-height: 200px; width: 200px;">
            </div>
        </div>
        <div style="text-align: center;">
            <div>
                <label for="" class="control-label col">Kamar 3</label>
            </div>
            <div>
                <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $os->foto_kamar_3) ?>"
                    style="max-height: 200px; width: 200px;">
            </div>
        </div>
        <div style="text-align: center;">
            <div>
                <label for="" class="control-label col">Kamar Mandi</label>
            </div>
            <div>
                <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $os->foto_kamar_mandi) ?>"
                    style="max-height: 200px; width: 200px;">
            </div>
        </div>
        <div style="text-align: center;">
            <div>
                <label for="" class="control-label col">Dapur</label>
            </div>
            <div>
                <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $os->foto_dapur) ?>"
                    style="max-height: 200px; width: 200px;">
            </div>
        </div>
    </div>




</div>

<br>

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