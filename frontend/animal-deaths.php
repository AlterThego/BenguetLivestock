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


    <title>Animal Deaths due to Disease Infection</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/animal-deaths-sidebar.php';
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
                                    <h3 class="text-center font-weight-bold ">Animal Deaths Due to Disease Infections
                                    </h3>
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
                                                <th scope="col">Number</th>
                                                <th scope="col">Date Updated</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM animaldeaths;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            $labels = [];
                                            $animalDeathsData = [];

                                            $totalAnimalDeaths = 0;

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    $totalAnimalDeaths += $row['deaths'];

                                                    $labels[] = $row['municipality_name'];
                                                    $animalDeathsData[] = $row['deaths'];

                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['municipality_id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['municipality_name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['deaths'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <button class="btn btn-update btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModal"
                                                                data-zip="<?php echo $row['municipality_id'] ?>"
                                                                data-name="<?php echo $row['municipality_name'] ?>"
                                                                data-deaths="<?php echo $row['deaths']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">Update

                                                            </button>

                                                        </td>
                                                        <td class="text-center">
                                                            <form action="../backend/animal-deaths-code.php" method="post">
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
                                                <?php echo number_format($totalAnimalDeaths, 0, '.', ','); ?>
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
                                <canvas class="canvas" id="animalDeathChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Secondary Table -->
                <div class="container-fluid mt-3">
                    <div class="row justify-content-center">
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
                                    <h4 class="text-center font-weight-bold ">Yearly Record of Animal Deaths due to
                                        Disease Infection
                                    </h4>
                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addModal">
                                        Add data
                                    </button> -->

                                </div>
                                <div class="table-responsive">
                                    <table class="display table-bordered" id="yearly-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Year</th>
                                                <th scope="col">Total Deaths</th>
                                                <th scope="col">Date Updated</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM yearlydeaths;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            $yearlyDeaths = 0;

                                            $yearlyLabel = [];
                                            $yearlyDeathsData = [];

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    $yearlyDeaths += $row['total_deaths'];

                                                    $yearlyLabel[] = $row['year'];
                                                    $yearlyDeathsData[] = $row['total_deaths'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['year']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['total_deaths'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <button class="btn btn-update-yearly btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModalYearly"
                                                                data-year="<?php echo $row['year'] ?>"
                                                                data-total-deaths="<?php echo $row['total_deaths']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">Update

                                                            </button>

                                                        </td>

                                                        <td class="text-center">
                                                            <form action="/benguetlivestock/backend/common-diseases-code.php"
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
                                                <?php echo number_format($yearlyDeaths, 0, '.', ','); ?>
                                            </td>
                                            <td></td>
                                            <td colspan="1"></td>
                                        </tr>



                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Secondary Table Visual Representation -->
                <div class="container-fluid mt-1">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <canvas class="canvas" id="yearlyAnimalDeathChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/animal-deaths-modal.php'; ?>


    <script>
        var ctx = document.getElementById('animalDeathChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Animal Death per Municipality',
                    data: <?php echo json_encode($animalDeathsData); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
                { targets: [4, 5], orderable: false },
                { "className": "dt-center", "targets": "_all" } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
            columns: [
                { "width": "16.67%" },
                { "width": "16.67%" },
                { "width": "16.67%" },
                { "width": "16.67%" },
                { "width": "16.67%" },
                { "width": "16.67%" },
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

    </script>

    <script>
        var dataTable = new DataTable('#yearly-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [3, 4], orderable: false },
                { "className": "dt-center", "targets": "_all" },
                // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
            columns: [
                { "width": "20%" },
                { "width": "20%" },
                { "width": "20%" },
                { "width": "20%" },
                { "width": "20%" },
            ],
            autoWidth: false,
            search: true,
            // info: false,
            paging: false,
            order: [[0, 'asc']],
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
                $('#yearly-table').css('font-size', '14px'); // Adjust the size as needed
            }
        });

    </script>

    <script>
        var ctx = document.getElementById('yearlyAnimalDeathChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($yearlyLabel); ?>,
                datasets: [{
                    label: 'Yearly Number',
                    data: <?php echo json_encode($yearlyDeathsData); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
                url: '/benguetlivestock/backend/animal-deaths-code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/animal-deaths.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }
    </script>

    <script>
        var totalAnimalDeaths = <?php echo $totalAnimalDeaths; ?>;
    </script>

    <script>
        // Function to calculate and update totals in the modal
        function submitTotalModal() {
            <?php
            // Assuming these variables are already defined in your PHP code
            echo "var totalAnimalDeaths = $totalAnimalDeaths;\n";
            ?>

            // Update the modal content
            document.getElementById('totalTableBody').innerHTML = `
    <tr>
        <td>Total Animal Deaths</td>
        <td>${totalAnimalDeaths}</td>
    </tr>
        `;
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
                url: '/benguetlivestock/backend/animal-deaths-code.php',
                data: { deleteDataYearly: true, id_yearly: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/animal-deaths.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }

    </script>

    <script src="/benguetlivestock/assets/js/content-js/animal-deaths-script.js"></script>
</body>

</html>