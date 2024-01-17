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

    <title>Pet Population</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/pets-population-sidebar.php';
        ?>
        <!-- Main Component -->
        <div class="main" id="main-component">
            <main class="content py-2 mb-5">
                <?php
                $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                $fetch_query = "SELECT * FROM petspopulation;";

                $fetch_query_run = mysqli_query($connection, $fetch_query);

                $totalCat = $totalDog = 0;

                if (mysqli_num_rows($fetch_query_run) > 0) {
                    while ($row = mysqli_fetch_array($fetch_query_run)) {
                        $totalDog += $row['dog_count'];
                        $totalCat += $row['cat_count'];
                    }
                }
                ?>

                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card p-2" style="align-items: center;">
                                <h5 class="text-left font-weight-bold">Dogs: </h5>
                                <?php echo number_format($totalDog, 0, '.', ','); ?>
                            </div>
                            <div class="card" style="height: 150px; width: 100%; align-items: center;">
                                <canvas id="dogChart" class="p-2"></canvas>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-2" style="align-items: center;">
                                <h5 class="text-left font-weight-bold">Cats: </h5>
                                <?php echo number_format($totalCat, 0, '.', ','); ?>
                            </div>
                            <div class="card" style="height: 150px; width: 100%; align-items: center;">
                                <canvas id="catChart" class="p-2"></canvas>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-2" style="align-items: center; color: #FF0000; ">
                                <h5 class="text-left font-weight-bold">Total Pets: </h5>
                                <?php echo number_format($totalCat + $totalDog, 0, '.', ','); ?>
                            </div>
                            <div class="card" style="height: 150px; width: 100%; align-items: center;">
                                <canvas id="totalChart" class="p-2"></canvas>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                            // Get the maximum year
                            $max_year_query = "SELECT MAX(pet_year) AS max_year FROM pettrend;";
                            $max_year_result = mysqli_query($connection, $max_year_query);

                            if ($max_year_result) {
                                $max_year_row = mysqli_fetch_assoc($max_year_result);
                                $max_year = $max_year_row['max_year'];

                                // Fetch data for the maximum year
                                $fetch_query = "SELECT pet_year, dog_count, cat_count FROM pettrend WHERE pet_year = $max_year;";
                                $fetch_query_run = mysqli_query($connection, $fetch_query);

                                if ($fetch_query_run) {
                                    $data = mysqli_fetch_assoc($fetch_query_run);

                                    // Access the values
                                    $recent_year = $data['pet_year'];
                                    $dog_count = $data['dog_count'];
                                    $cat_count = $data['cat_count'];

                                    // Now you can use $recent_year, $dog_count, and $cat_count as needed
                                } else {
                                    echo "Error fetching data: " . mysqli_error($connection);
                                }
                            } else {
                                echo "Error fetching max year: " . mysqli_error($connection);
                            }
                            ?>
                            <div class="card p-2" style="align-items: center; color: #008000;">
                                <h5 class="text-left font-weight-bold">Recent Year: </h5>
                                <?php echo ($recent_year); ?>
                            </div>
                            <div class="card" style="height: 150px; width: 100%; align-items: center;">
                                <canvas id="petTrend" class="p-1"></canvas>
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
                                        <h5 class="text-left font-weight-bold">Pet Population</h5>
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
                                                <th scope="col">Dog</th>
                                                <th scope="col">Cat</th>
                                                <th scope="col">Date Updated</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM petspopulation;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            $labels = [];
                                            $dogData = [];
                                            $catData = [];

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    $labels[] = $row['municipality_name'];
                                                    $dogData[] = $row['dog_count'];
                                                    $catData[] = $row['cat_count'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['municipality_id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['municipality_name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['dog_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['cat_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <button class="btn btn-update btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModal"
                                                                data-zip="<?php echo $row['municipality_id'] ?>"
                                                                data-name="<?php echo $row['municipality_name'] ?>"
                                                                data-dog="<?php echo $row['dog_count']; ?>"
                                                                data-cat="<?php echo $row['cat_count']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">* Update

                                                            </button>

                                                        </td>
                                                        <td class="text-center">
                                                            <form action="../backend/pets-population-code.php" method="post">
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
                                            <td>
                                                <?php echo number_format($totalDog, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalCat, 0, '.', ','); ?>
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

                <!-- Visual Representation -->
                <div class="container-fluid mt-1">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <canvas class="canvas" id="populationChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/pets-population-modal.php'; ?>


    <!-- Primary Chart -->
    <script>
        var ctx = document.getElementById('populationChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Dog Population',
                    data: <?php echo json_encode($dogData); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 1)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Cat Population',
                    data: <?php echo json_encode($catData); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 1)',
                    borderColor: 'rgba(255, 99, 132, 1)',
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

    <!-- Table settings js -->
    <script src="/benguetlivestock/assets/js/table-js/pets-population-table.js"></script>


    <!-- Delete Script -->
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
                url: '/benguetlivestock/backend/pets-population-code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/pets-population.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }
    </script>


    <!-- <script>
        var totalDog = <?php echo $totalDog; ?>;
        var totalCat = <?php echo $totalCat; ?>;
    </script> -->


    <!-- Submit Summary -->
    <script>
        // Function to calculate and update totals in the modal
        function submitTotalModal() {
            <?php
            // Assuming these variables are already defined in your PHP code
            echo "var totalDog = $totalDog;\n";
            echo "var totalCat = $totalCat;\n";
            ?>

            // Update the modal content
            document.getElementById('totalTableBody').innerHTML = `
    <tr>
        <td>Dog</td>
        <td>${totalDog}</td>
    </tr>
    <tr>
        <td>Cat</td>
        <td>${totalCat}</td>
    </tr>
        `;
        }
    </script>

    <!-- Placeholder script -->
    <script src="/benguetlivestock/assets/js/content-js/pets-population-script.js"></script>

    <!-- Chart.js -->
    <script>
        var dogPercentage = <?php echo ($totalDog / ($totalCat + $totalDog)) * 100; ?>;
        var catPercentage = <?php echo ($totalCat / ($totalCat + $totalDog)) * 100; ?>;
    </script>

    <script>
        var recentYear = <?php echo json_encode($recent_year); ?>;
        var dogCount = <?php echo json_encode($dog_count); ?>;
        var catCount = <?php echo json_encode($cat_count); ?>;
    </script>
    <script src="/benguetlivestock/assets/js/chart.js/pets-population-chart.js"></script>
    <!-- Close -->


    <!-- Save State of Page Script -->
    <script src="/benguetlivestock/assets/js/save-state.js"></script>
    <!-- Sidebar Responsive Script -->
    <script src="/benguetlivestock/assets/js/sidebar.js"></script>
    <!-- Dropdown Script -->
    <script src="/benguetlivestock/assets/js/dropdown.js"></script>

</body>

</html>