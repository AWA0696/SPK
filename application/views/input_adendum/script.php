<script src="<?= base_url('assets/js/') ?>select2.min.js"></script>
<!-- jquery-validation -->
<script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/additional-methods.min.js"></script>
<script>
$(document).ready(function() {

    $('#datatables').DataTable({
        "order": [
            [0, "desc"]
        ]
    });
});

$(document).ready(function() {
    $('.select2bs4').select2({});
    $('#itemName2').select2({});

});




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

$(document).ready(function() {
    listdata();
    $('#listUserTable').dataTable({
        "bPaginate": false,
        "bInfo": false,
        "bFilter": false,
        "bLengthChange": false,
        "pageLength": 5
    });


    //menampilkan data penambahan/pengurangan biaya pada halaman booking fee
    function listdata() {
        $.ajax({
            type: 'ajax',
            url: "<?= base_url('Database_spk/data_temp_koreksi_adendum') ?>",
            async: false,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                var no = 1;
                var k;
                for (i = 0; i < data.length; i++) {
                    if (data[i].koreksi == 1) {
                        k = "Penambahan";
                    } else {
                        k = "Pengurangan";
                    }
                    html += '<tr id="' + data[i].id + '">' +
                        '<td>' + no++ + '</td>' +
                        '<td>' + k + '</td>' +
                        '<td>' + data[i].keterangan + '</td>' +
                        '<td>' + Intl.NumberFormat().format(data[i].jumlah) + '</td>' +
                        '<td style="text-align:right;">' +
                        '<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-id="' +
                        data[i].id + '">Hapus</a>' +
                        '</td>' +
                        '</tr>';
                }
                $('#listdata').html(html);
            }

        });
    }



    //menyimpan data temp untuk penambahan/pengurangan biaya pada halaman booking fee
    $('#form_koreksi').submit('click', function() {
        var koreksi = $('#koreksi').val();
        var keterangan = $('#keterangan').val();
        var jumlah = $('#jumlah').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('Database_spk/simpan_temp_koreksi_adendum') ?>",
            dataType: "JSON",
            data: {
                koreksi: koreksi,
                keterangan: keterangan,
                jumlah: jumlah.replace(/\D/g, '')
            },
            success: function(data) {
                $('[name="keterangan"]').val("");
                $('[name="jumlah"]').val("");
                $('#modalkoreksi').modal('hide');
                listdata();
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                console.log(xhr.responseText);
            }
        });
        return false;
    });

    // menampilkan modal delete penguranga/penambahan biaya pada halaman booking fee
    $('#listdata').on('click', '.deleteRecord', function() {
        var idk = $(this).data('id');
        $('#delete-modal').modal('show');
        $('#id').val(idk);
    });

    // untuk menghapus data temp penambahan/pengurangan biaya
    $('#delete-koreksi').on('submit', function() {
        var UserId = $('#id').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('Database_spk/hapus_temp_koreksi_adendum') ?>",
            dataType: "JSON",
            data: {
                id: UserId
            },
            success: function(data) {
                $('#' + UserId).remove();
                $('#id').val("");
                $('#delete-modal').modal('hide');
                listdata();
            }
        });
        return false;
    });

});
</script>