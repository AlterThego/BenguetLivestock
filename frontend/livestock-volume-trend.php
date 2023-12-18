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
    <link rel="stylesheet" href="/benguetlivestock/assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/benguetlivestock/assets/css/buttons.dataTables.min.css">

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


    <title>Livestock Volume Trend</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/livestock-volume-trend-sidebar.php';
        ?>

        <!-- Main Component -->
        <div class="main" id="main-component">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <!-- Button for sidebar toggle -->
                <button class="btn" type="button">
                    <img src="../assets/images/sidebar-toggle.png" style="width: 20px; height: 20px;" />
                </button>
            </nav>
            <main class="content px-3 py-2 mb-5">
                <!-- Main Table -->
                <div class="container-fluid mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <?php
                            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                                ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['status']; ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                                unset($_SESSION['status']);
                            }
                            ?>
                            <div class="card p-3">
                                <div class="card-header mb-3">
                                    <h3 class="text-center font-weight-bold ">Livestock Volume Trend</h3>
                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addModal">
                                        Add data
                                    </button> -->
                                </div>
                                <table class="display table-bordered table-responsive" id="main-volume-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Year</th>
                                            <th scope="col">Cattle</th>
                                            <th scope="col">Swine</th>
                                            <th scope="col">Carabao</th>
                                            <th scope="col">Goat</th>
                                            <th scope="col">Chicken</th>
                                            <th scope="col">Duck</th>
                                            <th scope="col">Fish</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Date Updated</th>
                                            <th scope="col" class="text-center">Update</th>
                                            <th scope="col" class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                        $fetch_query = "SELECT * FROM livestockvolumetrend;";

                                        $fetch_query_run = mysqli_query($connection, $fetch_query);

                                        $totalCattleVolume = $totalSwineVolume = $totalCarabaoVolume = $totalGoatVolume = $totalChickenVolume = $totalDuckVolume = $totalFishVolume = 0;

                                        if (mysqli_num_rows($fetch_query_run) > 0) {

                                            while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                $totalCattleVolume += $row['cattle_volume'];
                                                $totalSwineVolume += $row['swine_volume'];
                                                $totalCarabaoVolume += $row['carabao_volume'];
                                                $totalGoatVolume += $row['goat_volume'];
                                                $totalChickenVolume += $row['chicken_volume'];
                                                $totalDuckVolume += $row['duck_volume'];
                                                $totalFishVolume += $row['fish_volume'];
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['year']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['cattle_volume'], 0, '.', ','); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['swine_volume'], 0, '.', ','); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['carabao_volume'], 0, '.', ','); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['goat_volume'], 0, '.', ','); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['chicken_volume'], 0, '.', ','); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['duck_volume'], 0, '.', ','); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['fish_volume'], 0, '.', ','); ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $total = $row['cattle_volume'] + $row['swine_volume'] + $row['carabao_volume'] + $row['goat_volume']
                                                            + $row['chicken_volume'] + $row['duck_volume'] + $row['fish_volume'];
                                                        echo number_format($total, 0, '.', ',');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['date_updated']; ?>
                                                    </td>

                                                    <td class="text-center">
                                                        <button class="btn btn-update btn-success btn-sm" data-toggle="modal"
                                                            data-target="#updateModal" data-year="<?php echo $row['year'] ?>"
                                                            data-cattle="<?php echo $row['cattle_volume']; ?>"
                                                            data-swine="<?php echo $row['swine_volume']; ?>"
                                                            data-carabao="<?php echo $row['carabao_volume']; ?>"
                                                            data-goat="<?php echo $row['goat_volume']; ?>"
                                                            data-chicken="<?php echo $row['chicken_volume']; ?>"
                                                            data-duck="<?php echo $row['duck_volume']; ?>"
                                                            data-fish="<?php echo $row['fish_volume']; ?>"
                                                            data-date="<?php echo $row['date_updated']; ?>">Update

                                                        </button>

                                                    </td>
                                                    <td class="text-center">
                                                        <form action="/benguetlivestock/backend/livestock-volume-trend-code.php"
                                                            method="post">
                                                            <input type="hidden" name="id" value="<?php echo $row['year']; ?>">
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

                <!-- Prediction -->
                <div class="container-fluid mt-5">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <h4 class="text-center font-weight-bold mb-3">Linear Regression Analysis</h4>
                                <p class="text-left font-weight-italicized mb-3">
                                    <b>Note:</b> This prediction for livestock volume is based on linear regression
                                    analysis. It's important to understand that this is not a guaranteed forecast but
                                    rather an estimate using statistical methods.
                                </p>
                                <table class="display table-bordered table-responsive" id="predicted-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Year</th>
                                            <th scope="col">Possible Cattle Count</th>
                                            <th scope="col">Possible Swine Count</th>
                                            <th scope="col">Possible Carabao Count</th>
                                            <th scope="col">Possible Goat Count</th>
                                            <th scope="col">Possible Chicken Count</th>
                                            <th scope="col">Possible Duck Count</th>
                                            <th scope="col">Possible Fish Count</th>
                                            <th scope="col">Possible Total Livestock Volume</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                        try {
                                            // Analyze trends and predict the next year's counts
                                            $max_year = 0;
                                            $counts = array();

                                            $fetch_query = "SELECT * FROM livestockvolumetrend";
                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            if ($fetch_query_run === false) {
                                                throw new Exception("Error fetching data: " . mysqli_error($connection));
                                            }

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    // Store counts for analysis
                                                    $counts[$row['year']] = array(
                                                        'cattle' => $row['cattle_volume'],
                                                        'swine' => $row['swine_volume'],
                                                        'carabao' => $row['carabao_volume'],
                                                        'goat' => $row['goat_volume'],
                                                        'chicken' => $row['chicken_volume'],
                                                        'duck' => $row['duck_volume'],
                                                        'fish' => $row['fish_volume'],
                                                    );

                                                    // Find the maximum year
                                                    $max_year = max($max_year, $row['year']);

                                                }
                                            } else {
                                                throw new Exception("Insufficient data for analysis.");
                                            }

                                            // Linear regression for cattle count
                                            if (count($counts) > 1) {
                                                $cattle_values = array_column($counts, 'cattle');
                                                $cattle_regression = linearRegression(array_keys($counts), $cattle_values);
                                                $predicted_cattle = $cattle_regression['slope'] * ($max_year + 1) + $cattle_regression['intercept'];
                                            } else {
                                                throw new Exception("Insufficient data for linear regression on dog analysis.");
                                            }

                                            // Linear regression for swine count
                                            if (count($counts) > 1) {
                                                $swine_values = array_column($counts, 'swine');
                                                $swine_regression = linearRegression(array_keys($counts), $swine_values);
                                                $predicted_swine = $swine_regression['slope'] * ($max_year + 1) + $swine_regression['intercept'];
                                            } else {
                                                throw new Exception("Insufficient data for linear regression on cat count.");
                                            }

                                            // Linear regression for carabao count
                                            if (count($counts) > 1) {
                                                $carabao_values = array_column($counts, 'carabao');
                                                $carabao_regression = linearRegression(array_keys($counts), $carabao_values);
                                                $predicted_carabao = $carabao_regression['slope'] * ($max_year + 1) + $carabao_regression['intercept'];
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

                                            // Linear regression for chicken count
                                            if (count($counts) > 1) {
                                                $chicken_values = array_column($counts, 'chicken');
                                                $chicken_regression = linearRegression(array_keys($counts), $chicken_values);
                                                $predicted_chicken = $chicken_regression['slope'] * ($max_year + 1) + $chicken_regression['intercept'];
                                            } else {
                                                throw new Exception("Insufficient data for linear regression on cat count.");
                                            }

                                            // Linear regression for duck count
                                            if (count($counts) > 1) {
                                                $duck_values = array_column($counts, 'duck');
                                                $duck_regression = linearRegression(array_keys($counts), $duck_values);
                                                $predicted_duck = $duck_regression['slope'] * ($max_year + 1) + $duck_regression['intercept'];
                                            } else {
                                                throw new Exception("Insufficient data for linear regression on cat count.");
                                            }

                                            // Linear regression for fish count
                                            if (count($counts) > 1) {
                                                $fish_values = array_column($counts, 'fish');
                                                $fish_regression = linearRegression(array_keys($counts), $fish_values);
                                                $predicted_fish = $fish_regression['slope'] * ($max_year + 1) + $fish_regression['intercept'];
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
                                                <?php echo isset($predicted_cattle) ? number_format($predicted_cattle, 0, '.', ',') : "N/A"; ?>
                                            </td>
                                            <td>
                                                <?php echo isset($predicted_swine) ? number_format($predicted_swine, 0, '.', ',') : "N/A"; ?>
                                            </td>

                                            <td>
                                                <?php echo isset($predicted_carabao) ? number_format($predicted_carabao, 0, '.', ',') : "N/A"; ?>
                                            </td>
                                            <td>
                                                <?php echo isset($predicted_goat) ? number_format($predicted_goat, 0, '.', ',') : "N/A"; ?>
                                            </td>

                                            <td>
                                                <?php echo isset($predicted_chicken) ? number_format($predicted_chicken, 0, '.', ',') : "N/A"; ?>
                                            </td>
                                            <td>
                                                <?php echo isset($predicted_duck) ? number_format($predicted_duck, 0, '.', ',') : "N/A"; ?>
                                            </td>

                                            <td>
                                                <?php echo isset($predicted_fish) ? number_format($predicted_fish, 0, '.', ',') : "N/A"; ?>
                                            </td>
                                            <td>
                                                <?php echo (isset($predicted_cattle) && isset($predicted_swine) && isset($predicted_carabao)
                                                    && isset($predicted_goat) && isset($predicted_chicken) && isset($predicted_duck) && isset($predicted_fish))
                                                    ? number_format($predicted_cattle + $predicted_swine + $predicted_carabao + $predicted_goat +
                                                        $predicted_chicken + $predicted_duck + $predicted_fish, 0, '.', ',') : "N/A"; ?>
                                            </td>
                                        </tr>
                                    </tbody>


                                </table>


                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visual Representation -->
                <div class="container-fluid mb-5 mt-1">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <canvas class="canvas" id="livestockVolumeTrend"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/livestock-volume-trend-modal.php'; ?>


    <!-- Linear Regression Graph -->
    <script>
        const ctx = document.getElementById('livestockVolumeTrend');

        const livestockVolumeData = {
            labels: [<?php echo implode(',', array_keys($counts)); ?>],
            cattle: [<?php echo implode(',', array_column($counts, 'cattle')); ?>],
            swine: [<?php echo implode(',', array_column($counts, 'swine')); ?>],
            carabao: [<?php echo implode(',', array_column($counts, 'carabao')); ?>],
            goat: [<?php echo implode(',', array_column($counts, 'goat')); ?>],
            chicken: [<?php echo implode(',', array_column($counts, 'chicken')); ?>],
            duck: [<?php echo implode(',', array_column($counts, 'duck')); ?>],
            fish: [<?php echo implode(',', array_column($counts, 'fish')); ?>]
        };

        const predictedYear = <?php echo $predicted_year; ?>;
        const cattleRegressionLine = calculateRegressionLine(livestockVolumeData.labels, livestockVolumeData.cattle);
        const swineRegressionLine = calculateRegressionLine(livestockVolumeData.labels, livestockVolumeData.swine);
        const carabaoRegressionLine = calculateRegressionLine(livestockVolumeData.labels, livestockVolumeData.carabao);
        const goatRegressionLine = calculateRegressionLine(livestockVolumeData.labels, livestockVolumeData.goat);
        const chickenRegressionLine = calculateRegressionLine(livestockVolumeData.labels, livestockVolumeData.chicken);
        const duckRegressionLine = calculateRegressionLine(livestockVolumeData.labels, livestockVolumeData.duck);
        const fishRegressionLine = calculateRegressionLine(livestockVolumeData.labels, livestockVolumeData.fish);


        // Calculate predicted values for 2023
        const predictedcattle = cattleRegressionLine.slope * predictedYear + cattleRegressionLine.intercept;
        const predictedswine = swineRegressionLine.slope * predictedYear + swineRegressionLine.intercept;
        const predictedcarabao = carabaoRegressionLine.slope * predictedYear + carabaoRegressionLine.intercept;
        const predictedgoat = goatRegressionLine.slope * predictedYear + goatRegressionLine.intercept;
        const predictedchicken = chickenRegressionLine.slope * predictedYear + chickenRegressionLine.intercept;
        const predictedduck = duckRegressionLine.slope * predictedYear + duckRegressionLine.intercept;
        const predictedfish = fishRegressionLine.slope * predictedYear + fishRegressionLine.intercept;

        const predictedTotal = predictedcattle + predictedswine + predictedcarabao + predictedgoat + predictedchicken
            + predictedduck + predictedfish;

        // Add the predicted data for 2023
        livestockVolumeData.labels.push(predictedYear.toString());
        livestockVolumeData.cattle.push(predictedcattle);
        livestockVolumeData.swine.push(predictedswine);
        livestockVolumeData.carabao.push(predictedcarabao);
        livestockVolumeData.goat.push(predictedgoat);
        livestockVolumeData.chicken.push(predictedchicken);
        livestockVolumeData.duck.push(predictedduck);
        livestockVolumeData.fish.push(predictedfish);


        new Chart(ctx, {
            type: 'line',
            data: {
                labels: livestockVolumeData.labels,
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
                    label: 'Cattle',
                    data: livestockVolumeData.cattle,
                    fill: false,
                    borderColor: 'rgb(255, 0, 0)', // Red
                    tension: 0.1
                },
                {
                    label: 'Swine',
                    data: livestockVolumeData.swine,
                    fill: false,
                    borderColor: 'rgb(0, 255, 0)', // Green
                    tension: 0.1
                },
                {
                    label: 'Carabao',
                    data: livestockVolumeData.carabao,
                    fill: false,
                    borderColor: 'rgb(0, 0, 255)', // Blue
                    tension: 0.1
                },
                {
                    label: 'Goat',
                    data: livestockVolumeData.goat,
                    fill: false,
                    borderColor: 'rgb(255, 255, 0)', // Yellow
                    tension: 0.1
                },
                {
                    label: 'Chicken',
                    data: livestockVolumeData.chicken,
                    fill: false,
                    borderColor: 'rgb(255, 165, 0)', // Orange
                    tension: 0.1
                },
                {
                    label: 'Duck',
                    data: livestockVolumeData.duck,
                    fill: false,
                    borderColor: 'rgb(128, 0, 128)', // Purple
                    tension: 0.1
                },
                {
                    label: 'Fish',
                    data: livestockVolumeData.fish,
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
        var dataTable = new DataTable('#main-volume-table', {
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
                { "width": "8.33%" },
                { "width": "8.33%" }],
            autoWidth: false,
            search: true,
            paging: false,
            order: [[0, 'desc']],
            dom: 'Bfrtip',
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
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.btn-delete').click(function () {
                var id = $(this).closest('form').find('input[name="id"]').val();
                $('#confirmDelete').data('id', id);
                $('#confirmDelete').on('hidden.bs.modal', function () {
                    $('.modal-backdrop').remove();
                });
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
                url: '/benguetlivestock/backend/livestock-volume-trend-code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/livestock-volume-trend.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }
    </script>



    <script src="/benguetlivestock/assets/js/content-js/livestock-volume-trend-script.js"></script>
</body>

</html>