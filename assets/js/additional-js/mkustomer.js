$(document).ready(function () {
    reload();
});

function reload() {
    $("#table-kustomer").DataTable({
        "processing": true,
        "language": { 
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
            // "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',            
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url+'master-kustomer/jsonkus',
            "type": "POST"
        },
        "columns": [
            { "data": "id_plg"},
            { "data": "nama_plg"},
            { "data": "no_ponsel"},
            { "data": "email" },
            { "data": "alamat" },
            { 
              "data": "id_plg",
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