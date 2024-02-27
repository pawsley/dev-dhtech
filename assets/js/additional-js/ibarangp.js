var tableBK;
function tablebk() {
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
            "url": base_url + 'pindah-barang/loadbk/',
            "type": "POST"
        },
        "columns": [
            { 
                "data": null,
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },            
            {
                "data": "nama_toko",
                "render": function (data, type, row, meta) {
                    return '<select class="select2" id="cab" value="'+row.id_toko+'" data-id_toko="'+row.id_toko+'" data-id_keluar="' + row.id_keluar + '" data-current-value="' + data + '" data-cab="' + row.id_toko + '"></select>';
                }
            },            
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "jenis" },
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
        ],
        "drawCallback": function(settings) {
            $('.select2').each(function() {
                var $select = $(this);
                var currentValue = $select.data('current-value');
                var value = $select.data('id_toko');
                var id_keluar = $select.data('id_keluar');
        
                $select.select2({
                    language: 'id',
                    ajax: {
                        url: base_url + 'BarangTerima/loadstore',
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
                                        id: item.id_toko,
                                        text: item.nama_toko
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
                    var toko = $(this).find('option:selected').text();
                    var id_keluar = $select.data('id_keluar');
                    console.log(id_keluar);
                    
                    $.ajax({
                        url: 'pindah-barang/update',
                        method: 'POST',
                        data: {
                            ids: id_keluar, // Array of IDs
                            cab: newValue // Value of cab
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                swal("Barang berhasil dipindah ke cabang "+toko, {
                                    icon: "success",
                                }).then((value) => {
                                    reload();
                                });
                            } else {
                                swal("Gagal pindah barang", {
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
                        tableBK.ajax.reload();
                    }
                },
            ]
    });
    return tableBK;
}

$(document).ready(function () {
    reload();
});

function reload() {
    var bkReloaded = tablebk();
    if (bkReloaded) {
        bkReloaded.clear().draw();
        bkReloaded.ajax.reload();
    }
}