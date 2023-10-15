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
            <div class="invoice p-3 mb-3">
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
                            $denda=0;
                            $selisih_hari=0;
                            $total_denda=0;
                            $total_retensi=0;
                            

                            foreach ($spk as $row) {
                                $opini = $row->opini; // Nilai opini
                                // $persentase = $opini * 10 . '%';
                                
                                $persentase = '';
                                if ($opini == 3) {
                                    $persentase = '30%';
                                } elseif ($opini == 7) {
                                    $persentase = '70%';
                                } elseif ($opini == 10) {
                                    $persentase = '100%';
                                } elseif ($opini == 11) {
                                    $persentase = 'Retensi';
                                } // Menghitung persentase// Menghitung persentase
                                $nilai_borongan = $row->nilai_borongan; // Nilai borongan
                                
                                $tanggal_awal_spk = $row->tanggal_awal_spk; 
                                $tanggal_akhir_spk = $row->tanggal_akhir_spk;
                                $penambahan_hari = $row->penambahan_hari; 
                           
                               
                                        

                            ?>
                            Dengan ini saya: <?= $row->pengaju_opname ?> <br>
                            Jabatan: Arsitek <br>
                            Kontraktor: <?="<strong>". $row->nama_kontraktor ."</strong>"?><br>
                            Tanggal Akhir SPK:
                            <?= "<strong>". date('d M Y', strtotime($tanggal_akhir_spk)) ."</strong>"?><br>
                            <br>
                            <br>

                            Telah melakukan pengecekan pembangunan PT.Dofla Jaya Properti pada tanggal
                            <strong><?= $row->tanggal_input_opname ?></strong> untuk digunakan dalam rangka pemberian
                            produk terbaik kepada konsumen. <br>
                            <br>

                            Dalam hal ini didapatkan Pembangunan rumah di<strong> <?= $row->nama_perumahan ?>
                                (<?= $row->nama_blok ?> <?= $persentase ?>)</strong> kesiapan bangunan <strong> Wajar
                                Tanpa pengecualian</strong>. Dengan ini menyatakan bahwa pencairan dana sudah bisa di
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
                                    <th>Perumahan</th>
                                    <th>Blok</th>
                                    <th>Type</th>
                                    <th>Nilai Borongan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($spk as $p) { ?>
                                <tr>
                                    <td><?= $p->nama_perumahan ?></td>
                                    <td><?= $p->nama_blok ?></td>
                                    <td><?= $p->type_perumahan ?></td>
                                    <td><?= $this->pitih->formatrupiah("$p->nilai_borongan") ?></td>
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

                <p class="rincian-text"><?= $p->rincian ?></p>

                <?php
                   
                    $nilai_borongan_akhir = $nilai_borongan; // Inisialisasi nilai borongan akhir

                    if (!empty($biaya_spk)) {
                        // If $adendum_spk is not empty
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
                                // If $adendum_spk is not empty
                                $no = 0;

                                foreach ($biaya_spk as $bs) {
                                    $no++;
                                    $opini = $row->opini; // Nilai opini

                                    if ($bs->koreksi == 1) {
                                        // Penambahan
                                        $nilai_borongan_akhir += $bs->jumlah;
                                    } else {
                                        // Pengurangan
                                        $nilai_borongan_akhir -= $bs->jumlah;
                                    }

                                    // Menampilkan informasi pada $adendum_spk
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
                                    <td><?= $this->pitih->formatrupiah("$bs->jumlah") ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                }

                    // Initialize the variable outside the condition
                 // Inisialisasi nilai borongan akhir setelah biaya

                if ($opini == 10 && !empty($adendum_spk)) {
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
                                        if ($as->koreksi_adendum == 2) {
                                            echo "(" . $this->pitih->formatrupiah($as->jumlah_adendum) . ")";
                                        } else {
                                            echo $this->pitih->formatrupiah($as->jumlah_adendum);
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                    }
               
                if (!empty($biaya_spk)) {
                    // If $adendum_spk is not empty 
                    if ($opini == 3) {
                        $nilai_pencairan = $nilai_borongan_akhir * 0.3; // Pencairan = nilai_borongan * 30%
                    } elseif ($opini == 7) {
                        $nilai_pencairan = $nilai_borongan_akhir * 0.4; // Pencairan = nilai_borongan * 40%
                    } elseif ($opini == 10) {
                        $nilai_pencairan = $nilai_borongan_akhir * 0.25; // Pencairan = nilai_borongan * 25%
                    } elseif ($opini == 11) {
                        $nilai_pencairan = $nilai_borongan_akhir * 0.05; // Pencairan = nilai_borongan * opini / 5%
                    }
                }  else {
                  
                    if ($opini == 3) {
                        $nilai_pencairan = $nilai_borongan * 0.3; // Pencairan = nilai_borongan * 30%
                    } elseif ($opini == 7) {
                        $nilai_pencairan = $nilai_borongan * 0.4; // Pencairan = nilai_borongan * 40%
                    } elseif ($opini == 10) {
                        $nilai_pencairan = $nilai_borongan * 0.25; // Pencairan = nilai_borongan * 25%
                    } elseif ($opini == 11) {
                        $nilai_pencairan = $nilai_borongan * 0.05; // Pencairan = nilai_borongan * opini / 5%
                    }
                } 
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
               
                if  (!empty($adendum_spk)) {
                $nba= $nilai_borongan_akhir;
                }  elseif(!empty($nilai_borongan_akhir)) {
                    $nba=$nilai_borongan_akhir;
                }else{

                    $nba=$nilai_borongan;
                }

                if  ($opini == 10 && !empty($adendum_spk)) {
                    $nbad= $nilai_borongan_akhir+$total_adendum;
                    }  elseif(!empty($nilai_borongan_akhir)) {
                        $nbad=$nilai_borongan_akhir;
                    }else{
    
                        $nbad=$nilai_borongan;
                    }

                if ($opini == 10 && !empty($adendum_spk)) { 
                    $nilai_pencairan += $total_adendum;
                }
                
                ?>
                <h6 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                    Nilai Borongan Ahkir: <?= "<strong>". $this->pitih->formatrupiah("$nba")."</strong>" ?><br>
                    <br>
                    <?php
                         $tanggal_awal_spk_obj = new DateTime($tanggal_awal_spk);
                         $tanggal_akhir_spk_obj = new DateTime($tanggal_akhir_spk);
                      
                         $tanggal_akhir_spk_obj->modify('+' . $penambahan_hari . ' days');
                        
                         $tanggal_akhir_spk_sebenarnya = $tanggal_akhir_spk_obj->format('d M Y');

                         $tanggal_input_opname = strtotime($row->tanggal_input_opname);
                         $tanggal_akhir_spk = strtotime($tanggal_akhir_spk_sebenarnya);

                             if ($tanggal_input_opname > $tanggal_akhir_spk) {
                                 $selisih_hari = floor(($tanggal_input_opname - $tanggal_akhir_spk) / (60 * 60 * 24));
                                 $denda = $selisih_hari * (0.005 * $nbad);
                                 $total_denda += $denda;
                             }
                        ?>
                    Penambahan Hari:
                    <?php if ($opini == 10) {
                            $ph=$penambahan_hari;
                        } else{
                            $ph=0;

                        } ?>
                    <?= "<strong>". $ph. ' Hari'."</strong>";  ?><br>
                    <br>
                    Keterlambatan:
                    <?php if ($opini == 10) {
                            $sh=$selisih_hari;
                        } else{
                            $sh=0;

                        } ?>
                    <?="<strong>". $sh. ' Hari'."</strong>";  ?><br>
                    <br>
                    Denda:
                    <?php if ($opini == 10) {
                            $denda_akhir=$denda;
                        } else{
                            $denda_akhir=0;

                        } ?>
                    <?=  "<strong>".$this->pitih->formatrupiah("$denda_akhir")."</strong>" ?> <br>
                    <br>

                    Retensi:
                    <?php if ($opini == 11) {
                            $tr=$total_retensi;
                        } else{
                            $tr=0;

                        } ?>
                    <?=  "<strong>".$this->pitih->formatrupiah("$tr")."</strong>" ?> <br>


                    <br>

                    Pencairan Opini <?= $persentase ?> =
                    (
                    <?php if ($opini == 3) {
                            echo '30%';
                        } elseif ($opini == 7) {
                            echo '40%';
                        } elseif ($opini == 10) {
                            echo '25%';
                        } elseif ($opini == 11) {
                            echo '5%';
                        } ?> dari <?= "<strong>".$this->pitih->formatrupiah("$nba") ."</strong>"?>,
                    <?php if($opini==10) { ?>
                    dikurangi denda <?="<strong>".$this->pitih->formatrupiah("$denda")."</strong>"?>
                    <?php } ?>

                    <?php if($opini==11 && !empty($retensi_spk)) { ?>
                    Retensi <?="<strong>".$this->pitih->formatrupiah("$total_retensi")."</strong>"?>
                    <?php } ?>

                    <?php if ($opini == 10 && !empty($adendum_spk)) { ?>
                    Adendum: <?="<strong>". $this->pitih->formatrupiah("$total_adendum"). "</strong>"?> di kurang Denda
                    <?="<strong>". $this->pitih->formatrupiah("$denda_akhir")."</strong>" ?>
                    <?php } ?>
                    ) =

                    <?php

                       
                       $pencairan_ahkir = $nilai_pencairan - $denda_akhir;

                     
                           if ($tr < 0) {
                               $pencairan_ahkir -= abs($tr); // Mengurangi nilai $pencairan_ahkir jika $tr negatif
                           } elseif ($tr > 0) {
                               $pencairan_ahkir += $tr; // Menambahkan nilai $total_retensi ke $pencairan_ahkir jika $total_retensi positif
                           }
                      
                        ?>
                    <?= "<strong>".$this->pitih->formatrupiah("$pencairan_ahkir"). "</strong>"?>
                </h6>

                <br>
                <br>
                <br>
                <br>
                <address style=" text-align: right; font-family: 'Times New Roman' , Times, serif;">
                    Padang Pariaman, <?=date('d M Y'); ?>
                </address>
                <!-- /.row -->

                <div style="display: flex; justify-content: space-between;">
                    <!-- Foto-foto baris pertama -->
                    <div style="text-align: center;">
                        <div>
                            <label for="" class="control-label col">Depan</label>
                        </div>
                        <div>
                            <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $row->foto_depan) ?>"
                                style="max-height: 200px; width: 200px;">
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <div>
                            <label for="" class="control-label col">Belakang</label>
                        </div>
                        <div>
                            <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $row->foto_belakang) ?>"
                                style="max-height: 200px; width: 200px;">
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <div>
                            <label for="" class="control-label col">Kanan</label>
                        </div>
                        <div>
                            <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $row->foto_kanan) ?>"
                                style="max-height: 200px; width: 200px;">
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <div>
                            <label for="" class="control-label col">Kiri</label>
                        </div>
                        <div>
                            <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $row->foto_kiri) ?>"
                                style="max-height: 200px; width: 200px;">
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <div>
                            <label for="" class="control-label col">Ruang Tamu</label>
                        </div>
                        <div>
                            <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $row->foto_ruang_tamu) ?>"
                                style="max-height: 200px; width: 200px;">
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between;">
                    <!-- Foto-foto baris pertama -->
                    <div style="text-align: center;">
                        <div>
                            <label for="" class="control-label col">Kamar 1</label>
                        </div>
                        <div>
                            <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $row->foto_kamar_1) ?>"
                                style="max-height: 200px; width: 200px;">
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <div>
                            <label for="" class="control-label col">Kamar 2</label>
                        </div>
                        <div>
                            <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $row->foto_kamar_2) ?>"
                                style="max-height: 200px; width: 200px;">
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <div>
                            <label for="" class="control-label col">Kamar 3</label>
                        </div>
                        <div>
                            <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $row->foto_kamar_3) ?>"
                                style="max-height: 200px; width: 200px;">
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <div>
                            <label for="" class="control-label col">Kamar Mandi</label>
                        </div>
                        <div>
                            <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $row->foto_kamar_mandi) ?>"
                                style="max-height: 200px; width: 200px;">
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <div>
                            <label for="" class="control-label col">Dapur</label>
                        </div>
                        <div>
                            <img src="<?= base_url('../spk/upload_spk/foto_opname/' . $row->foto_dapur) ?>"
                                style="max-height: 200px; width: 200px;">
                        </div>
                    </div>
                </div>
                <br>



                <!-- this row will not appear when printing -->



                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>