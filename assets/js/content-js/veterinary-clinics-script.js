const toggler = document.querySelector(".btn");
toggler.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var id = $(this).data('zip');
        var name = $(this).data('zip') + ' -' + $(this).data('name');
        var clinics_count = $(this).data('number');

        // Set the values in the update modal fields
        $('#update_id').val(id);
        $('#update_name').val(name);
        $('#update_clinics_count').attr('placeholder', clinics_count);

        // $('#update_cat_count').attr('placeholder', cat_count);


        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

        // Show the update modal
        $('#updateModal').modal('show');
        $('.modal-backdrop').remove();
    });

    $('.btn-update-yearly').click(function () {


        var private_id = $(this).data('private-zip');
        var private_name = $(this).data('private-zip') + ' -' + $(this).data('private-name');
        var private_number = $(this).data('private-number');

        $('#update_private_id').val(private_id);
        $('#update_private_name').val(private_name);
        $('#update_private_clinics_count').attr('placeholder', private_number);

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



