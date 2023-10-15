<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bayanakun - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style>
body {
    background-image: url('<?= base_url('assets/') ?>dist/img/Background.JPG');
    /* Gantilah 'URL_GAMBAR' dengan URL atau path ke gambar Anda */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.center-vertical {
    display: flex;
    align-items: center;
}
</style>

<body style="background-image: url('<?= base_url() ?>assets/img/Background.JPG');">

    <div class="container">
        <?php
if ($this->session->flashdata('msg_danger')) {
  echo "<div class='alert alert-danger alert-dismissible'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>" . $this->session->flashdata('msg_danger') . "</div>";
} else if ($this->session->flashdata('msg_success')) {
  echo "<div class='alert alert-success alert-dismissible'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>" . $this->session->flashdata('msg_success') . "</div>";
} else if ($this->session->flashdata('msg_info')) {
  echo "<div class='alert alert-info alert-dismissible'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>" . $this->session->flashdata('msg_info') . "</div>";
}

?>
        <!-- flashdata -->


        <!-- / flashdata -->

        <!-- Outer Row -->
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="col-4 offset-3">
            <div class="text-center">
                <h1 class="text-dark text-nowrap">Surat Perintah Kerja</h1>
            </div>
            <p class="login-box-msg"><?php echo lang('login_subheading'); ?></p>
            <div id="infoMessage"><?php echo $message; ?></div>
            <form method="post" action="<?= base_url('Auth/login') ?>" class="user">
                <div class="form-group text-center">
                    <input type="email" class="form-control form-control-user" id="identity" name="identity"
                        aria-describedby="emailHelp" placeholder="Enter Email Address...">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" name="password"
                        placeholder="Password">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                        <label class="custom-control-label" for="customCheck">Remember
                            Me</label>
                    </div>
                </div>
                <!--  <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a> -->
                <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-primary btn-user btn-block">
                </div>

            </form>

        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

</body>

</html>