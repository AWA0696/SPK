    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header bg-light m-0 font-weight-bold text-white">
                <a onclick="location.href = ('<?php echo site_url('Database_spk/perumahan/') ?>')"
                    class="btn btn-info btn-icon-split mb-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-caret-square-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>

            <div class="card-header bg-info">
                <h6 class="m-0 font-weight-bold text-white">Pilih Perumahan</h6>
            </div>

            <div class="card-body">
                <div class="row-12 table-responsive">
                    <table id="datatables" class="table table-bordered ">
                        <thead>
                            <tr class="bg-light m-0 font-weight-bold text-dark" style="text-align: center;">
                                <th width="10%">No</th>

                                <th width="20%">Nama Perumahan </th>
                                <th width="10%">Block </th>
                                <th width="10%">Type</th>
                                <th width="20%">Jenis SPK</th>
                                <th width="20%">Nilai Borongan </th>
                                <th width="10%">Sisa Borongan </th>
                                <th width="10%">Tanggal Mulai SPK</th>
                                <th width="10%">Nama Kontraktor</th>
                                <th width="10%">Penambahan Hari</th>
                                <th width="10%">Tanggal Akhir SPK</th>
                                <th width="10%">Rincian</th>
                                <th width="10%">Aksi</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                    //data loopingan
                                $no = 0; 
                                foreach ($tampil as $t) {
                            
                                    $no++ ;
                                    $id_table_spk = $t->id_table_spk; 
                                    $tanggal_awal_spk = $t->tanggal_awal_spk; // Ambil tanggal awal SPK dari data loopingan
                                    $tanggal_akhir_spk = $t->tanggal_akhir_spk;
                                    if (!empty($t->total_penambahan_hari)) {
                                        $penambahan_hari = $t->total_penambahan_hari; }
                                        else{$penambahan_hari = 0;} // Ambil penambahan hari dari data loopingan
                                    
                                    // Mengubah tanggal_awal_spk dan tanggal_akhir_spk menjadi objek DateTime
                                    $tanggal_awal_spk_obj = new DateTime($tanggal_awal_spk);
                                    $tanggal_akhir_spk_obj = new DateTime($tanggal_akhir_spk);
                                    
                                    // Menambahkan jumlah hari ke tanggal_akhir_spk
                                    $tanggal_akhir_spk_obj->modify('+' . $penambahan_hari . ' days');
                                    
                                    // Mengubah tanggal_akhir_spk_sebenarnya menjadi format yang diinginkan
                                    $tanggal_akhir_spk_sebenarnya = $tanggal_akhir_spk_obj->format('d M Y');

                                    $table_spk = $this->db->get_where("table_spk", ["id_table_spk" => $id_table_spk])->row();
                                    $nilai_borongan_spk = $table_spk->nilai_borongan;
                                    
                                    //Total Biaya Adendum
                                    $jumlah_biaya_spk=0;
                                    $biaya_spk_koreksi = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 1])->row();
                                    $biaya_spk_pengurangan = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 2])->row();

                                
                                    $jumlah_biaya_spk += ($biaya_spk_koreksi->jumlah ?? 0);
                                    $jumlah_biaya_spk -= ($biaya_spk_pengurangan->jumlah ?? 0);

                                    //Total Biaya Adendum
                                
                                    $biaya_adendum_spk_koreksi = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 1])->row();
                                    $biaya_adendum_spk_pengurangan = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 2])->row();

                                    $jumlah_biaya_adendum_spk=0;
                                    $jumlah_biaya_adendum_spk += ($biaya_adendum_spk_koreksi->jumlah_adendum ?? 0);
                                    $jumlah_biaya_adendum_spk -= ($biaya_adendum_spk_pengurangan->jumlah_adendum ?? 0);
                                

                                    //Total Denda
                                    $denda = $this->db->select_sum("denda")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
                                    $total_denda = $denda->denda;
                                
                                    if (empty($total_denda)) {
                                        $total_denda = 0;
                                    }

                                    $nilai_borongan_spk_akhir= $nilai_borongan_spk+$jumlah_biaya_spk+$jumlah_biaya_adendum_spk;

                                    // Mengambil total pencairan dari tabel opname_hpp_spk
                                    $total_pencairan = $this->db->select_sum("pencairan")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
                                
                                    $total_pencairan_spk = $total_pencairan->pencairan;

                                    // Menghitung selisih_spk
                                    $selisih_spk =$nilai_borongan_spk_akhir- $total_pencairan_spk-$total_denda;

                                    if($selisih_spk<0){
                                        $selisih_spk=0;
                                    }
                                
                                    ?>

                            <tr>
                                <td class="text-dark "><?php echo $no; ?></td>

                                <td class="text-dark text-nowrap"><?php echo $t->nama_perumahan; ?></td>
                                <td class="text-dark "><?php echo $t->nama_blok; ?></td>
                                <td class="text-dark "><?php echo $t->type_perumahan; ?></td>
                                <td class="text-dark text-nowrap">
                                    <?php 
                                            if ($t->jenis_spk == 1) {
                                                echo 'Opname';
                                            } elseif ($t->jenis_spk == 2) {
                                                echo 'HPP Borongan';
                                            } elseif ($t->jenis_spk == 3) {
                                                echo 'Lain-Lain';
                                            } 
                                        ?>
                                </td>
                                <td class="text-dark text-nowrap">
                                    <?php echo  $this->pitih->formatrupiah("$nilai_borongan_spk_akhir"); ?></td>
                                <td class="text-dark text-nowrap">
                                    <?php echo  $this->pitih->formatrupiah("$selisih_spk"); ?></td>



                                <td class="text-dark text-nowrap">
                                    <?php echo date('d M Y', strtotime($t->tanggal_awal_spk));  ?>
                                </td>
                                <td class="text-dark "><?php echo $t->nama_kontraktor; ?></td>
                                <td class="text-dark "><?php echo $penambahan_hari; ?></td>

                                <td class="text-dark text-nowrap"><?php echo $tanggal_akhir_spk_sebenarnya; ?></td>
                                <td class="text-dark "><?php echo $t->rincian; ?></td>
                                <!-- <td class="text-dark "> -->
                                <!-- <div class="dropdown">
                                        <button class="btn btn-info btn-sm btn-block dropdown-toggle" type="button"
                                            id="opnameDropdown" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Opname <i></i>
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="opnameDropdown">
                                            <a class="dropdown-item" id="opnameLink<?php echo $t->id_table_spk; ?>"
                                                href="<?= site_url('Database_spk/input_opname/') . $t->id_table_spk; ?>"
                                                name="opname">
                                                Opname Rumah
                                            </a>
                                            <script>
                                            var opnameLink<?php echo $t->id_table_spk; ?> = document.getElementById(
                                                "opnameLink<?php echo $t->id_table_spk; ?>");
                                            if (<?= $t->jenis_spk ?> !== 1) {
                                                opnameLink<?php echo $t->id_table_spk; ?>.hidden = true;
                                                opnameLink<?php echo $t->id_table_spk; ?>.classList.add("hidden");
                                                opnameLink<?php echo $t->id_table_spk; ?>.addEventListener("click",
                                                    function(event) {
                                                        event.preventDefault();
                                                    });
                                            }
                                            </script>
                                            <script>
                                            var opname = document.getElementsByName("opname");

                                            // Menggunakan loop untuk mengakses setiap elemen tombol SPMB
                                            for (var i = 0; i < opname.length; i++) {
                                                var authFirstName = "<?php echo $ion_auth->first_name; ?>";
                                                var opnames = opname[i];
                                                if (authFirstName !== "Arsitek," && authFirstName !== "Owner,") {

                                                    opnames.style.pointerEvents = "none";
                                                }
                                            }
                                            </script>

                                           
                                            <a class="dropdown-item" id="opnameHpp<?php echo $t->id_table_spk; ?>"
                                                href="<?= site_url('Database_spk/input_opname_hpp/') . $t->id_table_spk; ?>"
                                                name="opnameHpp1">
                                                Opname HPP
                                            </a>
                                            <script>
                                            var opnameHpp<?php echo $t->id_table_spk; ?> = document.getElementById(
                                                "opnameHpp<?php echo $t->id_table_spk; ?>");
                                            if (<?= $t->jenis_spk ?> !== 2) {
                                                opnameHpp<?php echo $t->id_table_spk; ?>.hidden = true;
                                                opnameHpp<?php echo $t->id_table_spk; ?>.classList.add("hidden");
                                                opnameHpp<?php echo $t->id_table_spk; ?>.addEventListener("click",
                                                    function(event) {
                                                        event.preventDefault();
                                                    });
                                            }
                                            </script>
                                           
                                            <a class="dropdown-item" id="opnameLain<?php echo $t->id_table_spk; ?>"
                                                href="<?= site_url('Database_spk/input_opname_lain2/') . $t->id_table_spk; ?>"
                                                name="opnameLain1">
                                                Lain-Lain
                                            </a>
                                            <script>
                                            var opnameLain<?php echo $t->id_table_spk; ?> = document.getElementById(
                                                "opnameLain<?php echo $t->id_table_spk; ?>");
                                            if (<?= $t->jenis_spk ?> !== 3) {
                                                opnameLain<?php echo $t->id_table_spk; ?>.hidden = true;
                                                opnameLain<?php echo $t->id_table_spk; ?>.classList.add("hidden");
                                                opnameLain<?php echo $t->id_table_spk; ?>.addEventListener("click",
                                                    function(event) {
                                                        event.preventDefault();
                                                    });
                                            }
                                            </script>
                                            <hr>
                                            <a class="dropdown-item"
                                                href="<?= site_url('Database_spk/list_opname/') . $t->id_table_spk; ?>">Print
                                                Opname</a>
                                        </div>
                                    </div> -->

                                <!-- <br>
                                    <div class="dropdown">
                                        <button class="btn btn-info btn-sm btn-block dropdown-toggle" type="button"
                                            id="opnameDropdown" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" name="adendumButton">
                                            Adendum <i></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="opnameDropdown">
                                            <a class="dropdown-item"
                                                href="<?= site_url('Database_spk/input_adendum/') . $t->id_table_spk; ?>">Input
                                            </a>
                                            <a class="dropdown-item"
                                                href="<?= site_url('Database_spk/list_adendum/') . $t->id_table_spk; ?>">Print
                                                Adendum</a>
                                        </div>
                                    </div>

                                </td> -->
                                <!-- <td class="text-dark " style="text-align: center;">
                                    <div class="dropdown">
                                        <button class="btn btn-info btn-sm btn-block dropdown-toggle" type="button"
                                            id="spmbDropdown" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" name="spmbDropdown">
                                            SPMB <i></i>
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="spmbDropdown">
                                            <a class="dropdown-item"
                                                href="<?= site_url('Database_spk/list_spmb/') . $t->id_table_spk; ?>"
                                                name="spmbButton">
                                                Detail SPMB
                                            </a>



                                        
                                            <a class="dropdown-item" id="retensi<?php echo $t->id_table_spk; ?>"
                                                href="<?= site_url('Database_spk/input_pengurangan_retensi/') . $t->id_table_spk; ?>"
                                                name="retensi">
                                                Input Retensi
                                            </a>


                                            <a class="dropdown-item" id="detailRetensi<?php echo $t->id_table_spk; ?>"
                                                href="<?= site_url('Database_spk/list_retensi/') . $t->id_table_spk; ?>"
                                                name="detailRetensi">
                                                Detail Retensi
                                            </a>


                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex flex-column align-items-center">


                                    </div>
                                </td> -->


                                <td class="text-dark text-nowrap" style="text-align: center;">
                                    <a href="<?= site_url('Database_spk/print_spk/') . $t->id_table_spk; ?>"
                                        class="btn-sm btn-primary btn-block">Print SPK<i></i></a>
                                    <br>
                                    <?php if ($t->status == 1) { ?>
                                    <a class="btn-sm btn-success btn-block disabled" name="akad">AKAD</a>
                                    <?php } else { ?>
                                    <?php if ($t->jenis_spk != 3) { ?>
                                    <a href="<?= site_url('Database_spk/status_spk/' . $t->id_table_spk . '') ?>"
                                        class="btn-sm btn-danger btn-block" name="akad2">AKAD?</a>
                                    <?php } ?>
                                    <?php } ?>
                                    <br>



                                    <?php if ($t->status_ready == 1) { ?>
                                    <a class="btn-sm btn-success btn-block disabled" name="akad">READY</a>
                                    <?php } else { ?>
                                    <?php if ($t->jenis_spk != 3) { ?>
                                    <a href="<?= site_url('Database_spk/status_ready/' . $t->id_table_spk . '') ?>"
                                        class="btn-sm btn-danger btn-block" name="akad2">READY?</a>
                                    <?php } ?>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <script>
        // Mendapatkan elemen tombol "AKAD"
        var akadButton = document.getElementsByName('akad');
        // Mendapatkan nilai $t->jenis_spk
        var jenisSpk = "<?php echo $t->jenis_spk; ?>";

        // Memeriksa kondisi $t->jenis_spk
        if (jenisSpk == 3) {
            // Menghilangkan tombol "AKAD"
            akadButton.style.display = 'none';
        }

        var akad = document.getElementsByName("akad");

        // Menggunakan loop untuk mengakses setiap elemen tombol SPMB
        for (var i = 0; i < akad.length; i++) {
            var authFirstName = "<?php echo $ion_auth->first_name; ?>";
            var akads = akad[i];
            if (authFirstName !== "Admin," && authFirstName !== "Owner,") {

                akads.style.pointerEvents = "none";
            }
        }

        var akad = document.getElementsByName("akad2");

        // Menggunakan loop untuk mengakses setiap elemen tombol SPMB
        for (var i = 0; i < akad.length; i++) {
            var authFirstName = "<?php echo $ion_auth->first_name; ?>";
            var akads = akad[i];
            if (authFirstName !== "Admin," && authFirstName !== "Owner,") {

                akads.style.pointerEvents = "none";
            }
        }

        var editHari = document.getElementsByName("editHari");

        // Menggunakan loop untuk mengakses setiap elemen tombol SPMB
        for (var i = 0; i < editHari.length; i++) {
            var authFirstName = "<?php echo $ion_auth->first_name; ?>";
            var editHaris = editHari[i];
            if (authFirstName !== "Akuntan," && authFirstName !== "Owner,") {
                editHaris.style.display = "none";
            }
        }

        var spmbDropdown = document.getElementsByName("spmbDropdown");

        // Menggunakan loop untuk mengakses setiap elemen tombol SPMB
        for (var i = 0; i < spmbDropdown.length; i++) {
            var authFirstName = "<?php echo $ion_auth->first_name; ?>";
            var spmbDropdowns = spmbDropdown[i];
            if (authFirstName !== "Akuntan," && authFirstName !== "Owner,") {

                spmbDropdowns.style.pointerEvents = "none";
            }
        }

        var adendumButton = document.getElementsByName("adendumButton");

        // Menggunakan loop untuk mengakses setiap elemen tombol SPMB
        for (var i = 0; i < adendumButton.length; i++) {
            var authFirstName = "<?php echo $ion_auth->first_name; ?>";
            var adendumButtons = adendumButton[i];
            if (authFirstName !== "Admin," && authFirstName !== "Owner,") {

                adendumButtons.style.pointerEvents = "none";
            }
        }

        var opnameLain1 = document.getElementsByName("opnameLain1");

        // Menggunakan loop untuk mengakses setiap elemen tombol SPMB
        for (var i = 0; i < opnameLain1.length; i++) {
            var authFirstName = "<?php echo $ion_auth->first_name; ?>";
            var opnameLain1s = opnameLain1[i];
            if (authFirstName !== "Arsitek," && authFirstName !== "Owner,") {

                opnameLain1s.style.pointerEvents = "none";
            }
        }



        var opnameHpp1 = document.getElementsByName("opnameHpp1");

        // Menggunakan loop untuk mengakses setiap elemen tombol SPMB
        for (var i = 0; i < opnameHpp1.length; i++) {
            var authFirstName = "<?php echo $ion_auth->first_name; ?>";
            var opnameHpp1s = opnameHpp1[i];
            if (authFirstName !== "Arsitek," && authFirstName !== "Owner,") {

                opnameHpp1s.style.pointerEvents = "none";
            }
        }
        </script>