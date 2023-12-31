const toggler = document.querySelector(".btn");
toggler.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var year = $(this).data('year');
        var carabao = $(this).data('carabao');
        var cattle = $(this).data('cattle');
        var swine = $(this).data('swine');
        var goat = $(this).data('goat');
        var dog = $(this).data('dog');
        var sheep = $(this).data('sheep');
        var horse = $(this).data('horse');


        // Set the values in the update modal fields
        $('#update_year').val(year);
        $('#update_carabao').attr('placeholder', carabao);
        $('#update_cattle').attr('placeholder', cattle);
        $('#update_swine').attr('placeholder', swine);
        $('#update_goat').attr('placeholder', goat);
        $('#update_dog').attr('placeholder', dog);
        $('#update_sheep').attr('placeholder', sheep);
        $('#update_horse').attr('placeholder', horse);

        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

        // Show the update modal
        $('#updateModal').modal('show');
        $('.modal-backdrop').remove();
    });






});



