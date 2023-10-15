<!-- jquery-validation -->
<script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/additional-methods.min.js"></script>
<script>
$('#form_opname_lain2').validate({
    rules: {
        satuan: {
            required: true,
        },
        masukan_angka: {
            required: true,

        },
        rincian_opname_lain2: {
            required: true,


        },
        opini: {
            required: true,


        },
        foto_depan: {
            required: true,


        },
        foto_belakang: {
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

$('#opname_hpp').validate({
    rules: {
        nilai_borongan: {
            required: true,
        },
        jenis_hpp: {
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

$('#opname_lain2').validate({
    rules: {
        nilai_borongan: {
            required: true,
        },
        jenis_hpp: {
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



// Validasi input menggunakan JavaScript
var masukanAngkaInput = document.getElementById('masukan_angka');
masukanAngkaInput.addEventListener('input', function(event) {
    var value = event.target.value;
    // Hapus karakter selain angka dan titik
    value = value.replace(/[^0-9.]/g, '');
    event.target.value = value;
});




function renderAngkaRupiah() {
    var rupiah2 = document.getElementById('nilai_borongan');

    rupiah2.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        this.value = formatRupiah(this.value, 'Rp. ');
    });

    // console.log(rupiah2);

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
}
</script>