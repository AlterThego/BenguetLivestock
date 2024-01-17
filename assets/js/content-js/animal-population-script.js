$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var id = $(this).data('zip');
        var name = $(this).data('zip') + ' - ' + $(this).data('name');
        var carabao_count = $(this).data('carabao');
        var cattle_count = $(this).data('cattle');
        var swine_count = $(this).data('swine');
        var goat_count = $(this).data('goat');
        var dog_count = $(this).data('dog');
        var sheep_count = $(this).data('sheep');
        var horse_count = $(this).data('horse');

        // Set the values in the update modal fields
        $('#update_id').val(id);
        $('#update_name').val(name);
        $('#update_carabao_count').val(carabao_count);
        $('#update_cattle_count').val(cattle_count);
        $('#update_swine_count').val(swine_count);
        $('#update_goat_count').val(goat_count);
        $('#update_dog_count').val(dog_count);
        $('#update_sheep_count').val(sheep_count);
        $('#update_horse_count').val(horse_count);

        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

    });
});



