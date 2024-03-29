$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var id = $(this).data('id');
        var name = $(this).data('id') + ' - ' + $(this).data('name');
        var number = $(this).data('number');

        // Set the values in the update modal fields
        $('#update_id').val(id);
        $('#update_name').val(name);
        $('#update_number').val(number);

        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);
    });

    $('.btn-update-yearly').click(function () {
        var year = $(this).data('year');
        var number = $(this).data('total-number');

        $('#update_year').val(year);
        $('#update_number_yearly').val(number);

        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);
    });
});



