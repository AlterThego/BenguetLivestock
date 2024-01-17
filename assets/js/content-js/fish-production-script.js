$(document).ready(function () {

    // Function to handle update button click
    $('.btn-update').click(function () {
        // Get data attributes from the clicked button
        var id = $(this).data('id');
        var pond = $(this).data('pond');
        var cage = $(this).data('cage');
        var tank = $(this).data('tank');
        var rice = $(this).data('rice');
        var communal = $(this).data('communal');

        // Set the values in the update modal fields
        $('#update_poultry_id').val(id);
        $('#update_pond_count').val(pond);
        $('#update_cage_count').val(cage);
        $('#update_tank_count').val(tank);
        $('#update_rice_count').val(rice);
        $('#update_communal_count').val(communal);

        // Get today's date in the format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set the value of the "Date Updated" input field to today's date
        $('#update_date').val(today);

        // Show the update modal
        $('#updateModal').modal('show');
        $('.modal-backdrop').remove();
    });

    $('.btn-update-yearly').click(function () {


        var year = $(this).data('year');
        var pond = $(this).data('yearly-pond');
        var cage = $(this).data('yearly-cage');
        var tank = $(this).data('yearly-tank');
        var rice = $(this).data('yearly-rice-culture');
        var communal = $(this).data('yearly-communal');
        $('#update_year').val(year);
        $('#update_pond_yearly').val(pond);
        $('#update_cage_yearly').val(cage);
        $('#update_tank_yearly').val(tank);
        $('#update_rice_yearly').val(rice);
        $('#update_communal_yearly').val(communal);

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



