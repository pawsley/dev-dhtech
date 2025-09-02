var tableKry;
var tableTlAbsen;
var tableTlRest;
var tableShift;
var tableShiftKry;
var tableDenda;
var laporanDenda;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});
$(document).ready(function() {
    getFingerKaryawan();
    getTimelineAbsen();
    getTimelineRest();
    getSettingShift();
    getSettingDenda();
    addShift();
    addDenda();
    getLaporanDenda();
    getKaryawanShift();
    card();
    allcount(formatcur);
});
function getLaporanDenda() {
if ($.fn.DataTable.isDataTable('#table-denda-kry')) {
        laporanDenda.destroy();
    }
    laporanDenda = $("#table-denda-kry").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [3, 'desc'],
        "ajax": {
            "url": base_url + 'DashboardKar/getDendaKaryawan',
            "type": "POST"
        },
        autoWidth: false,
        columnDefs: [
            { width: "40%", targets: 0 },
            { width: "20%", targets: 1 },
            { width: "20%", targets: 2 },
            { width: "20%", targets: 3 },
        ],
        "columns": [
            {
                "data": "nama_lengkap",
                "orderable": false,
            },
            { 
                "data": "denda",
                "orderable": false,
                "render": function(data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "durasi_terlambat",
                "orderable": false,
            },
            { "data": "tanggal" }
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'col-sm-12 col-md-2'B>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p>>",
        "buttons": [
            {
            "text": '<i class="icofont icofont-refresh"></i>', // Use Font Awesome refresh icon
            "className": 'custom-refresh-button',
            "attr": {
                "id": "refresh-button"
            },
            "init": function (api, node, config) {
                $(node).removeClass('btn-default');
                $(node).addClass('btn-primary');
                $(node).attr('title', 'Refresh');
            },
            "action": function () {
                laporanDenda.ajax.reload();
            }
            },
        ]
    });
    return laporanDenda;
}
function getFingerKaryawan() {
    if ($.fn.DataTable.isDataTable('#table-kry')) {
        tableKry.destroy();
    }
    tableKry = $("#table-kry").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'DashboardKar/getFingerData',
            "type": "POST"
        },
        autoWidth: false,
        columnDefs: [
            { width: "20%", targets: 0 },
            { width: "80%", targets: 1 }
        ],
        "columns": [
            { "data": "finger_id" },
            {
                "data": "nama_lengkap",
                "render": function (data, type, row, meta) {
                    return '<select class="select2finger" value="'+row.id_user+'" data-id_user="'+row.id_user+'" data-finger_id="'+row.finger_id+'" data-current-value="' + data + '"></select>';
                },
            },                     
        ],
        "drawCallback": function(settings) {
            $('.select2finger').each(function() {
                var $select = $(this);
                var currentValue = $select.data('current-value');
                var value = $select.data('id_user');
        
                $select.select2({
                    dropdownParent: $("#DetailUser"),
                    language: 'id',
                    ajax: {
                        url: base_url + 'DashboardKar/getKaryawanData',
                        type: 'GET',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item.id_user,
                                        text: item.nama_lengkap,
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
                if (currentValue) {
                    $select.append('<option value="' + value + '" selected>' + currentValue + '</option>').trigger('change');
                }

                $select.on('change', function() {
                    var newValue = $(this).val();
                    var finger_id = $select.data('finger_id');
                    
                    $.ajax({
                        url: base_url+'DashboardKar/updateFinger',
                        method: 'POST',
                        data: {
                            finger_id: finger_id,
                            id_user: newValue 
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                swal("Berhasil terdaftar!", {
                                    icon: "success",
                                }).then((value) => {
                                    tableKry.ajax.reload();
                                });
                            } else {
                                swal("Gagal terdaftar", {
                                    icon: "error",
                                });
                            }
                        },
                    });
                });
            });
        },
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'col-sm-12 col-md-2'B>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p>>",
               "buttons": [
                {
                    "text": '<i class="icofont icofont-refresh"></i>', // Font Awesome icon for refresh
                    "className": 'custom-refresh-button', // Add a class name for identification
                    "attr": {
                        "id": "refresh-button" // Set the ID attribute
                    },
                    "init": function (api, node, config) {
                        $(node).removeClass('btn-default');
                        $(node).addClass('btn-primary');
                        $(node).attr('title', 'Refresh'); // Add a title attribute for tooltip
                    },
                    "action": function () {
                        tableKry.ajax.reload();
                    }
                },
            ]
    });
    return tableKry;
}
function getKaryawanShift() {
    if ($.fn.DataTable.isDataTable('#table-shift-kry')) {
        tableShiftKry.destroy();
    }
    tableShiftKry = $("#table-shift-kry").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'DashboardKar/getShiftKaryawan',
            "type": "POST"
        },
        autoWidth: false,
        columnDefs: [
            { width: "80%", targets: 0 },
            { width: "20%", targets: 1 }
        ],
        "columns": [
            { "data": "nama_lengkap" },
            {
                "data": "shift",
                "render": function (data, type, row, meta) {
                    return '<select class="select2shift" value="'+data+'" data-id_user="'+row.id_user+'" data-ids="'+row.id+'" data-current-value="' + data + '"></select>';
                },
            },                     
        ],
        "drawCallback": function(settings) {
            $('.select2shift').each(function() {
                var $select = $(this);
                var currentValue = $select.data('current-value');
                var value = $select.data('id_user');
        
                $select.select2({
                    dropdownParent: $("#DetailUser"),
                    language: 'id',
                    ajax: {
                        url: base_url + 'DashboardKar/getShiftData',
                        type: 'GET',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item.id,
                                        text: item.nama,
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
                if (currentValue) {
                    $select.append('<option value="' + value + '" selected>' + currentValue + '</option>').trigger('change');
                }

                $select.on('change', function() {
                    var newValue = $(this).val();
                    var id_user = $select.data('id_user');
                    
                    $.ajax({
                        url: base_url+'DashboardKar/updateShiftKaryawan',
                        method: 'POST',
                        data: {
                            id_user: id_user,
                            id_shift: newValue 
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                swal("Berhasil diperbarui!", {
                                    icon: "success",
                                }).then((value) => {
                                    tableShiftKry.ajax.reload();
                                });
                            } else {
                                swal("Gagal diperbarui", {
                                    icon: "error",
                                });
                            }
                        },
                    });
                });
            });
        },
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'col-sm-12 col-md-2'B>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p>>",
               "buttons": [
                {
                    "text": '<i class="icofont icofont-refresh"></i>', // Font Awesome icon for refresh
                    "className": 'custom-refresh-button', // Add a class name for identification
                    "attr": {
                        "id": "refresh-button" // Set the ID attribute
                    },
                    "init": function (api, node, config) {
                        $(node).removeClass('btn-default');
                        $(node).addClass('btn-primary');
                        $(node).attr('title', 'Refresh'); // Add a title attribute for tooltip
                    },
                    "action": function () {
                        tableShiftKry.ajax.reload();
                    }
                },
            ]
    });
    return tableShiftKry;
}
function getSettingShift() {
    if ($.fn.DataTable.isDataTable('#table-shift')) {
        tableShift.destroy();
    }
    tableShift = $("#table-shift").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'DashboardKar/getSettingShift',
            "type": "POST"
        },
        autoWidth: false,
        columnDefs: [
            { width: "40%", targets: 0 },
            { width: "50%", targets: 1 },
            { width: "10%", targets: 2 }
        ],
        "columns": [
            { 
                "data": "nama",
                "orderable": false,
            },
            { 
                "data": "waktu_shift",
                "orderable": false,
            },
            {
                "data": "id",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                            <ul class="action">
                                <div class="btn-group">
                                    <button class="btn btn-primary" id="editsf" data-id="${data}""><i class="icofont icofont-ui-edit"></i></button>
                                    <button class="btn btn-danger" id="deletesf" data-id="${data}"><i class="icofont icofont-ui-delete"></i></button>
                                </div>
                            </ul>
                        `;
                    }
                    return data;
                }
            },                     
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'col-sm-12 col-md-2'B>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p>>",
        "buttons": [
            {
            "text": '<i class="icofont icofont-refresh"></i>', // Use Font Awesome refresh icon
            "className": 'custom-refresh-button',
            "attr": {
                "id": "refresh-button"
            },
            "init": function (api, node, config) {
                $(node).removeClass('btn-default');
                $(node).addClass('btn-primary');
                $(node).attr('title', 'Refresh');
            },
            "action": function () {
                tableShift.ajax.reload();
            }
            },
        ]
    });
    tableShift.on('click', '#editsf', function() {
        var id = $(this).data('id');

        var rowData = tableShift.row($(this).closest('tr')).data();
        $('#nama_shift').val(rowData.nama);
        $('#shift_in').val(rowData.waktu_shift.split(' - ')[0]);
        $('#shift_out').val(rowData.waktu_shift.split(' - ')[1]);
        $('#btnsave').on('click', function(e) {
            e.preventDefault();
            var namaShift = $('#nama_shift').val();
            var shiftIn = $('#shift_in').val();
            var shiftOut = $('#shift_out').val();

            if (namaShift && shiftIn && shiftOut) {
                $.ajax({
                    url: base_url + 'DashboardKar/updateShift',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        nama: namaShift,
                        shift_in: shiftIn,
                        shift_out: shiftOut
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            swal("Shift berhasil diperbarui!", {
                                icon: "success",
                            }).then(() => {
                                tableShift.ajax.reload();
                                $('#nama_shift').val('');
                                $('#shift_in').val('');
                                $('#shift_out').val('');
                                $('#btnsave').off('click');
                            });
                        } else {
                            swal("Gagal memperbarui shift", {
                                icon: "error",
                            });
                        }
                    },
                    error: function() {
                        swal("Terjadi kesalahan saat memperbarui shift", {
                            icon: "error",
                        });
                    }
                });
            } else {
                swal("Semua field harus diisi!", {
                    icon: "warning",
                });
            }
        });
    });
    tableShift.on('click', '#deletesf', function() {
        var id = $(this).data('id');
        swal({
            title: "Hapus Shift",
            text: "Apakah Anda yakin ingin menghapus shift ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: base_url + 'DashboardKar/deleteShift/' + id,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            swal("Shift berhasil dihapus!", {
                                icon: "success",
                            }).then(() => {
                                tableShift.ajax.reload();
                            });
                        } else {
                            swal("Gagal menghapus shift", {
                                icon: "error",
                            });
                        }
                    },
                    error: function() {
                        swal("Terjadi kesalahan saat menghapus shift", {
                            icon: "error",
                        });
                    }
                });
            }
        });
    });
    return tableShift;
}
function getSettingDenda() {
    if ($.fn.DataTable.isDataTable('#table-denda')) {
        tableDenda.destroy();
    }
    tableDenda = $("#table-denda").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'DashboardKar/getSettingDenda',
            "type": "POST"
        },
        autoWidth: false,
        columnDefs: [
            { width: "30%", targets: 0 },
            { width: "30%", targets: 1 },
            { width: "30%", targets: 2 },
            { width: "10%", targets: 3 }
        ],
        "columns": [
            { 
                "data": "nominal_denda",
                "orderable": false,
                "render": function(data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "durasi_denda",
                "orderable": false,
            },
            { 
                "data": "status_denda",
                "orderable": false,
            },
            {
                "data": "id",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                            <ul class="action">
                                <div class="btn-group">
                                    <button class="btn btn-primary" id="editdd" data-id="${data}""><i class="icofont icofont-ui-edit"></i></button>
                                    <button class="btn btn-danger" id="deletedd" data-id="${data}"><i class="icofont icofont-ui-delete"></i></button>
                                </div>
                            </ul>
                        `;
                    }
                    return data;
                }
            },                     
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'col-sm-12 col-md-2'B>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p>>",
        "buttons": [
            {
            "text": '<i class="icofont icofont-refresh"></i>', // Use Font Awesome refresh icon
            "className": 'custom-refresh-button',
            "attr": {
                "id": "refresh-button"
            },
            "init": function (api, node, config) {
                $(node).removeClass('btn-default');
                $(node).addClass('btn-primary');
                $(node).attr('title', 'Refresh');
            },
            "action": function () {
                tableDenda.ajax.reload();
            }
            },
        ]
    });
    tableDenda.on('click', '#editdd', function() {
        var id = $(this).data('id');

        var rowData = tableDenda.row($(this).closest('tr')).data();
        $('#nominal_denda').val(rowData.nominal_denda);
        $('#durasi_denda').val(rowData.durasi_denda);
        $('#status_denda').val(rowData.status_denda);
        $('#btnsavedenda').on('click', function(e) {
            e.preventDefault();
            var nominal = parseFloat($('#nominal_denda').val().replace(/\D/g, ''));
            var durasi = $('#durasi_denda').val();
            var status = $('#status_denda').val();

            if (nominal && durasi && status) {
                $.ajax({
                    url: base_url + 'DashboardKar/updateDenda',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        nominal: nominal,
                        durasi: durasi,
                        status: status
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            swal("Denda berhasil diperbarui!", {
                                icon: "success",
                            }).then(() => {
                                tableDenda.ajax.reload();
                                $('#nominal_denda').val('');
                                $('#durasi_denda').val('');
                                $('#status_denda').val('');
                                $('#btnsavedenda').off('click');
                            });
                        } else {
                            swal("Gagal memperbarui denda", {
                                icon: "error",
                            });
                        }
                    },
                    error: function() {
                        swal("Terjadi kesalahan saat memperbarui denda", {
                            icon: "error",
                        });
                    }
                });
            } else {
                swal("Semua field harus diisi!", {
                    icon: "warning",
                });
            }
        });
    });
    tableDenda.on('click', '#deletedd', function() {
        var id = $(this).data('id');
        swal({
            title: "Hapus Denda",
            text: "Apakah Anda yakin ingin menghapus denda ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: base_url + 'DashboardKar/deleteDenda/' + id,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            swal("Denda berhasil dihapus!", {
                                icon: "success",
                            }).then(() => {
                                tableDenda.ajax.reload();
                            });
                        } else {
                            swal("Gagal menghapus denda", {
                                icon: "error",
                            });
                        }
                    },
                    error: function() {
                        swal("Terjadi kesalahan saat menghapus denda", {
                            icon: "error",
                        });
                    }
                });
            }
        });
    });
    return tableDenda;
}
function addShift() {
    $('#btnsave').on('click', function(e) {
        e.preventDefault();
        var namaShift = $('#nama_shift').val();
        var shiftIn = $('#shift_in').val();
        var shiftOut = $('#shift_out').val();

        if (namaShift && shiftIn && shiftOut) {
            $.ajax({
                url: base_url + 'DashboardKar/addShift',
                type: 'POST',
                dataType: 'json',
                data: {
                    nama: namaShift,
                    shift_in: shiftIn,
                    shift_out: shiftOut
                },
                success: function(response) {
                    if (response.status === 'success') {
                        swal("Shift berhasil diperbarui!", {
                            icon: "success",
                        }).then(() => {
                            tableShift.ajax.reload();
                            $('#nama_shift').val('');
                            $('#shift_in').val('');
                            $('#shift_out').val('');
                            $('#btnsave').off('click');
                        });
                    } else {
                        swal("Gagal memperbarui shift", {
                            icon: "error",
                        });
                    }
                },
                error: function() {
                    swal("Terjadi kesalahan saat memperbarui shift", {
                        icon: "error",
                    });
                }
            });
        } else {
            swal("Semua field harus diisi!", {
                icon: "warning",
            });
        }
    });
}
function addDenda() {
    $('#btnsavedenda').on('click', function(e) {
        e.preventDefault();
        var nominal = parseFloat($('#nominal_denda').val().replace(/\D/g, ''));
        var durasi = $('#durasi_denda').val();
        var status = $('#status_denda').val();

        if (nominal && durasi && status) {
            $.ajax({
                url: base_url + 'DashboardKar/addDenda',
                type: 'POST',
                dataType: 'json',
                data: {
                    nominal: nominal,
                    durasi: durasi,
                    status: status
                },
                success: function(response) {
                    if (response.status === 'success') {
                        swal("Denda berhasil diperbarui!", {
                            icon: "success",
                        }).then(() => {
                            tableDenda.ajax.reload();
                            $('#nominal_denda').val('');
                            $('#durasi_denda').val('');
                            $('#status_denda').val('');
                            $('#btnsavedenda').off('click');
                        });
                    } else {
                        swal("Gagal memperbarui denda", {
                            icon: "error",
                        });
                    }
                },
                error: function() {
                    swal("Terjadi kesalahan saat memperbarui denda", {
                        icon: "error",
                    });
                }
            });
        } else {
            swal("Semua field harus diisi!", {
                icon: "warning",
            });
        }
    });
}
function getTimelineAbsen() {
        if ($.fn.DataTable.isDataTable('#table-timelineabsen')) {
        tableTlAbsen.destroy();
    }
    tableTlAbsen = $("#table-timelineabsen").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'DashboardKar/getTimelineAbsen',
            "type": "POST"
        },
        "columns": [
            { "data": "finger_id" },
            {
                "data": "nama_lengkap",
            },
            {
                "data": "absen_at",
                            render: function(data) {
                const dt = new Date(data);
                return dt.getFullYear() + "-" +
                    String(dt.getMonth() + 1).padStart(2, "0") + "-" +
                    String(dt.getDate()).padStart(2, "0") + " " +
                    String(dt.getHours()).padStart(2, "0") + ":" +
                    String(dt.getMinutes()).padStart(2, "0");
            }
            },
            {
                "data": "status_absen",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return data === "IN" ? 
                            '<span class="badge rounded-pill badge-light-primary">IN</span>' : 
                            '<span class="badge rounded-pill badge-light-danger">OUT</span>';
                    }
                    return data;
                }
            },
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'col-sm-12 col-md-2'B>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p>>",
               "buttons": [
                {
                    "text": 'Refresh', // Font Awesome icon for refresh
                    "className": 'custom-refresh-button', // Add a class name for identification
                    "attr": {
                        "id": "refresh-button" // Set the ID attribute
                    },
                    "init": function (api, node, config) {
                        $(node).removeClass('btn-default');
                        $(node).addClass('btn-primary');
                        $(node).attr('title', 'Refresh'); // Add a title attribute for tooltip
                    },
                    "action": function () {
                        tableTlAbsen.ajax.reload();
                    }
                },
            ]
    });
    return tableTlAbsen;
}
function getTimelineRest() {
        if ($.fn.DataTable.isDataTable('#table-istirahat')) {
        tableTlRest.destroy();
    }
    tableTlRest = $("#table-istirahat").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [1, 'desc'],
        "ajax": {
            "url": base_url + 'DashboardKar/getTimelineRest',
            "type": "POST"
        },
        "columns": [
            { "data": "nama_lengkap" },
            { "data": "tanggal" },
            { "data": "durasi_istirahat" },
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'col-sm-12 col-md-2'B>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p>>",
               "buttons": [
                {
                    "text": 'Refresh', // Font Awesome icon for refresh
                    "className": 'custom-refresh-button', // Add a class name for identification
                    "attr": {
                        "id": "refresh-button" // Set the ID attribute
                    },
                    "init": function (api, node, config) {
                        $(node).removeClass('btn-default');
                        $(node).addClass('btn-primary');
                        $(node).attr('title', 'Refresh'); // Add a title attribute for tooltip
                    },
                    "action": function () {
                        tableTlRest.ajax.reload();
                    }
                },
            ]
    });
    return tableTlRest;
}
function card(){
    $('.ctf').click(function(event) {
        event.preventDefault();
        $('#spintf').removeClass('d-none');
        $('#counttf').addClass('d-none');
        countus(formatcur);
    });
    $('.cti').click(function(event) {
        event.preventDefault();
        $('#spinti').removeClass('d-none');
        $('#countti').addClass('d-none');
        countti(formatcur);
    });
    $('.cde').click(function(event) {
        event.preventDefault();
        $('#spintd').removeClass('d-none');
        $('#countdenda').addClass('d-none');
        countdenda(formatcur);
    });
}
function allcount(formatcur) {
    $('#spintf').removeClass('d-none');
    $('#spinti').removeClass('d-none');
    $('#spintd').removeClass('d-none');
    countus(formatcur);
    countti(formatcur);
    countdenda(formatcur);
}
function countus(formatcur) {
    $.ajax({
        url: base_url + 'DashboardKar/totalFinger/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#counttf').removeClass('d-none');
            
            var tf = formatcur.format(data.total_finger).replace(/\D/g, '');
            $('#counttf').text(tf);
            $('.ctf').attr('data-total_tf', tf);
            
            $('#spintf').addClass('d-none');
        }
    });
}
function countti(formatcur) {
    $.ajax({
        url: base_url + 'DashboardKar/totalIstirahat/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#countti').removeClass('d-none');
            
            var ti = formatcur.format(data.total_istirahat).replace(/\D/g, '');
            $('#countti').text(ti);
            $('.cti').attr('data-total_ti', ti);
            
            $('#spinti').addClass('d-none');
        }
    });
}
function countdenda(formatcur) {
    $.ajax({
        url: base_url + 'DashboardKar/totalDenda/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#countdenda').removeClass('d-none');
            
            var ti = formatcur.format(data.total_denda);
            $('#countdenda').text(ti);
            $('.cde').attr('data-total_denda', ti);
            
            $('#spintd').addClass('d-none');
        }
    });
}