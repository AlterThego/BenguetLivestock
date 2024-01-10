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

    <title>Animals Affected with Diseases</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/affected-animals-sidebar.php';
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
                                    <h3 class="text-center font-weight-bold mb-5">Number of Animals Affected with
                                        Disease</h3>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addModal">
                                        Add data
                                    </button>
                                </div>

                                <div class="table-responsive">
                                    <table class="display table-bordered" id="main-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">ZIP Code</th>
                                                <th scope="col">Municipality</th>
                                                <th scope="col">Chicken</th>
                                                <th scope="col">Duck</th>
                                                <th scope="col">Cattle</th>
                                                <th scope="col">Swine</th>
                                                <th scope="col">Carabao</th>
                                                <th scope="col">Goat</th>
                                                <th scope="col">Horse</th>
                                                <th scope="col">Dog</th>
                                                <th scope="col">Sheep</th>
                                                <th scope="col">Date Updated</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM affectedanimals;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);


                                            $totalChicken = $totalDuck = $totalCattle = $totalSwine = $totalCarabao = $totalGoat =
                                                $totalHorse = $totalDog = $totalSheep = 0;

                                            $municipalityData = [];
                                            $chickenData = [];
                                            $duckData = [];
                                            $cattleData = [];
                                            $swineData = [];
                                            $carabaoData = [];
                                            $goatData = [];
                                            $horseData = [];
                                            $dogData = [];
                                            $sheepData = [];

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    $totalChicken += $row['chicken'];
                                                    $totalDuck += $row['duck'];
                                                    $totalCattle += $row['cattle'];
                                                    $totalSwine += $row['swine'];
                                                    $totalCarabao += $row['carabao'];
                                                    $totalGoat += $row['goat'];
                                                    $totalHorse += $row['horse'];
                                                    $totalDog += $row['dog'];
                                                    $totalSheep += $row['sheep'];

                                                    $municipalityData[] = $row['municipality_name'];
                                                    $chickenData[] = $row['chicken'];
                                                    $duckData[] = $row['duck'];
                                                    $cattleData[] = $row['cattle'];
                                                    $swineData[] = $row['swine'];
                                                    $carabaoData[] = $row['carabao'];
                                                    $goatData[] = $row['goat'];
                                                    $horseData[] = $row['horse'];
                                                    $dogData[] = $row['dog'];
                                                    $sheepData[] = $row['sheep'];
                                                    ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?php echo $row['municipality_id']; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $row['municipality_name']; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo number_format($row['chicken'], 0, '.', ','); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo number_format($row['duck'], 0, '.', ','); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo number_format($row['cattle'], 0, '.', ','); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo number_format($row['swine'], 0, '.', ','); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo number_format($row['carabao'], 0, '.', ','); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo number_format($row['goat'], 0, '.', ','); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo number_format($row['horse'], 0, '.', ','); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo number_format($row['dog'], 0, '.', ','); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo number_format($row['sheep'], 0, '.', ','); ?>
                                                        </td>


                                                        <td class="text-center">
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <button class="btn btn-update btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModal"
                                                                data-zip="<?php echo $row['municipality_id'] ?>"
                                                                data-name="<?php echo $row['municipality_name'] ?>"
                                                                data-chicken="<?php echo $row['chicken']; ?>"
                                                                data-duck="<?php echo $row['duck']; ?>"
                                                                data-cattle="<?php echo $row['cattle']; ?>"
                                                                data-swine="<?php echo $row['swine']; ?>"
                                                                data-carabao="<?php echo $row['carabao']; ?>"
                                                                data-goat="<?php echo $row['goat']; ?>"
                                                                data-horse="<?php echo $row['horse']; ?>"
                                                                data-dog="<?php echo $row['dog']; ?>"
                                                                data-sheep="<?php echo $row['sheep']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">Update

                                                            </button>

                                                        </td>
                                                        <td class="text-center">
                                                            <form action="/benguetlivestock/backend/affected-animals-code.php"
                                                                method="post">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $row['municipality_id']; ?>">
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

                                        <tr class="total-row text-center" style="font-weight: bold; color: red;">
                                            <td>Total</td>
                                            <td></td>
                                            <td>
                                                <?php echo number_format($totalChicken, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalDuck, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalCattle, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalSwine, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalCarabao, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalGoat, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalHorse, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalDog, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalSheep, 0, '.', ','); ?>
                                            </td>
                                            <td></td>
                                            <td colspan="2"></td>
                                        </tr>
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

                <!-- Visual Representation of Main Table-->
                <div class="container-fluid mb-5 mt-1">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <canvas class="canvas" id="affectedAnimalsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Yearly Veterinary and Poultry Farm Supplies -->
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
                                    <h3 class="text-center font-weight-bold ">Yearly Affected Animals</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="display table-bordered" id="yearly-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Year</th>

                                                <th scope="col">Chicken</th>
                                                <th scope="col">Duck</th>
                                                <th scope="col">Cattle</th>
                                                <th scope="col">Swine</th>
                                                <th scope="col">Carabao</th>
                                                <th scope="col">Goat</th>
                                                <th scope="col">Horse</th>
                                                <th scope="col">Dog</th>
                                                <th scope="col">Sheep</th>

                                                <th scope="col">Date Added</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM yearlyaffectedanimals;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            $totalYearlyChicken = $totalYearlyDuck = $totalYearlyCattle = $totalYearlySwine =
                                                $totalYearlyCarabao = $totalYearlyGoat = $totalYearlyHorse = $totalYearlyDog =
                                                $totalYearlySheep = 0;

                                            $yearData = [];

                                            $yearlyChickenData = [];
                                            $yearlyDuckData = [];
                                            $yearlyCattleData = [];
                                            $yearlySwineData = [];
                                            $yearlyCarabaoData = [];
                                            $yearlyGoatData = [];
                                            $yearlyHorseData = [];
                                            $yearlyDogData = [];
                                            $yearlySheepData = [];

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    $totalYearlyChicken += $row['chicken'];
                                                    $totalYearlyDuck += $row['duck'];
                                                    $totalYearlyCattle += $row['cattle'];
                                                    $totalYearlySwine += $row['swine'];
                                                    $totalYearlyCarabao += $row['carabao'];
                                                    $totalYearlyGoat += $row['goat'];
                                                    $totalYearlyHorse += $row['horse'];
                                                    $totalYearlyDog += $row['dog'];
                                                    $totalYearlySheep += $row['sheep'];

                                                    $yearData[] = $row['year'];
                                                    $yearlyChickenData[] = $row['chicken'];
                                                    $yearlyDuckData[] = $row['duck'];
                                                    $yearlyCattleData[] = $row['cattle'];
                                                    $yearlySwineData[] = $row['swine'];
                                                    $yearlyCarabaoData[] = $row['carabao'];
                                                    $yearlyGoatData[] = $row['goat'];
                                                    $yearlyHorseData[] = $row['horse'];
                                                    $yearlyDogData[] = $row['dog'];
                                                    $yearlySheepData[] = $row['sheep'];
                                                    ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?php echo $row['year']; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo number_format($row['chicken'], 0, '.', ','); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo number_format($row['duck'], 0, '.', ','); ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <?php echo number_format($row['cattle'], 0, '.', ','); ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <?php echo number_format($row['swine'], 0, '.', ','); ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <?php echo number_format($row['carabao'], 0, '.', ','); ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <?php echo number_format($row['goat'], 0, '.', ','); ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <?php echo number_format($row['horse'], 0, '.', ','); ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <?php echo number_format($row['dog'], 0, '.', ','); ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <?php echo number_format($row['sheep'], 0, '.', ','); ?>
                                                        </td>


                                                        <td class="text-center">
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <button class="btn btn-update-yearly btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModalYearly"
                                                                data-year="<?php echo $row['year'] ?>"
                                                                data-total-chicken="<?php echo $row['chicken']; ?>"
                                                                data-total-duck="<?php echo $row['duck']; ?>"
                                                                data-total-cattle="<?php echo $row['cattle']; ?>"
                                                                data-total-swine="<?php echo $row['swine']; ?>"
                                                                data-total-carabao="<?php echo $row['carabao']; ?>"
                                                                data-total-goat="<?php echo $row['goat']; ?>"
                                                                data-total-horse="<?php echo $row['horse']; ?>"
                                                                data-total-dog="<?php echo $row['dog']; ?>"
                                                                data-total-sheep="<?php echo $row['sheep']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">Update

                                                            </button>

                                                        </td>

                                                        <td class="text-center">
                                                            <form action="/benguetlivestock/backend/affected-animals-code.php"
                                                                method="post">
                                                                <input type="hidden" name="id_yearly"
                                                                    value="<?php echo $row['year']; ?>">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-delete-yearly btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#deleteConfirmationModalYearly">
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

                                        <tr class="total-row text-center" style="font-weight: bold; color: red;">
                                            <td>Total</td>
                                            <td>
                                                <?php echo number_format($totalYearlyChicken, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalYearlyDuck, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalYearlyCattle, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalYearlySwine, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalYearlyCarabao, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalYearlyGoat, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalYearlyHorse, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalYearlyDog, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalYearlySheep, 0, '.', ','); ?>
                                            </td>
                                            <td></td>
                                            <td colspan="2"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visual Representation of Yearly Table-->
                <div class="container-fluid mb-5 mt-1">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <canvas class="canvas" id="yearlyAffectedAnimalsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>




            </main>
        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/affected-animals-modal.php'; ?>

    <script>
        var ctx = document.getElementById('affectedAnimalsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($municipalityData); ?>,
                datasets: [{
                    label: 'Chicken',
                    data: <?php echo json_encode($chickenData); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Duck',
                    data: <?php echo json_encode($duckData); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Cattle',
                    data: <?php echo json_encode($cattleData); ?>,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Swine',
                    data: <?php echo json_encode($swineData); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Carabao',
                    data: <?php echo json_encode($carabaoData); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Goat',
                    data: <?php echo json_encode($goatData); ?>,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Horse',
                    data: <?php echo json_encode($horseData); ?>,
                    backgroundColor: 'rgba(255, 0, 255, 0.2)',
                    borderColor: 'rgba(255, 0, 255, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Dog',
                    data: <?php echo json_encode($dogData); ?>,
                    backgroundColor: 'rgba(0, 255, 0, 0.2)',
                    borderColor: 'rgba(0, 255, 0, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Sheep',
                    data: <?php echo json_encode($sheepData); ?>,
                    backgroundColor: 'rgba(128, 128, 128, 0.2)',
                    borderColor: 'rgba(128, 128, 128, 1)',
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
        var ctx = document.getElementById('yearlyAffectedAnimalsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($yearData); ?>,
                datasets: [{
                    label: 'Affected Chicken Yearly',
                    data: <?php echo json_encode($yearlyChickenData); ?>,
                    backgroundColor: 'rgba(255, 102, 102, 0.2)',
                    borderColor: 'rgba(255, 102, 102, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Affected Duck Yearly',
                    data: <?php echo json_encode($yearlyDuckData); ?>,
                    backgroundColor: 'rgba(102, 178, 255, 0.2)',
                    borderColor: 'rgba(102, 178, 255, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Affected Cattle Yearly',
                    data: <?php echo json_encode($yearlyCattleData); ?>,
                    backgroundColor: 'rgba(255, 230, 128, 0.2)',
                    borderColor: 'rgba(255, 230, 128, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Affected Swine Yearly',
                    data: <?php echo json_encode($yearlySwineData); ?>,
                    backgroundColor: 'rgba(102, 255, 255, 0.2)',
                    borderColor: 'rgba(102, 255, 255, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Affected Carabao Yearly',
                    data: <?php echo json_encode($yearlyCarabaoData); ?>,
                    backgroundColor: 'rgba(204, 153, 255, 0.2)',
                    borderColor: 'rgba(204, 153, 255, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Affected Goat Yearly',
                    data: <?php echo json_encode($yearlyGoatData); ?>,
                    backgroundColor: 'rgba(255, 179, 102, 0.2)',
                    borderColor: 'rgba(255, 179, 102, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Affected Horse Yearly',
                    data: <?php echo json_encode($yearlyHorseData); ?>,
                    backgroundColor: 'rgba(255, 77, 255, 0.2)',
                    borderColor: 'rgba(255, 77, 255, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Affected Dog Yearly',
                    data: <?php echo json_encode($yearlyDogData); ?>,
                    backgroundColor: 'rgba(77, 255, 77, 0.2)',
                    borderColor: 'rgba(77, 255, 77, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Affected Sheep Yearly',
                    data: <?php echo json_encode($yearlySheepData); ?>,
                    backgroundColor: 'rgba(179, 179, 179, 0.2)',
                    borderColor: 'rgba(179, 179, 179, 1)',
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

    <style>
        #maintable {
            align-items: center;
        }
    </style>

    <script>
        var dataTable = new DataTable('#main-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [12, 13], orderable: false },
                { "className": "dt-center", "targets": "_all" }
            ],
            columns: [
                { "width": "7.14%" },
                { "width": "7.14%" },
                { "width": "7.14%" },
                { "width": "7.14%" },
                { "width": "7.14%" },
                { "width": "7.14%" },
                { "width": "7.14%" },
                { "width": "7.14%" },
                { "width": "7.14%" },
                { "width": "7.14%" },
                { "width": "7.14%" },
                { "width": "7.14%" },
                { "width": "7.14%" },
                { "width": "7.14%" },
            ],
            autoWidth: false,
            search: true,
            paging: false,
            dom: 'Bfrtip',
            order: [[1, 'asc']],
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
        var dataTable = new DataTable('#yearly-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [11, 12], orderable: false },
                { "className": "dt-center", "targets": "_all" } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
            columns: [
                { "width": "7.69%" },
                { "width": "7.69%" },
                { "width": "7.69%" },
                { "width": "7.69%" },
                { "width": "7.69%" },
                { "width": "7.69%" },
                { "width": "7.69%" },
                { "width": "7.69%" },
                { "width": "7.69%" },
                { "width": "7.69%" },
                { "width": "7.69%" },
                { "width": "7.69%" },
                { "width": "7.69%" }
            ],
            autoWidth: false,
            search: true,
            // info: false,
            paging: false,
            "drawCallback": function (settings) {
                // Manually set the font size for the DataTable
                $('#yearly-table').css('font-size', '14px'); // Adjust the size as needed
            }
        });
    </script>

    <script>
        var totalChicken = <?php echo $totalChicken; ?>;
        var totalDuck = <?php echo $totalDuck; ?>;
        var totalCattle = <?php echo $totalCattle; ?>;
        var totalSwine = <?php echo $totalSwine; ?>;
        var totalCarabao = <?php echo $totalCarabao; ?>;
        var totalGoat = <?php echo $totalGoat; ?>;
        var totalHorse = <?php echo $totalHorse; ?>;
        var totalDog = <?php echo $totalDog; ?>;
        var totalSheep = <?php echo $totalSheep; ?>;
    </script>

    <script>
        // Function to calculate and update totals in the modal
        function submitTotalModal() {
            <?php
            // Assuming these variables are already defined in your PHP code
            echo "var totalChicken = $totalChicken;\n";
            echo "var totalDuck = $totalDuck;\n";
            echo "var totalCattle = $totalCattle;\n";
            echo "var totalSwine = $totalSwine;\n";
            echo "var totalCarabao = $totalCarabao;\n";
            echo "var totalGoat = $totalGoat;\n";
            echo "var totalHorse = $totalHorse;\n";
            echo "var totalDog = $totalDog;\n";
            echo "var totalSheep = $totalSheep;\n";
            ?>

            // Update the modal content
            document.getElementById('totalTableBody').innerHTML = `
    <tr>
        <td>Total Chicken</td>
        <td>${totalChicken}</td>
    </tr>
    <tr>
        <td>Total Duck</td>
        <td>${totalDuck}</td>
    </tr>
    <tr>
        <td>Total Cattle</td>
        <td>${totalCattle}</td>
    </tr>
    <tr>
        <td>Total Swine</td>
        <td>${totalSwine}</td>
    </tr>
    <tr>
        <td>Total Carabao</td>
        <td>${totalCarabao}</td>
    </tr>
    <tr>
        <td>Total Goat</td>
        <td>${totalGoat}</td>
    </tr>
    <tr>
        <td>Total Horse</td>
        <td>${totalHorse}</td>
    </tr>
    <tr>
        <td>Total Dog</td>
        <td>${totalDog}</td>
    </tr>
    <tr>
        <td>Total Sheep</td>
        <td>${totalSheep}</td>
    </tr>
        `;
        }
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
                url: '/benguetlivestock/backend/affected-animals-code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/affected-animals.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }

    </script>


    <script>
        $(document).ready(function () {
            // Handler for the yearly form
            $('.btn-delete-yearly').click(function () {
                var id = $(this).closest('form').find('input[name="id_yearly"]').val();
                $('#confirmDeleteYearly').data('id', id);
                $('#confirmDeleteYearly').on('hidden.bs.modal', function () {
                    $('.modal-backdrop').remove();
                });
            });

            // Confirm delete handler for the yearly form
            $('#confirmDeleteYearly').click(function () {
                var id = $(this).data('id');
                // Call the function to handle deletion in code.php
                deleteDataYearly(id);
            });
        });

        // Function to handle deletion for the yearly form
        function deleteDataYearly(id) {
            $.ajax({
                type: 'POST',
                url: '/benguetlivestock/backend/affected-animals-code.php',
                data: { deleteDataYearly: true, id_yearly: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/affected-animals.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }

    </script>










    <!-- JS for Update and Delete 'script.js'-->
    <script src="/benguetlivestock/assets/js/content-js/affected-animals-script.js"></script>
</body>

</html>