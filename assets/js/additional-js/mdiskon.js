$(document).ready(function () {
    var formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    });
    reload(formatter);
    initSweetAlert(formatter);
});

function reload(formatter) {
    $("#table-diskon").DataTable({
        "processing": true,
        "language": { 
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
            // "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',            
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url+'master-diskon/jsondis',
            "type": "POST"
        },
        "columns": [
            { "data": "kode_diskon"},
            { 
                "data": "nilai",
                "render": function (data, type, row) {
                    return formatter.format(data);
                }
            },
            { "data": "kuota"},
            { 
                "data": "total_diskon",
                "render": function (data, type, row) {
                    return formatter.format(data);
                }
            },
            { 
              "data": "kode_diskon",
              "orderable": false, // Disable sorting for this column
              "render": function(data, type, full, meta) {
                if (type === "display") {
                  if (data) {
                    return `
                      <ul class="action">
                          <li class="edit"><a class="btn" data-id="${data}" type="button" data-bs-toggle="modal" data-bs-target="#EditMasterKaryawan"><i class="icon-pencil"></i></a></li>
                          <li class="delete"><a class="btn" href="'.base_url('memo/hapus/').'${data}"><i class="icon-trash"></i></a></li>
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

function initSweetAlert(formatter) {
    $(".tambahdiskon").on("click", function () {
        var nilaiDiskon = $("#FormBuatKuotaDiskon").val();
        var kuotaDiskon = $("#kuota").val();
        var kode = $("#kode").val();
        var selectedValues = $("#tipe").val();
        var numbdiscount = parseFloat(nilaiDiskon.replace(/\D/g, ''));
        var total = numbdiscount * kuotaDiskon;


        if (!nilaiDiskon || !kuotaDiskon || !kode || !selectedValues) {
            // Display an error message or take appropriate action for missing values
            swal("Error", "Please fill out all required fields.", "error");
            return;
        }
        $("#total").val(total);
        swal({
            title: "Apa anda yakin?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            content: {
                element: "div",
                attributes: {
                    innerHTML: "Menambahkan kode diskon <strong>" + kode + "</strong> dengan nilai Total <strong>" + formatter.format(total) + "</strong>",
                },
            },
            closeOnClickOutside: false,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "master-diskon/simpan-data", // Adjust the URL to match your CodeIgniter controller method
                    data: {
                        kode: kode,
                        tipe: selectedValues,
                        nilai: numbdiscount,
                        kuota: kuotaDiskon,
                        total: total
                    },
                    dataType: "json", // Specify the expected data type
                    success: function (response) {
                        // Handle the server response here
                        if (response.status === 'success') {
                            swal("Berhasil! Diskon Baru telah ditambahkan!", {
                                icon: "success",
                            });
                            refresh();
                        } else {
                            swal("Gagal menambahkan diskon baru", {
                                icon: "error",
                            });
                        }
                    },
                    error: function (error) {
                        // Handle the error here
                        swal("Gagal menambahkan diskon baru", {
                            icon: "error",
                        });
                    }
                });
            } else {
                swal("Anda telah membatalkan pembuatan diskon baru");
            }
        });
    });
}

function refresh() {
    $("#table-diskon").DataTable().ajax.reload();
    $("#tipe").val('0');
    $("#kode").val('');
    $("#FormBuatKuotaDiskon").val('');
    $("#kuota").val('');
    $("#total").val('');
}