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


    <title>Number of Veterinary Clinics</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/veterinary-clinics-sidebar.php';
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
                        <div class="col-md-6">
                            <div class="card p-3">
                                <div class="card-header mb-3">
                                    <h4 class="text-center font-weight-bold ">Government Veterinary Clinics
                                    </h4>
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

                                            $fetch_query = "SELECT * FROM governmentveterinaryclinics;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            $labels = [];
                                            $governmentVeterinaryClinicData = [];

                                            $totalNumber = 0;

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    $totalNumber += $row['number'];

                                                    $labels[] = $row['municipality_name'];
                                                    $governmentVeterinaryClinicData[] = $row['number'];

                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['municipality_id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['municipality_name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['number'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <button class="btn btn-update btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModal"
                                                                data-zip="<?php echo $row['municipality_id'] ?>"
                                                                data-name="<?php echo $row['municipality_name'] ?>"
                                                                data-number="<?php echo $row['number']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">Update

                                                            </button>

                                                        </td>
                                                        <td class="text-center">
                                                            <form action="../backend/veterinary-clinics-code.php" method="post">
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
                                                <?php echo number_format($totalNumber, 0, '.', ','); ?>
                                            </td>
                                            <td colspan="3"></td>
                                        </tr>



                                    </table>
                                </div>

                                <div class="card mt-5">
                                    <canvas class="canvas" id="governmentVeterinaryClinicsChart"></canvas>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
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
                                    <h4 class="text-center font-weight-bold ">Private Veterinary Clinics
                                    </h4>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addPrivateModal">
                                        Add data
                                    </button>

                                </div>
                                <div class="table-responsive">
                                    <table class="display table-bordered" id="secondary-table">
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

                                            $fetch_query = "SELECT * FROM privateveterinaryclinics;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            $privateClinics = 0;

                                            $privateLabel = [];
                                            $privateVeterinaryClinicsData = [];

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    $privateClinics += $row['number'];

                                                    $privateLabel[] = $row['municipality_name'];
                                                    $privateVeterinaryClinicsData[] = $row['number'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['municipality_id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['municipality_name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['number'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <button class="btn btn-update-yearly btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModalYearly"
                                                                data-private-zip="<?php echo $row['municipality_id'] ?>"
                                                                data-private-name="<?php echo $row['municipality_name'] ?>"
                                                                data-private-number="<?php echo $row['number']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">Update

                                                            </button>

                                                        </td>

                                                        <td class="text-center">
                                                            <form action="/benguetlivestock/backend/veterinary-clinics-code.php"
                                                                method="post">
                                                                <input type="hidden" name="id_yearly"
                                                                    value="<?php echo $row['municipality_id']; ?>">
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
                                            <td></td>
                                            <td>
                                                <?php echo number_format($privateClinics, 0, '.', ','); ?>
                                            </td>
                                            <td colspan="3"></td>
                                        </tr>



                                    </table>
                                </div>

                                <div class="card mt-5">
                                    <canvas class="canvas" id="privateVeterinaryClinicsChart"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/veterinary-clinics-modal.php'; ?>


    <script>
        var ctx = document.getElementById('governmentVeterinaryClinicsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Government Veterinary Clinics',
                    data: <?php echo json_encode($governmentVeterinaryClinicData); ?>,
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
        var dataTable = new DataTable('#secondary-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [4, 5], orderable: false },
                { "className": "dt-center", "targets": "_all" },
                // Disable sorting for columns with index 4 (Update) and 5 (Delete)
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
                $('#secondary-table').css('font-size', '14px'); // Adjust the size as needed
            }
        });

    </script>

    <script>
        var ctx = document.getElementById('privateVeterinaryClinicsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($privateLabel); ?>,
                datasets: [{
                    label: 'Private Veterinary Clinics',
                    data: <?php echo json_encode($privateVeterinaryClinicsData); ?>,
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
                url: '/benguetlivestock/backend/veterinary-clinics-code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/veterinary-clinics.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }
    </script>

    <script>
        var totalAnimalDeaths = <?php echo $totalNumber; ?>;
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
                url: '/benguetlivestock/backend/veterinary-clinics-code.php',
                data: { deleteDataYearly: true, id_yearly: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/veterinary-clinics.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }

    </script>

    <script src="/benguetlivestock/assets/js/content-js/veterinary-clinics-script.js"></script>
</body>

</html>