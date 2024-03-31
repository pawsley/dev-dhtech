        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Stock Opname Baru</h4>
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
                    <li class="breadcrumb-item active"> Stock Opname</li>
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
                            <h4>Informasi Audit</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-0">
                                <form class="row g-3">
                                <!-- ID StockOpname -->
                                <div class="col-6"> 
                                    <label class="form-label" for="idstockopname">ID STOCK OPNAME</label>
                                    <input class="form-control" id="idstockopname" name="idstockopname" type="text" placeholder="TERISI OTOMATIS" aria-label="idproduk" readonly>
                                </div>
                                <!-- Tanggal Catatan -->
                                <div class="col-6"> 
                                    <label class="form-label" for="tanggalwaktubarang">Tanggal Waktu</label>
                                    <input class="form-control digits" id="tanggalwaktubarang" name="tanggalwaktubarang" type="datetime-local" readonly>
                                </div>
                                <!-- Pilih Cabang -->
                                <div class="col-6"> 
                                    <label class="form-label" for="pilihcabang">CABANG</label>
                                    <select class="form-select" id="cabang" name="cabang" required="">
                                        <option selected="" disabled="" value="0">Pilih Cabang</option>
                                    </select>
                                </div>
                                <!-- Pilih Auditor -->
                                <div class="col-6"> 
                                    <label class="form-label" for="pilihauditor">AUDITOR</label>
                                    <select class="form-select" id="auditor" name="auditor" required="">
                                        <option selected="" disabled="" value="0">Pilih Auditor</option>
                                    </select>
                                </div>
                                <!-- Submit -->
                                <div class="col-12 mt-3">
                                    <button class="btn btn-primary" id="addauditor" type="button">Submit Data</button>
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
                    <h4>Opname List</h4>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-primary simpanopnm" id="simpanopnm" style="border-left-style: solid;border-left-width: 1px;border-right-style: solid;margin-right: 16px;">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="table-ol">
                        <thead>
                            <tr>
                                <th>ID OPNAME</th>
                                <th>TANGGAL OPNAME</th>
                                <th>AUDITOR</th>
                                <th>CABANG</th>
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