var tableBK;
var tableSK;
var detailSK;
var formatter = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});

function tablebk(formatter) {
    if ($.fn.DataTable.isDataTable('#table-bk')) {
        tableBK.destroy();
    }
    tableBK = $("#table-bk").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'barang-keluar/loadbk/',
            "type": "POST"
        },
        "columns": [
            { "data": "tgl_keluar" },
            { "data": "no_surat_keluar" },
            { "data": "nama_toko" },
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            {
                "data": "spek",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        var formattedDeskripsi = data.replace(/\n/g, '<br>');
                        return formattedDeskripsi;
                    }
                    return data;
                }
            },
            { 
                "data": "kondisi",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "Baru") {
                            return `<span class="badge rounded-pill badge-light-primary">BARU</span>`;
                          } else {
                            return `<span class="badge rounded-pill badge-light-warning">BEKAS</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },
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
                "data": "sn_brg",
                "render": function(data, type, full, meta) {
                  // You can customize the rendering of the image here
                  if (type === "display") {
                      if (data) {
                          return `<img class="img-fluid table-avtar img-90" src="${base_url+'assets/dhdokumen/snbarcode/'+data+'.jpg'}" alt="Image" loading="lazy">`;
                      } else {
                          return "No Image";
                      }
                  }
                  return data;
              }
            },
            {
                "data": "id_keluar",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (full.status === "1") { 
                            return `
                                <ul class="action">
                                    <li class="delete">
                                        <button class="btn" id="delete-btn" type="button" data-id="${data}"><i class="icon-trash"></i></button>
                                    </li>
                                </ul>
                            `;
                        } else {
                            return `
                                <ul class="action">
                                    <li class="delete">
                                        <button class="btn" id="disabled-btn" type="button" data-id="${data}"><i class="icon-trash disabled"></i></button>
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
                        tableBK.ajax.reload();
                        getCountStock(formatter);
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
    return tableBK;
}

function tablesk(formatter) {
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
        "ajax": {
            "url": base_url + 'barang-keluar/groupsk/',
            "type": "POST"
        },
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
                                    <li class="delete">
                                        <button class="btn" type="button" data-id="${data}" data-bs-toggle="modal" data-bs-target="#DetailSuratKeluar"><i class="fa fa-info-circle"></i></button>
                                    </li>
                                    <li class="edit">
                                        <button class="btn download-button" type="button" id="downloadsk" data-id="${data}"><i class="icofont icofont-print"></i></button>
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
                        tableSK.ajax.reload();
                        getCountStock(formatter);
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

function detailsk(sk) {
    if ($.fn.DataTable.isDataTable('#table-detail')) {
        detailSK.destroy();
    }
    detailSK = $("#table-detail").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'barang-keluar/getsk/'+sk,
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "jenis" },
            { "data": "merk" },
            {
                "data": "spek",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        var formattedDeskripsi = data.replace(/\n/g, '<br>');
                        return formattedDeskripsi;
                    }
                    return data;
                }
            },
            { 
                "data": "kondisi",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "Baru") {
                            return `<span class="badge rounded-pill badge-light-primary">BARU</span>`;
                          } else {
                            return `<span class="badge rounded-pill badge-light-warning">BEKAS</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },
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
                "data": "sn_brg",
                "render": function(data, type, full, meta) {
                  // You can customize the rendering of the image here
                  if (type === "display") {
                      if (data) {
                          return `<img class="img-fluid table-avtar img-90" src="${base_url+'assets/dhdokumen/snbarcode/'+data+'.jpg'}" alt="Image" loading="lazy">`;
                      } else {
                          return "No Image";
                      }
                  }
                  return data;
              }
            },
            {
                "data": "id_keluar",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (full.status === "1") { 
                            return `
                                <ul class="action">
                                    <li class="delete">
                                        <button class="btn" id="delete-btn" type="button" data-id="${data}"><i class="icon-trash"></i></button>
                                    </li>
                                </ul>
                            `;
                        } else {
                            return `
                                <ul class="action">
                                    <li class="delete">
                                        <button class="btn" id="disabled-btn" type="button" data-id="${data}"><i class="icon-trash disabled"></i></button>
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
                        detailSK.ajax.reload();
                        getCountStock(formatter);
                    }
                },
            ]
            
    });
    return detailSK;
}
function formatDate(date) {
    var options = { day: 'numeric', month: 'long', year: 'numeric' };
    return date.toLocaleDateString('id-ID', options);
}
function getsk(){
    $('#DetailSuratKeluar').on('show.bs.modal', function (e) {
        getselect();
        var button = $(e.relatedTarget);
        var sk = button.data('id');
        
        $.ajax({
            url: base_url + "barang-keluar/getdetailsk/"+sk,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    var date = new Date(item.tgl_keluar);
                    var formattedDate = formatDate(date);
                    $('#dsk').text(item.no_surat_keluar);
                    $('#dtgl').text(formattedDate);
                    $('#dcab').text(item.nama_toko);
                });
            }
        });
        detailsk(sk);
    });
}



