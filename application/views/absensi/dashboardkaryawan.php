        <!-- Begin Content -->
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h4>Dashboard Karyawan</h4>
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
                                <li class="breadcrumb-item active"> Dashboard Karyawan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <!-- Card Sections -->
                <div class="row">
                    <!-- Total Karyawan -->
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="ctu" data-bs-toggle="modal" data-bs-target="#DetailUser" data-total_usr="">
                            <div class="card widget-hover overflow-hidden">
                                <div class="card-header card-no-border pb-2">
                                    <h5>Fingerprint Karyawan</h5>
                                </div>
                                <div class="card-body pt-0 count-student">
                                    <div class="school-wrapper"> 
                                        <div class="school-header">
                                            <h4 class="text-warning">20</h4>
                                            <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                                <p class="text-muted">Realtime Updated</p>
                                            </div>
                                        </div>
                                        <div class="school-body"><img src="../assets/images/karyawan/karyawans.png" alt="dh-karyawan">
                                            <div class="right-line"><img src="../assets/images/inventoriassets/line.png" alt="line"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="ctu" data-bs-toggle="modal" data-bs-target="#DetailRest" data-total_usr="">
                            <div class="card widget-hover overflow-hidden">
                                <div class="card-header card-no-border pb-2">
                                    <h5>Istirahat Karyawan</h5>
                                </div>
                                <div class="card-body pt-0 count-student">
                                    <div class="school-wrapper"> 
                                        <div class="school-header">
                                            <h4 class="text-primary">0</h4>
                                            <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                                <p class="text-muted">Realtime Updated</p>
                                            </div>
                                        </div>
                                        <div class="school-body"><img src="../assets/images/karyawan/karyawans.png" alt="dh-karyawan">
                                            <div class="right-line"><img src="../assets/images/inventoriassets/line.png" alt="line"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Denda Karyawan Bulanan -->
                    <div class="col-md-4 col-sm-6">
                    <div class="card widget-hover overflow-hidden">
                        <div class="card-header card-no-border pb-2">
                        <h5>Denda Karyawan</h5>
                        </div>
                        <div class="card-body pt-0 count-student">
                        <div class="school-wrapper"> 
                            <div class="school-header">
                            <h4 class="text-danger">Rp350.000</h4>
                            <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                <p class="text-muted">Bulan Ini</p>
                            </div>
                            </div>
                            <div class="school-body"><img src="../assets/images/karyawan/dendakaryawan.png" alt="dh-karyawan">
                            <div class="right-line"><img src="../assets/images/inventoriassets/line.png" alt="line"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- Denda Karyawan -->
                    <!-- <div class="col-md-4 col-sm-6">
                    <div class="card widget-hover overflow-hidden">
                        <div class="card-header card-no-border pb-2">
                        <h5>Total Denda Karyawan</h5>
                        </div>
                        <div class="card-body pt-0 count-student">
                        <div class="school-wrapper"> 
                            <div class="school-header">
                            <h4 class="text-danger">Rp4.700.000</h4>
                            <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                <p class="text-muted">Realtime Updated</p>
                            </div>
                            </div>
                            <div class="school-body"><img src="../assets/images/karyawan/totaldenda.png" alt="dh-karyawan">
                            <div class="right-line"><img src="../assets/images/inventoriassets/line.png" alt="line"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div> -->
                </div>
                <!-- Card Section Ends -->
                <!-- Section Akhir -->
                <div class="row">
                <!-- Detail Denda Karyawan -->
                <!-- <div class="col-xxl-6 col-md-6">
                    <div class="card height-equal">
                    <div class="card-header">
                        <h4>Denda Karyawan Tahunan</h4>
                    </div>
                    <div class="card-body">
                        <div class="vertical-scroll scroll-demo scroll-b-none">
                        <ul class="schedule-list">
                            <li class="warning">
                            <img src="../assets/images/karyawan/user-1.png" alt="profile">
                            <div> 
                                <h6 class="mb-1">FIGO VIO HIDAYAT</h6>
                                <ul>
                                <li class="f-light">
                                    <svg class="fill-icon f-light">
                                    <use href="../assets/svg/icon-sprite.svg#bag"></use>
                                    </svg><span>DHEMP-0001</span>
                                </li>
                                <li class="f-light">
                                    <svg class="fill-icon f-success">
                                    <use href="../assets/svg/icon-sprite.svg#clock"></use>
                                    </svg><span> 75 Menit</span>
                                </li>
                                </ul>
                            </div>
                            <div class=" justify-content-between">
                                <h6 class="text-danger text-end"> Rp750.000</h6>
                            </div>
                            </li>
                            <li class="warning">
                            <img src="../assets/images/karyawan/user-3.png" alt="profile">
                            <div> 
                                <h6 class="mb-1">ALDO DIO HIDAYAT</h6>
                                <ul>
                                <li class="f-light">
                                    <svg class="fill-icon f-light">
                                    <use href="../assets/svg/icon-sprite.svg#bag"></use>
                                    </svg><span>DHEMP-0002</span>
                                </li>
                                <li class="f-light">
                                    <svg class="fill-icon f-success">
                                    <use href="../assets/svg/icon-sprite.svg#clock"></use>
                                    </svg><span> 69 Menit</span>
                                </li>
                                </ul>
                            </div>
                            <div class=" justify-content-between">
                                <h6 class="text-danger text-end"> Rp690.000</h6>
                            </div>
                            </li>
                            <li class="warning">
                            <img src="../assets/images/karyawan/user-5.png" alt="profile">
                            <div> 
                                <h6 class="mb-1">RANGGIA SATRIA PUTRA</h6>
                                <ul>
                                <li class="f-light">
                                    <svg class="fill-icon f-light">
                                    <use href="../assets/svg/icon-sprite.svg#bag"></use>
                                    </svg><span>DHEMP-0004</span>
                                </li>
                                <li class="f-light">
                                    <svg class="fill-icon f-success">
                                    <use href="../assets/svg/icon-sprite.svg#clock"></use>
                                    </svg><span> 50 Menit</span>
                                </li>
                                </ul>
                            </div>
                            <div class=" justify-content-between">
                                <h6 class="text-danger text-end"> Rp500.000</h6>
                            </div>
                            </li>
                            <li class="warning">
                            <img src="../assets/images/karyawan/user-2.png" alt="profile">
                            <div> 
                                <h6 class="mb-1">SHERLY TANAPUTRA</h6>
                                <ul>
                                <li class="f-light">
                                    <svg class="fill-icon f-light">
                                    <use href="../assets/svg/icon-sprite.svg#bag"></use>
                                    </svg><span>DHEMP-0003</span>
                                </li>
                                <li class="f-light">
                                    <svg class="fill-icon f-success">
                                    <use href="../assets/svg/icon-sprite.svg#clock"></use>
                                    </svg><span> 30 Menit</span>
                                </li>
                                </ul>
                            </div>
                            <div class=" justify-content-between">
                                <h6 class="text-danger text-end"> Rp300.000</h6>
                            </div>
                            </li>
                        </ul>
                        </div>
                    </div>
                    </div>
                </div> -->
                <!-- Detail Absen Karyawan -->
                <div class="col-xxl-12 col-md-12 notification main-timeline">
                    <div class="card">
                    <div class="card-header">
                        <h4>Timeline Absensi</h4>
                    </div>
                    <div class="card-body dark-timeline">
                        <div class="table-responsive">
                            <table class="display" id="table-timelineabsen">
                                <thead>
                                    <tr>
                                        <th><span class="f-light f-w-600">FINGER ID</span></th>
                                        <th><span class="f-light f-w-600">NAMA KARYAWAN</span></th>
                                        <th><span class="f-light f-w-600">ABSEN</span></th>
                                        <th><span class="f-light f-w-600">STATUS</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="vertical-scroll scroll-demo scroll-b-none">
                        <ul>
                            <li class="d-flex">
                            <div class="timeline-dot-danger"></div>
                            <div class="w-100 ms-3">
                                <p class="d-flex justify-content-between mb-2">
                                <span class="date-content light-background">Absen Keluar</span>
                                <span>23/01/2024 20:03 WIB</span>
                                </p>
                                <h6>FIGO VIO HIDAYAT | DHEMP-0001<span class="dot-notification"></span></h6>
                                <p class="f-light">
                                Telah melakukan absen keluar
                                </p>
                            </div>
                            </li>
                            <li class="d-flex">
                            <div class="timeline-dot-danger"></div>
                            <div class="w-100 ms-3">
                                <p class="d-flex justify-content-between mb-2">
                                <span class="date-content light-background">Absen Keluar</span>
                                <span>23/01/2024 18:17 WIB</span>
                                </p>
                                <h6>ALDO DIO HIDAYAT | DHEMP-0002<span class="dot-notification"></span></h6>
                                <p class="f-light">
                                Telah melakukan absen keluar
                                </p>
                            </div>
                            </li>
                            <li class="d-flex">
                            <div class="timeline-dot-success"></div>
                            <div class="w-100 ms-3">
                                <p class="d-flex justify-content-between mb-2"><span class="date-content light-background">Absen Masuk</span><span>23/01/2024 09:00 WIB</span></p>
                                <h6>FIGO VIO HIDAYAT | DHEMP-0001<span class="dot-notification"></span></h6>
                                <p class="f-light">Telah hadir di 
                                <span class="light-background">
                                    <a href="javascrip(0);" data-bs-toggle="modal" data-bs-target="#MapKaryawan">Lokasi</a>
                                </span>
                                dan
                                <span class="light-background">
                                    <a href="javascrip(0);" data-bs-toggle="modal" data-bs-target="#FotoKaryawanAbsen">Foto</a>
                                </span>
                                </p>
                            </div>
                            </li>
                            <li class="d-flex">
                            <div class="timeline-dot-success"></div>
                            <div class="w-100 ms-3">
                                <p class="d-flex justify-content-between mb-2"><span class="date-content light-background">Absen Masuk</span><span>23/01/2024 08:45 WIB</span></p>
                                <h6>ALDO DIO HIDAYAT | DHEMP-0002<span class="dot-notification"></span></h6>
                                <p class="f-light">Telah hadir di 
                                <span class="light-background">
                                    <a href="javascrip(0);" data-bs-toggle="modal" data-bs-target="#MapKaryawan">Lokasi</a>
                                </span>
                                dan
                                <span class="light-background">
                                    <a href="javascrip(0);" data-bs-toggle="modal" data-bs-target="#FotoKaryawanAbsen">Foto</a>
                                </span>
                                </p>
                            </div>
                            </li>
                        </ul>
                        </div> -->
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
            <!-- Modal Map -->
            <div class="modal fade  bd-example-modal-lg" id="MapKaryawan" tabindex="-1" role="dialog" aria-labelledby="MapKaryawan" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="border-radius:5%; max-height: 90vh; overflow-y: auto;">
                        <div class="modal-toggle-wrapper">
                        <div class="modal-header mb-4">
                            <h3>Detail Map Lokasi</h3>
                            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="card-body z-1">
                            <div class="map-js-height" id="weathermap"></div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- Modal Gambar Absen -->
            <div class="modal fade" id="FotoKaryawanAbsen" tabindex="-1" role="dialog" aria-labelledby="FotoKaryawanAbsen" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="border-radius:5%; max-height: 90vh; overflow-y: auto;">
                        <div class="modal-toggle-wrapper">
                        <div class="modal-header mb-4">
                            <h3>Detil Foto Absen</h3>
                            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="card-body align-content-center">
                            <img class="img-thumbnail" src="../assets/images/fotoabsen/test.jpeg">
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-xl" id="DetailUser" tabindex="-1" role="dialog" aria-labelledby="DetailUser" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content dark-sign-up">
                  <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                      <div class="modal-toggle-wrapper">
                          <div class="modal-header mb-4">
                              <h3>Detail Fingerprint Karyawan</h3>
                              <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <!-- Data Table -->
                          <div class="col-lg-12"> 
                              <div class="card"> 
                                  <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="display" id="table-kry">
                                          <thead>
                                              <tr>
                                                  <th><span class="f-light f-w-600">FINGER ID</span></th>
                                                  <th><span class="f-light f-w-600">NAMA KARYAWAN</span></th>
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
            <div class="modal fade bd-example-modal-xl" id="DetailRest" tabindex="-1" role="dialog" aria-labelledby="DetailRest" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content dark-sign-up">
                  <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                      <div class="modal-toggle-wrapper">
                          <div class="modal-header mb-4">
                              <h3>Detail Istirahat Karyawan</h3>
                              <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <!-- Data Table -->
                          <div class="col-lg-12"> 
                              <div class="card"> 
                                  <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="display" id="table-istirahat">
                                          <thead>
                                              <tr>
                                                  <th><span class="f-light f-w-600">NAMA KARYAWAN</span></th>
                                                  <th><span class="f-light f-w-600">TANGGAL</span></th>
                                                  <th><span class="f-light f-w-600">ISTIRAHAT</span></th>
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
        <!-- End Content -->