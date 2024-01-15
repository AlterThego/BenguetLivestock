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





    <title>Poultry Population</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/poultry-population-sidebar.php';
        ?>

        <!-- Main Component -->
        <div class="main" id="main-component">
            <main class="content py-2 mb-5">
                <?php
                $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                $fetch_query = "SELECT * FROM poultrypopulation;";

                $fetch_query_run = mysqli_query($connection, $fetch_query);

                $totalLayers = $totalBroiler = $totalNative = $totalFighting = 0;

                if (mysqli_num_rows($fetch_query_run) > 0) {
                    while ($row = mysqli_fetch_array($fetch_query_run)) {
                        $totalLayers += $row['layers_count'];
                        $totalNative += $row['native_count'];
                        $totalBroiler += $row['broiler_count'];
                        $totalFighting += $row['fighting_count'];
                    }
                }
                ?>

                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card" style="height: 400px; width: 100%; align-items: center;">
                                <canvas id="poultryChart" class="p-2"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="card p-2" style="align-items: center;">
                                    <h5 class="text-left font-weight-bold">Poultry Population Summary Report </h5>
                                    <p>Here is the summary of the poultry population data:</p>
                                </div>


                                <div class="col-md-6 p-3">
                                    <div class="row">
                                        <!-- Top-Right Quadrant -->
                                        <div class="col-md-6 p-1">
                                            <div class="card"
                                                style="height: 100%; background-color: rgba(54, 162, 235, 0.8)">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Native</h5>
                                                    <p class="card-text text-center">
                                                        <?php echo $totalNative; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Bottom-Right Quadrant -->
                                        <div class="col-md-6 p-1">
                                            <div class="card"
                                                style="height: 100%; background-color: rgba(255, 206, 86, 0.8)">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Broiler</h5>
                                                    <p class="card-text text-center">
                                                        <?php echo $totalBroiler; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Bottom-Left Quadrant -->
                                        <div class="col-md-6 p-1" style="bottom: 0; left: 0;">
                                            <div class="card"
                                                style="height: 100%;  background-color: rgba(75, 192, 192, 0.8)">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Fighting</h5>
                                                    <p class="card-text text-center">
                                                        <?php echo $totalFighting; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Top-Left Quadrant -->
                                        <div class="col-md-6 p-1" style="top: 0; left: 0;">
                                            <div class="card"
                                                style="height: 100%; background-color: rgba(255, 99, 132, 0.8);">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Layers</h5>
                                                    <p class="card-text text-center">
                                                        <?php echo $totalLayers; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <div class="col-md-6 p-3">
                                    <div class="card p-2" style="height: 250px; width: 100%;">
                                        <p>Distribution of Poultry Types:</p>
                                        <?php
                                        $percentageLayers = ($totalLayers != 0) ? round(($totalLayers / ($totalLayers + $totalNative + $totalBroiler + $totalFighting)) * 100, 2) : 0;
                                        $percentageNative = ($totalNative != 0) ? round(($totalNative / ($totalLayers + $totalNative + $totalBroiler + $totalFighting)) * 100, 2) : 0;
                                        $percentageBroiler = ($totalBroiler != 0) ? round(($totalBroiler / ($totalLayers + $totalNative + $totalBroiler + $totalFighting)) * 100, 2) : 0;
                                        $percentageFighting = ($totalFighting != 0) ? round(($totalFighting / ($totalLayers + $totalNative + $totalBroiler + $totalFighting)) * 100, 2) : 0;
                                        ?>
                                        <ul>
                                            <li>Layers:
                                                <?php echo $percentageLayers; ?>%
                                            </li>
                                            <li>Native:
                                                <?php echo $percentageNative; ?>%
                                            </li>
                                            <li>Broiler:
                                                <?php echo $percentageBroiler; ?>%
                                            </li>
                                            <li>Fighting:
                                                <?php echo $percentageFighting; ?>%
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container-fluid mt-3">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="text-left font-weight-bold">Poultry Population</h5>
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
                <!-- Main Table -->
                <div class="container-fluid mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <?php include_once '../assets/toastr.php';
                            ?>
                            <div class="card p-3">
                                <div class="table-responsive">
                                    <table class="row-border" id="main-table">
                                        <thead class="thead-light">

                                            <tr>
                                                <th scope="col">Date Updated</th>
                                                <th scope="col">Layers</th>
                                                <th scope="col">Broiler</th>
                                                <th scope="col">Native/ Range</th>
                                                <th scope="col">Fighting/ Fancy Fowl</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM poultrypopulation;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            $layersData = [];
                                            $broilerData = [];
                                            $nativeData = [];
                                            $fightingData = [];

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {

                                                    $layersData[] = $row['layers_count'];
                                                    $broilerData[] = $row['broiler_count'];
                                                    $nativeData[] = $row['native_count'];
                                                    $fightingData[] = $row['fighting_count'];
                                                    ?>
                                                    <tr>
                                                        <td style="display: none;">
                                                            <?php echo $row['poultry_id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['layers_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['broiler_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['native_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['fighting_count'], 0, '.', ','); ?>
                                                        </td>


                                                        <td class="text-center">
                                                            <button class="btn btn-update btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModal"
                                                                data-id="<?php echo $row['poultry_id'] ?>"
                                                                data-layers="<?php echo $row['layers_count']; ?>"
                                                                data-broiler="<?php echo $row['broiler_count']; ?>"
                                                                data-native="<?php echo $row['native_count']; ?>"
                                                                data-fighting="<?php echo $row['fighting_count']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">* Update
                                                            </button>

                                                        </td>
                                                        <td class="text-center">
                                                            <form action="../backend/poultry-population-code.php" method="post">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $row['poultry_id']; ?>">
                                                                <button type="button" class="btn btn-danger btn-delete btn-sm"
                                                                    data-toggle="modal" data-target="#deleteConfirmationModal">
                                                                    - Delete
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
                                <div class="right">
                                    <button class="btn btn-info float-right" onclick="submitTotalModal()"
                                        data-toggle="modal" data-target="#submitTotalModal">Submit Total Count
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visual Representation -->
                <div class="container-fluid mt-1">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <canvas class="canvas" id="poultryPopulationChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/poultry-population-modal.php'; ?>

    <script>
        var ctx = document.getElementById('poultryPopulationChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Layers', 'Broiler', 'Native', 'Fighting'],
                datasets: [{
                    data: [
                        <?php echo join(',', $layersData); ?>,
                        <?php echo join(',', $broilerData); ?>,
                        <?php echo join(',', $nativeData); ?>,
                        <?php echo join(',', $fightingData); ?>
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>




    <script>
        var dataTable = new DataTable('#main-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [6, 7], orderable: false },
                { "className": "dt-center", "targets": "_all" } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
            columns: [
                { "width": "12.5%" },
                { "width": "12.5%" },
                { "width": "12.5%" },
                { "width": "12.5%" },
                { "width": "12.5%" },
                { "width": "12.5%" },
                { "width": "12.5%" },
                { "width": "12.5%" },


            ],
            autoWidth: false,
            search: true,
            paging: false,
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

    </script>




    <script>
        var totalLayers = <?php echo $totalLayers; ?>;
        var totalBroiler = <?php echo $totalBroiler; ?>;
        var totalNative = <?php echo $totalNative; ?>;
        var totalFighting = <?php echo $totalFighting; ?>;
    </script>

    <script>
        // Function to calculate and update totals in the modal
        function submitTotalModal() {
            <?php
            // Assuming these variables are already defined in your PHP code
            echo "var totalLayers = $totalLayers;\n";
            echo "var totalBroiler = $totalBroiler;\n";
            echo "var totalNative = $totalNative;\n";
            echo "var totalFighting = $totalFighting;\n";
            ?>

            // Update the modal content
            document.getElementById('totalTableBody').innerHTML = `
    <tr>
        <td>Layers</td>
        <td>${totalLayers}</td>
    </tr>
    <tr>
        <td>Broiler</td>
        <td>${totalBroiler}</td>
    </tr>
    <tr>
        <td>Native/ Range</td>
        <td>${totalNative}</td>
    </tr>
    <tr>
        <td>Fighting/ Fancy Fowl</td>
        <td>${totalFighting}</td>
    </tr>
        `;
        }
    </script>

    <!-- DELETE SCRIPTS -->
    <script>
        $(document).ready(function () {
            $('.btn-delete').click(function () {
                var id = $(this).closest('form').find('input[name="id"]').val();
                $('#confirmDelete').data('id', id);
                $('#deleteConfirmationModal').modal('show');
                $('.modal-backdrop').remove();
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
                url: '/benguetlivestock/backend/poultry-population-code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/poultry-population.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }
    </script>

    <script>
        var ctx = document.getElementById('poultryChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: ['Layers', 'Native', 'Broiler', 'Fighting'],
                datasets: [{
                    data: [totalLayers, totalNative, totalBroiler, totalFighting],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                    ],
                }],
            },
        });
    </script>

    <script src="/benguetlivestock/assets/js/content-js/poultry-population-script.js"></script>

    <!-- Sidebar Responsive Script -->
    <script src="/benguetlivestock/assets/js/sidebar.js"></script>

    <!-- Dropdown Script -->
    <script src="/benguetlivestock/assets/js/dropdown.js"></script>
</body>

</html>