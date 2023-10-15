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
                                $total_denda=0;

                            foreach ($spk as $row) {
                              
                                $nilai_borongan = $row->nilai_borongan;  
                                $tanggal_awal_spk = $row->tanggal_awal_spk; 
                                $tanggal_akhir_spk = $row->tanggal_akhir_spk;
                                $penambahan_hari = $row->penambahan_hari; 
                            ?>
                            Dengan ini saya: <?= $row->pengaju_opname ?> <br>
                            Jabatan: Arsitek <br>
                            Kontraktor: <?= "<strong>". $row->nama_kontraktor ."</strong>" ?><br>
                            Tanggal Akhir SPK:
                            <?= "<strong>". date('d M Y', strtotime($tanggal_akhir_spk)) ."</strong>" ?><br>
                            <br>
                            <br>

                            Telah melakukan pengecekan pembangunan PT.Dofla Jaya Properti pada tanggal
                            <strong><?= $row->tanggal_input_opname ?></strong> untuk digunakan dalam rangka pemberian
                            produk terbaik kepada konsumen. <br>
                            <br>

                            Dalam hal ini didapatkan Pembangunan rumah di<strong> <?= $row->nama_perumahan ?>
                                (<?= $row->nama_blok ?> )</strong> kesiapan bangunan <strong> Wajar
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
                                    <th>Konsumen</th>
                                    <th>Perumahan</th>
                                    <th>Blok</th>
                                    <th>Type</th>
                                    <th>Nilai Borongan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($spk as $p) { ?>
                                <tr>
                                    <td><?= $p->nama_konsumen ?></td>
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
                                    <th>No</th>
                                    <th>Penambahan / Pengurangan</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // If $adendum_spk is not empty
                                $no = 0;
                                $total_biaya=0;
                                foreach ($biaya_spk as $bs) {
                                    $no++;
                                   // Nilai opini

                                    if ($bs->koreksi == 1) {
                                        // Penambahan
                                      
                                        $total_biaya += $bs->jumlah;
                                    } else {
                                        // Pengurangan
                                       
                                        $total_biaya -= $bs->jumlah;
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

                if ( !empty($adendum_spk)) {
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
                                    <th>No</th>
                                    <th>Penambahan / Pengurangan</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
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
                                    <td><?= $this->pitih->formatrupiah("$as->jumlah_adendum") ?></td>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                    }
                // Calculate $nilai_pencairan based on conditions
              $nilai_pencairan=$row->pencairan;
          
                ?>

                <?php
                // Calculate $nilai_pencairan based on conditions
                
                    if (!empty($biaya_spk) && !empty($adendum_spk)) {
                        $nba = $nilai_borongan_akhir + $total_adendum + $total_biaya;
                    } elseif (!empty($biaya_spk)) {
                        $nba = $nilai_borongan_akhir + $total_biaya;
                    } elseif(!empty($adendum_spk)) {
                        $nba = $nilai_borongan_akhir + $total_adendum;
                    } else {

                        $nba = $nilai_borongan;
                    }

                    if (!empty($biaya_spk) && !empty($adendum_spk)) {
                        $nilai_pencairan_akhir = $nilai_pencairan + $total_adendum + $total_biaya;
                    } elseif (!empty($biaya_spk)) {
                        $nilai_pencairan_akhir = $nilai_pencairan + $total_biaya;
                    } elseif(!empty($adendum_spk)) {
                        $nilai_pencairan_akhir = $nilai_pencairan + $total_adendum;
                    } else {

                        $nilai_pencairan_akhir= $row->pencairan;
                    }
               
                ?>
                <h6 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                    Nilai Borongan Ahkir: <?= "<strong>". $this->pitih->formatrupiah("$selisih_spk")."</strong>" ?><br>

                    <?php
                         $tanggal_awal_spk_obj = new DateTime($tanggal_awal_spk);
                         $tanggal_akhir_spk_obj = new DateTime($tanggal_akhir_spk);
                      
                         $tanggal_akhir_spk_obj->modify('+' . $penambahan_hari . ' days');
                        
                         $tanggal_akhir_spk_sebenarnya = $tanggal_akhir_spk_obj->format('d M Y');

                         $tanggal_input_opname = strtotime($row->tanggal_input_opname);
                         $tanggal_akhir_spk = strtotime($tanggal_akhir_spk_sebenarnya);

                             if ($tanggal_input_opname > $tanggal_akhir_spk) {
                                 $selisih_hari = floor(($tanggal_input_opname - $tanggal_akhir_spk) / (60 * 60 * 24));
                                 $denda = $selisih_hari * (0.005 * $nba);
                                 $total_denda += $denda;
                             }

                             $nbad=$nilai_pencairan_akhir-$total_denda;
                        ?>
                    <br>


                    Penambahan/Pengurangan:

                    <?php
                            if (!empty($biaya_spk)) {
                                echo "<strong>". $this->pitih->formatrupiah($total_biaya)."</strong>";
                            } else {
                                echo "<strong>".$this->pitih->formatrupiah(0). "</strong>";
                            }
                            
                            ?>
                    <br>
                    <br>

                    Adendum:

                    <?php
                            if (!empty($adendum_spk)) {
                                echo "<strong>".$this->pitih->formatrupiah($total_adendum)."</strong>";
                            } else {
                                echo "<strong>".$this->pitih->formatrupiah(0)."</strong>";
                            }
                            ?>
                    <br>
                    <br>

                    Denda:
                    <?php
                            if (!empty($total_denda)) {
                                echo"<strong>". $this->pitih->formatrupiah($total_denda)."</strong>";
                            } else {
                                echo "<strong>".$this->pitih->formatrupiah(0)."</strong>";
                            }
                            
                            ?> <br>
                    <br>
                    Nilai pencairan yang diajukan :
                    <?= "<strong>".$this->pitih->formatrupiah("$row->pencairan") ."</strong>"?><br>
                    <br>
                    Nilai yang bisa dicairkan = <?="<strong>". $this->pitih->formatrupiah("$nbad")."</strong>" ?><br>





                </h6>
                <br>
                <br>
                <br>
                <br>


                <!-- /.row -->


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

                <address style=" text-align: right; font-family: 'Times New Roman' , Times, serif;">
                    Padang Pariaman, <?=date('d M Y'); ?>
                </address>
                <br>
                <br>
                <div class=" table-responsive">


                </div>
                <!-- this row will not appear when printing -->

            </div>

            <!-- /.invoice -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>