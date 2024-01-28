$(document).ready(function () {
    $('#FormKepalaCabang').on('click', function () {
        var selectedValue = $('#FormKepalaCabang').val();

        $('#FormKepalaCabang').html('<option value="0" disabled selected>Loading...</option>');

        setTimeout(function () {
            $.ajax({
                url: base_url + 'MasterCabang/loadkar',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#FormKepalaCabang').empty();
                    $('#FormKepalaCabang').append('<option selected="" disabled="" value="">Pilih Kepala Cabang ...</option>');
                    $.each(data, function (index, value) {
                        $('#FormKepalaCabang').append('<option value="' + value.id_user + '">' + value.id_user + ' | ' + value.nama_lengkap + '</option>');
                    });
                    $('#FormKepalaCabang').val(selectedValue);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                },
                complete: function () {
                    $('#FormKepalaCabang option[value="0"]').remove();
                }
            });
        }, 50); 
    });
    reload();
});

function reload() {
    $("#table-cabang").DataTable({
        "processing": true,
        "language": { 
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
            // "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',            
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url+'master-cabang/jsoncab',
            "type": "POST"
        },
        "columns": [
            { "data": "id_toko"},
            { "data": "nama_lengkap"},
            { "data": "nama_toko"},
            { "data": "provinsi" },
            { "data": "kabupaten" },
            { "data": "kecamatan" },
            { "data": "alamat" },
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
              "data": "id_toko",
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