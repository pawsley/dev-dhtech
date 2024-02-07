var table;

function tablemrk() {
    if ($.fn.DataTable.isDataTable('#table-barang')) {
        table.destroy();
    }
    table = $("#table-barang").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'master-barang/loadbrg/',
            "type": "POST"
        },
        "columns": [
            { "data": "id_brg" },
            { "data": "nama_supplier" },
            { "data": "merk" },
            { "data": "jenis" },
            { "data": "nama_brg" },
            { 
                "data": "kondisi",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "baru") {
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
                "data": "deskripsi",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        var formattedDeskripsi = data.replace(/\n/g, '<br>');
                        return formattedDeskripsi;
                    }
                    return data;
                }
            },
            {
                "data": "id_brg",
                "orderable": false, // Disable sorting for this column
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (data) {
                            return `
                                <ul class="action">
                                    <li class="edit">
                                        <button class="btn" id="edit-btn" type="button" data-id="${data}" data-bs-toggle="modal" data-bs-target="#EditBarang"><i class="icon-pencil"></i></button>
                                    </li>
                                    <li class="delete">
                                        <button class="btn" id="delete-btn" type="button" data-id="${data}"><i class="icon-trash"></i></button>
                                    </li>
                                </ul>
                            `;
                        }
                    }
                    return data;
                }
            }
        ],
    });
}

$(document).on('click', '#delete-btn', function (e) {
    e.preventDefault();

    var id_brg = $(this).data('id');

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
                url: base_url + 'master-barang/hapus/' + id_brg,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        swal('Deleted!', response.message, 'success');
                        reload();
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
    $('#FormIDSupplier').select2({
        language: 'id',
        ajax: {
            url: base_url + 'MasterBarang/loadsupp',
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
                            id: item.id_supplier,
                            text: item.id_supplier + ' | ' + item.nama_supplier,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    $('#brandproduk').select2({
        language: 'id',
        ajax: {
            url: base_url + 'MasterBarang/loadmerk',
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
                            id: item.nama_kategori,
                            text: item.nama_kategori,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    $('#jenisproduk').select2({
        language: 'id',
        ajax: {
            url: base_url + 'MasterBarang/loadjenis',
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
                            id: item.nama_kategori,
                            text: item.nama_kategori,
                        };
                    }),
                };
            },
            cache: false,
        },
    });   
    $("#idproduk").on("click", function() {
        generate();
    });
    $('#TambahSubKategoriItem').on('show.bs.modal', function (e) {
        addkat();
        setTimeout(function () {
            $("input[name='newmerk']").val('');
            $("input[name='newjenis']").val('');
        }, 100);
    });
    add();
    getid();
    reload();
});

function reload() {
    if (tablemrk()) {
        table.clear().draw();
        table.ajax.reload();
    }
}

function getid(){
    $('#EditBarang').on('show.bs.modal', function (e) {
        getselect();
        var button = $(e.relatedTarget);
        var id_brg = button.data('id');
        
        console.log(id_brg);
        $.ajax({
            url: base_url + "master-barang/edit/"+id_brg,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    $("#e_id_brg").val(item.id_brg);
                    $("#e_id_supplier").empty().append('<option value="' + item.id_supplier + '">' + item.id_supplier +' | '+ item.nama_supplier + '</option>').trigger('change.select2');
                    $("#e_merk").empty().append('<option value="' + item.merk + '">' + item.merk + '</option>').trigger('change.select2');
                    $("#e_jenis").empty().append('<option value="' + item.jenis + '">' + item.jenis + '</option>').trigger('change.select2');
                    $("#e_nama_brg").val(item.nama_brg);
                    $("input[name='e_kondisi'][value='" + item.kondisi + "']").prop('checked', true);
                    $("#e_deskripsi").val(item.deskripsi);
                });
            }
        });
        edit();
    });
}

