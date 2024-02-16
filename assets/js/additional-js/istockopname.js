$(document).ready(function () {
    // setInterval(getCountPM, 3000);
    getCountPM();
    $('#cardLink').click(function(event) {
        event.preventDefault();
        $('#spinner').removeClass('d-none');
        $('#pm').addClass('d-none');
        getCountPM();
    });
});

function getCountPM() {
    $.ajax({
        url: base_url+'StockOpname/countpm/', 
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#pm').removeClass('d-none');
            $('#pm').text(response);
            $('#spinner').addClass('d-none');
        },
        error: function(xhr, status, error) {
            console.error(xhr, status, error);
            $('#spinner').addClass('d-none');
        }
    });
}