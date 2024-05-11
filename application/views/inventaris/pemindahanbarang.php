        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Pemindahan Barang</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">                      
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a>
                    </li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Applications</li>
                    <li class="breadcrumb-item"> Data Barang</li>
                    <li class="breadcrumb-item active"> Pindah </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Card Status Data Barang -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Pemindahan Barang</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-0">
                                <form class="row g-3">
                                <!-- No Surat Pemindahan -->
                                <div class="col-6"> 
                                    <label class="form-label" for="no_sp">Nomor Surat Pemindahan</label>
                                    <input class="form-control" id="no_sp" name="no_sp" type="text" placeholder="TERISI OTOMATIS" aria-label="no_sp" readonly>
                                </div>
                                <!-- Tanggal -->
                                <div class="col-6"> 
                                    <label class="form-label" for="tanggalwaktubarang">Tanggal Waktu</label>
                                    <input class="form-control digits" id="tanggalwaktubarang" name="tanggalwaktubarang" type="datetime-local" readonly>
                                </div>
                                <!-- Pilih Cabang Awal -->
                                <div class="col-6"> 
                                    <label class="form-label" for="pilihcabang">Dari Cabang</label>
                                    <select class="form-select" id="f_cabang" name="f_cabang" required="">
                                        <option selected="" disabled="" value="0">Pilih Cabang</option>
                                    </select>
                                </div>
                                <!-- Pilih Cabang Penerima -->
                                <div class="col-6"> 
                                    <label class="form-label" for="pilihcabang">Kepada Cabang</label>
                                    <select class="form-select" id="t_cabang" name="t_cabang" required="">
                                        <option selected="" disabled="" value="0">Pilih Cabang</option>
                                    </select>
                                </div>                                
                                <!-- Submit -->
                                <div class="col-12 mt-3">
                                    <button class="btn btn-primary" id="addpindah" type="button">Submit Data</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Listing Stock Opname -->
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h4>Daftar Surat Pemindahan Barang</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="table-ol">
                        <thead>
                            <tr>
                                <th>TANGGAL</th>
                                <th>DARI CABANG</th>
                                <th>KEPADA CABANG</th>
                                <th>STATUS</th>
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
            <!-- End Listing Stock Opname -->
            <!-- Modal  -->
            <div class="modal fade bd-example-modal-lg" id="CariBarang" tabindex="-1" role="dialog" aria-labelledby="CariBarang" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                            <div class="modal-toggle-wrapper">
                                <div class="modal-header mb-4">
                                    <h3>Inventori Stock</h3>
                                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Isi Konten -->
                                <ul class="list-group">
                                  <!-- ID OPNAME -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <span>ID OPNAME</span>
                                      <strong id="ido">-</strong>
                                  </li>
                                  <!-- Nama Auditor -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <span>NAMA AUDITOR</span>
                                      <strong id="aud">-</strong>
                                  </li>
                                  <!-- NAMA CABANG -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <span>DETAIL CABANG</span>
                                      <strong id="cab">-</strong>
                                  </li>
                                  <!-- TANGGAL & WAKTU -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <span>TANGGAL & WAKTU</span>
                                      <strong id="dtgl">-</strong>
                                  </li>
                                  <!-- TOTAL PRODUK -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <span>TOTAL PRODUK</span>
                                      <strong id="cprod">0</strong>
                                  </li>
                                </ul>
                                <!-- Data Table -->
                                <div class="col-lg-12"> 
                                    <div class="card"> 
                                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                                            <h5>Produk List</h5>
                                            <a class="btn btn-primary" type="button" id="addprod"><i class="fa fa-plus"></i>Tambahkan</a>
                                        </div>
                                        <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="display" id="table-pr">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>SN PRODUK</th>
                                                        <th>NAMA PRODUK</th>
                                                        <th>MERK</th>
                                                        <th>JENIS</th>
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->