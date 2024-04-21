        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Riwayat Penjualan</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="<?=base_url()?>">
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg>
                      </a>
                    </li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Applications</li>
                    <li class="breadcrumb-item"> Penjualan</li>
                    <li class="breadcrumb-item active"> Riwayat Penjualan</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Riwayat Penjualan -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h4>Laporan Penjualan</h4>
                                <div class="d-flex align-items-center">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-sales">
                                <thead>
                                    <tr>
                                        <th style="min-width: 30%; width: 20%;"><span class="f-light f-w-600">SALES</span></th>
                                        <th style="min-width: 40%; width: 40%;"><span class="f-light f-w-600">TOTAL PENJUALAN</span></th>
                                        <th style="min-width: 40%; width: 30%;"><span class="f-light f-w-600">TOTAL DISKON</span></th>
                                        <th style="min-width: 10%; width: 10%;"><span class="f-light f-w-600">DETAIL</span></th>
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
            <div class="modal fade bd-example-modal-xl" id="DetailPenjualan" tabindex="-1" role="dialog" aria-labelledby="DetailPenjualan" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                            <div class="modal-toggle-wrapper">
                                <div class="modal-header mb-4">
                                    <h3>Detail Penjualan</h3>
                                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Isi Konten -->
                                <ul class="list-group">
                                    <!-- Total -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Total Penjualan</span></strong>
                                        <strong id="ttdh">-</strong>
                                    </li>
                                </ul>
                                <!-- Data Table -->
                                <div class="col-lg-12"> 
                                    <div class="card"> 
                                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                                            <h5 id="saldh">-</h5>
                                        </div>
                                        <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="display" id="table-dt">
                                                <thead>
                                                    <tr>
                                                        <th><span class="f-light f-w-600">INVOICE</span></th>
                                                        <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                        <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                        <th><span class="f-light f-w-600">HARGA PRODUK</span></th>
                                                        <th><span class="f-light f-w-600">DISKON</span></th>
                                                        <th><span class="f-light f-w-600">HARGA JUAL</span></th>
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
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->