$(document).on('click', '#delete-btn', function (e) {
    e.preventDefault();

    var id_k = $(this).data('id');

    swal({
        title: 'Apa anda yakin?',
        text: 'Data yang sudah terhapus hilang permanen!',
        icon: 'warning',
        buttons: {
            cancel: {
                text: 'Cancel',
                value: null,
                visible: true,
                className: 'btn-secondary',
                closeModal: true,
            },
            confirm: {
                text: 'Delete',
                value: true,
                visible: true,
                className: 'btn-danger',
                closeModal: true
            }
        }
    }).then((result) => {
        if (result) {
            // User clicked 'Delete', proceed with the deletion
            $.ajax({
                type: 'POST',
                url: base_url + 'barang-keluar/hapus/' + id_k,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        swal('Deleted!', response.message, 'success');
                        reload(formatter);
                    } else {
                        swal('Error!', response.message, 'error');
                    }
                },
                error: function (error) {
                    swal('Error!', 'An error occurred while processing the request.', 'error');
                }
            });
        }
    });
});


$(document).ready(function () {

    getCountStock(formatter);
    card(formatter);
    getselect();
    setInterval(updateDateTime, 1000);
    selectedbrg();
    addmb(formatter);
    addmk(formatter);
    reload(formatter);
    getsk();
    printsk();
});

function printsk() {
    $('#table-sk').on('click', '.download-button', function() {
        var nosk = $(this).data('id');
        var printUrl = base_url + 'barang-keluar/printsk/' + nosk;
        window.open(printUrl, '_blank');
    });
}

function card(formatter) {
    $('.cardLink').click(function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        $('#spinner-' + id).removeClass('d-none');
        $('#counting-' + id).addClass('d-none');
        countbystore(id, formatter);
    });
}

function countbystore(id, formatter){
    $.ajax({
        url: base_url + 'barang-keluar/stock/'+id,
        type: 'GET',
        dataType: 'json',
        data: { id: id },
        success: function(data) {
            var matched = false;
            $('#counting-' + id).removeClass('d-none');
            $.each(data, function(index, item) {
                if (item.id_toko === id) {
                    var formattedNumber = formatter.format(item.brg_rdy).replace(/\D/g, '');
                    $('#counting-' + id).text(formattedNumber);
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


function getCountStock(formatter) {
    $('h5#id_toko').each(function() {
        var id = $(this).data('id');
        var count = $(this).closest('.card').find('.counting');
        var spinner = $(this).closest('.card').find('.spinner-border');

        $.ajax({
            url: base_url + 'barang-keluar/stock/'+id,
            type: 'GET',
            dataType: 'json',
            data: { id: id },
            success: function(data) {
                var matched = false;
                count.removeClass('d-none');
                $.each(data, function(index, item) {
                    if (item.id_toko === id) {
                        var formattedNumber = formatter.format(item.brg_rdy).replace(/\D/g, '');
                        count.text(formattedNumber);
                        matched = true;
                        return false;
                    }
                });
                if (!matched) {
                    count.text('0');
                }
                spinner.addClass('d-none');
            }
        });
    });
}

function selectedbrg() {
    $('#prodbaru').on('select2:select', function(e) {
        var data = e.params.data;
        var textParts = data.id.split('-');
        var merk = textParts[1].trim();
        var jenis = textParts[2].trim();
        var spek = textParts[3].trim();
        $('#merkbaru').val(merk);
        $('#jenisbaru').val(jenis);
        $('#spekbaru').val(spek);
    });
    $('#prodbekas').on('select2:select', function(e) {
        var data = e.params.data;
        var textParts = data.id.split('-');
        var merk = textParts[1].trim();
        var jenis = textParts[2].trim();
        var spek = textParts[3].trim();
        $('#merkbekas').val(merk);
        $('#jenisbekas').val(jenis);
        $('#spekbekas').val(spek);
    });
}

function getselect(){
    $('#cabangbaru').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangKeluar/loadstore',
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
    $('#cabangbekas').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangKeluar/loadstore',
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
    $('#prodbaru').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangKeluar/loadbrgb',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, 
                };
            },
            processResults: function (data) {
                var groups = {};
                var results = [];
    
                data.forEach(function (item) {
                    var groupName = item.merk + ' - ' + item.jenis;
                    if (!groups[groupName]) {
                        groups[groupName] = [];
                    }
                    groups[groupName].push({
                        id: item.id_masuk+'-'+item.merk+'-'+item.jenis+'-'+item.spek,
                        text: item.sn_brg+' | '+item.nama_brg
                    });
                });
    
                Object.keys(groups).forEach(function (groupName) {
                    results.push({
                        text: groupName,
                        children: groups[groupName]
                    });
                });
    
                return {
                    results: results
                };
            },
            cache: false,
        },
    });
    $('#prodbekas').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangKeluar/loadbrgk',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, 
                };
            },
            processResults: function (data) {
                var groups = {};
                var results = [];
    
                data.forEach(function (item) {
                    var groupName = item.merk + ' - ' + item.jenis;
                    if (!groups[groupName]) {
                        groups[groupName] = [];
                    }
                    groups[groupName].push({
                        id: item.id_masuk+'-'+item.merk+'-'+item.jenis+'-'+item.spek,
                        text: item.sn_brg+' | '+item.nama_brg
                    });
                });
    
                Object.keys(groups).forEach(function (groupName) {
                    results.push({
                        text: groupName,
                        children: groups[groupName]
                    });
                });
    
                return {
                    results: results
                };
            },
            cache: false,
        },
    });    
}

