$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var id = $(this).data('zip');
        var name = $(this).data('zip') + ' -' + $(this).data('name');
        var deaths_count = $(this).data('deaths');

        // Set the values in the update modal fields
        $('#update_id').val(id);
        $('#update_name').val(name);
        $('#update_death_count').val(deaths_count);

        // $('#update_cat_count').attr('placeholder', cat_count);


        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

    });

    $('.btn-update-yearly').click(function () {


        var year = $(this).data('year');
        var deaths = $(this).data('total-deaths');

        $('#update_year').val(year);
        $('#update_deaths_yearly').attr('placeholder', deaths);

        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

    });


});



