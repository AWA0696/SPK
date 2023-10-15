    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header bg-light m-0 font-weight-bold text-white">
                <a onclick="location.href = ('<?php echo site_url('Database_spk/perumahan_pen_hari/') ?>')"
                    class="btn btn-info btn-icon-split mb-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-caret-square-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>

            <div class="card-header bg-info">
                <h6 class="m-0 font-weight-bold text-white">Penambahan Hari</h6>
            </div>

            <div class="card-body">
                <div class="row-12 table-responsive">
                    <table id="datatables" class="table table-striped ">
                        <thead>
                            <tr class="bg-light m-0 font-weight-bold text-gray" style="text-align: center;">
                                <th>No</th>
                                <th>Nama Perumahan </th>
                                <th>Block </th>
                                <th>Type</th>
                                <th>Jenis SPK</th>
                                <th>Aksi</th>

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
                                <td class=" text-center"><?php echo $no; ?></td>

                                <td class=" text-center"><?php echo $t->nama_perumahan; ?></td>
                                <td class=" text-center"><?php echo $t->nama_blok; ?></td>
                                <td class=" text-center"><?php echo $t->type_perumahan; ?></td>
                                <td class=" text-center">
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

                                <td class=" text-center">
                                    <a href="<?= site_url('Database_spk/tampil_edit_penambahan_hari/') . $t->id_table_spk;?>"
                                        class="btn-sm btn-warning" name="editHari">Edit</a>
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