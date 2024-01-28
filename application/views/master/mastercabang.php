        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Data Master Cabang</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Data Master</li>
                    <li class="breadcrumb-item active"> Master Cabang</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Form Tambah Cabang -->
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="<?=base_url()?>master-cabang/simpan-data">
                    <!-- ID Cabang-->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormIDCabang">ID Cabang</label>
                        <input class="form-control" id="FormIDCabang" name="id" type="text" value="<?= $newID ?>" required="" readonly>
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Nama Cabang -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormNamaCabang">Nama Cabang</label>
                        <input class="form-control" id="FormNamaCabang" name="nt" type="text" placeholder="Masukkan Nama Cabang" required="">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Provinsi Cabang -->
                    <div class="col-md-6 position-relative">
                    <label class="form-label" for="FormProvinsiCabang">Provinsi Cabang</label>
                    <select class="form-select" id="province" name="prov" required="">
                        <option selected="" disabled="" value="">Pilih Provinsi ...</option>
                    </select>
                    <input class="form-control" type="hidden" name="prov_name" id="prov_name">
                    <div class="invalid-tooltip">Silahkan Pilih Provinsi Cabang.</div>
                    </div>
                    <!-- Kabupaten / Kota -->
                    <div class="col-md-6 position-relative">
                    <label class="form-label" for="FormKotaKabCabang">Kota / Kabupaten Cabang</label>
                    <select class="form-select" id="kabupaten" name="kab" required="">
                        <option selected="" disabled="" value="">Pilih Kota / Kab ...</option>
                    </select>
                    <input class="form-control" type="hidden" name="kab_name" id="kab_name">
                    <div class="invalid-tooltip">Silahkan Pilih Kota / Kab Cabang.</div>
                    </div>
                    <!-- Kecamatan -->
                    <div class="col-md-6 position-relative">
                    <label class="form-label" for="FormKecamatanCabang">Kecamatan Cabang</label>
                    <select class="form-select" id="kecamatan" name="kec" required="">
                        <option selected="" disabled="" value="">Pilih Kecamatan ...</option>
                    </select>
                    <input class="form-control" type="hidden" name="kec_name" id="kec_name">
                    <div class="invalid-tooltip">Silahkan Pilih Kecamatan Cabang.</div>
                    </div>
                    <!-- kodepos -->
                    <div class="col-md-6 position-relative">
                    <label class="form-label" for="kode_pos">Kode Pos</label>
                    <input class="form-control" id="kode_pos" name="kode_pos" type="text" placeholder="contoh: 602999" required="">
                    <div class="invalid-tooltip">Masukkan kode pos</div>
                    </div>
                    <!-- Detai Alamat Cabang -->
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="FormDetailAlamatCabang">Detail Alamat Cabang</label>
                        <input class="form-control" id="FormDetailAlamatCabang" name="alamat" type="text" placeholder="contoh: Jl. Tamtama No 19" required="">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Pilih Kepala Cabang -->
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="FormKepalaCabang">Kepala Cabang</label>
                        <select class="form-select" id="FormKepalaCabang" name="kc" required="">
                            <option selected="" disabled="" value="">Pilih Kepala Cabang ...</option>
                            <?php foreach ($kacab as $kc) { ?>
                              <option value="<?=$kc['id_user']?>"><?=$kc['id_user']?> | <?=$kc['nama_lengkap']?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-tooltip">Silahkan Pilih Kepala Cabang.</div>
                    </div>
                    <!-- Button Tambah Cabang Baru -->
                    <div class="col-12">
                    <button class="btn btn-primary" type="submit">Tambah Cabang</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Form Tambah Cabang-->
            <!-- Listing Cabang -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header pb-0 card-no-border">
                        <h4>List Data Cabang</h4>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="display" id="table-cabang">
                            <thead>
                              <tr>
                                <th>ID CABANG</th>
                                <th>KEPALA CABANG</th>
                                <th>NAMA CABANG</th>
                                <th>PROVINSI</th>
                                <th>KAB / KOTA</th>
                                <th>KECAMATAN</th>
                                <th>DETAIL ALAMAT</th>
                                <th>STATUS</th>
                                <th style="text-align: center;">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <!-- End Listing Cabang -->
            <!-- Modal Edit Data Master -->
            <div class="modal fade" id="EditMasterCabangModal" tabindex="-1" role="dialog" aria-labelledby="EditMasterCabangModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                    <div class="modal-body social-profile text-start">
                      <div class="modal-toggle-wrapper">
                        <h3>Edit Master Data</h3>
                        <form class="row g-3">
                        <!-- ID Cabang -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormIDCabang">ID Cabang</label>
                            <input class="form-control" id="FormIDCabang" type="text" placeholder="DHC-0001" disabled>
                        </div>
                        <!-- Nama Cabang -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormNamaCabang">Nama Cabang</label>
                            <input class="form-control" id="FormNamaCabang" type="text" placeholder="Masukkan Namma Cabang">
                        </div>
                        <!-- Provinsi Cabang -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormProvinsiCabang">Provinsi Cabang</label>
                            <select class="form-select" id="FormProvinsiCabang" required="">
                                <option selected="" disabled="" value="">Pilih Provinsi Cabang ...</option>
                                <option>Jawa Timur</option>
                                <option>Jawa Tengah</option>
                                <option>Jawa Barat</option>
                            </select>
                        </div>
                        <!-- Kabupaten / Kota -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormKotaKabCabang">Kota / Kabupaten Cabang</label>
                            <select class="form-select" id="FormKotaKabCabang" required="">
                                <option selected="" disabled="" value="">Pilih Kota / Kab Cabang ...</option>
                                <option>Kota Surabaya</option>
                                <option>Kabupaten Sidoarjo</option>
                                <option>Kabupaten Malang</option>
                            </select>
                        </div>
                        <!-- Kecamatan -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormKecamatanCabang">Kecamatan Cabang</label>
                            <select class="form-select" id="FormKecamatanCabang" required="">
                                <option selected="" disabled="" value="">Pilih Kecamatan Cabang ...</option>
                                <option>Jagir</option>
                                <option>Wonokromo</option>
                                <option>Kedung Asri</option>
                            </select>
                        </div>
                        <!-- Kelurahaan -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormKelurahaanCabang">Kelurahan Cabang</label>
                            <select class="form-select" id="FormKelurahaanCabang" required="">
                                <option selected="" disabled="" value="">Pilih Kelurahaan Cabang ...</option>
                                <option>Sawunggaling</option>
                                <option>Kesatrian</option>
                                <option>Gedangan</option>
                            </select>
                        </div>
                        <!-- Detai Alamat Cabang -->
                        <div class="col-md-12 position-relative">
                            <label class="form-label" for="FormDetailAlamatCabang">Detail Alamat Cabang</label>
                            <input class="form-control" id="FormDetailAlamatCabang" type="text" placeholder="contoh: Jl. Tamtama No 19" required="">
                        </div>
                        <!-- Pilih Kepala Cabang -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormKepalaCabang">Kepala Cabang</label>
                            <select class="form-select" id="FormKepalaCabang" required="">
                                <option selected="" disabled="" value="">Pilih Kepala Cabang ...</option>
                                <option>DHE-01020001 | FIGO VIO HIDAYAT</option>
                                <option>DHE-01020002 | ALDO HIDAYAT</option>
                            </select>
                        </div>
                        <!-- Statu Cabang -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="StatusCabang">Status Cabang</label>
                            <select class="form-select" id="StatusCabang" required="">
                                <option selected="" disabled="" value="">Aktif</option>
                                <option>Tidak Aktif</option>
                            </select>
                        </div>
                        <!-- Button Simpan -->
                          <div class="col-12">
                            <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Simpan Perubahan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->