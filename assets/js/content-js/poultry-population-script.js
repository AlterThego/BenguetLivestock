const toggler = document.querySelector(".btn");
toggler.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

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
        $('#update_layers_count').attr('placeholder', layers);
        $('#update_broiler_count').attr('placeholder', broiler);
        $('#update_native_count').attr('placeholder', native);
        $('#update_fighting_count').attr('placeholder', fighting);

        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

        // Show the update modal
        $('#updateModal').modal('show');
        $('.modal-backdrop').remove();
    });









});



