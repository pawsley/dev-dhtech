        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Order Masuk</h4>
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
                    <li class="breadcrumb-item active"> Order Masuk</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                <!-- Card Cabang -->
                <?php foreach ($setcabang as $sc) { ?>
                    <div class="col-md-4 col-sm-6">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#DetailPenjualan" class="cardLink" data-id="<?=$sc['id_toko']?>" data-total="<?=$sc['total_penjualan']?>" data-cabang="<?=$sc['nama_toko']?>">
                            <div class="card widget-hover overflow-hidden">
                                <div class="card-header card-no-border pb-2">
                                    <h5 id="id_toko" data-id="<?=$sc['id_toko']?>">Transaksi <?=$sc['nama_toko']?></h5>
                                </div>
                                <div class="card-body pt-0 count-student">
                                    <div class="school-wrapper"> 
                                        <div class="school-header" data-id="<?=$sc['id_toko']?>">
                                            <div class="spinner-border text-primary d-none" role="status" id="spinner-<?=$sc['id_toko']?>">
                                                <span class="visually-hidden">Memuat...</span>
                                            </div>
                                            <h4 class="txt-success counting" id="counting-<?=$sc['id_toko']?>">Rp <?=$sc['total_penjualan']?></h4>
                                            <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                                <p class="text-muted">Update Hari ini</p>
                                            </div>                          
                                        </div>
                                        <div class="school-body"> <img src="<?=base_url()?>assets/images/inventoriassets/store-dh.png" alt="store-produk-dh">
                                            <div class="right-line"><img src="<?=base_url()?>assets/images/inventoriassets/line.png" alt="line"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <!-- List Order Masuk -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <div class="row">
                                <div class="col-md-8 position-relative">
                                    <h4>Daftar Order Masuk</h4>
                                </div>
                                <div class="col-md-4 position-relative">
                                    <select class="form-select" id="cab" name="cab" required="">
                                        <option selected="" disabled="" value="0">Semua Cabang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-om">
                                    <thead>
                                        <tr>
                                        <th><span class="f-light f-w-600">INVOICE</span></th>
                                        <th><span class="f-light f-w-600">TGL & JAM</span></th>
                                        <th><span class="f-light f-w-600">CABANG</span></th>
                                        <th><span class="f-light f-w-600">TIPE</span></th>
                                        <th><span class="f-light f-w-600">BANK PENERIMA</span></th>
                                        <th><span class="f-light f-w-600">PENJUALAN</span></th>
                                        <th><span class="f-light f-w-600">TOTAL</span></th>
                                        <th><span class="f-light f-w-600">AKSI</span></th>
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
          <div class="modal fade bd-example-modal-lg" id="DetailPenjualan" tabindex="-1" role="dialog" aria-labelledby="DetailPenjualan" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content dark-sign-up">
                    <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                        <div class="modal-toggle-wrapper">
                            <div class="modal-header mb-4">
                                <h3>Detail Transaksi Hari Ini</h3>
                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- Isi Konten -->
                            <ul class="list-group">
                                <!-- Total -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Total Penjualan</span></strong>
                                    <strong id="odto">-</strong>
                                </li>
                            </ul>
                            <!-- Data Table -->
                            <div class="col-lg-12"> 
                                <div class="card"> 
                                    <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                                        <h5 id="cabdh">-</h5>
                                    </div>
                                    <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display" id="table-dt">
                                            <thead>
                                                <tr>
                                                    <th><span class="f-light f-w-600">INVOICE</span></th>
                                                    <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                    <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                    <th><span class="f-light f-w-600">NOMINAL</span></th>
                                                    <th><span class="f-light f-w-600">PENJUALAN</span></th>
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
          <div class="modal fade bd-example-modal-xl" id="DetailInvoice" tabindex="-1" role="dialog" aria-labelledby="DetailInvoice" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content dark-sign-up">
                    <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                        <div class="modal-toggle-wrapper">
                            <div class="modal-header mb-4">
                                <h3>Detail Invoice <span id="noinv"></span></h3>
                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- Data Table -->
                            <div class="col-lg-12"> 
                                <div class="card"> 
                                    <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display" id="table-dtiv">
                                            <thead>
                                                <tr>
                                                    <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                    <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                    <th><span class="f-light f-w-600">KONDISI</span></th>
                                                    <th><span class="f-light f-w-600">NOMINAL</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        </div>                                            
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Total</span></strong>
                                    <strong id="tt">-</strong>                                                           
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Diskon</span></strong>
                                    <strong id="di">-</strong>                                                              
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Grand Total</span></strong>
                                    <strong id="gt">-</strong>                                                                        
                                </li>
                            </ul>                            
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <!-- Modal Detail Produk -->
          <div class="modal fade" id="DetailProduk" tabindex="-1" role="dialog" aria-labelledby="DetailProduk" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content dark-sign-up">
                    <div class="modal-body social-profile text-start" style="border-radius:5%; max-height: 90vh; overflow-y: auto;">
                    <div class="modal-toggle-wrapper">
                      <div class="modal-header mb-4">
                          <h3>Detail Info Barang</h3>
                          <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                        <ul class="list-group">
                            <!-- Barcode Produk -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Barcode Produk</span>
                                <strong>
                                    <div style="font-size:0;position:relative;width:90px;height:35px;">
                                        <div style="background-color:black;width:2px;height:35px;position:absolute;left:0px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:3px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:6px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:11px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:4px;height:35px;position:absolute;left:13px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:19px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:22px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:27px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:2px;height:35px;position:absolute;left:30px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:33px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:4px;height:35px;position:absolute;left:35px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:41px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:44px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:49px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:2px;height:35px;position:absolute;left:52px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:55px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:2px;height:35px;position:absolute;left:57px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:63px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:2px;height:35px;position:absolute;left:66px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:70px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:75px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:2px;height:35px;position:absolute;left:77px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:3px;height:35px;position:absolute;left:82px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:1px;height:35px;position:absolute;left:86px;top:0">&nbsp;</div>
                                        <div style="background-color:black;width:2px;height:35px;position:absolute;left:88px;top:0">&nbsp;</div>
                                    </div>
                                </strong>
                            </li>
                            <!-- ID Produk -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>ID Produk</span>
                                <strong>DHP-010201020503001</strong>
                            </li>
                            <!-- SN Produk -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>SN Produk</span>
                                <strong>350944540625782</strong>
                            </li>
                            <!-- Suplier -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Supplier</span>
                                <strong>DHSUPP-0002 | (TAM) Teletama Artha Mandiri</strong>
                            </li>
                            <!-- Nama Produk -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Nama Produk</span>
                                <strong>Iphone 12 Pro Max</strong>
                            </li>
                            <!-- Kondisi Produk -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Kondisi Produk</span>
                                <strong>BARU</strong>
                            </li>
                            <!-- Merek Produk -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Merek Produk</span>
                                <strong>Apple</strong>
                            </li>
                            <!-- Jenis Produk -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Jenis Produk</span>
                                <strong>Handphone</strong>
                            </li>
                            <!-- Penyimpanan -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Penyimpanan</span>
                                <strong>256 Gb</strong>
                            </li>
                            <!-- Variant Warna -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Variant Warna</span>
                                <strong>Midnight Blue</strong>
                            </li>
                            <!-- Tanggal Registrasi -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Tanggal Register</span>
                                <strong>23/01/2024</strong>
                            </li>
                            <!-- Waktu Register -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Waktu Register</span>
                                <strong>18:39:59</strong>
                            </li>
                            <!-- Posisi Barang -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Posisi Produk</span>
                                <strong>DHC-0001 | WTC Store</strong>
                            </li>
                        </ul>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <!-- Modal Detail Produk Bekas -->
          <div class="modal fade" id="DetailProdukBekas" tabindex="-1" role="dialog" aria-labelledby="DetailProdukBekas" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start" style="border-radius:5%; max-height: 90vh; overflow-y: auto;">
                      <div class="modal-toggle-wrapper">
                          <div class="modal-header mb-4">
                              <h3>Detail Info Barang</h3>
                              <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <ul class="list-group">
                              <!-- Barcode Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Barcode Produk</span>
                                  <strong>
                                      <div style="font-size:0;position:relative;width:90px;height:35px;">
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:0px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:3px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:6px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:11px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:4px;height:35px;position:absolute;left:13px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:19px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:22px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:27px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:30px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:33px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:4px;height:35px;position:absolute;left:35px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:41px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:44px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:49px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:52px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:55px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:57px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:63px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:66px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:70px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:75px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:77px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:3px;height:35px;position:absolute;left:82px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:86px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:88px;top:0">&nbsp;</div>
                                      </div>
                                  </strong>
                              </li>
                              <!-- ID Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>ID Produk</span>
                                  <strong>DHP-010201020503001</strong>
                              </li>
                              <!-- SN Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>SN Produk</span>
                                  <strong>350944540625782</strong>
                              </li>
                              <!-- Suplier -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Supplier</span>
                                  <strong>DHSUPP-0002 | (TAM) Teletama Artha Mandiri</strong>
                              </li>
                              <!-- Nama Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Nama Produk</span>
                                  <strong>Iphone 12 Pro Max</strong>
                              </li>
                              <!-- Kondisi Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Kondisi Produk</span>
                                  <strong>BARU</strong>
                              </li>
                              <!-- Merek Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Merek Produk</span>
                                  <strong>Apple</strong>
                              </li>
                              <!-- Jenis Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Jenis Produk</span>
                                  <strong>Handphone</strong>
                              </li>
                              <!-- Penyimpanan -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Penyimpanan</span>
                                  <strong>256 Gb</strong>
                              </li>
                              <!-- Variant Warna -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Variant Warna</span>
                                  <strong>Midnight Blue</strong>
                              </li>
                              <!-- Tanggal Registrasi -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Tanggal Register</span>
                                  <strong>23/01/2024</strong>
                              </li>
                              <!-- Waktu Register -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Waktu Register</span>
                                  <strong>18:39:59</strong>
                              </li>
                              <!-- Posisi Barang -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Posisi Produk</span>
                                  <strong>DHC-0001 | WTC Store</strong>
                              </li>
                              <!-- Catatan Tambahan -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span class="accordion-item accordion-wrapper">
                                      <h2 class="accordion-header" id="outlineaccordionthree">
                                      <button class="accordion-button collapsed accordion-light-primary txt-danger" type="button" data-bs-toggle="collapse" data-bs-target="#left-collapseThree" aria-expanded="false" aria-controls="left-collapseThree">
                                          <strong>Catatan Tambahan Produk</strong>
                                      </button>
                                      </h2>
                                      <div class="accordion-collapse collapse" id="left-collapseThree" aria-labelledby="outlineaccordionthree" data-bs-parent="#outlineaccordion">
                                      <div class="accordion-body">
                                          <ul class="d-flex flex-column gap-3 accordions-content">
                                              <li>---------------------------------------------------------</li>
                                              <li>Kondisi Fisik 98%</li>
                                              <li>Lightning Cable Tidak Ada</li>
                                              <li>Setiap Enter nanti ganti paragraf</li>
                                              <li>Outputnya Kayak Gini Mas....</li>
                                          </ul>
                                      </div>
                                      </div>
                                  </span>
                              </li>
                          </ul>
                      </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->