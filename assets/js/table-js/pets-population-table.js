var dataTable = new DataTable('#main-table', {
    lengthChange: false,
    columnDefs: [
        { targets: [5, 6], orderable: false },
        { "className": "dt-center", "targets": "_all" } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
    ],
    columns: [
        { "width": "14.29%" },
        { "width": "14.29%" },
        { "width": "14.29%" },
        { "width": "14.29%" },
        { "width": "14.29%" },
        { "width": "14.29%" },
        { "width": "14.29%" },

    ],
    autoWidth: false,
    search: true,
    paging: false,
    order: [[1, 'asc']],
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'copy',
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'csv',
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'excel',
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'pdf',
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        },
        'print'
    ],
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

    "drawCallback": function (settings) {
        // Manually set the font size for the DataTable
        $('#main-table').css('font-size', '14px'); // Adjust the size as needed
    }
});


