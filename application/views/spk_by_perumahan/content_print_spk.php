<a onclick="window.location=document.referrer;" class="btn btn-info btn-icon-split ml-4">
    <span class="icon text-white-50">
        <i class="fas fa-caret-square-left"></i>
    </span>
    <span class="text">Kembali</span>
</a>
<div id="div1" class="container-fluid" style="text-align: center; font-family: 'Times New Roman', Times, serif;">
    <div class="row">
        <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h5 style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                            <img src="<?= base_url('assets/img/dofla-logo.jpg') ?>"
                                style="max-width: 100px; float: left;">

                            <div style="text-align: center;">
                                <strong>PT.DOFLA JAYA PROPERTI</strong><br>
                                <strong>DEVELOPER DAN PERDAGANGAN UMUM</strong>
                            </div>

                            <div style="text-align: center;">
                                Jl. Mr.H Sutan Moh. Rasyid Bandara Internasional Minang Kabau,<br>
                                Kec. Batang Anai, Kab. Padang Pariaman<br>
                                Telepon: (0751) 4853235 <br>
                                Email: doflajayaproperti@gmail.com
                            </div>
                        </h5>
                        <hr style="border-top: 3px solid black; margin: 20px 0;">
                        <h4 style="text-align: center; font-family: 'Times New Roman', Times, serif;">

                            <strong>SURAT PERINTAH KERJA</strong><br>

                        </h4>

                        <h4 style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                            <?php foreach ($print as $row) { ?>

                            Saya yang bernama Doris Flantika memberikan Surat Perintah Kerja kepada
                            <?="<strong>".$row->nama_kontraktor."</strong>"?><br> untuk mengerjakan pembangunan di
                            <?="<strong>".$row->nama_perumahan ."</strong>"?>, dengan rincian sebagai berikut:
                            <?php } ?>
                        </h4>
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
                                    <th>Tanggal Awal SPK</th>
                                    <th>Tanggal Akhir SPK</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($print as $p) { ?>
                                <tr>
                                    <td><?=$p->nama_perumahan?></td>
                                    <td><?=$p->nama_blok?></td>
                                    <td><?=$p->type_perumahan?></td>
                                    <td><?= $this->pitih->formatrupiah("$p->nilai_borongan") ?></td>
                                    <td class="text-nowrap">
                                        <?php echo date('d M Y', strtotime($p->tanggal_awal_spk));  ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <?php echo date('d M Y', strtotime($p->tanggal_akhir_spk));  ?>
                                    </td>

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


                <?php if (!empty($biaya_spk)) { ?>
                <h6 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                    <strong> Penambahan/Pengurangan</strong>
                </h6>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered"
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
                                $nilai_borongan_akhir = $p->nilai_borongan; // Inisialisasi nilai borongan akhir
                                foreach ($biaya_spk as $bs) {
                                    $no++;
                                    // Perhitungan operasi aritmatika
                                    if ($bs->koreksi == 1) {
                                        // Penambahan
                                        $nilai_borongan_akhir += $bs->jumlah;
                                    } else {
                                        // Pengurangan
                                        $nilai_borongan_akhir -= $bs->jumlah;
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
                                    <td><?= $this->pitih->formatrupiah("$bs->jumlah") ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <h6 style="text-align: left; font-family: 'Times New Roman', Times, serif;"">
                            <strong> Nilai Borongan Ahkir: <?= $this->pitih->formatrupiah("$nilai_borongan_akhir") ?>
                            </strong>
                        </h6>
                    </div>
                </div>
                        <?php } else { ?>
               
                        <h6 style=" text-align: left; font-family: 'Times New Roman' , Times, serif;">
                            <strong>Nilai Borongan Ahkir: <?= $this->pitih->formatrupiah($p->nilai_borongan) ?></strong>
                        </h6>
                        <?php } ?>

                        <br>
                        <br>
                        <br>
                        <br>



                        <!-- /.row -->


                        <!-- /.row -->
                        <style>
                        .float-right,
                        .float-center,
                        .float-left {
                            float: left;
                            float: center;
                            float: right;
                            width: 30%;
                            text-align: center;
                        }
                        </style>
                        <address style=" text-align: right; font-family: 'Times New Roman' , Times, serif;">
                            Padang Pariaman, <?=date('d M Y'); ?>
                        </address>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class=" table-responsive">

                            <div class="float-center"
                                style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                                <p>
                                    <center><strong></strong></center>
                                </p>
                                <br>
                                <br>
                                <p>
                                    <center>
                                        <?=$row->nama_kontraktor?> <br>
                                        (Kontraktor)
                                    </center>
                                </p>
                            </div>


                            <div class="float-center"
                                style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                                <p>
                                    <center><strong></strong></center>
                                </p>
                                <br>
                                <br>
                                <p>
                                    <center>
                                        Uci Nindia Risa <br>
                                        (Admin)
                                    </center>
                                </p>
                            </div>
                            <div class="float-center"
                                style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                                <p>
                                    <center><strong></strong></center>
                                </p>
                                <br>
                                <br>
                                <p>
                                    <center>
                                        Indah Utami Sri Wahyuni<br>
                                        (SPV Operasional)
                                    </center>
                                </p>
                            </div>
                        </div>
                        <!-- this row will not appear when printing -->

                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        <div class="row no-print">
            <div class="col-12">
                <button onclick="printContent('div1')" target="_blank" class="btn btn-primary btn-lg ml-4"><i
                        class="fas fa-print"></i> Print</button>
                <!-- <a href="<?= base_url('Database_spk/edit_spk/' . $row->id_table_spk) ?>"
                    class="btn btn-warning btn-lg ml-4"><i class="fas fa-pen"></i> Edit</a> -->
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