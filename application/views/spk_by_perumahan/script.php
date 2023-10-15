<script src="<?= base_url('assets/js/') ?>select2.min.js"></script>
<!-- jquery-validation -->
<script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/additional-methods.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2bs4').select2({});
    $('#itemName2').select2({});

});


$('#datatables').DataTable();



function renderAngkaRupiah() {
    var rupiah2 = document.getElementById('nilai_borongan');

    rupiah2.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        this.value = formatRupiah(this.value, 'Rp. ');
    });

    // console.log(rupiah2);
}

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
</script>