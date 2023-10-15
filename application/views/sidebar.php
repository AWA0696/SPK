<?php  
$user = $this->ion_auth->user()->row();
 ?>
<ul class="navbar-nav sidebar sidebar-dark accordion toggled" id="accordionSidebar" style="background-color: #212529;">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <img class="bg-white" width="100" src="<?= base_url("assets/img/dofla-logo-2.png") ?>">

    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <!-- <a class="nav-link" href="<?= base_url("Crm/index") ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a> -->
    </li>

    <!-- <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            <i class="fas fa-database"></i>
            <span>Data SPK</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Insialisasi Data:</h6>
                <a class="collapse-item" href="<?= base_url('Database_spk/data_spk') ?>">Balance Sheet</a>

            </div>
        </div>
    </li> -->

    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-database"></i>
            <span>Input Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Insialisasi Data:</h6>
                <a class="collapse-item" href="<?= base_url('Crm/tampil_data_konsumen') ?>">Tambah Data</a>
                <a class="collapse-item" href="<?= base_url('Crm/Input_data_folowup') ?>">Update Data Folow UP</a>
            </div>
        </div>
    </li> -->



    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">

    </div>


    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Database_spk/perumahan') ?>">
            <i class="fas fa-pencil-alt"></i>
            <span>Data SPK</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Database_spk/perumahan_opname') ?>">
            <i class="far fa-clipboard"></i>
            <span>Opname</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Database_spk/perumahan_adendum') ?>">
            <i class="far fa-clipboard"></i>
            <span>Adendum</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Database_spk/perumahan_spmb') ?>">
            <i class="far fa-clipboard"></i>
            <span>SPMB</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Database_spk/perumahan_pen_hari') ?>">
            <i class="far fa-clipboard"></i>
            <span>Penambahan Hari</span></a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Database_spk/data_spk') ?>">
            <i class="fas fa-pencil-alt"></i>
            <span>Input SPK</span></a>
    </li> -->



    <!-- <li class="nav-item">

        <a class="nav-link" href="<?= base_url('Crm/input') ?>">
                    <i class="far fa-clipboard"></i>
                    <span>Transaksi</span></a>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        <i class="far fa-clipboard"></i>
                        <span>Transaksi</span>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Menu Transaksi:</h6>
                            <a class="collapse-item" href="<?= base_url('Crm/index') ?>">Input</a>
                            <a class="collapse-item" href="<?= base_url('Crm/transaksi') ?>">Kelola</a>
                        </div>
                    </div>
                </li> -->

    <!-- <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('Crm/jurnal_umum') ?>">
                            <i class="fas fa-journal-whills"></i>
                            <span>Jurnal Umum</span></a>

                        </li> -->

    <!-- <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('Crm/cashflow_pertahun') ?>">
                            <i class="fas fa-money-bill-alt"></i>
                            <span>Cashflow Analysis</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('Crm/balance_sheet') ?>">
                                <i class="fas fa-balance-scale"></i>
                                <span>Balance Sheet</span></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('Crm/income_statement') ?>">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <span>Income Statement</span></a>
                                </li> -->

    <li id="container" class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
            aria-controls="collapseFive">
            <i class="far fa-clipboard"></i>
            <span>Pengajuan Opname</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item" href="<?= base_url('Database_spk/request_opname') ?>">Opname
                    Standar
                </a>
                <a class="collapse-item" href="<?= base_url('Database_spk/request_opname_hpp') ?>">Opname
                    HPP</a>
                <a class="collapse-item" href="<?= base_url('Database_spk/request_opname_lain2') ?>">Opname
                    Lain-Lain</a>
            </div>
        </div>
    </li>

    <!-- <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Crm/sales') ?>">
            <i class="fas fa-clipboard"></i>
            <span>Daftar Konsumen by Sales</span></a>
    </li> -->



    <hr class="sidebar-divider">


    <!-- <div class="sidebar-heading">
        Navigasi
    </div> -->

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Auth/change_password') ?>">
            <i class="fas fa-key"></i>
            <span>Ganti Password</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Auth/logout') ?>">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var userFirstName = "<?php echo $user->first_name; ?>";
    var containerDiv = document.getElementById('container');

    if (userFirstName !== "Arsitek,") {
        containerDiv.style.display = "none";
    }
});
</script>