<div class="card card-default">
    <div class="card-header bg-cyan">
        <h3 class="card-title">Request Opname HPP</h3>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <th class="text-center">No</th>
                <th class="text-center">Request Oleh</th>
                <th class="text-center">Perumahan</th>
                <th class="text-center">Block</th>
                <th class="text-center">Pencairan</th>
                <th class="text-center">Tanggal Pengajuan SPK</th>
                <th class="text-center">Aksi</th>
            </thead>
            <tbody>
                <?php 
                $no = 0;
                foreach ($request as $req) {
                    $no++;
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $req->pengaju_opname ?></td>
                    <td><?= $req->nama_perumahan ?></td>
                    <td><?= $req->nama_blok ?></td>
                    <td><?= $this->pitih->formatrupiah("$req->pencairan") ?></td>
                    <td><?= date('d M Y', strtotime($req->tanggal_input_opname)) ?></td>
                    <td>
                        <a class="btn btn-xs btn-primary"
                            href="<?= site_url('Database_spk/detail_opname_hpp/' . $req->id_stagging_opname_hpp_spk. '') ?>">
                            <i class="fas fa-eye" style="color: whitesmoke"> Detail</i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>