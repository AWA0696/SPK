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
                                $masukan_angka=0;


                                foreach ($opname_spk as $row) {
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
                            Kontraktor: <?= "<strong>" . $row->nama_kontraktor ."</strong>"?><br>
                            Tanggal Akhir SPK:
                            <?= "<strong>" .date('d M Y', strtotime($tanggal_akhir_spk))."</strong>" ?><br>
                            <br>
                            <br>

                            Telah melakukan pengecekan pembangunan PT.Dofla Jaya Properti pada tanggal
                            <strong><?= $row->tanggal_input_opname ?></strong> untuk digunakan dalam rangka pemberian
                            produk terbaik kepada konsumen. <br>
                            <br>

                            Dalam hal ini didapatkan <?= $row->rincian_opname_lain2 ?>
                            <strong><?=$persentase?></strong>
                            kesiapan bangunan <strong> Wajar Tanpa pengecualian</strong>. <br>
                            Dengan ini menyatakan bahwa
                            pencairan dana sudah bisa di
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
                                <?php foreach ($opname_spk as $p) { ?>
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
                            $nilai_pencairan_akhir=$row->pencairan;
                            ?>
                        <?=$masukan_angka?><?=$satuanakhir?> x <?=$this->pitih->formatrupiah("$nilai_pencairan")?> =

                        <?=$this->pitih->formatrupiah("$nilai_pencairan_akhir")?>



                    </strong>
                </h6>
                <br>
                <br>
                <br>
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
</div>
<br>
<br>
<br>
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