$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var year = $(this).data('year');
        var poultry = $(this).data('poultry');
        var cattle = $(this).data('cattle');
        var piggery = $(this).data('piggery');


        // Set the values in the update modal fields
        $('#update_year').val(year);
        $('#update_poultry_farms').val(poultry);
        $('#update_cattle_farms').val(cattle);
        $('#update_piggery_farms').val(piggery);


        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

    });






});



