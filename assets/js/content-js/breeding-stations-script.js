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

        // Show the update modal
        $('#updateModal').on('hidden.bs.modal', function () {
            $('.modal-backdrop').remove();
        });
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

        $('#update_latrinidad').attr('placeholder', latrinidad);
        $('#update_tuba').attr('placeholder', tuba);
        $('#update_itogon').attr('placeholder', itogon);
        $('#update_bokod').attr('placeholder', bokod);
        $('#update_kabayan').attr('placeholder', kabayan);
        $('#update_buguias').attr('placeholder', buguias);
        $('#update_mankayan').attr('placeholder', mankayan);
        $('#update_bakun').attr('placeholder', bakun);
        $('#update_kibungan').attr('placeholder', kibungan);
        $('#update_atok').attr('placeholder', atok);
        $('#update_kapangan').attr('placeholder', kapangan);
        $('#update_sablan').attr('placeholder', sablan);
        $('#update_tublay').attr('placeholder', tublay);



        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

        // Show the update modal
        $('#updateModal').on('hidden.bs.modal', function () {
            $('.modal-backdrop').remove();
        });
    });


});



