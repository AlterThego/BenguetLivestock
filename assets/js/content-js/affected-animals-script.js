// const toggler = document.querySelector(".btn");
// toggler.addEventListener("click", function () {
//     document.querySelector("#sidebar").classList.toggle("collapsed");
// });

$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var id = $(this).data('zip');
        var name = $(this).data('zip') + ' - ' + $(this).data('name');

        var chicken = $(this).data('chicken');
        var duck = $(this).data('duck');
        var cattle = $(this).data('cattle');
        var swine = $(this).data('swine');
        var carabao = $(this).data('carabao');
        var goat = $(this).data('goat');
        var horse = $(this).data('horse');
        var dog = $(this).data('dog');
        var sheep = $(this).data('sheep');


        // Set the values in the update modal fields
        $('#update_id').val(id);
        $('#update_name').val(name);
        $('#update_chicken').attr('placeholder', chicken);
        $('#update_duck').attr('placeholder', duck);
        $('#update_cattle').attr('placeholder', cattle);
        $('#update_swine').attr('placeholder', swine);
        $('#update_carabao').attr('placeholder', carabao);
        $('#update_goat').attr('placeholder', goat);
        $('#update_horse').attr('placeholder', horse);
        $('#update_dog').attr('placeholder', dog);
        $('#update_sheep').attr('placeholder', sheep);

        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

        // Show the update modal
        $('#updateModal').on('hidden.bs.modal', function () {
            $('.modal-backdrop').remove();
        });
    });

    $('.btn-update-yearly').click(function () {


        var year = $(this).data('year');
        var total_chicken = $(this).data('total-chicken');
        var total_duck = $(this).data('total-duck');
        var total_cattle = $(this).data('total-cattle');
        var total_swine = $(this).data('total-swine');
        var total_carabao = $(this).data('total-carabao');
        var total_goat = $(this).data('total-goat');
        var total_horse = $(this).data('total-horse');
        var total_dog = $(this).data('total-dog');
        var total_sheep = $(this).data('total-sheep');


        $('#update_year').val(year);
        $('#update_chicken_yearly').attr('placeholder', total_chicken);
        $('#update_duck_yearly').attr('placeholder', total_duck);
        $('#update_cattle_yearly').attr('placeholder', total_cattle);
        $('#update_swine_yearly').attr('placeholder', total_swine);
        $('#update_carabao_yearly').attr('placeholder', total_carabao);
        $('#update_goat_yearly').attr('placeholder', total_goat);
        $('#update_horse_yearly').attr('placeholder', total_horse);
        $('#update_dog_yearly').attr('placeholder', total_dog);
        $('#update_sheep_yearly').attr('placeholder', total_sheep);

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



