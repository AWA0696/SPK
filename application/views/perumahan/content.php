<div class="container-fluid">

    <div class="card shadow">
        <div class="card-header bg-light m-0 font-weight-bold text-dark-100">
            <a id="spkButton" class="btn btn-success btn-bg text-left"
                href="<?php echo base_url('Database_spk/input_spk_rumah') ?>">
                <i class="fas fa-plus">SPK</i>
            </a>
        </div>

        <script>
        var authFirstName = "<?php echo $ion_auth->first_name; ?>";

        if (authFirstName !== "Admin," && authFirstName !== "Owner,") {
            document.getElementById("spkButton").style.display = "none";
        }
        </script>

        <div class="card-header " style="background-color: #17a2b8;">
            <h6 class="m-0 font-weight-bold text-white">Pilih Perumahan</h6>
        </div>

        <div class="card-body">
            <div class="row-12 table-responsive">
                <table id="table_his" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="bg-light m-0 font-weight-bold text-dark-100">No</th>
                            <th class="bg-light m-0 font-weight-bold text-dark-100">Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$total = 0;
						$i = 0; 
						foreach ($tampil as $data) {
							$i++;
							echo "<tr>";
							echo "<td class='col-sm-1 offset-1'>" . $i . "</td>";
							
							echo "<td><a href='" . base_url('Database_spk/spk_by_perumahan/') . $data->id_perumahan . "'>" . $data->nama_perumahan . "</a></td>";

							?>
                        <?php
							echo "</tr>"; 
						}
						?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>