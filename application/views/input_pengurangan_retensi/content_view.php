<div class="container-fluid">
    <a onclick="location.href = '<?php echo site_url('Database_spk/spk_by_perumahan_spmb/'.$id_perumahan) ?>'"
        class="btn btn-info btn-icon-split mb-3">
        <span class="icon text-white-50">
            <i class="fas fa-caret-square-left"></i>
        </span>
        <span class="text">Kembali</span>
    </a>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h6 class="m-0 font-weight-bold text-dark-100">Input Pengurangan Retensi</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('Database_spk/simpan_pengurangan_retensi') ?>"
                        class="form-horizontal" id="input_data_konsumen">



                        <label for="" class="col-12 col-form-label">Perumahan</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input hidden type="text" name="id_table_spk" class="form-control"
                                    value="<?php echo $tampil_perumahan_dan_blok->id_table_spk; ?>">
                                <input hidden type="text" name="id_perumahan" id=""
                                    value="<?php echo $tampil_perumahan_dan_blok->id_perumahan; ?>">
                                <input readonly type="text" class="form-control"
                                    value="<?php echo $tampil_perumahan_dan_blok->nama_perumahan; ?>">
                            </div>
                        </div>

                        <label for="" class="col-12 col-form-label">Block</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input hidden type="text" name="id_blok" id=""
                                    value="<?php echo $tampil_perumahan_dan_blok->id_blok; ?>">
                                <input readonly type="text" class="form-control"
                                    value="<?php echo $tampil_perumahan_dan_blok->nama_blok; ?>">
                            </div>
                        </div>

                        <label for="" class="col-12 col-form-label">Type</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input readonly type="text" class="form-control" name="type"
                                    value="<?php echo $tampil_perumahan_dan_blok->type_perumahan; ?>">
                            </div>
                        </div>

                        <label for="" class="col-12 col-form-label">Tanggal Input</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input readonly type="text" class="form-control"
                                    name="tanggal_input_pengurangan_retensi" id="" value="<?php echo date('d F Y');  ?>"
                                    required>
                            </div>
                        </div>

                        <label for="" class="col-12 col-form-label">Rincian</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <textarea class="form-control" rows="5" id=""
                                    name="rincian_pengurangan_retensi"></textarea>
                            </div>
                        </div>

                        <div class="card-header bg-cyan">
                            <h5 class="card-title">Input</h6>
                        </div>

                        <div class="card-body">
                            <div>
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#modalkoreksi">
                                    <i class="fas fa-plus"></i> Tambah Data
                                </button>
                            </div>

                            <div class="container mt-5">
                                <table class="table table-bordered" id="listUserTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis</th>
                                            <th>Keterangan</th>
                                            <th>Jumlah</th>
                                            <th style="text-align: right;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listdata">
                                        <!-- Untuk menampilkan datanya, menggunakan JQuery + AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>

            <div class="row">
                <div class=" col">
                    <button type="submit" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">
                            SIMPAN
                        </span>
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>




    <form id="form_koreksi" method="post">
        <div class="modal fade" id="modalkoreksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Jenis</label>
                            <div class="form-group clearfix col-md-3">
                                <!-- <div class="icheck-info d-inline">
                                <input type="radio" id="radioPrimary1" value="1" name="koreksi"> 
                                <label for="radioPrimary1">
                                    Penambahan
                                </label>
                            </div>
                            <div class="icheck-info d-inline">
                                <input type="radio" id="radioPrimary2" value="2" name="koreksi">
                                <label for="radioPrimary2">
                                    Pengurangan
                                </label>
                            </div> -->

                                <select name="koreksi" class="form-control" id="koreksi">
                                    <option disabled>-Pilih-</option>
                                    <option value="1">Penambahan</option>
                                    <option value="2">Pengurangan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Keterangan</label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="2" id="keterangan" name="keterangan"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Jumlah</label>
                            <div class="col-md-10">
                                <input type="text" id="jumlah" class="form-control" name="jumlah">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="delete-koreksi" method="post">
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Anda Yakin Ingin Menghapus Data ini??</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id" class="form-control">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </form>




    <script>
    var rupiah = document.getElementById('jumlah');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    var nilai_borongan = document.getElementById('nilai_borongan');
    nilai_borongan.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        nilai_borongan.value = formatRupiah(this.value, 'Rp. ');
    });


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
    </script>