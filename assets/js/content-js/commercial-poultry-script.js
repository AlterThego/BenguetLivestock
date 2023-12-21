const toggler = document.querySelector(".btn");
toggler.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

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
        $('#update_poultry_farms').attr('placeholder', poultry);
        $('#update_cattle_farms').attr('placeholder', cattle);
        $('#update_piggery_farms').attr('placeholder', piggery);


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