function updateDateTime() {
    var now = new Date();
    var year = now.getFullYear();
    var month = (now.getMonth() + 1).toString().padStart(2, '0');
    var day = now.getDate().toString().padStart(2, '0');
    var hours = now.getHours().toString().padStart(2, '0');
    var minutes = now.getMinutes().toString().padStart(2, '0');
    $('#tglbaru').val(year + '-' + month + '-' + day + 'T' + hours + ':' + minutes);
    $('#tglbekas').val(year + '-' + month + '-' + day + 'T' + hours + ':' + minutes);
    
}

function addmb(formatter) {
    $("#tambahbaru").on("click", function () {
        var tgl = $("#tglbaru").val();
        var cab = $("#cabangbaru").val();
        var sk = $("#nosuratb").val();
        var brg = $("#prodbaru").val().split('-');
        var idm = brg[0].trim();
        if (!cab || !sk || !brg ) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        } 
        $.ajax({
            type: "POST",
            url: "barang-keluar/simpan-barang-baru",
            data: {
                tglbaru: tgl,
                cabangbaru: cab,
                nosuratb: sk,
                prodbaru: idm,
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("success", "Data berhasil ditambahkan", "success").then(() => {
                        $("#cabangbaru").val($("#cabangbaru").find('option').last().val()).trigger('change.select2');
                        $("#prodbaru").val('0').trigger('change.select2');
                        $("#merkbaru").val('');
                        $("#jenisbaru").val('');
                        $("#spekbaru").val('');
                        reload(formatter);
                    });
                } else if(response.status === 'exists') {
                    swal("Warning", "Barang sudah diinputkan", "warning").then(() => {
                        $("#prodbaru").val($("#prodbaru").find('option').last().val()).trigger('change.select2');
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

function addmk(formatter) {
    $("#tambahbekas").on("click", function () {
        var tgl = $("#tglbekas").val();
        var cab = $("#cabangbekas").val();
        var sk = $("#nosuratk").val();
        var brg = $("#prodbekas").val().split('-');
        var idm = brg[0].trim();
        if (!cab || !sk || !brg ) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        } 
        $.ajax({
            type: "POST",
            url: "barang-keluar/simpan-barang-bekas",
            data: {
                tglbekas: tgl,
                cabangbekas: cab,
                nosuratk: sk,
                prodbekas: idm,
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("success", "Data berhasil ditambahkan", "success").then(() => {
                        $("#cabangbekas").val($("#cabangbekas").find('option').last().val()).trigger('change.select2');
                        $("#prodbekas").val('0').trigger('change.select2');
                        $("#merkbekas").val('');
                        $("#jenisbekas").val('');
                        $("#spekbekas").val('');
                        reload(formatter);
                    });
                } else if(response.status === 'exists'){
                    swal("Warning", "Barang sudah diinputkan", "warning").then(() => {
                        $("#prodbekas").val($("#prodbekas").find('option').last().val()).trigger('change.select2');
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

function reload(formatter) {
    var bkReloaded = tablebk(formatter);
    var skReloaded = tablesk(formatter);
    if (bkReloaded && skReloaded) {
        bkReloaded.clear().draw();
        bkReloaded.ajax.reload();
        skReloaded.clear().draw();
        skReloaded.ajax.reload();
    }
}