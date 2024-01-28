        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Data Master Diskon</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Data Master</li>
                    <li class="breadcrumb-item active"> Master Diskon</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Form Tambah Diskon -->
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <form class="row g-3 needs-validation custom-input" novalidate="">
                    <!-- Tipe Diskon -->
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="FormTipeDiskon">Tipe Diskon</label>
                        <select class="form-select" id="tipe" required name="tipe">
                            <option selected="" disabled="" value="">Pilih Tipe Diskon ...</option>
                            <option value="Nominal">Nominal</option>
                        </select>
                        <div class="invalid-tooltip">Silahkan Pilih Tipe Diskon.</div>
                    </div>
                    <!-- Kode Diskon -->
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="FormBuatKodeDiskon">Kode Diskon</label>
                        <input class="form-control" id="kode" name="kode" type="text" placeholder="Buat Kode Diskon" required="">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Nilai Diskon -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormBuatKuotaDiskon">Nilai Diskon</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">Rp</span>
                            <input class="form-control is-invalid" id="FormBuatKuotaDiskon" name="nilai" type="text" onkeyup="formatRupiah(this)" required="">
                        </div>
                    </div>
                    <!-- Kuota Diskon -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormBuatKuotaDiskon">Kuota Diskon</label>
                        <input class="form-control" id="kuota" name="kuota" type="text" placeholder="Input Jumlah Kuota Diskon" required oninput="kuotaDiskon(this)">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <input class="form-control" id="total" name="total" type="hidden" placeholder="Input Jumlah Kuota Diskon" required>
                    <!-- Button Tambah Diskon Baru -->
                    <div class="col-12 btn-showcase">
                        <button class="btn btn-primary tambahdiskon" type="button" onclick="push(['_trackEvent', 'example', 'try', 'tambahdiskon']);">Buat Diskon Baru</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Form Tambah Diskon Baru  -->
            <!-- Listing Diskon -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <h4>List Data Diskon</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-diskon">
                                    <thead>
                                    <tr>
                                        <th>KODE DISKON</th>
                                        <th>NILAI DISKON</th>
                                        <th>KUOTA DISKON</th>
                                        <th>TOTAL DISKON</th>
                                        <th>AKSI</th>
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
            <!-- End Listing Diskon -->
            <!-- Modal Edit Data Master -->
            <div class="modal fade bd-example-modal-xl" id="EditMasterDiskonModal" tabindex="-1" role="dialog" aria-labelledby="EditMasterCabangModal" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                    <div class="modal-body social-profile text-start">
                      <div class="modal-toggle-wrapper">
                        <div class="modal-header mb-4">
                            <h3>Edit Master Diskon</h3>
                            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="row g-3">
                        <!-- Tipe Diskon -->
                        <div class="col-md-12 position-relative">
                            <label class="form-label" for="FormTipeDiskon">Tipe Diskon</label>
                            <select class="form-select" id="FormTipeDiskon" required="">
                                <option selected="" disabled="" value="">Pilih Tipe Diskon ...</option>
                                <option>Nominal</option>
                            </select>
                            <div class="invalid-tooltip">Silahkan Pilih Tipe Diskon.</div>
                        </div>
                        <!-- Kode Diskon -->
                        <div class="col-md-12 position-relative">
                            <label class="form-label" for="FormBuatKodeDiskon">Kode Diskon</label>
                            <input class="form-control" id="kode" type="text" placeholder="Buat Kode Diskon" required="">
                            <div class="valid-tooltip">Looks good!</div>
                        </div>
                        <!-- Nilai Diskon -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormBuatKuotaDiskon">Nilai Diskon</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">Rp</span>
                                <input class="form-control is-invalid" id="FormBuatKuotaDiskon" type="text" onkeyup="formatRupiah(this)" required="">
                            </div>
                        </div>
                        <!-- Kuota Diskon -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormBuatKuotaDiskon">Kuota Diskon</label>
                            <input class="form-control" id="kuota" type="text" placeholder="Input Jumlah Kuota Diskon" required oninput="kuotaDiskon(this)">
                            <div class="valid-tooltip">Looks good!</div>
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
