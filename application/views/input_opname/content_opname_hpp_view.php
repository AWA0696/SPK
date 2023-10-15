 <div class="container-fluid">
     <a onclick="location.href = '<?php echo site_url('Database_spk/spk_by_perumahan_opname/'.$id_perumahan) ?>'"
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
                     <h6 class="m-0 font-weight-bold text-dark-100">Input Opname</h6>
                 </div>
                 <div class="card-body">
                     <form method="post" action="<?= base_url('Database_spk/simpan_opname_hpp_view') ?>"
                         class="form-horizontal" enctype="multipart/form-data" id='opname_hpp'>

                         <label for="" class="col-12 col-form-label">Jabatan</label>
                         <div class="row mb-3">
                             <div class="col-12">
                                 <input hidden type="text" class="form-control" name="id_table_spk"
                                     value="<?= $id_table_spk?>">
                                 <input readonly type="text" class="form-control" name="pengaju_opname"
                                     value="<?= $ion_auth->last_name ?>">
                             </div>
                         </div>

                         <label for="" class="col-12 col-form-label">Perumahan</label>
                         <div class="row mb-3">
                             <div class="col-12">
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
                                 <input readonly type="text" class="form-control" name="tanggal_input_opname"
                                     id="tanggal_pengajuan_spk" value="<?php echo date('d F Y');  ?>" required>
                             </div>
                         </div>

                         <label for="sisa_pencairan" class="col-12 col-form-label">Sisa Pencairan</label>
                         <div class="row mb-3">
                             <div class="col-12">
                                 <input readonly type="text" class="form-control" name="sisa_pencairan"
                                     id="sisa_pencairan" value="<?=$this->pitih->formatrupiah($selisih_spk )?>"
                                     required>
                             </div>
                         </div>

                         <label for="nilai_borongan" class="col-12 col-form-label">Nilai Pencairan</label>
                         <div class="row mb-3">
                             <div class="col-12">
                                 <input type="text" class="form-control" name="nilai_borongan" id="nilai_borongan"
                                     placeholder="Rp." required>
                             </div>
                         </div>

                         <label for="" class="col-12 col-form-label">Jenis HPP</label>
                         <div class="row mb-3">
                             <div class="col-12">
                                 <select class="form-control" name="jenis_hpp" id="">
                                     <option disabled selected>-Pilih-</option>
                                     <option value="0">Pencairan Biasa</option>
                                     <option value="1">Pencairan 100%</option>

                                 </select>
                             </div>
                         </div>


                         <label for="" class="col-12 col-form-label">Depan</label>
                         <div class="row mb-3">
                             <div class="col-12">

                                 <input type="file" name="foto_depan" id="foto_depan" class="form-control">

                             </div>
                         </div>

                         <label for="" class="col-12 col-form-label">Belakang</label>
                         <div class="row mb-3">
                             <div class="col-12">

                                 <input type="file" name="foto_belakang" id="foto_belakang" class="form-control">

                             </div>
                         </div>

                         <label for="" class="col-12 col-form-label">Tampak Kiri</label>
                         <div class="row mb-3">
                             <div class="col-12">

                                 <input type="file" name="foto_kiri" id="foto_kiri" class="form-control">

                             </div>
                         </div>

                         <label for="" class="col-12 col-form-label">Tampak Kanan</label>
                         <div class="row mb-3">
                             <div class="col-12">

                                 <input type="file" name="foto_kanan" id="foto_kanan" class="form-control">

                             </div>
                         </div>

                         <label for="" class="col-12 col-form-label">Ruang Tamu</label>
                         <div class="row mb-3">
                             <div class="col-12">

                                 <input type="file" name="foto_ruang_tamu" id="foto_ruang_tamu" class="form-control">

                             </div>
                         </div>

                         <label for="" class="col-12 col-form-label">Kamar 1</label>
                         <div class="row mb-3">
                             <div class="col-12">

                                 <input type="file" name="foto_kamar_1" id="foto_kamar_1" class="form-control">

                             </div>
                         </div>

                         <label for="" class="col-12 col-form-label">Kamar 2</label>
                         <div class="row mb-3">
                             <div class="col-12">

                                 <input type="file" name="foto_kamar_2" id="foto_kamar_2" class="form-control">

                             </div>
                         </div>

                         <label for="" class="col-12 col-form-label">Kamar 3</label>
                         <div class="row mb-3">
                             <div class="col-12">

                                 <input type="file" name="foto_kamar_3" id="foto_kamar_3" class="form-control">

                             </div>
                         </div>

                         <label for="" class="col-12 col-form-label">Kamar Mandi</label>
                         <div class="row mb-3">
                             <div class="col-12">

                                 <input type="file" name="foto_kamar_mandi" id="foto_kamar_mandi" class="form-control">

                             </div>
                         </div>

                         <label for="" class="col-12 col-form-label">Dapur</label>
                         <div class="row mb-3">
                             <div class="col-12">

                                 <input type="file" name="foto_dapur" id="foto_dapur" class="form-control">

                             </div>
                         </div>
                 </div>
                 <div class="row">
                     <div class="col-12 col-form-label ml-4">
                         <button type="submit" class="btn btn-info btn-icon-split"
                             <?= ($selisih_spk == 0) ? 'disabled' : '' ?>>
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
     </div>
 </div>

 <script>
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