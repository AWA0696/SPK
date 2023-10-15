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

                        <img style="float: left; max-width: 100%; max-height: 150px;"
                            src="<?= base_url('assets/') ?>img/dofla-logo.jpg">
                        <h5 style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                            <strong> PT. DOFLA JAYA PROPERTI <br>
                                DEVELOPER DAN PERDAGANGAN UMUM <br></strong>
                            Jl. Mr. H Sutan Moh. Rasyid Bandara Internasional Minangkabau <br>
                            Kec. Batang Anai Kab. Padang Pariaman <br>
                            Telp. 0751 - 4853235 <br>
                            e-mail:doflajayaproperti@gmail.com <br>

                        </h5>


                        <hr style="border-top: 3px solid black; margin: 20px 0;">
                        <h5 style="text-align: center; font-family: 'Times New Roman', Times, serif;">

                            <strong>ADENDUM</strong><br>

                        </h5>
                        <br>

                        <h5 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                            <?php
                            foreach ($data_spk as $ds) {
                                
                            ?>
                            Pada hari ini, <strong><?=date('d M Y'); ?></strong> yang bertanda-tangan

                            di bawah ini dengan diketahui para saksi yang akan turut menandatangani perjanjian ini:

                            <?php } ?>
                        </h5>
                        <br>
                        <br>
                        <br>
                        <h5 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                            <strong>PIHAK 1 : Doris Flantika</strong>
                        </h5>
                        <br>
                        <h5 style="text-align: left; font-family: 'Times New Roman' , Times, serif;">Bertindak selaku
                            Developer, selanjutnya disebut sebagai: <br>
                            -------------------------------------------- PIHAK PERTAMA. <br>
                            <br>

                            <strong>PIHAK 2 : <?=$ds->nama_konsumen_adendum?></strong><br>

                            <br>
                            Alamat sekarang / di : <i><?=$ds->alamat?></i> <br>


                            Nomor telp rumah / HP : <i><?=$ds->no_telp?></i> <br>
                            <br>
                            Bertindak selaku Konsumen, selanjutnya disebut sebagai :<br>
                            ------------------------------------------------ PIHAK KEDUA.

                        </h5>

                        <br>
                        <br>
                        <h5 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                            Kedua belah pihak telah sepakat mengikatkan diri untuk melakukan <strong>addendum/perubahan/
                                tambahan isi-isi Perjanjian Pendahuluan Jual Beli</strong> dengan ketentuan dan syarat —
                            syarat
                            sebagai berikut :
                        </h5>
                        <h5>
                            <strong style="text-align: left; font-family: 'Times New Roman' , Times, serif;">``
                                <?=$ds->rincian_adendum?> ``</strong>
                        </h5>
                        <br>
                        <h5 style="text-align: left; font-family: 'Times New Roman', Times, serif;">
                            Demikian isi addendum/perubahan/tambahan isi—isi Perjanjian Pendahuluan Jual Beli ini
                            ditandatangani masing - masing pihak dalam keadaan sadar tanpa tekanan dan paksaan dari
                            pihak
                            manapun, dibuat rangkap 2 (dua), dan masing-masing mempunyai kekuatan hukum yang sama.
                        </h5>
                    </div>
                </div>
                <br>
                <br>
                <br>

                <style>
                .float-left,
                .float-right,
                .float-center {
                    float: left;
                    width: 25%;
                    text-align: center;
                }
                </style>
                <h5>
                    <address style=" text-align: right; font-family: 'Times New Roman' , Times, serif;">
                        Padang Pariaman, <strong><?=date('d M Y'); ?></strong>
                    </address>
                </h5>
                <br>
                <br>
                <h5>
                    <div class=" table-responsive">

                        <div class="float-left"
                            style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                            <p>
                                <center><strong></strong></center>
                            </p>
                            <br>
                            <br>
                            <p>
                                <center>
                                    Pihak Kedua <br>
                                    Konsumen<br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    (<?=$ds->nama_konsumen_adendum?>)
                                </center>
                            </p>
                        </div>
                        <div class="float-right"
                            style="text-align: center; font-family: 'Times New Roman', Times, serif;">
                            <p>
                                <center><strong></strong></center>
                            </p>
                            <br>
                            <br>
                            <p>
                                <center>
                                    Pihak Pertama <br>
                                    Doveloper<br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    (Doris Flantika, SE)
                                </center>
                            </p>
                        </div>

                    </div>
                </h5>
                <div class="row">
                </div>
                <br>
                <br>
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