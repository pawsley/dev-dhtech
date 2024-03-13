$(document).ready(function() {
    $('#province').select2({
        language: 'id',
    });
    $('#kabupaten').select2({
        language: 'id',
    });
    $('#kecamatan').select2({
        language: 'id',
    });
    $.ajax({
        url: base_url + "RajaOngkir/getProvince",
        dataType: "json",
        success: function(data) {
            $("#province").empty();
            var defaultOption =
                "<option value='0' disabled selected>Pilih Provinsi ...</option>";
            $("#province").append(defaultOption);
            $.each(data, function(index, item) {
                $("#province").append($("<option>", {
                    value: item.province_id,
                    text: item.province
                }));
            });
            $('#province').select2({
                language: 'id',
            });
        }
    });

    $("#province").change(function() {
        var province = $(this).val();
        $("#prov_name").val($(this).find(":selected").text());
        $.ajax({
            url: base_url + "RajaOngkir/getCity/"+ province,
            dataType: "json",
            success: function(data) {
                $("#kabupaten").empty();
                var defaultOption =
                "<option value='0' disabled selected required>Pilih Kota / Kab ...</option>";
                $("#kabupaten").append(defaultOption);
                $.each(data, function(index, item) {
                    $("#kabupaten").append($("<option>", {
                        value: item.city_id,
                        text: item.city_name
                    }));
                });
                $('#kabupaten').select2({
                    language: 'id',
                });
            }
        });
    });

    $("#kabupaten").change(function() {
        var kabupaten = $(this).val();
        $("#kab_name").val($(this).find(":selected").text());
        $.ajax({
            url: base_url + "RajaOngkir/getKecamatan/"+ kabupaten,
            dataType: "json",
            success: function(data) {
                $("#kecamatan").empty();
                var defaultOption =
                "<option value='0' disabled selected required>Pilih Kecamatan...</option>";
                $("#kecamatan").append(defaultOption);
                $.each(data, function(index, item) {
                    $("#kecamatan").append($("<option>", {
                        value: item.subdistrict_id,
                        text: item.subdistrict_name
                    }));
                });
                $('#kecamatan').select2({
                    language: 'id',
                });
            }
        });
    });

    $("#kecamatan").change(function() {
        var kecamatan = $(this).val();
        $('#kecamatan').select2({
            language: 'id',
        });
        $("#kec_name").val($(this).find(":selected").text());
    });
});