        <!-- Begin Content -->
        <?php 
            $jab= $this->session->userdata('jabatan'); 
            $allowed_roles = ['Finance', 'Manager Oprasional', 'OWNER'];
            $is_allowed = in_array($jab, $allowed_roles);
        ?>
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
                        <a href="#" class="ctf <?= $is_allowed ? '' : 'disabled-link' ?>" 
                        <?= $is_allowed ? 'data-bs-toggle="modal" data-bs-target="#DetailUser" data-total_usr=""' : '' ?>>
                            <div class="card widget-hover overflow-hidden" style="<?= $is_allowed ? '' : 'opacity:0.5; pointer-events:none;' ?>">
                                <div class="card-header card-no-border pb-2">
                                    <h5>Fingerprint Karyawan</h5>
                                </div>
                                <div class="card-body pt-0 count-student">
                                    <div class="school-wrapper"> 
                                        <div class="school-header">
                                            <div class="spinner-border text-primary d-none" role="status" id="spintf">
                                                <span class="visually-hidden"></span>
                                            </div>
                                            <h4 class="text-warning" id="counttf"></h4>
                                            <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                                <p class="text-muted">Realtime Updated</p>
                                            </div>
                                        </div>
                                        <div class="school-body">
                                            <img src="../assets/images/karyawan/absen-karyawan.png" alt="dh-karyawan">
                                            <div class="right-line">
                                                <img src="../assets/images/inventoriassets/line.png" alt="line">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="cti" data-bs-toggle="modal" data-bs-target="#DetailRest" data-total_usr="">
                            <div class="card widget-hover overflow-hidden">
                                <div class="card-header card-no-border pb-2">
                                    <h5>Istirahat Karyawan</h5>
                                </div>
                                <div class="card-body pt-0 count-student">
                                    <div class="school-wrapper"> 
                                        <div class="school-header">
                                            <div class="spinner-border text-primary d-none" role="status" id="spinti">
                                                <span class="visually-hidden"></span>
                                            </div>
                                            <h4 class="text-primary" id="countti"></h4>
                                            <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                                <p class="text-muted">Realtime Updated</p>
                                            </div>
                                        </div>
                                        <div class="school-body"><img src="../assets/images/karyawan/karyawan-terlambat.png" alt="dh-karyawan">
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
                                        <h4 class="text-danger">Rp0</h4>
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
                                    <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active txt-primary" id="list-fingerprint-tab" data-bs-toggle="tab" href="#list-fingerprint" role="tab" aria-controls="list-fingerprint" aria-selected="true"><i class="icofont icofont-database"></i>List Fingerprint</a></li>
                                        <li class="nav-item"><a class="nav-link txt-primary" id="setting-shift-tab" data-bs-toggle="tab" href="#setting-shift" role="tab" aria-controls="setting-shift" aria-selected="false"><i class="icofont icofont-ui-settings"></i>Setting Shift</a></li>
                                        <li class="nav-item"><a class="nav-link txt-primary" id="shift-karyawan-tab" data-bs-toggle="tab" href="#shift-karyawan" role="tab" aria-controls="shift-karyawan" aria-selected="false"><i class="icofont icofont-time"></i>Shift Karyawan</a></li>
                                    </ul>
                                    <div class="tab-content" id="icon-tabContent">
                                        <div class="tab-pane fade show active" id="list-fingerprint" role="tabpanel" aria-labelledby="list-fingerprint-tab">
                                            <div class="table-responsive mt-2">
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
                                        <div class="tab-pane fade" id="setting-shift" role="tabpanel" aria-labelledby="setting-shift-tab">
                                            <div class="mt-2">
                                                <form id="form-setting-shift" class="row g-3">
                                                    <div class="col-12 position-relative">
                                                        <label for="shift-name" class="form-label">Nama Shift</label>
                                                        <input type="text" class="form-control" id="nama_shift" name="nama_shift" required>
                                                    </div>
                                                    <div class="col-6 position-relative">
                                                        <label for="shift-time" class="form-label">Shift Masuk</label>
                                                        <input type="time" class="form-control" id="shift_in" name="shift_in" required>
                                                    </div>
                                                    <div class="col-6 position-relative">
                                                        <label for="shift-time" class="form-label">Shift Pulang</label>
                                                        <input type="time" class="form-control" id="shift_out" name="shift_out" required>
                                                    </div>
                                                    <div class="col-6 position-relative">
                                                        <button type="button" id="btnsave" class="btn btn-primary">Simpan Shift</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="table-responsive mt-2">
                                                <table class="display" id="table-shift">
                                                    <thead>
                                                        <tr>
                                                            <th><span class="f-light f-w-600">SHIFT</span></th>
                                                            <th><span class="f-light f-w-600">WAKTU</span></th>
                                                            <th><span class="f-light f-w-600">AKSI</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="shift-karyawan" role="tabpanel" aria-labelledby="shift-karyawan-tab">
                                            <div class="table-responsive mt-2">
                                                <table class="display" id="table-shift-kry">
                                                    <thead>
                                                        <tr>
                                                            <th><span class="f-light f-w-600">NAMA KARYAWAN</span></th>
                                                            <th><span class="f-light f-w-600">SHIFT</span></th>
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