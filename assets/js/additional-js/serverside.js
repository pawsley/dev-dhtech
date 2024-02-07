$(document).ready(function() {
    reload();
    getid();
});

function getid() {
    $('#EditMasterKaryawan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id_user = button.data('id');
        
        console.log(id_user);
        $.ajax({
            url: base_url + "master-karyawan/edit/"+id_user,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    $("#e_id").val(item.id_user);
                    $("#e_nl").val(item.nama_lengkap);
                    $("#e_tl").val(item.tanggal_lahir);
                    $("#e_jk").val(item.jen_kel);
                    $("#e_email").val(item.email);
                    $("#e_password").val(item.password);
                    $("#ex_prov").val(item.provinsi);
                    $("#ex_kab").val(item.kabupaten);
                    $("#ex_kec").val(item.kecamatan);
                    $("#e_kode").val(item.kode_pos);
                    $("#e_alamat").val(item.alamat);
                    $("#e_wa").val(item.no_wa);
                    $("#filecv_filename").val(item.file_cv);
                    $("#e_jabatan").val(item.jabatan);
                    $("#e_role").val(item.role_user);
                    $("#e_gaji").val(item.gaji);
                    formatRupiah(document.getElementById("e_gaji"));
                    $("#e_status").val(item.status);
                });
            }
        });
    });
}


// Call getid after the document is ready



function reload() {
    var formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0 // Set the number of decimal places to 0 for whole numbers
    });
    $("#table-karyawan").DataTable({
        "processing": true,
        "language": { 
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
            // "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',            
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url+'master-karyawan/jsonkar',
            "type": "POST"
        },
        "columns": [
            { "data": "id_user"},
            { "data": "nama_lengkap"},
            { "data": "jabatan"},
            { "data": "role_user" },
            { 
                "data": "gaji",
                "render": function (data, type, row) {
                    return formatter.format(data);
                }
            },
            { 
                "data": "file_cv",
                "render": function (data, type, row) {
                    if (type === 'display' && data !== null && data !== "") {
                        // Assuming 'data' is the filename (e.g., 'sample.pdf')
                        var pdfLink = '<a class="pdf" href="' + base_url + 'assets/dhdokumen/karyawan/' + data + '" target="_blank">' +
                            '<i class="icofont icofont-file-pdf">'+ data +'</i>' +
                            '</a>';
                        return pdfLink;
                    } else {
                        return data;
                    }
                }
            },
            { "data": "no_wa" },
            { "data": "email" },
            { "data": "password" },
            {
              "data": "status",
              "render": function (data, type, full, meta) {
                  // You can customize the rendering here
                  if (type === "display") {
                      if (data === "1") {
                          return `<span class="badge rounded-pill badge-success">Aktif</span>`;
                        } else {
                          return `<span class="badge rounded-pill badge-secondary">Non Aktif</span>`;
                      }
                      return data; // return the original value for other cases
                  }
                  return data;
              }
            },
            { 
              "data": "id_user",
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
