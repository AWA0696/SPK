<!-- jquery-validation -->
<script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/additional-methods.min.js"></script>
<script>
$('#input_data_konsumen').validate({
    rules: {
        input_nama: {
            required: true,
        },
        kontak: {
            required: true,

        },
        alamat: {
            required: true,


        },
        ketertarikan_rumah: {
            required: true,


        },
        block: {
            required: true,


        },
        tipe: {
            required: true,


        },
        sumber_data: {
            required: true,


        },
        tipe_konsumen: {
            required: true,


        },
        nama_sales: {
            required: true,


        },

    },
    errorElement: 'span',
    errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
});
</script>