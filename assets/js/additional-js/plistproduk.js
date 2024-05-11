var tablePL;
var tableDT;
var defaultSelectedName = null;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});
$(document).ready(function () {
    $("#cab").val('0').trigger('change.select2');
    defaultSelectedName = $("#cab").val();
    tablepl();
    detailbrg();
    getselect();
    // card(formatcur);
});
function tablepl() {
    var ajaxConfig = {
        type: "POST",
        url: base_url + 'produk-list/daftar/',
    };
    if ($.fn.DataTable.isDataTable('#table-pl')) {
        tablePL.destroy();
    }
    tablePL = $("#table-pl").DataTable({
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
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "nama_toko" },
            { 
                "data": "hrg_jual",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "status",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if(data ==="2"){
                            return `<span class="badge rounded-pill badge-primary">READY</span>`;
                        } else if(data==="3"){
                            return `<span class="badge rounded-pill badge-success">TERJUAL</span>`;
                        } else if(data==="4"){
                            return `<span class="badge rounded-pill badge-info">BOOKING</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },
            {
                "data": "id_keluar",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action d-flex justify-content-center">
                                    <div class="btn-group">
                                        <button class="btn btn-primary" data-id="${data}" data-bs-toggle="modal" data-bs-target="#InfoDetail" title="detail barang"><i class="fa fa-exclamation-circle"></i></button>
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
                    tablePL.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Produk List',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            },
        ]
            
    });
    return tablePL;
}
function detailbrg() {
    $('#InfoDetail').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        $.ajax({
            url: base_url + 'produk-list/detailbrg/'+id,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    // var tgl_keluar = item.tgl_keluar;
                    // var datePart = tgl_keluar.split(' ')[0];
                    // var timePart = tgl_keluar.split(' ')[1];
                    $('#bardh').attr('src', base_url+'assets/dhdokumen/snbarcode/'+item.sn_brg+'.jpg').css('width', '100px');
                    $('#dhsn').text(item.sn_brg);
                    // $('#dhsupp').text(item.nama_supplier);
                    $('#dhnm').text(item.nama_brg);
                    $('#dhkon').text(item.kondisi);
                    $('#dhmerk').text(item.merk);
                    $('#dhjen').text(item.jenis);
                    $('#spek').text(item.spek);
                    // $('#dhdreg').text(datePart);
                    // $('#dhtreg').text(timePart);
                    $('#dhcab').text(item.nama_toko);
                });
            }
        });
    });
}
$(document).on('select2:select', '#cab', function (e) {
    e.preventDefault();
    var selectedValue = e.params.data.id;
    var selectedName = selectedValue.split('|')[1];
    
    if (selectedName !== 'AllCab') { 
        var ajaxUrl = base_url + 'produk-list/filtercab/' + selectedName;
        filterCab(ajaxUrl, selectedName); 
    } else {
        var ajaxUrl = base_url + 'produk-list/daftar/';
        filterCab(ajaxUrl, null); 
    }
});
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
                var results = $.map(data, function (item) {
                    return {
                        id: item.id_toko+'|'+item.nama_toko,
                        text: item.id_toko+' | '+item.nama_toko,
                    };
                });
    
                results.unshift({
                    id: '0|AllCab',
                    text: 'Semua Cabang',
                    value: '0',
                });
    
                return {
                    results: results,
                };
            },
            cache: false,
        },
    });
}
function filterCab(url, selectedName) {
    if ($.fn.DataTable.isDataTable('#table-pl')) {
        tablePL.ajax.url(url).load(); 
        if (selectedName) {
            tablePL.column(2).search(selectedName).draw(); 
        } else {
            tablePL.column(2).search('').draw(); 
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
        url: base_url + 'produk-list/asset-store/'+id,
        type: 'GET',
        dataType: 'json',
        data: { id: id },
        success: function(data) {
            var matched = false;
            $('#counting-' + id).removeClass('d-none');
            $.each(data, function(index, item) {
                if (item.id_toko === id) {
                    $('#counting-' + id).text('Rp '+item.total_asset);
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