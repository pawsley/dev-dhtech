        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Data Master Kustomer</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">                                       
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Data Master</li>
                    <li class="breadcrumb-item active"> Master Kustomer</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Form Tambah Supplier -->
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="<?=base_url()?>master-kustomer/simpan-data">
                    <!-- ID Kustomer -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormIDKustomer">ID Kustomer</label>
                        <input class="form-control" id="FormIDKustomer" name="id" value="<?= $newID ?>" type="text" placeholder="ID KUSTOMER TERISI OTOMATIS" required="" readonly>
                        <div class="valid-tooltip">Looks good!</div>
                        </div>
                    <!-- Nama Kustomer -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormNamaKustomer">Nama Kustomer</label>
                        <input class="form-control" id="FormNamaKustomer" name="nama" type="text" placeholder="Masukkan Nama Kustomer" required="">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Alamat Email Kustomer -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormEmailKustomer">Email Kustomer</label>
                        <input class="form-control" id="FormEmailKustomer" name="email" type="email" placeholder="alamat@email.com" required="">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Kontak Kustomer -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormNomorKustomer">Kontak Kustomer</label>
                        <input class="form-control" id="FormNomorKustomer" name="wa" type="text" oninput="formatPhoneNumber(this)" placeholder="ex: 081220812206" required="">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Detai Alamat Kustomer -->
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="FormDetailAlamatKustomer">Detail Alamat Kustomer</label>
                        <input class="form-control" id="FormDetailAlamatKustomer" name="alamat" type="text" placeholder="contoh: Jl. Tamtama No 19" required="">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Button Tambah Kustomer Baru -->
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Tambah Kustomer</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Form Tambah Kustomer -->
            <!-- Listing Kustomer -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <h4>List Data Kustomer</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-kustomer">
                                    <thead>
                                    <tr>
                                        <th>ID KUSTOMER</th>
                                        <th>NAMA KUSTOMER</th>
                                        <th>EMAIL KUSTOMER</th>
                                        <th>KONTAK KUSTOMER</th>
                                        <th>ALAMAT KUSTOMER</th>
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
            <!-- End Listing Kustomer -->
            <!-- Modal Edit Data Master -->
            <div class="modal fade" id="EditMasterSupplierModal" tabindex="-1" role="dialog" aria-labelledby="EditMasterCabangModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                    <div class="modal-body social-profile text-start">
                      <div class="modal-toggle-wrapper">
                        <h3>Edit Kustomer</h3>
                        <form class="row g-3">
                        <!-- ID Supplier -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormIDSupplier">ID Supplier</label>
                            <input class="form-control" id="FormIDSupplier" type="text" placeholder="DHSUPP-0001" disabled>
                        </div>
                        <!-- Nama Supplier -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormNamaSupplier">Nama Supplier</label>
                            <input class="form-control" id="FormNamaSupplier" type="text" placeholder="Masukkan Namma Supplier">
                        </div>
                        <!-- PIC Supplier -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormPICSupplier">PIC Supplier</label>
                            <input class="form-control" id="FormPICSupplier" type="text" placeholder="Masukkan Nama PIC Supplier" required="">
                        </div>
                        <!-- Kontak Supplier -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormNomorSupplier">Kontak Supplier</label>
                            <input class="form-control" id="FormNomorSupplier" type="text" placeholder="ex: 081220812206" required="">
                        </div>
                        <!-- Provinsi Supplier -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormProvinsiSupplier">Provinsi Supplier</label>
                            <select class="form-select" id="FormProvinsiSupplier" required="">
                                <option selected="" disabled="" value="">Pilih Provinsi Supplier ...</option>
                                <option>Jawa Timur</option>
                                <option>Jawa Tengah</option>
                                <option>Jawa Barat</option>
                            </select>
                        </div>
                        <!-- Kabupaten / Kota -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormKotaKabSupplier">Kota / Kabupaten Supplier</label>
                            <select class="form-select" id="FormKotaKabSupplier" required="">
                                <option selected="" disabled="" value="">Pilih Kota / Kab Supplier ...</option>
                                <option>Kota Surabaya</option>
                                <option>Kabupaten Sidoarjo</option>
                                <option>Kabupaten Malang</option>
                            </select>
                        </div>
                        <!-- Kecamatan -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormKecamatanSupplier">Kecamatan</label>
                            <select class="form-select" id="FormKecamatanSupplier" required="">
                                <option selected="" disabled="" value="">Pilih Kecamatan Supplier ...</option>
                                <option>Jagir</option>
                                <option>Wonokromo</option>
                                <option>Kedung Asri</option>
                            </select>
                        </div>
                        <!-- Kelurahaan -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormKelurahaanSupplier">Kelurahan Supplier</label>
                            <select class="form-select" id="FormKelurahaanSupplier" required="">
                                <option selected="" disabled="" value="">Pilih Kelurahaan Supplier ...</option>
                                <option>Sawunggaling</option>
                                <option>Kesatrian</option>
                                <option>Gedangan</option>
                            </select>
                        </div>
                        <!-- Detai Alamat Supplier -->
                        <div class="col-md-12 position-relative">
                            <label class="form-label" for="FormDetailAlamatSupplier">Detail Alamat Supplier</label>
                            <input class="form-control" id="FormDetailAlamatSupplier" type="text" placeholder="contoh: Jl. Tamtama No 19" required="">
                        </div>
                        <!-- Status Supplier -->
                        <div class="col-md-12 position-relative">
                            <label class="form-label" for="StatusSupplier">Status Supplier</label>
                            <select class="form-select" id="StatusSupplier" required="">
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