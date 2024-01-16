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


    <title>Animal Population</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/animal-population-sidebar.php';
        ?>

        <!-- Main Component -->
        <div class="main" id="main-component">
            <main class="content py-2 mb-5">
                <?php
                $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                $fetch_query = "SELECT * FROM animalpopulation;";

                $fetch_query_run = mysqli_query($connection, $fetch_query);

                $totalCarabao = $totalCattle = $totalSwine = $totalGoat = $totalDog = $totalSheep = $totalHorse = 0;

                if (mysqli_num_rows($fetch_query_run) > 0) {
                    while ($row = mysqli_fetch_array($fetch_query_run)) {
                        $totalCarabao += $row['carabao_count'];
                        $totalCattle += $row['cattle_count'];
                        $totalSwine += $row['swine_count'];
                        $totalGoat += $row['goat_count'];
                        $totalSheep += $row['sheep_count'];
                        $totalHorse += $row['horse_count'];
                        $totalDog += $row['dog_count'];
                    }
                }
                ?>

                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <div class="card p-2">
                                        <div class="row">
                                            <div class="col text-left">
                                                <h6>Carabao</h6>
                                            </div>
                                            <div class="col text-right">
                                                <h6>
                                                    <?php echo number_format($totalCarabao, 0, '.', ','); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" style="height: 150px; width: 100%; align-items: center;">
                                        <canvas id="carabaoChart" class="p-1"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card p-2">
                                        <div class="row">
                                            <div class="col text-left">
                                                <h6>Cattle</h6>
                                            </div>
                                            <div class="col text-right">
                                                <h6>
                                                    <?php echo number_format($totalCattle, 0, '.', ','); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" style="height: 150px; width: 100%; align-items: center;">
                                        <canvas id="cattleChart" class="p-1"></canvas>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-2">
                                        <div class="row">
                                            <div class="col text-left">
                                                <h6>Swine</h6>
                                            </div>
                                            <div class="col text-right">
                                                <h6>
                                                    <?php echo number_format($totalSwine, 0, '.', ','); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" style="height: 150px; width: 100%; align-items: center;">
                                        <canvas id="swineChart" class="p-1"></canvas>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-2">
                                        <div class="row">
                                            <div class="col text-left">
                                                <h6>Dog</h6>
                                            </div>
                                            <div class="col text-right">
                                                <h6>
                                                    <?php echo number_format($totalDog, 0, '.', ','); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" style="height: 150px; width: 100%; align-items: center;">
                                        <canvas id="dogChart" class="p-1"></canvas>
                                    </div>
                                </div>


                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <div class="card p-2">
                                        <div class="row">
                                            <div class="col text-left">
                                                <h6>Goat</h6>
                                            </div>
                                            <div class="col text-right">
                                                <h6>
                                                    <?php echo number_format($totalGoat, 0, '.', ','); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" style="height: 150px; width: 100%; align-items: center;">
                                        <canvas id="goatChart" class="p-1"></canvas>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-2">
                                        <div class="row">
                                            <div class="col text-left">
                                                <h6>Sheep</h6>
                                            </div>
                                            <div class="col text-right">
                                                <h6>
                                                    <?php echo number_format($totalSheep, 0, '.', ','); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" style="height: 150px; width: 100%; align-items: center;">
                                        <canvas id="sheepChart" class="p-1"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card p-2">
                                        <div class="row">
                                            <div class="col text-left">
                                                <h6>Horse</h6>
                                            </div>
                                            <div class="col text-right">
                                                <h6>
                                                    <?php echo number_format($totalHorse, 0, '.', ','); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" style="height: 150px; width: 100%; align-items: center;">
                                        <canvas id="horseChart" class="p-1"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-2" style="align-items: center; color: #FF6666; ">
                                <h5 class="text-left font-weight-bold">Overall Animals:
                                    <?php echo number_format($totalCarabao + $totalCattle + $totalSwine + $totalGoat + $totalSheep +
                                        $totalHorse + $totalDog, 0, '.', ','); ?>
                                </h5>

                            </div>
                            <div class="card" style="height: 375px; width: 100%; align-items: center;">
                                <canvas id="overallChart" class="p-2"></canvas>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Title + Add -->
                <div class="container-fluid mt-3">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="text-left font-weight-bold">Animal Population</h5>
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
                                                <th scope="col">ZIP Code</th>
                                                <th scope="col">Municipality</th>
                                                <th scope="col">Carabao</th>
                                                <th scope="col">Cattle</th>
                                                <th scope="col">Swine</th>
                                                <th scope="col">Goat</th>
                                                <th scope="col">Sheep</th>
                                                <th scope="col">Horse</th>
                                                <th scope="col"><i>Dog</i></th>
                                                <th scope="col">Date Updated</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM animalpopulation;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            $labels = [];
                                            $carabaoData = [];
                                            $cattleData = [];
                                            $swineData = [];
                                            $goatData = [];
                                            $sheepData = [];
                                            $horseData = [];
                                            $dogData = [];

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    $labels[] = $row['municipality_name'];
                                                    $carabaoData[] = $row['carabao_count'];
                                                    $cattleData[] = $row['cattle_count'];
                                                    $swineData[] = $row['swine_count'];
                                                    $goatData[] = $row['goat_count'];
                                                    $sheepData[] = $row['sheep_count'];
                                                    $horseData[] = $row['horse_count'];
                                                    $dogData[] = $row['dog_count'];

                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['municipality_id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['municipality_name']; ?>
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
                                                        <td>
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <button class="btn btn-update btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModal"
                                                                data-zip="<?php echo $row['municipality_id'] ?>"
                                                                data-name="<?php echo $row['municipality_name'] ?>"
                                                                data-carabao="<?php echo $row['carabao_count']; ?>"
                                                                data-cattle="<?php echo $row['cattle_count']; ?>"
                                                                data-swine="<?php echo $row['swine_count']; ?>"
                                                                data-goat="<?php echo $row['goat_count']; ?>"
                                                                data-sheep="<?php echo $row['sheep_count']; ?>"
                                                                data-horse="<?php echo $row['horse_count']; ?>"
                                                                data-dog="<?php echo $row['dog_count']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">* Update

                                                            </button>

                                                        </td>
                                                        <td class="text-center">
                                                            <form action="../backend/animal-population-code.php" method="post">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $row['municipality_id']; ?>">
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

                                        <tr class="total-row text-center" style="font-weight: bold; color: red;">
                                            <td>Total</td>
                                            <td></td>
                                            <!-- You may leave the Municipality cell empty for the total row -->
                                            <td>
                                                <?php echo number_format($totalCarabao, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalCattle, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalSwine, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalGoat, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalSheep, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalHorse, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalDog, 0, '.', ','); ?>
                                            </td>

                                            <td></td>
                                            <!-- You may leave the Date Updated cell empty for the total row -->
                                            <td colspan="2"></td>
                                            <!-- You may leave the Update and Delete cells empty for the total row -->
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

                <!-- Visual Representation -->
                <div class="container-fluid mt-1">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <canvas class="canvas" id="animalPopulationChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>


    <!-- Add, Delete, Update Modal -->
    <!-- STRICTLY THIS IS ITS LOCATION -->
    <?php include './modals/animal-population-modal.php'; ?>


    <script>
        var ctx = document.getElementById('animalPopulationChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Carabao',
                    data: <?php echo json_encode($carabaoData); ?>,
                    backgroundColor: 'rgba(65, 105, 225, 0.5)', // Royal Blue
                    borderColor: 'rgba(65, 105, 225, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Cattle',
                    data: <?php echo json_encode($cattleData); ?>,
                    backgroundColor: 'rgba(255, 165, 0, 0.5)', // Orange
                    borderColor: 'rgba(255, 165, 0, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Swine',
                    data: <?php echo json_encode($swineData); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)', // Pink
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Goat',
                    data: <?php echo json_encode($goatData); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)', // Dodger Blue
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Sheep',
                    data: <?php echo json_encode($sheepData); ?>,
                    backgroundColor: 'rgba(218, 112, 214, 0.5)', // Orchid
                    borderColor: 'rgba(218, 112, 214, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Horse',
                    data: <?php echo json_encode($horseData); ?>,
                    backgroundColor: 'rgba(255, 159, 64, 0.5)', // Light Orange
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Dog',
                    data: <?php echo json_encode($dogData); ?>,
                    backgroundColor: 'rgba(255, 0, 0, 0.5)', // Red
                    borderColor: 'rgba(255, 0, 0, 1)',
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
                }
            }
        });
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
                { "width": "8.33%" },
                { "width": "8.33%" }],
            autoWidth: false,
            search: true,
            // info: false,
            paging: false,
            order: [[1, 'asc']],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
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
        var totalCarabao = <?php echo $totalCarabao; ?>;
        var totalCattle = <?php echo $totalCattle; ?>;
        var totalSwine = <?php echo $totalSwine; ?>;
        var totalGoat = <?php echo $totalGoat; ?>;
        var totalDog = <?php echo $totalDog; ?>;
        var totalSheep = <?php echo $totalSheep; ?>;
        var totalHorse = <?php echo $totalHorse; ?>;
    </script>

    <script>
        // Function to calculate and update totals in the modal
        function submitTotalModal() {
            <?php
            // Assuming these variables are already defined in your PHP code
            echo "var totalCarabao = $totalCarabao;\n";
            echo "var totalCattle = $totalCattle;\n";
            echo "var totalSwine = $totalSwine;\n";
            echo "var totalGoat = $totalGoat;\n";
            echo "var totalDog = $totalDog;\n";
            echo "var totalSheep = $totalSheep;\n";
            echo "var totalHorse = $totalHorse;\n";
            ?>

            // Update the modal content
            document.getElementById('totalTableBody').innerHTML = `
    <tr>
        <td>Carabao</td>
        <td>${totalCarabao}</td>
    </tr>
    <tr>
        <td>Cattle</td>
        <td>${totalCattle}</td>
    </tr>
    <tr>
        <td>Swine</td>
        <td>${totalSwine}</td>
    </tr>
    <tr>
        <td>Goat</td>
        <td>${totalGoat}</td>
    </tr>
    <tr>
        <td>Dog</td>
        <td>${totalDog}</td>
    </tr>
    <tr>
        <td>Sheep</td>
        <td>${totalSheep}</td>
    </tr>
    <tr>
        <td>Horse</td>
        <td>${totalHorse}</td>
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
                url: '/benguetlivestock/backend/animal-population-code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/animal-population.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }
    </script>

    <script src="/benguetlivestock/assets/js/content-js/animal-population-script.js"></script>

    <!-- Chart.js -->
    <script>
        var carabaoPercentage = <?php echo ($totalCarabao / ($totalCarabao + $totalCattle + $totalSwine + $totalGoat + $totalSheep + $totalHorse + $totalDog)) * 100; ?>;
        var cattlePercentage = <?php echo ($totalCattle / ($totalCarabao + $totalCattle + $totalSwine + $totalGoat + $totalSheep + $totalHorse + $totalDog)) * 100; ?>;
        var swinePercentage = <?php echo ($totalSwine / ($totalCarabao + $totalCattle + $totalSwine + $totalGoat + $totalSheep + $totalHorse + $totalDog)) * 100; ?>;
        var goatPercentage = <?php echo ($totalGoat / ($totalCarabao + $totalCattle + $totalSwine + $totalGoat + $totalSheep + $totalHorse + $totalDog)) * 100; ?>;
        var sheepPercentage = <?php echo ($totalSheep / ($totalCarabao + $totalCattle + $totalSwine + $totalGoat + $totalSheep + $totalHorse + $totalDog)) * 100; ?>;
        var horsePercentage = <?php echo ($totalHorse / ($totalCarabao + $totalCattle + $totalSwine + $totalGoat + $totalSheep + $totalHorse + $totalDog)) * 100; ?>;
        var dogPercentage = <?php echo ($totalDog / ($totalCarabao + $totalCattle + $totalSwine + $totalGoat + $totalSheep + $totalHorse + $totalDog)) * 100; ?>;
    </script>

    <script>
        var carabaoCount = <?php echo json_encode($carabao_count); ?>;
        var cattleCount = <?php echo json_encode($cattle_count); ?>;
        var swineCount = <?php echo json_encode($swine_count); ?>;
        var goatCount = <?php echo json_encode($goat_count); ?>;
        var sheepCount = <?php echo json_encode($sheep_count); ?>;
        var horseCount = <?php echo json_encode($horse_count); ?>;
        var dogCount = <?php echo json_encode($dog_count); ?>;
    </script>
    <script src="/benguetlivestock/assets/js/chart.js/animal-population-chart.js"></script>
    <!-- Close -->

    <!-- Save State of Page Script -->
    <script src="/benguetlivestock/assets/js/save-state.js"></script>
    <!-- Sidebar Responsive Script -->
    <script src="/benguetlivestock/assets/js/sidebar.js"></script>
    <!-- Dropdown Script -->
    <script src="/benguetlivestock/assets/js/dropdown.js"></script>
</body>

</html>