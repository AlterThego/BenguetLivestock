$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var year = $(this).data('year');
        var carabao = $(this).data('carabao');
        var cattle = $(this).data('cattle');
        var swine = $(this).data('swine');
        var goat = $(this).data('goat');
        var dog = $(this).data('dog');
        var sheep = $(this).data('sheep');
        var horse = $(this).data('horse');


        // Set the values in the update modal fields
        $('#update_year').val(year);
        $('#update_carabao').val(carabao);
        $('#update_cattle').val(cattle);
        $('#update_swine').val(swine);
        $('#update_goat').val(goat);
        $('#update_dog').val(dog);
        $('#update_sheep').val(sheep);
        $('#update_horse').val(horse);

        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

    });






});



