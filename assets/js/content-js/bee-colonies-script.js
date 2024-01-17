$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var id = $(this).data('zip');
        var name = $(this).data('zip') + ' -' + $(this).data('name');
        var colonies_count = $(this).data('honey-bee-colonies');
        var beekeepers_count = $(this).data('beekeepers');

        // Set the values in the update modal fields
        $('#update_id').val(id);
        $('#update_name').val(name);
        $('#update_colonies_count').val(colonies_count);
        $('#update_beekeepers_count').val(beekeepers_count);

        // $('#update_cat_count').attr('placeholder', cat_count);


        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

        // Show the update modal
        $('#updateModal').modal('show');
        $('.modal-backdrop').remove();
    });









});



