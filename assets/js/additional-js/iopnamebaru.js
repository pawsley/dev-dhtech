var tableOL;
var tablePR;

$(document).ready(function () {
    getSelect();
    setInterval(updateDateTime, 1000);
    addauditor();
    reload();
    getbarang();
    $('#addprod').click(function() {
        var id_opname = $(this).data('id_opname');
        addproduk(id_opname);
    });
    $('#simpanopnm').click(function() {
        simpanop();
    });
});

function tableol() {
    if ($.fn.DataTable.isDataTable('#table-ol')) {
        tableOL.destroy();
    }
    tableOL = $("#table-ol").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'stock-opname/opname-list/',
            "type": "POST"
        },
        "columns": [
            { "data": "kode_opname" },
            { "data": "tgl_opname",
                "render": function (data, type, row) {
                    var date = new Date(data);
                    return formatDate(date);
                }
            },
            { "data": "nama_lengkap" },
            { "data": "nama_toko" },
            {
                "data": "kode_opname",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-success" data-id="${data}" data-bs-toggle="modal" data-bs-target="#CariBarang"><i class="fa fa-plus"></i></button>
                                        <button class="btn btn-secondary" data-id="${data}"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </ul>
                            `;
                    }
                    return data;
                }
            }            
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
                        tableOL.ajax.reload();
                    }
                },
                {
                    extend: 'excelHtml5', // Specify the Excel button
                    text: 'Export', // Text for the button
                    className: 'btn btn-success', // Add a class for styling
                    title: 'Opname List',
                    exportOptions: {
                        columns: ':visible:not(:last-child):not(:nth-last-child(2))'
                    }
                }
            ]
            
    });
    return tableOL;
}

function tablepr(id_toko,tgl) {
    if ($.fn.DataTable.isDataTable('#table-pr')) {
        tablePR.destroy();
    }
    tablePR = $("#table-pr").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'stock-opname/produk-list/'+id_toko+'/'+tgl,
            "type": "POST"
        },
        "columns": [
            { "data": "id_keluar",
                "render": function(data, type, row, meta) {
                  return '<input type="checkbox" class="checkbox_prod" id="checkbox_' + data + '" value="' + data + '">';
                }
            },
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "jenis" },  
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
                        tablePR.ajax.reload();
                        $('#cprod').text('0');
                    }
                }
            ]
            
    });
    return tablePR;    
}

function getSelect() {
    $('#auditor').select2({
        language: 'id',
    });
    $('#cabang').select2({
        language: 'id',
        ajax: {
            url: base_url + 'StockOpname/loadcabang',
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
                            id: item.id_toko,
                            text: item.id_toko+' | '+item.nama_toko,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    $('#cabang').on('select2:select', function(e) {
        var data = e.params.data;
        var id_toko = data.id;

        $('#auditor').select2({
            language: 'id',
            ajax: {
                url: base_url + 'StockOpname/loadauditor/'+id_toko,
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
                                id: item.id_user,
                                text: item.id_user+' | '+item.nama_lengkap,
                            };
                        }),
                    };
                },
                cache: false,
            },
        });
    });
}

function updateDateTime() {
    var now = new Date();
    var year = now.getFullYear();
    var month = (now.getMonth() + 1).toString().padStart(2, '0');
    var day = now.getDate().toString().padStart(2, '0');
    var hours = now.getHours().toString().padStart(2, '0');
    var minutes = now.getMinutes().toString().padStart(2, '0');
    $('#tanggalwaktubarang').val(year + '-' + month + '-' + day + 'T' + hours + ':' + minutes);   
}

function addauditor() {
    $("#addauditor").on("click", function () {
        var idop = $("#idstockopname").val();
        var tgl = $("#tanggalwaktubarang").val();
        var cab = $("#cabang").val();
        var aud = $("#auditor").val();
        if (!cab || !aud ) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        } 
        $.ajax({
            type: "POST",
            url: base_url+"stock-opname/simpan-data",
            data: {
                idstockopname: idop,
                tanggalwaktubarang: tgl,
                cabang: cab,
                auditor: aud,
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("success", "Data berhasil ditambahkan", "success").then(() => {
                        $("#cabang").val('0').trigger('change.select2');
                        $("#auditor").val('0').trigger('change.select2');
                        reload();
                    });
                } else if(response.status === 'exists') {
                    swal("Warning", "Barang sudah diinputkan", "warning").then(() => {
                        // $("#prodbaru").val($("#prodbaru").find('option').last().val()).trigger('change.select2');
                    });
                }
            },
            error: function (error) {
                swal("Gagal "+error, {
                    icon: "error",
                });
            }
        });
    });
}

function reload() {
    var olReloaded = tableol();
    olReloaded.on('draw.dt', function () {
        var counting = olReloaded.rows().count();
        if (counting === 0) {
            $('#simpanopnm').addClass('d-none');
        } else {
            $('#simpanopnm').removeClass('d-none');
        }
    });
    if (olReloaded) {
        olReloaded.clear().draw();
        olReloaded.ajax.reload();
    }
}
function reloadpr(id_toko) {
    var olReloaded = tablepr(id_toko);
    if (olReloaded) {
        olReloaded.clear().draw();
        olReloaded.ajax.reload();
    }
}
function formatDate(date) {
    var options = { day: 'numeric', month: 'long', year: 'numeric' };
    return date.toLocaleDateString('id-ID', options);
}

function getbarang(){
    $('#CariBarang').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        
        $.ajax({
            url: base_url + "stock-opname/getbarang/"+id,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    var date = new Date(item.tgl_opname);
                    var year = date.getFullYear();
                    var month = (date.getMonth() + 1).toString().padStart(2, '0');
                    var day = date.getDate().toString().padStart(2, '0');
                    var tgl = year + '-' + month + '-' + day;
                    var formattedDate = formatDate(date);
                    var id_opname = item.id_opname;
                    $('#ido').text(item.kode_opname);
                    $('#aud').text(item.nama_lengkap);
                    $('#cab').text(item.id_toko+'|'+item.nama_toko);
                    $('#dtgl').text(formattedDate);
                    tablepr(item.id_toko,tgl);
                    $('#addprod').attr('data-id_opname', id_opname);
                });
            }
        });
        $('#table-pr').on('change', '.checkbox_prod', function() {
            var countChecked = $('.checkbox_prod:checked').length;
            $('#cprod').text(countChecked);
        });
    });
}
function addproduk(id_opname) {
    var cabText = $('#cab').text(); // Get the text inside the #cab element
    var cabParts = cabText.split('|'); // Split the text by '|'

    var id_toko = cabParts[0].trim();
    $('.checkbox_prod').each(function() {
        if ($(this).is(':checked')) {
            var id_keluar = $(this).val();
            $.ajax({
                url: base_url+'stock-opname/simpan-data-produk',
                type: 'POST',
                data: { 
                    idopname: id_opname,
                    idkeluar: id_keluar
                },
                dataType: "json", 
                success: function(response) {
                    if (response.status === 'success') {
                            swal("success", "Data berhasil ditambahkan", "success").then(() => {
                                tablepr(id_toko);
                                // reloadpr(id_toko);
                                // $('#CariBarang').modal('hide');
                            });
                    } else if(response.status === 'exists') {
                        swal("Warning", "Barang sudah diinputkan", "warning").then(() => {
                        });
                    }
                },
                error: function(xhr, status, error) {
                    swal("Gagal "+error, {
                        icon: "error",
                    });
                }
            });
        }
    });
}
function simpanop() {
    $.ajax({
        url: base_url+'stock-opname/approve',
        type: 'POST',
        dataType: "json", 
        success: function(response) {
            if (response.status === 'success') {
                swal("success", "List opname berhasil disetujui", "success").then(() => {
                    reload()
                });
            }
        },
        error: function(xhr, status, error) {
            swal("Gagal "+error, {
                icon: "error",
            });
        }
    });
}