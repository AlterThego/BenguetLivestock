$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var year = $(this).data('year');
        var dog = $(this).data('dog');
        var cat = $(this).data('cat');


        // Set the values in the update modal fields
        $('#update_year').val(year);
        $('#update_dog').val(dog);
        $('#update_cat').val(cat);

        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

    });
});





