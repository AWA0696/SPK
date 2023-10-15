</div>
<!-- End of Main Content -->
<!-- <?= date('Y') ?> -->
<!-- Footer -->
<br>
<footer class="sticky-footer" style="background-color: #17a2b8; ">
    <div style="text-align: center;">
        <strong style="color: black;">Copyright &copy; 2023 <b style="color: black;">Doflaland</b>.</strong>
        <small style="color: black;"> All rights reserved.</small>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class=" scroll-to-top rounded" href="#page-top">

</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Core plugin JavaScript-->
<!-- <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script> -->

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>



<!-- Page level plugins -->
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<!-- <script src="<?= base_url('assets/') ?>js/ajax.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->




<?php
if (isset($script)) {
    $this->load->view("$script/script");
}

?>

</body>

</html>