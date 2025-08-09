var tableKry;
var tableTlAbsen;
var tableTlRest;
$(document).ready(function() {
    getFingerKaryawan();
    getTimelineAbsen();
    getTimelineRest();
});

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
        "columns": [
            { "data": "finger_id" },
            {
                "data": "nama_lengkap",
                "render": function (data, type, row, meta) {
                    return '<select class="select2" value="'+row.id_user+'" data-id_user="'+row.id_user+'" data-finger_id="'+row.finger_id+'" data-current-value="' + data + '"></select>';
                },
            },                     
        ],
        "drawCallback": function(settings) {
            $('.select2').each(function() {
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
                        tableKry.ajax.reload();
                    }
                },
            ]
    });
    return tableKry;
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
        "order": [],
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