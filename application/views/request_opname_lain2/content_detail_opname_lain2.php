<a onclick="window.location=document.referrer;" class="btn btn-info btn-icon-split ml-2">
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
                            $masukan_angka=0;
                            

                            foreach ($spk as $row) {
                                $opini = $row->opini; // Nilai opini
                                $persentase = $opini * 10 . '%';
                                $satuan= $row->satuan;
                               
                                $nilai_borongan = $row->nilai_borongan; // Nilai borongan
                                
                                $tanggal_awal_spk = $row->tanggal_awal_spk; 
                                $tanggal_akhir_spk = $row->tanggal_akhir_spk;
                                $penambahan_hari = $row->penambahan_hari; 
                                $masukan_angka=$row->masukan_angka;

                               
                               
                           $satuanakhir='';
                                if($satuan == 1){
                            $satuanakhir = 'm';
                         } elseif($satuan == 2 ){
                            $satuanakhir = 'm²';
                         } elseif($satuan == 3 ){
                           
                            $satuanakhir = 'm³';
                         }elseif($satuan == 4 ){
                           
                            $satuanakhir = 'Kavling';
                         }elseif($satuan == 5 ){
                           
                            $satuanakhir = 'Unit';
                         }

                                        

                            ?>
                            Dengan ini saya: <?= $row->pengaju_opname ?> <br>
                            Jabatan: Arsitek <br>
                            Kontraktor: <?= $row->nama_kontraktor ?><br>
                            Tanggal Akhir SPK: <?= date('d M Y', strtotime($tanggal_akhir_spk)) ?><br>
                            <br>
                            <br>

                            Telah melakukan pengecekan pembangunan PT.Dofla Jaya Properti pada tanggal
                            <strong><?= $row->tanggal_input_opname ?></strong> untuk digunakan dalam rangka pemberian
                            produk terbaik kepada konsumen. <br>
                            <br>

                            Dalam hal ini didapatkan <?= $row->rincian_opname_lain2 ?><br>
                            <strong><?=$persentase?></strong>
                            Kesiapan bangunan <strong> Wajar
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
                <br>
                <br>





                <h6 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                    <strong>Nilai Borongan Ahkir: <br>

                        <?php if ($opini >= 1 && $opini <= 9) {
                                $nilai_pencairan = $nilai_borongan * ($opini / 10);
                            } else {
                                $nilai_pencairan = $nilai_borongan;
                            }
                    ?>

                        <?php
                    $nilai_pencairan_akhir=$nilai_pencairan*$masukan_angka;
                    ?>
                        <?=$masukan_angka?><?=$satuanakhir?> x <?=$this->pitih->formatrupiah("$nilai_pencairan")?> =

                        <?=$this->pitih->formatrupiah("$nilai_pencairan_akhir")?>



                    </strong>
                </h6>

                <br>
                <br>
                <br>
                <br>
                <address style=" text-align: right; font-family: 'Times New Roman' , Times, serif;">
                    Padang Pariaman, <?=date('d M Y'); ?>
                </address>
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



                <br>
                <br>
                <div class=" table-responsive">


                </div>
                <!-- this row will not appear when printing -->

            </div>
            <div class="form-group">
                <a class="btn btn-primary btn-icon-split"
                    href="<?= base_url('Spv_operasional/aprove_opname_lain2/') . $row->id_stagging_opname_lain2_spk. '?nilai_pencairan_akhir=' . $nilai_pencairan_akhir ?>"
                    <i class="fas fa-save"></i>
                    <span class="text">
                        TERIMA
                    </span>
                </a>

                <a type="button" class="btn btn-danger btn-icon-split"
                    href="<?= base_url("Spv_operasional/reject_opname_lain2/"). $row->id_stagging_opname_lain2_spk?>">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">
                        TOLAK
                    </span>
                </a>
            </div>
            <!-- /.invoice -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>