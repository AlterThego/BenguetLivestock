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

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/livestock-volume-modal.php'; ?>


    <title>Livestock Volume</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/livestock-volume-sidebar.php';
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
                                    <h3 class="text-center font-weight-bold ">Volume of Livestock</h3>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addModal">
                                        Add data
                                    </button>
                                </div>
                                <table class="display table-bordered table-responsive" id="main-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ZIP Code</th>
                                            <th scope="col">Municipality</th>
                                            <th scope="col">Cattle</th>
                                            <th scope="col">Swine</th>
                                            <th scope="col">Carabao</th>
                                            <th scope="col">Goat</th>
                                            <th scope="col">Chicken</th>
                                            <th scope="col">Duck</th>
                                            <th scope="col">Fish</th>
                                            <th scope="col">Date Updated</th>
                                            <th scope="col" class="text-center">Update</th>
                                            <th scope="col" class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                        $fetch_query = "SELECT * FROM livestockvolume;";

                                        $fetch_query_run = mysqli_query($connection, $fetch_query);

                                        $totalCattleVolume = $totalSwineVolume = $totalCarabaoVolume = $totalGoatVolume = $totalChickenVolume = $totalDuckVolume = $totalFishVolume = 0;

                                        $labels = [];
                                        $cattleData = [];
                                        $swineData = [];
                                        $carabaoData = [];
                                        $goatData = [];
                                        $chickenData = [];
                                        $duckData = [];
                                        $fishData = [];


                                        if (mysqli_num_rows($fetch_query_run) > 0) {

                                            while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                $totalCattleVolume += $row['cattle_volume'];
                                                $totalSwineVolume += $row['swine_volume'];
                                                $totalCarabaoVolume += $row['carabao_volume'];
                                                $totalGoatVolume += $row['goat_volume'];
                                                $totalChickenVolume += $row['chicken_volume'];
                                                $totalDuckVolume += $row['duck_volume'];
                                                $totalFishVolume += $row['fish_volume'];

                                                $labels[] = $row['municipality_name'];
                                                $cattleData[] = $row['cattle_volume'];
                                                $swineData[] = $row['swine_volume'];
                                                $carabaoData[] = $row['carabao_volume'];
                                                $goatData[] = $row['goat_volume'];
                                                $chickenData[] = $row['chicken_volume'];
                                                $duckData[] = $row['duck_volume'];
                                                $fishData[] = $row['fish_volume'];

                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['municipality_id']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['municipality_name']; ?>
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
                                                        <?php echo $row['date_updated']; ?>
                                                    </td>

                                                    <td class="text-center">
                                                        <button class="btn btn-update btn-success btn-sm" data-toggle="modal"
                                                            data-target="#updateModal"
                                                            data-zip="<?php echo $row['municipality_id'] ?>"
                                                            data-name="<?php echo $row['municipality_name'] ?>"
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
                                                        <form action="../backend/livestock-volume-code.php" method="post">
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
                                        <td></td> <!-- You may leave the Municipality cell empty for the total row -->
                                        <td>
                                            <?php echo number_format($totalCattleVolume, 0, '.', ','); ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($totalSwineVolume, 0, '.', ','); ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($totalCarabaoVolume, 0, '.', ','); ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($totalGoatVolume, 0, '.', ','); ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($totalChickenVolume, 0, '.', ','); ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($totalDuckVolume, 0, '.', ','); ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($totalFishVolume, 0, '.', ','); ?>
                                        </td><!-- You may leave the Date Updated cell empty for the total row -->
                                        <td colspan="3"></td>
                                        <!-- You may leave the Update and Delete cells empty for the total row -->
                                    </tr>



                                </table>

                                <div class="right">
                                    <button class="btn btn-info float-right" onclick="submitTotalVolumeModal()"
                                        data-toggle="modal" data-target="#submitTotalVolumeModal">Submit Total Count
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visual Representation -->
                <div class="container-fluid mt-5">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <canvas class="canvas" id="livestockVolumeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('livestockVolumeChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Cattle',
                    data: <?php echo json_encode($cattleData); ?>,
                    backgroundColor: 'rgba(65, 105, 225, 0.5)', // Royal Blue
                    borderColor: 'rgba(65, 105, 225, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Swine',
                    data: <?php echo json_encode($swineData); ?>,
                    backgroundColor: 'rgba(255, 165, 0, 0.5)', // Orange
                    borderColor: 'rgba(255, 165, 0, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Carabao',
                    data: <?php echo json_encode($carabaoData); ?>,
                    backgroundColor: 'rgba(255, 99, 71, 0.5)', // Tomato
                    borderColor: 'rgba(255, 99, 71, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Goat',
                    data: <?php echo json_encode($goatData); ?>,
                    backgroundColor: 'rgba(50, 205, 50, 0.5)', // Lime Green
                    borderColor: 'rgba(50, 205, 50, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Chicken',
                    data: <?php echo json_encode($chickenData); ?>,
                    backgroundColor: 'rgba(218, 112, 214, 0.5)', // Orchid
                    borderColor: 'rgba(218, 112, 214, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Duck',
                    data: <?php echo json_encode($duckData); ?>,
                    backgroundColor: 'rgba(255, 215, 0, 0.5)', // Gold
                    borderColor: 'rgba(255, 215, 0, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Fish',
                    data: <?php echo json_encode($fishData); ?>,
                    backgroundColor: 'rgba(173, 216, 230, 0.5)', // Light Blue
                    borderColor: 'rgba(173, 216, 230, 1)',
                    borderWidth: 1
                }]
            },
            options: {
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
        var ctx = document.getElementById('livestockVolumeChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Carabao',
                    data: <?php echo json_encode($dogData); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Cattle',
                    data: <?php echo json_encode($cattleData); ?>,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)', // Different color
                    borderColor: 'rgba(255, 206, 86, 1)',      // Different color
                    borderWidth: 1
                },
                {
                    label: 'Swine',
                    data: <?php echo json_encode($swineData); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Different color
                    borderColor: 'rgba(255, 99, 132, 1)',      // Different color
                    borderWidth: 1
                },
                {
                    label: 'Goat',
                    data: <?php echo json_encode($goatData); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Different color
                    borderColor: 'rgba(54, 162, 235, 1)',      // Different color
                    borderWidth: 1
                },
                {
                    label: 'Sheep',
                    data: <?php echo json_encode($sheepData); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)', // Different color
                    borderColor: 'rgba(153, 102, 255, 1)',      // Different color
                    borderWidth: 1
                },
                {
                    label: 'Horse',
                    data: <?php echo json_encode($horseData); ?>,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)', // Different color
                    borderColor: 'rgba(255, 159, 64, 1)',      // Different color
                    borderWidth: 1
                },
                {
                    label: 'Dog',
                    data: <?php echo json_encode($dogData); ?>,
                    backgroundColor: 'rgba(255, 0, 0, 0.2)',    // Different color
                    borderColor: 'rgba(255, 0, 0, 1)',         // Different color
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


    <script>
        var totalCattleVolume = <?php echo $totalCattleVolume; ?>;
        var totalSwineVolume = <?php echo $totalSwineVolume; ?>;
        var totalCarabaoVolume = <?php echo $totalCarabaoVolume; ?>;
        var totalGoatVolume = <?php echo $totalGoatVolume; ?>;
        var totalChickenVolume = <?php echo $totalChickenVolume; ?>;
        var totalDuckVolume = <?php echo $totalDuckVolume; ?>;
        var totalFishVolume = <?php echo $totalFishVolume; ?>;
    </script>

    <script>
        // Function to calculate and update totals in the modal
        function submitTotalVolumeModal() {
            <?php
            // Assuming these variables are already defined in your PHP code
            echo "var totalCattleVolume = $totalCattleVolume;\n";
            echo "var totalSwineVolume = $totalSwineVolume;\n";
            echo "var totalCarabaoVolume = $totalCarabaoVolume;\n";
            echo "var totalGoatVolume = $totalGoatVolume;\n";
            echo "var totalChickenVolume = $totalChickenVolume;\n";
            echo "var totalDuckVolume = $totalDuckVolume;\n";
            echo "var totalFishVolume = $totalFishVolume;\n";
            ?>

            // Update the modal content
            document.getElementById('totalVolumeTableBody').innerHTML = `
    <tr>
        <td>Cattle</td>
        <td>${totalCattleVolume}</td>
    </tr>
    <tr>
        <td>Swine</td>
        <td>${totalSwineVolume}</td>
    </tr>
    <tr>
        <td>Carabao</td>
        <td>${totalCarabaoVolume}</td>
    </tr>
    <tr>
        <td>Goat</td>
        <td>${totalGoatVolume}</td>
    </tr>
    <tr>
        <td>Chicken</td>
        <td>${totalChickenVolume}</td>
    </tr>
    <tr>
        <td>Duck</td>
        <td>${totalDuckVolume}</td>
    </tr>
    <tr>
        <td>Fish</td>
        <td>${totalFishVolume}</td>
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
                url: '../backend/livestock-volume-code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/livestock-volume.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }
    </script>


    <script src="/benguetlivestock/assets/js/content-js/livestock-volume-script.js"></script>
</body>

</html>