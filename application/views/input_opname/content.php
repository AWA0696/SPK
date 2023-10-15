 <div class="container-fluid">
     <a onclick="location.href = '<?php echo site_url('Database_spk/spk_by_perumahan/'.$id_perumahan) ?>'"
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
                     <form method="post" action="<?= base_url('Database_spk/simpan_opname') ?>" class="form-horizontal"
                         enctype="multipart/form-data">

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

                         <label for="" class="col-12 col-form-label">Opini</label>
                         <div class="row mb-3">
                             <div class="col-12">
                                 <select class="form-control" name="opini" id="">
                                     <option disabled selected>-Pilih-</option>
                                     <option value="3">30%</option>
                                     <option value="7">70%</option>
                                     <option value="10">100%</option>
                                     <option value="11">Retensi</option>
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
     </div>
 </div>