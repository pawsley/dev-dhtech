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
                                <li class="breadcrumb-item active"> Karyawan</li>
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
                        <a href="#" class="cde" data-bs-toggle="modal" data-bs-target="#DetailDenda" data-total_denda="">
                            <div class="card widget-hover overflow-hidden">
                                <div class="card-header card-no-border pb-2">
                                    <h5>Denda Karyawan</h5>
                                </div>
                                <div class="card-body pt-0 count-student">
                                    <div class="school-wrapper"> 
                                        <div class="school-header">
                                            <div class="spinner-border text-primary d-none" role="status" id="spintd">
                                                <span class="visually-hidden"></span>
                                            </div>
                                            <h4 class="text-danger" id="countdenda"></h4>
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
                        </a>
                    </div>
                </div>
                <!-- Card Section Ends -->
                <!-- Section Akhir -->
                <div class="row">
                    <!-- Detail Absen Karyawan -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="m-3">
                                <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active txt-primary" id="timeline-tab" data-bs-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="true"><i class="fa fa-list-alt"></i>Timeline Karyawan</a></li>
                                    <li class="nav-item"><a class="nav-link txt-primary" id="calender-tab" data-bs-toggle="tab" href="#calender" role="tab" aria-controls="calender" aria-selected="false"><i class="fa fa-calendar"></i>Kalender Karyawan</a></li>
                                </ul>
                                <div class="tab-content" id="icon-tabContent">
                                    <div class="tab-pane fade show active" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                                        <div class="dt-ext table-responsive mt-2">
                                            <table class="display" id="table-timelineabsen">
                                                <thead>
                                                    <tr>
                                                        <th>ID KARYAWAN</th>
                                                        <th>NAMA KARYAWAN</th>
                                                        <th>TANGGAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="calender" role="tabpanel" aria-labelledby="calender-tab">
                                        <div class="mt-2 calendar-basic">
                                            <!-- <div class="card">
                                                <div class="card-body"> -->
                                                    <div class="row" id="wrap">
                                                        <div class="col-xxl-12 box-col-12">
                                                            <div class="calendar-default" id="calendar-container">
                                                                <div id="calendar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <!-- </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="container-fluid calendar-basic">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row" id="wrap">
                                        <div class="col-xxl-12 box-col-12">
                                            <div class="calendar-default" id="calendar-container">
                                                <div id="calendar"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
            <!-- Modal Map -->
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
                                                            <th><span class="f-light f-w-600">SENIN</span></th>
                                                            <th><span class="f-light f-w-600">SELASA</span></th>
                                                            <th><span class="f-light f-w-600">RABU</span></th>
                                                            <th><span class="f-light f-w-600">KAMIS</span></th>
                                                            <th><span class="f-light f-w-600">JUMAT</span></th>
                                                            <th><span class="f-light f-w-600">SABTU</span></th>
                                                            <th><span class="f-light f-w-600">MINGGU</span></th>
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
            <div class="modal fade bd-example-modal-xl" id="DetailDenda" tabindex="-1" role="dialog" aria-labelledby="DetailDenda" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content dark-sign-up">
                  <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                      <div class="modal-toggle-wrapper">
                          <div class="modal-header mb-4">
                              <h3>Detail Denda Karyawan</h3>
                              <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <!-- Data Table -->
                          <div class="col-lg-12"> 
                              <div class="card"> 
                                  <div class="card-body">
                                    <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active txt-primary" id="list-denda-tab" data-bs-toggle="tab" href="#list-denda" role="tab" aria-controls="list-denda" aria-selected="true"><i class="icofont icofont-list"></i>List Denda Karyawan</a></li>
                                        <li class="nav-item"><a class="nav-link txt-primary" id="setting-denda-tab" data-bs-toggle="tab" href="#setting-denda" role="tab" aria-controls="setting-denda" aria-selected="false"><i class="icofont icofont-settings"></i>Setting Denda Karyawan</a></li>
                                    </ul>
                                    <div class="tab-content" id="icon-tabContent">
                                        <div class="tab-pane fade show active" id="list-denda" role="tabpanel" aria-labelledby="list-denda-tab">
                                            <div class="table-responsive mt-2">
                                                <table class="display" id="table-denda-kry">
                                                    <thead>
                                                        <tr>
                                                            <th><span class="f-light f-w-600">NAMA KARYAWAN</span></th>
                                                            <th><span class="f-light f-w-600">DENDA TELAT ABSEN</span></th>
                                                            <th><span class="f-light f-w-600">DURASI TELAT</span></th>
                                                            <th><span class="f-light f-w-600">TANGGAL</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="setting-denda" role="tabpanel" aria-labelledby="setting-denda-tab">
                                            <div class="mt-2">
                                                <form id="form-setting-denda" class="row g-3">
                                                    <div class="col-12 position-relative">
                                                        <label for="nominal_denda" class="form-label">Nominal</label>
                                                        <input type="text" class="form-control" id="nominal_denda" name="nominal_denda" onkeyup="formatRupiah(this)" required>
                                                    </div>
                                                    <div class="col-6 position-relative">
                                                        <label for="durasi_denda" class="form-label">Durasi Denda</label>
                                                        <input type="time" class="form-control" id="durasi_denda" name="durasi_denda" required>
                                                    </div>
                                                    <div class="col-6 position-relative">
                                                        <label for="status_denda" class="form-label">Status Denda</label>
                                                        <select class="form-select" id="status_denda" name="status_denda" required>
                                                            <option value="">Pilih Status Denda</option>
                                                            <option value="ABSEN">ABSEN</option>
                                                            <option value="ISTIRAHAT">ISTIRAHAT</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6 position-relative">
                                                        <button type="button" id="btnsavedenda" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="table-responsive mt-2">
                                                <table class="display" id="table-denda">
                                                    <thead>
                                                        <tr>
                                                            <th><span class="f-light f-w-600">NOMINAL DENDA</span></th>
                                                            <th><span class="f-light f-w-600">DURASI</span></th>
                                                            <th><span class="f-light f-w-600">STATUS</span></th>
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
            <div class="modal fade bd-example-modal-xl" id="InfoAbsen" tabindex="-1" role="dialog" aria-labelledby="InfoAbsen" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content dark-sign-up">
                  <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                      <div class="modal-toggle-wrapper">
                          <div class="modal-header mb-4">
                              <h3>Detail Absensi Karyawan</h3>
                              <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <!-- Data Table -->
                          <div class="col-lg-12"> 
                              <div class="card"> 
                                  <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="display" id="table-detailabsen">
                                          <thead>
                                              <tr>
                                                  <th><span class="f-light f-w-600">NAMA KARYAWAN</span></th>
                                                  <th><span class="f-light f-w-600">SHIFT</span></th>
                                                  <th><span class="f-light f-w-600">TANGGAL</span></th>
                                                  <th><span class="f-light f-w-600">ABSEN MASUK</span></th>
                                                  <th><span class="f-light f-w-600">ABSEN PULANG</span></th>
                                                  <th><span class="f-light f-w-600">TERLAMBAT</span></th>
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
            <div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true" 
                data-schedule-id="" data-user-id="" data-work-date="">
                <div class="modal-dialog modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Jadwal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Nama Karyawan</span>
                                    <strong id="eventName"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Tanggal</span>
                                    <strong id="eventDate"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Shift Awal</span>
                                    <strong id="eventShift"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Ganti Shift</span>
                                    <select class="form-select form-select-sm w-auto" 
                                            id="rescheduleShift" 
                                            data-schedule-id="" 
                                            data-user-id="">
                                    </select>

                                </li>
                                <li class="list-group-item px-0 py-0">
                                    <div class="form-floating">
                                        <textarea class="form-control border-0 shadow-none" 
                                                id="floatingTextarea" 
                                                placeholder="Leave a comment here" 
                                                style="height:100px"></textarea>
                                        <label for="floatingTextarea">Keterangan</label>
                                    </div>
                                </li>
                            </ul>
                            <div class="mt-2">
                                <button type="button" class="btn btn-primary w-100" id="saveEventChanges">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->