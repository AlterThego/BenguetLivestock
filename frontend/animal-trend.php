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




    <title>Animal Trend</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/animal-trend-sidebar.php';
        ?>

        <!-- Main Component -->
        <div class="main" id="main-component">
            <main class="content py-2">
                <!-- Main Table -->
                <div class="container-fluid mt-3">
                    <div class="row justify-content-center">


                        <!-- Title + Add -->
                        <div class="container-fluid mb-1">
                            <div class="row justify-content-center ">
                                <div class="col-md-12">
                                    <div class="card p-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="text-left font-weight-bold">Animal Trend</h5>
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

                        <div class="col-md-12  mt-3">
                            <?php include_once '../assets/toastr.php';
                            ?>
                            <div class="card p-3">
                                <div class="table-responsive">
                                    <table class="row-border" id="main-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Year</th>
                                                <th scope="col">Carabao</th>
                                                <th scope="col">Cattle</th>
                                                <th scope="col">Swine</th>
                                                <th scope="col">Goat</th>
                                                <th scope="col">Sheep</th>
                                                <th scope="col">Horse</th>
                                                <th scope="col">Dog</th>
                                                <th scope="col" style="color: red;">Total</th>
                                                <th scope="col">Date Updated</th>
                                                <th class="text-center" scope="col">Update</th>
                                                <th class="text-center" scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM animaltrend";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['livestock_year']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['carabao_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['cattle_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['swine_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['goat_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['sheep_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['horse_count'], 0, '.', ','); ?>
                                                        </td>

                                                        <td><i>
                                                                <?php echo number_format($row['dog_count'], 0, '.', ','); ?>
                                                            </i>
                                                        </td>
                                                        <td style="color: red; font-weight:bold;">
                                                            <!-- Total of layers, broiler, native, and fighting -->
                                                            <?php
                                                            $total = $row['carabao_count'] + $row['cattle_count'] + $row['swine_count'] + $row['goat_count']
                                                                + $row['dog_count'] + $row['sheep_count'] + $row['horse_count'];
                                                            echo number_format($total, 0, '.', ',');
                                                            ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>

                                                        <td class=" text-center">
                                                            <button class="btn btn-update btn-warning btn-sm center"
                                                                data-toggle="modal" data-target="#updateModal"
                                                                data-year="<?php echo $row['livestock_year']; ?>"
                                                                data-carabao="<?php echo $row['carabao_count']; ?>"
                                                                data-cattle="<?php echo $row['cattle_count']; ?>"
                                                                data-swine="<?php echo $row['swine_count']; ?>"
                                                                data-goat="<?php echo $row['goat_count']; ?>"
                                                                data-dog="<?php echo $row['dog_count']; ?>"
                                                                data-sheep="<?php echo $row['sheep_count']; ?>"
                                                                data-horse="<?php echo $row['horse_count']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">
                                                                Update
                                                            </button>

                                                        </td>
                                                        <td class="text-center">
                                                            <form action="/benguetlivestock/backend/animal-trend-code.php"
                                                                method="post">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $row['livestock_year']; ?>">
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

                <!-- Prediction -->
                <div class="container-fluid mt-5">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <h4 class="text-center font-weight-bold mb-3">Linear Regression Analysis</h4>
                                <p class="text-left font-weight-italicized mb-3">
                                    <b>Note:</b> This prediction for animal population is based on linear regression
                                    analysis. It's important to understand that this is not a guaranteed forecast
                                    but
                                    rather an estimate using statistical methods.
                                </p>
                                <div class="table-responsive">
                                    <table class="display table-bordered" id="predicted-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Year</th>
                                                <th scope="col">Possible Carabao Count</th>
                                                <th scope="col">Possible Cattle Count</th>
                                                <th scope="col">Possible Swine Count</th>
                                                <th scope="col">Possible Goat Count</th>
                                                <th scope="col">Possible Sheep Count</th>
                                                <th scope="col">Possible Horse Count</th>
                                                <th scope="col">Possible Dog Count</th>
                                                <th scope="col">Possible Total Animal Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            try {
                                                // Analyze trends and predict the next year's counts
                                                $max_year = 0;
                                                $counts = array();

                                                $fetch_query = "SELECT * FROM animaltrend";
                                                $fetch_query_run = mysqli_query($connection, $fetch_query);

                                                if ($fetch_query_run === false) {
                                                    throw new Exception("Error fetching data: " . mysqli_error($connection));
                                                }

                                                if (mysqli_num_rows($fetch_query_run) > 0) {
                                                    while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                        // Store counts for analysis
                                                        $counts[$row['livestock_year']] = array(
                                                            'carabao' => $row['carabao_count'],
                                                            'cattle' => $row['cattle_count'],
                                                            'swine' => $row['swine_count'],
                                                            'goat' => $row['goat_count'],
                                                            'sheep' => $row['sheep_count'],
                                                            'horse' => $row['horse_count'],
                                                            'dog' => $row['dog_count'],
                                                        );

                                                        // Find the maximum year
                                                        $max_year = max($max_year, $row['livestock_year']);

                                                    }
                                                } else {
                                                    throw new Exception("Insufficient data for analysis.");
                                                }

                                                // Linear regression for carabao count
                                                if (count($counts) > 1) {
                                                    $carabao_values = array_column($counts, 'carabao');
                                                    $carabao_regression = linearRegression(array_keys($counts), $carabao_values);
                                                    $predicted_carabao = $carabao_regression['slope'] * ($max_year + 1) + $carabao_regression['intercept'];
                                                } else {
                                                    throw new Exception("Insufficient data for linear regression on dog analysis.");
                                                }

                                                // Linear regression for cattle count
                                                if (count($counts) > 1) {
                                                    $cattle_values = array_column($counts, 'cattle');
                                                    $cattle_regression = linearRegression(array_keys($counts), $cattle_values);
                                                    $predicted_cattle = $cattle_regression['slope'] * ($max_year + 1) + $cattle_regression['intercept'];
                                                } else {
                                                    throw new Exception("Insufficient data for linear regression on cat count.");
                                                }

                                                // Linear regression for swine count
                                                if (count($counts) > 1) {
                                                    $swine_values = array_column($counts, 'swine');
                                                    $swine_regression = linearRegression(array_keys($counts), $swine_values);
                                                    $predicted_swine = $swine_regression['slope'] * ($max_year + 1) + $swine_regression['intercept'];
                                                } else {
                                                    throw new Exception("Insufficient data for linear regression on cat count.");
                                                }

                                                // Linear regression for goat count
                                                if (count($counts) > 1) {
                                                    $goat_values = array_column($counts, 'goat');
                                                    $goat_regression = linearRegression(array_keys($counts), $goat_values);
                                                    $predicted_goat = $goat_regression['slope'] * ($max_year + 1) + $goat_regression['intercept'];
                                                } else {
                                                    throw new Exception("Insufficient data for linear regression on cat count.");
                                                }

                                                // Linear regression for sheep count
                                                if (count($counts) > 1) {
                                                    $sheep_values = array_column($counts, 'sheep');
                                                    $sheep_regression = linearRegression(array_keys($counts), $sheep_values);
                                                    $predicted_sheep = $sheep_regression['slope'] * ($max_year + 1) + $sheep_regression['intercept'];
                                                } else {
                                                    throw new Exception("Insufficient data for linear regression on cat count.");
                                                }

                                                // Linear regression for horse count
                                                if (count($counts) > 1) {
                                                    $horse_values = array_column($counts, 'horse');
                                                    $horse_regression = linearRegression(array_keys($counts), $horse_values);
                                                    $predicted_horse = $horse_regression['slope'] * ($max_year + 1) + $horse_regression['intercept'];
                                                } else {
                                                    throw new Exception("Insufficient data for linear regression on cat count.");
                                                }

                                                // Linear regression for dog count
                                                if (count($counts) > 1) {
                                                    $dog_values = array_column($counts, 'dog');
                                                    $dog_regression = linearRegression(array_keys($counts), $dog_values);
                                                    $predicted_dog = $dog_regression['slope'] * ($max_year + 1) + $dog_regression['intercept'];
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
                                                    <?php echo isset($predicted_carabao) ? number_format($predicted_carabao, 0, '.', ',') : "N/A"; ?>
                                                </td>
                                                <td>
                                                    <?php echo isset($predicted_cattle) ? number_format($predicted_cattle, 0, '.', ',') : "N/A"; ?>
                                                </td>

                                                <td>
                                                    <?php echo isset($predicted_swine) ? number_format($predicted_swine, 0, '.', ',') : "N/A"; ?>
                                                </td>
                                                <td>
                                                    <?php echo isset($predicted_goat) ? number_format($predicted_goat, 0, '.', ',') : "N/A"; ?>
                                                </td>

                                                <td>
                                                    <?php echo isset($predicted_sheep) ? number_format($predicted_sheep, 0, '.', ',') : "N/A"; ?>
                                                </td>
                                                <td>
                                                    <?php echo isset($predicted_horse) ? number_format($predicted_horse, 0, '.', ',') : "N/A"; ?>
                                                </td>

                                                <td>
                                                    <?php echo isset($predicted_dog) ? number_format($predicted_dog, 0, '.', ',') : "N/A"; ?>
                                                </td>
                                                <td>
                                                    <?php echo (isset($predicted_carabao) && isset($predicted_cattle) && isset($predicted_swine)
                                                        && isset($predicted_goat) && isset($predicted_sheep) && isset($predicted_horse) && isset($predicted_dog))
                                                        ? number_format($predicted_carabao + $predicted_cattle + $predicted_swine + $predicted_goat +
                                                            $predicted_sheep + $predicted_horse + $predicted_dog, 0, '.', ',') : "N/A"; ?>
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
                <div class="container-fluid mb-5 mt-1">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <canvas class="canvas" id="animalTrend"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/animal-trend-modal.php'; ?>




    <!-- Linear Regression Graph -->
    <script>
        const ctx = document.getElementById('animalTrend');

        const animalData = {
            labels: [<?php echo implode(',', array_keys($counts)); ?>],
            carabao: [<?php echo implode(',', array_column($counts, 'carabao')); ?>],
            cattle: [<?php echo implode(',', array_column($counts, 'cattle')); ?>],
            swine: [<?php echo implode(',', array_column($counts, 'swine')); ?>],
            goat: [<?php echo implode(',', array_column($counts, 'goat')); ?>],
            sheep: [<?php echo implode(',', array_column($counts, 'sheep')); ?>],
            horse: [<?php echo implode(',', array_column($counts, 'horse')); ?>],
            dog: [<?php echo implode(',', array_column($counts, 'dog')); ?>]
        };

        const predictedYear = <?php echo $predicted_year; ?>;
        const carabaoRegressionLine = calculateRegressionLine(animalData.labels, animalData.carabao);
        const cattleRegressionLine = calculateRegressionLine(animalData.labels, animalData.cattle);
        const swineRegressionLine = calculateRegressionLine(animalData.labels, animalData.swine);
        const goatRegressionLine = calculateRegressionLine(animalData.labels, animalData.goat);
        const sheepRegressionLine = calculateRegressionLine(animalData.labels, animalData.sheep);
        const horseRegressionLine = calculateRegressionLine(animalData.labels, animalData.horse);
        const dogRegressionLine = calculateRegressionLine(animalData.labels, animalData.dog);


        // Calculate predicted values for 2023
        const predictedcarabao = carabaoRegressionLine.slope * predictedYear + carabaoRegressionLine.intercept;
        const predictedcattle = cattleRegressionLine.slope * predictedYear + cattleRegressionLine.intercept;
        const predictedswine = swineRegressionLine.slope * predictedYear + swineRegressionLine.intercept;
        const predictedgoat = goatRegressionLine.slope * predictedYear + goatRegressionLine.intercept;
        const predictedsheep = sheepRegressionLine.slope * predictedYear + sheepRegressionLine.intercept;
        const predictedhorse = horseRegressionLine.slope * predictedYear + horseRegressionLine.intercept;
        const predicteddog = dogRegressionLine.slope * predictedYear + dogRegressionLine.intercept;

        const predictedTotal = predictedcarabao + predictedcattle + predictedswine + predictedgoat + predictedsheep
            + predictedhorse + predicteddog;

        // Add the predicted data for 2023
        animalData.labels.push(predictedYear.toString());
        animalData.carabao.push(predictedcarabao);
        animalData.cattle.push(predictedcattle);
        animalData.swine.push(predictedswine);
        animalData.goat.push(predictedgoat);
        animalData.sheep.push(predictedsheep);
        animalData.horse.push(predictedhorse);
        animalData.dog.push(predicteddog);


        new Chart(ctx, {
            type: 'line',
            data: {
                labels: animalData.labels,
                datasets: [{
                    label: 'Total Pet Count',
                    data: [/* ... */],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    borderWidth: 4,
                    borderDash: [10, 10],
                },
                {
                    label: 'Carabao',
                    data: animalData.carabao,
                    fill: false,
                    borderColor: 'rgb(255, 0, 0)', // Red
                    tension: 0.1
                },
                {
                    label: 'Cattle',
                    data: animalData.cattle,
                    fill: false,
                    borderColor: 'rgb(0, 255, 0)', // Green
                    tension: 0.1
                },
                {
                    label: 'Swine',
                    data: animalData.swine,
                    fill: false,
                    borderColor: 'rgb(0, 0, 255)', // Blue
                    tension: 0.1
                },
                {
                    label: 'Goat',
                    data: animalData.goat,
                    fill: false,
                    borderColor: 'rgb(255, 255, 0)', // Yellow
                    tension: 0.1
                },
                {
                    label: 'Sheep',
                    data: animalData.sheep,
                    fill: false,
                    borderColor: 'rgb(255, 165, 0)', // Orange
                    tension: 0.1
                },
                {
                    label: 'Horse',
                    data: animalData.horse,
                    fill: false,
                    borderColor: 'rgb(128, 0, 128)', // Purple
                    tension: 0.1
                },
                {
                    label: 'Dog',
                    data: animalData.dog,
                    fill: false,
                    borderColor: 'rgb(0, 128, 128)', // Teal
                    tension: 0.1
                }
                ]
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
                        }
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


    <script>
        var dataTable = new DataTable('#main-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [10, 11], orderable: false },
                { "className": "dt-center", "targets": "_all" } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
            columns: [
                { "width": "8.33%" },
                { "width": "8.33%" },
                { "width": "8.33%" },
                { "width": "8.33%" },
                { "width": "8.33%" },
                { "width": "8.33%" },
                { "width": "8.33%" },
                { "width": "8.33%" },
                { "width": "8.33%" },
                { "width": "8.33%" },
                { "width": "8.33%" }],
            autoWidth: false,
            search: true,
            // info: false,
            paging: false,
            order: [[0, 'desc']],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
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

        var dataTable = new DataTable('#predicted-table', {
            lengthChange: false,
            columns: [
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" }

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
                url: '/benguetlivestock/backend/animal-trend-code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/animal-trend.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }
    </script>




    <script src="/benguetlivestock/assets/js/content-js/animal-trend-script.js"></script>

    <!-- Save State of Page Script -->
    <script src="/benguetlivestock/assets/js/save-state.js"></script>
    <!-- Sidebar Responsive Script -->
    <script src="/benguetlivestock/assets/js/sidebar.js"></script>
    <!-- Dropdown Script -->
    <script src="/benguetlivestock/assets/js/dropdown.js"></script>
</body>

</html>