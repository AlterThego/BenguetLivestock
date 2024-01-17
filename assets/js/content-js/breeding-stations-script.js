$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update-provincial').click(function () {
        // Get data attributes from the clicked button
        var year = $(this).data('year');
        var number = $(this).data('number');


        // Set the values in the update modal fields
        $('#update_year').val(year);
        $('#update_number').val(number);


        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

    });

    // Function to handle update button click
    $('.btn-update-municipality').click(function () {
        // Get data attributes from the clicked button
        var year = $(this).data('year');

        var latrinidad = $(this).data('latrinidad');
        var tuba = $(this).data('tuba');
        var itogon = $(this).data('itogon');
        var bokod = $(this).data('bokod');
        var kabayan = $(this).data('kabayan');
        var buguias = $(this).data('buguias');
        var mankayan = $(this).data('mankayan');
        var bakun = $(this).data('bakun');
        var kibungan = $(this).data('kibungan');
        var atok = $(this).data('atok');
        var kapangan = $(this).data('kapangan');
        var sablan = $(this).data('sablan');
        var tublay = $(this).data('tublay');


        // Set the values in the update modal fields
        $('#update_year_municipality').val(year);

        $('#update_latrinidad').val(latrinidad);
        $('#update_tuba').val(tuba);
        $('#update_itogon').val(itogon);
        $('#update_bokod').val(bokod);
        $('#update_kabayan').val(kabayan);
        $('#update_buguias').val(buguias);
        $('#update_mankayan').val(mankayan);
        $('#update_bakun').val(bakun);
        $('#update_kibungan').val(kibungan);
        $('#update_atok').val(atok);
        $('#update_kapangan').val(kapangan);
        $('#update_sablan').val(sablan);
        $('#update_tublay').val(tublay);



        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

    });


});



