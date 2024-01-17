$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var year = $(this).data('year');
        var cattle = $(this).data('cattle');
        var swine = $(this).data('swine');
        var carabao = $(this).data('carabao');
        var goat = $(this).data('goat');
        var chicken = $(this).data('chicken');
        var duck = $(this).data('duck');
        var fish = $(this).data('fish');

        // Set the values in the update modal fields
        $('#update_year').val(year);
        $('#update_cattle_volume').val(cattle);
        $('#update_swine_volume').val(swine);
        $('#update_carabao_volume').val(carabao);
        $('#update_goat_volume').val(goat);
        $('#update_chicken_volume').val(chicken);
        $('#update_duck_volume').val(duck);
        $('#update_fish_volume').val(fish);

        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);
    });





});



