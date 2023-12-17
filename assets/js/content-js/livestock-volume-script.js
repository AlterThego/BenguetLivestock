const toggler = document.querySelector(".btn");
toggler.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var id = $(this).data('zip');
        var name = $(this).data('zip') + ' - ' + $(this).data('name');
        var cattle = $(this).data('cattle');
        var swine = $(this).data('swine');
        var carabao = $(this).data('carabao');
        var goat = $(this).data('goat');
        var chicken = $(this).data('chicken');
        var duck = $(this).data('duck');
        var fish = $(this).data('fish');

        // Set the values in the update modal fields
        $('#update_id').val(id);
        $('#update_name').val(name);
        $('#update_cattle_volume').attr('placeholder', cattle);
        $('#update_swine_volume').attr('placeholder', swine);
        $('#update_carabao_volume').attr('placeholder', carabao);
        $('#update_goat_volume').attr('placeholder', goat);
        $('#update_chicken_volume').attr('placeholder', chicken);
        $('#update_duck_volume').attr('placeholder', duck);
        $('#update_fish_volume').attr('placeholder', fish);

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



