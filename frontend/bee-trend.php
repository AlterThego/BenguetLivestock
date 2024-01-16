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




    <title>Bee Trend</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/bee-trend-sidebar.php';
        ?>

        <!-- Main Component -->
        <div class="main" id="main-component">
            <main class="content py-2 mb-5  table-responsive">
                <!-- Main Table -->
                <div class="container-fluid">
                    <div class="row justify-content-center ">
                        <!-- Title + Add -->
                        <div class="container-fluid mt-3">
                            <div class="row justify-content-center ">
                                <div class="col-md-12">
                                    <div class="card p-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="text-left font-weight-bold">Bee Trend</h5>
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
                                                <th scope="col">Honey Bee Colonies</th>
                                                <th scope="col">Number of Beekeepers</th>
                                                <th scope="col">Date Updated</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM beetrend";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['bee_year'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['colonies_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['beekeepers_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['date_updated'] ?>
                                                        </td>


                                                        <td>
                                                            <button class="btn btn-update btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModal"
                                                                data-year="<?php echo $row['bee_year']; ?>"
                                                                data-colonies="<?php echo $row['colonies_count']; ?>"
                                                                data-beekeepers="<?php echo $row['beekeepers_count']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">
                                                                Update
                                                            </button>

                                                        </td>
                                                        <td>
                                                            <form action="/benguetlivestock/backend/bee-trend-code.php"
                                                                method="post">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $row['bee_year']; ?>">
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
                                <div class="mt-3 text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Prediction -->
                <div class="container-fluid mt-5">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <h4 class="text-center font-weight-bold mb-3">Linear Regression Analysis</h4>
                                <p class="text-left font-weight-italicized mb-3">
                                    <b>Note:</b> This prediction for honey bee colonies and number of beekeepers is
                                    based on linear regression
                                    analysis. It's important to understand that this is not a guaranteed forecast but
                                    rather an estimate using statistical methods.
                                </p>
                                <div class="table-responsive">
                                    <table class="row-border" id="predicted-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Year</th>
                                                <th scope="col">Possible Number of Honey Bee Colonies</th>
                                                <th scope="col">Possible Number of Beekeepers</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            try {
                                                // Analyze trends and predict the next year's counts
                                                $max_year = 0;
                                                $counts = array();

                                                $fetch_query = "SELECT * FROM beetrend";
                                                $fetch_query_run = mysqli_query($connection, $fetch_query);

                                                if ($fetch_query_run === false) {
                                                    throw new Exception("Error fetching data: " . mysqli_error($connection));
                                                }

                                                if (mysqli_num_rows($fetch_query_run) > 0) {
                                                    while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                        // Store counts for analysis
                                                        $counts[$row['bee_year']] = array(
                                                            'colonies' => $row['colonies_count'],
                                                            'beekeepers' => $row['beekeepers_count'],
                                                        );

                                                        // Find the maximum year
                                                        $max_year = max($max_year, $row['bee_year']);
                                                    }
                                                } else {
                                                    throw new Exception("Insufficient data for analysis.");
                                                }

                                                // Linear regression for colonies count
                                                if (count($counts) > 1) {
                                                    $colonies_values = array_column($counts, 'colonies');
                                                    $colonies_regression = linearRegression(array_keys($counts), $colonies_values);
                                                    $predicted_colonies = $colonies_regression['slope'] * ($max_year + 1) + $colonies_regression['intercept'];
                                                } else {
                                                    throw new Exception("Insufficient data for linear regression analysis.");
                                                }

                                                // Linear regression for beekeepers count
                                                if (count($counts) > 1) {
                                                    $beekeepers_values = array_column($counts, 'beekeepers');
                                                    $beekeepers_regression = linearRegression(array_keys($counts), $beekeepers_values);
                                                    $predicted_beekeepers = $beekeepers_regression['slope'] * ($max_year + 1) + $beekeepers_regression['intercept'];
                                                } else {
                                                    throw new Exception("Insufficient data for linear regression on cat count.");
                                                }

                                                // Predicted data for next year
                                                $predicted_year = $max_year + 1;
                                            } catch (Exception $e) {
                                                echo "Error: " . $e->getMessage();
                                            }
                                            ?>

                                            <?php
                                            // Function to calculate linear regression
                                            // Function to calculate linear regression
                                            // Function to calculate linear regression
                                            function linearRegression($x, $y)
                                            {
                                                $n = count($x);

                                                // Check if there are enough data points for regression
                                                $minDataPoints = 2;
                                                if ($n < $minDataPoints) {
                                                    return null; // Return null to indicate insufficient data points
                                                }

                                                $sumX = array_sum($x);
                                                $sumY = array_sum($y);
                                                $sumXY = 0;
                                                $sumX2 = 0;

                                                for ($i = 0; $i < $n; $i++) {
                                                    $sumXY += ($x[$i] * $y[$i]);
                                                    $sumX2 += ($x[$i] * $x[$i]);
                                                }

                                                // Check if the denominator is zero
                                                $denominator = $n * $sumX2 - $sumX * $sumX;
                                                if ($denominator == 0) {
                                                    return null; // Return null to indicate inability to perform linear regression
                                                }

                                                $slope = ($n * $sumXY - $sumX * $sumY) / $denominator;
                                                $intercept = ($sumY - $slope * $sumX) / $n;

                                                return array('slope' => $slope, 'intercept' => $intercept);
                                            }

                                            ?>

                                            <tr>
                                                <td>
                                                    <?php echo isset($predicted_year) ? $predicted_year : "N/A"; ?>
                                                </td>
                                                <td>
                                                    <?php echo isset($predicted_colonies) ? number_format($predicted_colonies, 0, '.', ',') : "N/A"; ?>
                                                </td>
                                                <td>
                                                    <?php echo isset($predicted_beekeepers) ? number_format($predicted_beekeepers, 0, '.', ',') : "N/A"; ?>
                                                </td>
                                            </tr>
                                        </tbody>


                                    </table>
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
                                <canvas class="canvas" id="beeTrend"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


            </main>
        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/bee-trend-modal.php'; ?>

    <!-- Main Table JS -->
    <script>
        var dataTable = new DataTable('#main-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [4, 5], orderable: false },
                { "className": "dt-center", "targets": "_all" }
            ],
            columns: [
                { "width": "16.67%" },
                { "width": "16.67%" },
                { "width": "16.67%" },
                { "width": "16.67%" },
                { "width": "16.67%" },
                { "width": "16.67%" }
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
                        columns: [0, 1, 2, 3, 4, 6]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 6]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 6]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 6]
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
        var dataTable = new DataTable('#predicted-table', {
            lengthChange: false,
            columns: [
                { "width": "33.33%" },
                { "width": "33.33%" },
                { "width": "33.33%" }
            ],
            autoWidth: false,
            searching: false,
            info: false,
            paging: false,
            ordering: false,
            "drawCallback": function (settings) {
                // Manually set the font size for the DataTable
                $('#predicted-table').css('font-size', '14px'); // Adjust the size as needed
            }
        });
    </script>




    <!-- Linear Regression Graph -->
    <script>
        const ctx = document.getElementById('beeTrend');

        const beeData = {
            labels: [<?php echo implode(',', array_keys($counts)); ?>],
            colonies: [<?php echo implode(',', array_column($counts, 'colonies')); ?>],
            beekeepers: [<?php echo implode(',', array_column($counts, 'beekeepers')); ?>],
        };

        // Limit the number of years in the graph
        // const beeData = {
        //     labels: [<?php echo implode(',', array_slice(array_keys($counts), -6)); ?>],
        //     colonies: [<?php echo implode(',', array_slice(array_column($counts, 'colonies'), -6)); ?>],
        //     beekeepers: [<?php echo implode(',', array_slice(array_column($counts, 'beekeepers'), -6)); ?>],
        // };

        const predictedYear = <?php echo $predicted_year; ?>;
        const coloniesRegressionLine = calculateRegressionLine(beeData.labels, beeData.colonies);
        const beekeepersRegressionLine = calculateRegressionLine(beeData.labels, beeData.beekeepers);


        // Calculate predicted values for 2023
        const predictedcolonies = coloniesRegressionLine.slope * predictedYear + coloniesRegressionLine.intercept;
        const predictedbeekeepers = beekeepersRegressionLine.slope * predictedYear + beekeepersRegressionLine.intercept;

        // Add the predicted data for 2023
        beeData.labels.push(predictedYear.toString());
        beeData.colonies.push(predictedcolonies);
        beeData.beekeepers.push(predictedbeekeepers);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: beeData.labels,
                datasets: [{
                    label: 'Honey Bee Colonies',
                    data: beeData.colonies,
                    fill: false,
                    borderColor: 'rgb(255, 0, 0)',
                    tension: 0.1
                }, {
                    label: 'Number of Beekeepers',
                    data: beeData.beekeepers,
                    fill: false,
                    borderColor: 'rgb(0, 255, 0)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        ticks: {
                            callback: function (value, index, values) {
                                return value % 1 === 0 ? value : '';
                            }
                        },
                        min: beeData.labels[0],  // Set the minimum x-axis value
                        max: predictedYear.toString()
                    },

                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Function to calculate linear regression
        function calculateRegressionLine(x, y) {
            const n = x.length;
            let sumX = 0;
            let sumY = 0;
            let sumXY = 0;
            let sumXSquare = 0;

            for (let i = 0; i < n; i++) {
                sumX += x[i];
                sumY += y[i];
                sumXY += x[i] * y[i];
                sumXSquare += x[i] * x[i];
            }

            const slope = (n * sumXY - sumX * sumY) / (n * sumXSquare - sumX * sumX);
            const intercept = (sumY - slope * sumX) / n;

            return { slope, intercept };
        }
    </script>









    <!-- Advanced Options JS -->
    <script>
        var dataTable = new DataTable('#advanced-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [1, 2], orderable: false } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
            autoWidth: false,
            search: true,
            // info: false,
            paging: false,
        });
    </script>

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
                url: '/benguetlivestock/backend/bee-trend-code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/bee-trend.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }
    </script>
    <script src="/benguetlivestock/assets/js/content-js/bee-trend-script.js"></script>

    <!-- Save State of Page Script -->
    <script src="/benguetlivestock/assets/js/save-state.js"></script>
    <!-- Sidebar Responsive Script -->
    <script src="/benguetlivestock/assets/js/sidebar.js"></script>
    <!-- Dropdown Script -->
    <script src="/benguetlivestock/assets/js/dropdown.js"></script>
</body>

</html>