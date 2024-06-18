var tableRS;
var tableDRS;
var tableJL;
var tableDJL;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});
var monthNames = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];
$(document).ready(function () {
    tablers();
    tablejl();
    detailpen();
    detaillappen();
});

function tablejl() {
    if ($.fn.DataTable.isDataTable('#table-jual')) {
        tableJL.destroy();
    }
    tableJL = $("#table-jual").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'asc'] 
        ],
        "ajax": {
            "url": base_url + 'riwayat-penjualan/laporan-jual/',
            "type": "POST"
        },
        "columns": [
            { "data": "kode_penjualan" },
            { 
                "data": "tgl_transaksi",
                "render": function (data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        // Format date to Indonesian format: dd-mm-yyyy hh:mm:ss
                        var date = new Date(data);
                        var day = ('0' + date.getDate()).slice(-2);
                        var month = monthNames[date.getMonth()]; // Get full month name
                        var year = date.getFullYear();
                        var hours = ('0' + date.getHours()).slice(-2);
                        var minutes = ('0' + date.getMinutes()).slice(-2);
                        var seconds = ('0' + date.getSeconds()).slice(-2);
                        return `${day} ${month} ${year} ${hours}:${minutes}:${seconds}`;
                    }
                    return data;
                }
            },
            { "data": "nama_toko" },
            { 
                "data": "total",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "status",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if(data ==="1"){
                            return `<span class="badge rounded-pill badge-primary">DP</span>`;
                        } else if(data==="2"){
                            return `<span class="badge rounded-pill badge-success">LUNAS</span>`;
                        } else if(data==="3"){
                            return `<span class="badge rounded-pill badge-warning">BATAL</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },       
            {
                "data": "kode_penjualan",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-primary" 
                                        data-id="${data}" data-total="${full.total}" data-idksr="${full.id_ksr}"
                                        data-sales="${full.nama_ksr}" data-hj="${full.total_harga_jual}" data-dis="${full.total_diskon}" 
                                        data-cb="${full.total_cb}" data-lb="${full.total_laba}" data-cst="${full.nama_plg}" data-tb="${full.cara_bayar}" 
                                        data-btf="${full.bank_tf}" data-nr="${full.no_rek}" data-tn="${full.tunai}" data-status="${full.status}"
                                        data-bnk="${full.bank}" data-krd="${full.kredit}" data-toko="${full.nama_toko}" data-tgltr="${full.tgl_transaksi}"
                                        data-bs-toggle="modal" data-bs-target="#DetailLapPenjualan" title="detail penjualan"><i class="fa fa-exclamation-circle"></i></button>
                                    </div>
                                </ul>
                            `;
                    }
                    return data;
                }
            }      
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-4'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tableJL.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Laporan Penjualan',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            }
        ]
            
    });
    return tableJL;
}

