<a onclick="window.location=document.referrer;" class="btn btn-info btn-icon-split mb-2 ml-2">
    <span class="icon text-white-50">
        <i class="fas fa-caret-square-left"></i>
    </span>
    <span class="text">Kembali</span>
</a>
<div class="card card-default">
    <div class="card-header bg-cyan">
        <h3 class="card-title">Rincian Penambahan Hari</h3>
    </div>
    <div class="card-body table-responsive">
        </form>
        <table id="example1" class="table table-bordered table-striped ">
            <thead>

                <th class="text-center">No</th>
                <th class="text-center">Tanggal Input</th>
                <th class="text-center">Tangal Awal</th>
                <th class="text-center">Tangal Akhir</th>
                <th class="text-center">Penambahan Hari</th>
                <th class="text-center">Keterangan</th>

            </thead>
            <tbody>
                <?php
                    $no = 0;
                foreach ($rincian as $req) {
                    $no++;
                ?>
                <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td class="text-center"><?= date('d M Y', strtotime($req->tanggal_input)) ?></td>
                    <td class="text-center"><?= date('d M Y', strtotime($req->tgl_awal_penhari)) ?></td>
                    <td class="text-center"><?= date('d M Y', strtotime($req->tgl_akhir_penhari)) ?></td>
                    <td class="text-center"><?= $req->penambahan_hari?></td>
                    <td class="text-center"><?= $req->ket_penam_hari?></td>

                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>