<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FINAL CSS-->
    <link rel="stylesheet" href="/benguetlivestock/assets/css/bootstrap-5-css/bootstrap.min.css">
    <link rel="stylesheet" href="/benguetlivestock/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/benguetlivestock/assets/styles.css">
    <link rel="stylesheet" href="/benguetlivestock/assets/css/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="/benguetlivestock/assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/benguetlivestock/assets/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="/benguetlivestock/assets/css/toastr.min.css">

    <!-- FINAL JS -->
    <script src="/benguetlivestock/assets/js/dependencies-js/jquery-3.7.0.js"></script>
    <script src="/benguetlivestock/assets/js/dependencies-js/jquery.dataTables.min.js"></script>
    <script src="/benguetlivestock/assets/js/dependencies-js/dataTables.buttons.min.js"></script>
    <script src="/benguetlivestock/assets/js/dependencies-js/jszip.min.js"></script>
    <script src="/benguetlivestock/assets/js/dependencies-js/pdfmake.min.js"></script>
    <script src="/benguetlivestock/assets/js/dependencies-js/vfs_fonts.js"></script>
    <script src="/benguetlivestock/assets/js/dependencies-js/buttons.html5.min.js"></script>
    <script src="/benguetlivestock/assets/js/dependencies-js/buttons.print.min.js"></script>

    <script src='/benguetlivestock/assets/js/dependencies-js/bootstrap.min.js'></script>
    <script src='/benguetlivestock/assets/js/dependencies-js/jquery.min.js'></script>
    <script src='/benguetlivestock/assets/js/dependencies-js/popper.min.js'></script>
    <script src="/benguetlivestock/assets/js/dependencies-js/bootstrap-5-js/bootstrap.min.js"></script>
    <script src="/benguetlivestock/assets/js/dependencies-js/chart.umd.min.js"></script>
    <script src="/benguetlivestock/assets/js/dependencies-js/iconify.min.js"></script>
    <script src="/benguetlivestock/assets/js/dependencies-js/toastr.min.js"></script>


    <title>Commerical, Cattle, and Piggery Farms</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/commercial-poultry-sidebar.php';
        ?>

        <!-- Main Component -->
        <div class="main" id="main-component">
            <main class="content py-2 mb-5">
                <!-- Main Table -->
                <div class="container-fluid mt-3">
                    <div class="row justify-content-center">
                        <!-- Title + Add -->
                        <div class="container-fluid mt-3">
                            <div class="row justify-content-center ">
                                <div class="col-md-12">
                                    <div class="card p-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="text-left font-weight-bold">Commercial Farms</h5>
                                            </div>
                                            <div class="col-6 text-end">
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#addModal">
                                                    + Add data
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <?php include_once '../assets/toastr.php';
                            ?>
                            <div class="card p-3">
                                <div class="table-responsive">
                                    <table class="row-border" id="main-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Year</th>
                                                <th scope="col">Poultry Farms</th>
                                                <th scope="col">Cattle Farms</th>
                                                <th scope="col">Piggery Farms</th>
                                                <th scope="col">Date Updated</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM commercialpoultry;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            $yearData = [];
                                            $poultryData = [];
                                            $cattleData = [];
                                            $poultryData = [];

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    $yearData[] = $row['year'];
                                                    $poultryData[] = $row['poultry_count'];
                                                    $cattleData[] = $row['cattle_count'];
                                                    $piggeryData[] = $row['piggery_count'];

                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['year']; ?>
                                                        </td>

                                                        <td>
                                                            <?php echo number_format($row['poultry_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['cattle_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['piggery_count'], 0, '.', ','); ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <button class="btn btn-update btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModal"
                                                                data-year="<?php echo $row['year'] ?>"
                                                                data-year="<?php echo $row['year'] ?>"
                                                                data-poultry="<?php echo $row['poultry_count'] ?>"
                                                                data-cattle="<?php echo $row['cattle_count'] ?>"
                                                                data-piggery="<?php echo $row['piggery_count'] ?>">Update

                                                            </button>

                                                        </td>
                                                        <td class="text-center">
                                                            <form action="/benguetlivestock/backend/commercial-poultry-code.php"
                                                                method="post">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $row['year']; ?>">
                                                                <button type="button" class="btn btn-danger btn-delete btn-sm"
                                                                    data-toggle="modal" data-target="#deleteConfirmationModal">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visual Representation -->
                <div class="container-fluid mb-5 mt-1">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <canvas class="canvas" id="commercialPoultryChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/commercial-poultry-modal.php'; ?>

    <!-- Municipalilty -->
    <script>
        var ctx = document.getElementById('commercialPoultryChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($yearData); ?>,
                datasets: [
                    {
                        label: 'Poultry Farms',
                        data: <?php echo json_encode($poultryData); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Cattle Farms',
                        data: <?php echo json_encode($cattleData); ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Piggery Farms',
                        data: <?php echo json_encode($piggeryData); ?>,
                        backgroundColor: 'rgba(255, 205, 86, 0.2)',
                        borderColor: 'rgba(255, 205, 86, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


    <script>
        var dataTable = new DataTable('#main-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [5, 6], orderable: false },
                { "className": "dt-center", "targets": "_all" }
            ],
            columns: [
                { "width": "14.29%" },
                { "width": "14.29%" },
                { "width": "14.29%" },
                { "width": "14.29%" },
                { "width": "14.29%" },
                { "width": "14.29%" },
                { "width": "14.29%" }
            ],
            autoWidth: false,
            search: true,
            paging: true,
            dom: 'Bfrtip',
            order: [[0, 'desc']],
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


    </script>

    <script>
        $(document).ready(function () {
            $('.btn-delete').click(function () {
                var id = $(this).closest('form').find('input[name="id"]').val();
                $('#confirmDelete').data('id', id);
            });

            $('#confirmDelete').click(function () {
                var id = $(this).data('id');
                // Call the function to handle deletion in code.php
                deleteData(id);
            });
        });

        // Function to handle deletion
        function deleteData(id) {
            $.ajax({
                type: 'POST',
                url: '/benguetlivestock/backend/commercial-poultry-code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/commercial-poultry.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }
    </script>

    <!-- JS for Update and Delete 'script.js'-->
    <script src="/benguetlivestock/assets/js/content-js/commercial-poultry-script.js"></script>

    <!-- Save State of Page Script -->
    <script src="/benguetlivestock/assets/js/save-state.js"></script>
    <!-- Sidebar Responsive Script -->
    <script src="/benguetlivestock/assets/js/sidebar.js"></script>
    <!-- Dropdown Script -->
    <script src="/benguetlivestock/assets/js/dropdown.js"></script>
</body>

</html>