function tablers() {
    if ($.fn.DataTable.isDataTable('#table-sales')) {
        tableRS.destroy();
    }
    tableRS = $("#table-sales").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'asc'] 
        ],
        "ajax": {
            "url": base_url + 'riwayat-penjualan/laporan-penjualan/',
            "type": "POST"
        },
        "columns": [
            { "data": "sales" },
            { 
                "data": "total_penjualan",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "total_diskon",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },            
            {
                "data": "id_ksr",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-primary" data-id="${data}" data-total="${full.total_penjualan}" data-ids="${full.id_ksr}" data-sales="${full.nama_ksr}" data-bs-toggle="modal" data-bs-target="#DetailPenjualan" title="detail penjualan"><i class="fa fa-exclamation-circle"></i></button>
                                    </div>
                                </ul>
                            `;
                    }
                    return data;
                }
            }      
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-4'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tableRS.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Laporan Penjualan Sales',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            }
        ]
            
    });
    return tableRS;
}

function detaillappen(){
    $('#DetailLapPenjualan').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var inv = button.data('id');
        var tgl = button.data('tgltr');
        var date = new Date(tgl);
        var stat = button.data('status');
        var monthName = date.toLocaleString('id-ID', { 
            day: 'numeric', 
            month: 'long', 
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        }).replace(' pukul ', ' ').replace(/\./g, ':');
        var cst = button.data('cst');
        var tipe = button.data('tb');
        var bpen = button.data('btf');
        var nor = button.data('nr');
        var tn = button.data('tn');
        var bnk = button.data('bnk');
        var krd = button.data('krd');
        var idksr = button.data('idksr');
        var sales = button.data('sales');
        var hj = button.data('hj');
        var dis = button.data('dis');
        var cb = button.data('cb');
        var lb = button.data('lb');
        var total = button.data('total');
        $('#ttcs').text(cst+' ('+monthName+') ');
        $('#ttdi').text(inv);
        $('#tp').text(tipe);
        $('#tp').text(tipe);
        if (tipe == 'Tunai') {
            $('#banktf').addClass('d-none');
            $('#tftn').removeClass('d-none');
            $('#tftb').addClass('d-none');
            $('#tfkr').addClass('d-none');
            $('#tn').text(formatcur.format(tn));
        } else if (tipe == 'Transfer'){
            $('#banktf').removeClass('d-none');
            $('#tftn').addClass('d-none');
            $('#tftb').removeClass('d-none');
            $('#tfkr').addClass('d-none');
            $('#bp').text(bpen+' - '+nor);
            $('#tb').text(formatcur.format(bnk));
        } else {
            $('#banktf').removeClass('d-none');
            $('#tftn').removeClass('d-none');
            $('#tftb').removeClass('d-none');
            $('#tfkr').removeClass('d-none');
            $('#bp').text(bpen+' - '+nor);
            $('#tn').text(formatcur.format(tn));
            $('#tb').text(formatcur.format(bnk));
            $('#kr').text(formatcur.format(krd));
        }
        $("#ttsales").text(idksr+' | '+sales);
        $("#tthj").text(formatcur.format(hj));
        $("#ttds").text(formatcur.format(dis));
        $("#ttcb").text(formatcur.format(cb));
        $("#ttlb").text(formatcur.format(lb));
        $("#ttgt").text(formatcur.format(total));
        if (stat == '3') {
            $("#canceltrans").addClass('d-none');
        }else{
            $("#canceltrans").removeClass('d-none');
            $('#canceltrans').attr('data-id', inv);
            canceltrans();
        }
        tabledtliv(inv);
    });
}

function detailpen(){
    $('#DetailPenjualan').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var ids = button.data('id');
        var tt = button.data('total');
        var sl = button.data('sales');
        $("#ttdh").text(formatcur.format(tt));
        $("#saldh").text(ids+' | '+sl);
        tabledts(ids);
    });
}

function tabledts(ids) {
    if ($.fn.DataTable.isDataTable('#table-dt')) {
        tableDRS.destroy();
    }
    tableDRS = $("#table-dt").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'riwayat-penjualan/laporan-detail-penjualan/'+ids,
            "type": "POST"
        },
        "columns": [
            { "data": "kode_penjualan" },
            { "data": "sn_brg" },   
            { "data": "nama_brg" },   
            { 
                "data": "harga_jual",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "diskon",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "harga_ril",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-4'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tableRS.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Detail Penjualan',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            }
        ]
            
    });
    return tableDRS;
}
function tabledtliv(inv) {
    if ($.fn.DataTable.isDataTable('#table-dtpn')) {
        tableDJL.destroy();
    }
    tableDJL = $("#table-dtpn").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'riwayat-penjualan/detail-laporan-jual/'+inv,
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },   
            { "data": "nama_brg" },   
            { 
                "data": "harga_jual",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "harga_diskon",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "harga_cashback",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "harga_bayar",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "laba_unit",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-4'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tableDJL.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Detail Laporan Penjualan '+inv,
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            }
        ]
            
    });
    return tableDJL;
}

function canceltrans() {
    $('#canceltrans').on('click', function (e) {
        e.preventDefault();
        var inv = $(this).data('id');
    
        swal({
            title: 'Apa anda yakin untuk membatalkan transaksi ini?',
            icon: 'warning',
            buttons: {
                cancel: {
                    text: 'Tidak',
                    value: null,
                    visible: true,
                    className: 'btn-secondary',
                    closeModal: true,
                },
                confirm: {
                    text: 'Iya',
                    value: true,
                    visible: true,
                    className: 'btn-danger',
                    closeModal: true
                }
            }
        }).then((result) => {
            if (result) {
                $.ajax({
                    type: "POST",
                    url: base_url+"order-masuk/cancel",
                    dataType: "json", 
                    data: {
                        inv: inv,
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            swal("Transaksi dibatalkan", {
                                icon: "warning",
                            }).then((value) => {
                                $('#DetailLapPenjualan').modal('hide');
                                tableJL.ajax.reload();
                            });
                        } else {
                            swal("Gagal membatalkan transaksi", {
                                icon: "error",
                            });
                        }
                    },
                    error: function (error) {
                        swal("Gagal", {
                            icon: "error",
                        });
                    }
                });
            }
        });
    });
}