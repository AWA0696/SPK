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


                        <h4 style="text-align: left; font-family: 'Times New Roman', Times, serif;">

                            <strong>Detail Retensi</strong><br>

                        </h4>
                        <hr style="border-top: 3px solid black; margin: 20px 0;">
                        <br>

                        <h5 style="text-align: left; font-family: 'Times New Roman', Times, serif;">

                            Rincian: <?= $detail_retensi->rincian_retensi ?> <br>
                            Tanggal Input:
                            <?= "<strong>".date('d M Y', strtotime($detail_retensi->tanggal_input_retensi))."</strong>" ?><br>

                            <br>
                            <br>


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
                            $total_retensi = 0;
                            $total_penambahan = 0;
                            $total_pengurangan = 0;

                            foreach ($biaya_retensi as $as) {
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
                <br>
                <address style=" text-align: right; font-family: 'Times New Roman' , Times, serif;">
                    Padang Pariaman, <?=date('d M Y'); ?>
                </address>
                <br>
                <br>
                <div class=" table-responsive">
                </div>
            </div><!-- /.row -->
        </div>
    </div>
</div>

<br>

<!-- <div class="row no-print">
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
</script> -->