function getselect(){
    $('#e_id_supplier').select2({
        language: 'id',
        ajax: {
            url: base_url + 'MasterBarang/loadsupp',
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
                            id: item.id_supplier,
                            text: item.id_supplier + ' | ' + item.nama_supplier,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    $('#e_merk').select2({
        language: 'id',
        ajax: {
            url: base_url + 'MasterBarang/loadmerk',
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
                            id: item.nama_kategori,
                            text: item.nama_kategori,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    $('#e_jenis').select2({
        language: 'id',
        ajax: {
            url: base_url + 'MasterBarang/loadjenis',
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
                            id: item.nama_kategori,
                            text: item.nama_kategori,
                        };
                    }),
                };
            },
            cache: false,
        },
    });    
}

function edit(){
    $("#edit").on("click", function (){
        var id = $("#e_id_brg").val();
        var sup = $("#e_id_supplier").val();
        var merk = $("#e_merk").val(); 
        var jenis = $("#e_jenis").val();
        var nama = $("#e_nama_brg").val();
        var spek = $("#e_deskripsi").val();
        var kond = $("input[name='e_kondisi']:checked").val();
        if (!jenis || !sup || !merk || !nama || !spek) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        }
        $.ajax({
            type: "POST",
            url: "master-barang/update-data",
            data: {
                e_id_brg: id,
                e_id_supplier: sup,
                e_merk: merk,
                e_jenis: jenis,
                e_nama_brg: nama,
                e_deskripsi: spek,
                e_kondisi: kond,
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("Data berhasil diupdate", {
                        icon: "success",
                    }).then((value) => {
                        $("#e_id_brg").val('');
                        $("#e_id_supplier").val('0').trigger('change.select2');
                        $("#e_merk").val('0').trigger('change.select2');
                        $("#e_jenis").val('0').trigger('change.select2');
                        $("#e_nama_brg").val('');
                        $("#e_deskripsi").val('');
                        $('[name="radio3"]').val('baru');
                        $('#EditBarang').modal('hide');
                        reload();
                        generate();
                    });
                } else {
                    swal("Gagal update data", {
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

function changeInputName(inputId, typeName) {
    $("#" + inputId).attr('name', typeName);
}

function generate(){
    $.ajax({
        type: "GET",
        url: "MasterBarang/generateid", // Adjust the URL to match your actual controller route
        dataType: "json",
        success: function(data) {
            // Update the #idproduk input with the new ID
            $("#idproduk").val(data.newID);
        },
        error: function(error) {
            // Handle the error if needed
            console.error("Error generating new ID:", error);
        }
    });
}

function addkat(){
    $("#tambahkat").on("click", function () {
        var subKategoriName = $("#SubKategoriItem").attr('name');
    
        if (subKategoriName == 'newjenis') {
            var jenis = $("input[name='newjenis']").val();
            var kode = "JNS";

            if (!jenis) {
                swal("Error", "Form jenis masih kosong", "error").then(() => {
                    $("input[name='newjenis']").focus();
                });
                return;
            }
            $.ajax({
                type: "POST",
                url: "MasterBarang/addjenis",
                data: {
                    kode: kode,
                    newjenis: jenis
                },
                dataType: "json", 
                success: function (response) {
                    if (response.status === 'success') {
                        swal("Berhasil! Kategori Baru telah ditambahkan!", {
                            icon: "success",
                        });
                        $("input[name='newmerk']").val('');
                        $('#TambahSubKategoriItem').modal('hide');
                    } else if (response.status === 'exists') {
                        swal("Warning", "Nama Kategori sudah ada", "warning").then(() => {
                            $("input[name='newmerk']").focus();
                        });
                        return;
                    }
                },
                error: function (error) {
                    swal("Gagal ", {
                        icon: "error",
                    });
                }
            });            
        } else if (subKategoriName == 'newmerk') {
            var merk = $("input[name='newmerk']").val();
            var kode = "MRK";
    
            if (!merk) {
                swal("Error", "Form merek masih kosong", "error").then(() => {
                    $("input[name='newmerk']").focus();
                });
                return;
            }
    
            $.ajax({
                type: "POST",
                url: "MasterBarang/addmerk",
                data: {
                    kode: kode,
                    newmerk: merk
                },
                dataType: "json", 
                success: function (response) {
                    if (response.status === 'success') {
                        swal("Berhasil! Kategori Baru telah ditambahkan!", {
                            icon: "success",
                        });
                        $("input[name='newmerk']").val('');
                        $('#TambahSubKategoriItem').modal('hide');
                    } else if (response.status === 'exists') {
                        swal("Warning", "Nama Kategori sudah ada", "warning").then(() => {
                            $("input[name='newmerk']").focus();
                        });
                        return;
                    }
                },
                error: function (error) {
                    swal("Gagal ", {
                        icon: "error",
                    });
                }
            });
        }
    });    
}

function add(){
    $("#tambah").on("click", function () {
        var sup = $("#FormIDSupplier").val('0').trigger('change.select2');
        var merk = $("#brandproduk").val('0').trigger('change.select2');
        var jenis = $("#jenisproduk").val('0').trigger('change.select2');
        var nama = $("#NamaProduk").val();
        var spek = $("#spek").val();
        if (!jenis || !sup || !merk || !nama || !spek) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        } 
        $.ajax({
            type: "POST",
            url: "master-barang/simpan-data",
            data: {
                id_brg: $("#idproduk").val(),
                id_supplier: $("#FormIDSupplier").val(),
                merk: $("#brandproduk").val(),
                jenis: $("#jenisproduk").val(),
                nama_brg: $("#NamaProduk").val(),
                deskripsi: $("#spek").val(),
                radio3: $("input[name='radio3']:checked").val(),
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("Data berhasil ditambahkan", {
                        icon: "success",
                    });
                    generate();
                    $("#FormIDSupplier").val('0').trigger('change.select2');
                    $("#brandproduk").val('0').trigger('change.select2');
                    $("#jenisproduk").val('0').trigger('change.select2');
                    $("#NamaProduk").val('');
                    $("#spek").val('');
                    $("input[name='radio3']:checked").val('baru');
                    reload();
                } else {
                    swal("Gagal menambahkan data", {
                        icon: "error",
                    });
                }
            },
            error: function (error) {
                swal("Gagal karena Product ID sudah ada, klik form Product ID untuk refresh ID", {
                    icon: "error",
                });
                generate();
            }
        });
    });
}