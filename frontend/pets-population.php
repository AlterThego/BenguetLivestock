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
                                $toastType = 'success'; // Default to success
                            
                                // Check if the status message indicates an error
                                if (strpos(strtolower($_SESSION['status']), 'failed') !== false || strpos(strtolower($_SESSION['status']), 'error') !== false) {
                                    $toastType = 'error';
                                }

                                echo "<script>
        // Display Toastr notification with custom options based on success or warning
        toastr.$toastType('{$_SESSION['status']}', 'Status', {
            closeButton: false,
            debug: false,
            newestOnTop: false,
            progressBar: true,
            positionClass: 'toast-top-center',
            preventDuplicates: false,
            onclick: null,
            showDuration: '300',
            hideDuration: '1000',
            timeOut: '5000',
            extendedTimeOut: '1000',
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
        });
    </script>";

                                unset($_SESSION['status']);
                            }
                            ?>
                            <div class="card p-3">
                                <div class="card-header mb-3">
                                    <h3 class="text-center font-weight-bold ">Pet Population</h3>
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

                                            $totalCat = $totalDog = 0;

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    $totalDog += $row['dog_count'];
                                                    $totalCat += $row['cat_count'];

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
                                                                data-date="<?php echo $row['date_updated']; ?>">Update

                                                            </button>

                                                        </td>
                                                        <td class="text-center">
                                                            <form action="../backend/pets-population-code.php" method="post">
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


    <script>
        var ctx = document.getElementById('populationChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Dog Population',
                    data: <?php echo json_encode($dogData); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Cat Population',
                    data: <?php echo json_encode($catData); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
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

    <script>
        var dataTable = new DataTable('#main-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [5, 6], orderable: false },
                { "className": "dt-center", "targets": "_all" } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
            columns: [
                { "width": "14.29%" },
                { "width": "14.29%" },
                { "width": "14.29%" },
                { "width": "14.29%" },
                { "width": "14.29%" },
                { "width": "14.29%" },
                { "width": "14.29%" },

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

    <script>
        var totalDog = <?php echo $totalDog; ?>;
        var totalCat = <?php echo $totalCat; ?>;
    </script>

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

    <script src="/benguetlivestock/assets/js/content-js/pets-population-script.js"></script>

    <script>
        // Save scroll position to sessionStorage before the page reloads
        window.onbeforeunload = function () {
            sessionStorage.setItem("scrollPos", window.scrollY);
        };
    </script>

    <script>
        // Restore scroll position from sessionStorage on page load
        window.onload = function () {
            var scrollPos = sessionStorage.getItem("scrollPos");
            if (scrollPos !== null) {
                window.scrollTo(0, scrollPos);
                sessionStorage.removeItem("scrollPos");
            }
        };
    </script>
</body>

</html>