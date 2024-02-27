var tableSK;
var defaultSelectedName = null;

function tablesk() {
    var ajaxConfig = {
        type: "POST",
        url: base_url + 'terima-barang/groupsk/',
    };
    if ($.fn.DataTable.isDataTable('#table-sk')) {
        tableSK.destroy();
    }
    tableSK = $("#table-sk").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": ajaxConfig,
        "columns": [
            { "data": "tgl_keluar" },
            { "data": "no_surat_keluar" },
            { "data": "nama_toko" },
            { 
                "data": "status",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "1") {
                            return `<span class="badge rounded-pill badge-secondary">ON PROSES</span>`;
                        } else if(data ==="2"){
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
                "data": "no_surat_keluar",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (data) { 
                            return `
                                <ul class="action">
                                    <li class="edit">
                                        <button class="btn download-button" type="button" id="approvesk" data-id="${data}"><i class="icofont icofont-ui-check"></i></button>
                                    </li>
                                </ul>
                            `;
                        }
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
                    tableSK.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(2))'
                }
            }
        ]
            
    });
    
    return tableSK;
}

$(document).on('select2:select', '#cab', function (e) {
    var selectedValue = e.params.data.id;
    var selectedName = selectedValue.split('|')[1];
    
    if (selectedValue !== defaultSelectedName) { 
        var ajaxUrl = base_url + 'terima-barang/filtersk/' + selectedName;
        reloadDataTable(ajaxUrl, selectedName); 
    } else {
        var ajaxUrl = base_url + 'terima-barang/groupsk/';
        reloadDataTable(ajaxUrl, null); 
    }
});

function approve() {
    $('#table-sk').on('click', '#approvesk', function() {
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "terima-barang/approve",
            dataType: "json", 
            data: {
                ska: id
            },
            success: function (response) {
                if (response.status === 'success') {
                    swal("Surat keluar berhasil disetujui", {
                        icon: "success",
                    }).then((value) => {
                        tableSK.ajax.reload();
                    });
                } else {
                    swal("Gagal approve surat keluar", {
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

$(document).ready(function () {
    $("#cab").val('0').trigger('change.select2'); // Set default value on page load
    defaultSelectedName = $("#cab").val();
    tablesk();
    approve();
    getselect();
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
                    q: params.term, // Add the search term to your AJAX request
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

function reloadDataTable(url, selectedName) {
    if ($.fn.DataTable.isDataTable('#table-sk')) {
        tableSK.ajax.url(url).load(); 
        if (selectedName) {
            tableSK.column(2).search(selectedName).draw(); 
        } else {
            tableSK.column(2).search('').draw(); 
        }
    }
}