<div class="container-fluid">
    <a onclick="window.location=document.referrer;" class="btn btn-info btn-icon-split ml-4">
        <span class="icon text-white-50">
            <i class="fas fa-caret-square-left"></i>
        </span>
        <span class="text">Kembali</span>
    </a>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h6 class="m-0 font-weight-bold text-dark-100">Edit SPK</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('Database_spk/simpan_spk') ?>" class="form-horizontal"
                        id="input_data_konsumen">


                        <label for="nama_perumahan" class="col-12 col-form-label">Perumahan</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input readonly type="text" class="form-control" name="nama_perumahan"
                                    id="nama_perumahan" value="<?=$print->nama_perumahan?>">
                                <select class="form-control select2bs4" name="nama_perumahan" id="nama_perumahan">
                                    <option selected disabled>Pilih</option>
                                    <?php foreach($tampil_perumahan as $row):?>
                                    <option value="<?php echo $row->id_perumahan;?>"><?php echo $row->nama_perumahan;?>
                                    </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>

                        <label for="blok_spk" class="col-12 col-form-label">Block</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input readonly type="text" class="form-control" name="nama_perumahan"
                                    id="nama_perumahan" value="<?=$print->nama_blok?>">
                                <select class="form-control select2bs4" name="blok_spk" id="blok_spk">
                                    <option selected disabled>Pilih</option>
                                    <?php foreach($tampil_blok as $row):?>
                                    <option value="<?php echo $row->id_blok;?>"><?php echo $row->nama_blok;?>
                                    </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>

                        <label for="type" class="col-12 col-form-label">Type</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input type="text" class="form-control" name="type" id="type"
                                    value="<?=$print->type_perumahan?>" required>
                            </div>
                        </div>

                        <label for="nilai_borongan" class="col-12 col-form-label">Nilai Borongan Awal</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input type="text" class="form-control" name="nilai_borongan" id="nilai_borongan"
                                    value="<?= $this->pitih->formatrupiah($print->nilai_borongan) ?>" placeholder="Rp."
                                    required>
                            </div>
                        </div>

                        <label for="tanggal_pengajuan_spk" class="col-12 col-form-label">Tanggal Pengajuan</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input readonly type="text" class="form-control" name="tanggal_pengajuan_spk"
                                    id="tanggal_pengajuan_spk" value="<?php echo $print->tanggal_pengajuan_spk  ?>"
                                    required>
                            </div>
                        </div>

                        <label for="tanggal_awal_spk" class="col-12 col-form-label">Tanggal Mulai SPK</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input type="text" class="form-control" name="tanggal_awal_spk" id="tanggal_awal_spk"
                                    value="<?php echo $print->tanggal_awal_spk  ?>" required>
                            </div>
                        </div>

                        <label for="tanggal_akhir_spk" class="col-12 col-form-label">Tanggal Akhir SPK</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input type="text" class="form-control" name="tanggal_akhir_spk" id="tanggal_akhir_spk"
                                    value="<?php echo $print->tanggal_akhir_spk  ?>" required>
                            </div>
                        </div>

                        <label for="nama_kontraktor" class="col-12 col-form-label">Nama Kontraktor</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input type="text" class="form-control" name="nama_kontraktor" id="nama_kontraktor"
                                    value="<?php echo $print->nama_kontraktor  ?>" required>
                            </div>
                        </div>

                        <label for="" class="col-12 col-form-label">Jenis SPK</label>
                        <div class="row mb-3">
                            <div class="col-12">
                                <select class="form-control" name="jenis_spk" id="">
                                    <option disabled selected>-Pilih-</option>
                                    <option value="1">Opname</option>
                                    <option value="2">HPP Borongan</option>
                                    <option value="3">Lain-Lain</option>
                                </select>
                            </div>
                        </div>

                        <textarea class="form-control" rows="5" id="rincian"
                            name="rincian"><?php echo $print->rincian ?></textarea>

                        <div class="card-header bg-cyan">
                            <h5 class="card-title">Penambahan / Pengurangan</h6>
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
                                            <th>Penambahan / Pengurangan</th>
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

                <div class="row">
                    <div class="col-1	">
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
                            <h6 class="modal-title" id="exampleModalLabel">Penambahan / Pengurangan
                            </h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="koreksi" class="col-md-2 col-form-label">Jenis</label>
                                <div class="form-group clearfix">
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
                                <label for="keterangan" class="col-md-2 col-form-label">Keterangan</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" rows="2" id="keterangan"
                                        name="keterangan"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jumlah" class="col-md-2 col-form-label">Jumlah</label>
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