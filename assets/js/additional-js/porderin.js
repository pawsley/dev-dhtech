var tableOM;
var tableDT;
var tableIV;
var defaultSelectedName = null;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});

$(document).ready(function () {
    $("#cab").val('0').trigger('change.select2');
    defaultSelectedName = $("#cab").val();
    tableom();
    getselect();
    card(formatcur);
    detailpenjualan();
    detailinv();
    approve();
    cancel();
});

function tableom() {
    var ajaxConfig = {
        type: "POST",
        url: base_url + 'order-masuk/load-order/',
    };
    if ($.fn.DataTable.isDataTable('#table-om')) {
        tableOM.destroy();
    }
    tableOM = $("#table-om").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": ajaxConfig,
        "columns": [
            { "data": "kode_penjualan" },
            { 
                "data": "format_tgl",
                "searchable": false
            },
            { "data": "nama_toko" },             
            { "data": "cara_bayar" },
            { "data": "nama_rek" },
            { "data": "tipe_penjualan" },
            { 
                "data": "bayar",
                "render": function (data, type, row) {
                    return formatcur.format(data);
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
                                        <button class="btn btn-primary" data-id="${data}" data-total="${full.total_keranjang}" data-diskon="${full.diskon}" data-grand="${full.bayar}" data-bs-toggle="modal" data-bs-target="#DetailInvoice" title="detail invoice"><i class="fa fa-exclamation-circle"></i></button>
                                        <button class="btn btn-success" id="approve" data-id="${data}" title="approve"><i class="icofont icofont-ui-check"></i></button>
                                        <button class="btn btn-danger" id="cancel" data-id="${data}" data-keluar="${full.id_keluar}" title="cancel"><i class="icofont icofont-ui-close"></i></button>
                                    </div>
                                </ul>
                            `;
                    }
                    return data;
                }
            }
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-2'B>>" +
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
                    tableOM.ajax.reload();
                }
            },
        ]
            
    });
    return tableOM;
}
function tabledt(id) {
    if ($.fn.DataTable.isDataTable('#table-dt')) {
        tableDT.destroy();
    }
    tableDT = $("#table-dt").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'order-masuk/detail-penjualan/'+id,
            "type": "POST"
        },
        "columns": [
            { "data": "kode_penjualan" },
            { "data": "sn_brg" },
            { "data": "nama_brg" },   
            { 
                "data": "bayar",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { "data": "tipe_penjualan" },          
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-2'B>>" +
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
                    tableDT.ajax.reload();
                }
            },
        ]
            
    });
    return tableDT;
}
function tableiv(inv) {
    if ($.fn.DataTable.isDataTable('#table-dtiv')) {
        tableIV.destroy();
    }
    tableIV = $("#table-dtiv").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'order-masuk/detail-invoice/'+inv,
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },   
            { "data": "kondisi" },   
            { 
                "data": "harga_jual",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
        ],
        "lengthChange": false,
        "paging": false,
        "dom": "<'row'<'col-sm-12 col-md-2'B><'col-sm-12 col-md-8'f>>" +
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
                    tableIV.ajax.reload();
                }
            },
        ]
            
    });
    return tableIV;    
}
function detailpenjualan(){
    $('#DetailPenjualan').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var cab = button.data('cabang');
        var total = button.data('total');
        $("#cabdh").text(cab);
        $("#odto").text('Rp '+total);
        tabledt(id);
    });
}
function detailinv(){
    $('#DetailInvoice').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var inv = button.data('id');
        var tt = button.data('total');
        var ds = button.data('diskon');
        var gd = button.data('grand');
        $("#noinv").text(inv);
        $("#tt").text(formatcur.format(tt));
        $("#di").text(formatcur.format(ds));
        $("#gt").text(formatcur.format(gd));
        tableiv(inv);
    });
}
function approve() {
    $('#table-om').on('click', '#approve', function() {
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: base_url+"order-masuk/approve",
            dataType: "json", 
            data: {
                inv: id
            },
            success: function (response) {
                if (response.status === 'success') {
                    swal("Transaksi disetujui", {
                        icon: "success",
                    }).then((value) => {
                        tableOM.ajax.reload();
                    });
                } else {
                    swal("Transaksi gagal disetujui", {
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
    });
}
function cancel() {
    $('#table-om').on('click', '#cancel', function() {
        var id = $(this).data('id');
        var keluar = $(this).data('keluar');
        $.ajax({
            type: "POST",
            url: base_url+"order-masuk/cancel",
            dataType: "json", 
            data: {
                inv: id,
                idk: keluar
            },
            success: function (response) {
                if (response.status === 'success') {
                    swal("Transaksi dibatalkan", {
                        icon: "warning",
                    }).then((value) => {
                        tableOM.ajax.reload();
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
    });
}
function getselect(){
    $('#cab').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangTerima/loadstore',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, 
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id_toko+'|'+item.nama_toko,
                            text: item.id_toko+' | '+item.nama_toko,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
}

$(document).on('select2:select', '#cab', function (e) {
    var selectedValue = e.params.data.id;
    var selectedName = selectedValue.split('|')[1];
    
    if (selectedValue !== defaultSelectedName) { 
        var ajaxUrl = base_url + 'order-masuk/filtercab/' + selectedName;
        filtercabang(ajaxUrl, selectedName); 
    } else {
        var ajaxUrl = base_url + 'order-masuk/load-order/';
        filtercabang(ajaxUrl, null); 
    }
});

function filtercabang(url, selectedName) {
    if ($.fn.DataTable.isDataTable('#table-om')) {
        tableOM.ajax.url(url).load(); 
        if (selectedName) {
            tableOM.column(2).search(selectedName).draw(); 
        } else {
            tableOM.column(2).search('').draw(); 
        }
    }
}
function card(formatcur) {
    $('.cardLink').click(function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        $('#spinner-' + id).removeClass('d-none');
        $('#counting-' + id).addClass('d-none');
        countbystore(id, formatcur);
    });
}
function countbystore(id, formatcur){
    $.ajax({
        url: base_url + 'order-masuk/hrgj/'+id,
        type: 'GET',
        dataType: 'json',
        data: { id: id },
        success: function(data) {
            var matched = false;
            $('#counting-' + id).removeClass('d-none');
            $.each(data, function(index, item) {
                if (item.id_toko === id) {
                    $('#counting-' + id).text(formatcur.format(item.total_penjualan));
                    matched = true;
                    return false;
                }
            });
            if (!matched) {
                $('#counting-' + id).text('0');
            }
            $('#spinner-' + id).addClass('d-none');
        }
    });
}