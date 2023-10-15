<div class="card card-default">

    <div class="card-header bg-cyan">
        <h3 class="card-title">Request Opname Lain-Lain</h3>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <th class="text-center">No</th>
                <th class="text-center">Request Oleh</th>
                <th class="text-center">Perumahan</th>
                <th class="text-center">Block</th>
                <th class="text-center">Opini</th>
                <th class="text-center">Tanggal Pengajuan Opname</th>
                <th class="text-center">Aksi</th>
            </thead>
            <tbody>
                <?php 
                $no = 0;
                foreach ($request as $req) {
                    $no++;
                    $opini = $req->opini; // Nilai opini
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
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $req->pengaju_opname ?></td>
                    <td><?= $req->nama_perumahan ?></td>
                    <td><?= $req->nama_blok ?></td>
                    <td><?= $persentase ?></td>
                    <td><?= date('d M Y', strtotime($req->tanggal_input_opname)) ?></td>
                    <td>
                        <a class="btn btn-xs btn-primary"
                            href="<?= site_url('Database_spk/detail_opname_lain2/' . $req->id_stagging_opname_lain2_spk. '') ?>">
                            <i class="fas fa-eye" style="color: whitesmoke"> Detail</i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>