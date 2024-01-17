$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var id = $(this).data('id');
        var layers = $(this).data('layers');
        var broiler = $(this).data('broiler');
        var native = $(this).data('native');
        var fighting = $(this).data('fighting');

        // Set the values in the update modal fields
        $('#update_poultry_id').val(id);
        $('#update_layers_count').val(layers);
        $('#update_broiler_count').val(broiler);
        $('#update_native_count').val(native);
        $('#update_fighting_count').val(fighting);

        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);
    });
});



