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




    <title>Poultry Population</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/poultry-population-sidebar.php';
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
                        <div class="col-md-10">
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
                                    <h3 class="text-center font-weight-bold ">Poultry Population</h3>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addModal">
                                        Add data
                                    </button>
                                    <h6 class="text-right text-sm"><i>Note: Only 1 row is allowed here (This Year)</i>
                                    </h6>
                                </div>
                                <table class="display table-bordered table-responsive" id="main-table">
                                    <thead class="thead-light">

                                        <tr>
                                            <th scope="col">Date Updated</th>
                                            <th scope="col">Layers</th>
                                            <th scope="col">Broiler</th>
                                            <th scope="col">Native/ Range</th>
                                            <th scope="col">Fighting/ Fancy Fowl</th>
                                            <th scope="col" class="text-center">Update</th>
                                            <th scope="col" class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                        $fetch_query = "SELECT * FROM poultrypopulation;";

                                        $fetch_query_run = mysqli_query($connection, $fetch_query);

                                        $totalLayers = $totalBroiler = $totalNative = $totalFighting = 0;

                                        if (mysqli_num_rows($fetch_query_run) > 0) {
                                            while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                $totalLayers += $row['layers_count'];
                                                $totalBroiler += $row['broiler_count'];
                                                $totalNative += $row['native_count'];
                                                $totalFighting += $row['fighting_count'];
                                                ?>
                                                <tr>
                                                    <td style="display: none;">
                                                        <?php echo $row['poultry_id']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['date_updated']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['layers_count'], 0, '.', ','); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['broiler_count'], 0, '.', ','); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['native_count'], 0, '.', ','); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['fighting_count'], 0, '.', ','); ?>
                                                    </td>


                                                    <td class="text-center">
                                                        <button class="btn btn-update btn-success btn-sm" data-toggle="modal"
                                                            data-target="#updateModal"
                                                            data-id="<?php echo $row['poultry_id'] ?>"
                                                            data-layers="<?php echo $row['layers_count']; ?>"
                                                            data-broiler="<?php echo $row['broiler_count']; ?>"
                                                            data-native="<?php echo $row['native_count']; ?>"
                                                            data-fighting="<?php echo $row['fighting_count']; ?>"
                                                            data-date="<?php echo $row['date_updated']; ?>">Update
                                                        </button>

                                                    </td>
                                                    <td class="text-center">
                                                        <form action="../backend/poultry-population-code.php" method="post">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo $row['poultry_id']; ?>">
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
                                        <td>
                                            <?php echo number_format($totalLayers, 0, '.', ','); ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($totalBroiler, 0, '.', ','); ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($totalNative, 0, '.', ','); ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($totalFighting, 0, '.', ','); ?>
                                        </td>
                                        <td></td>
                                        <td colspan="2"></td>
                                    </tr>



                                </table>
                                <div class="right">
                                    <button class="btn btn-info float-right" onclick="submitTotalModal()"
                                        data-toggle="modal" data-target="#submitTotalModal">Submit Total Count
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/poultry-population-modal.php'; ?>

    <script>
        var dataTable = new DataTable('#main-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [6, 7], orderable: false },
                { "className": "dt-center", "targets": "_all" } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
            columns: [
                { "width": "12.5%" },
                { "width": "12.5%" },
                { "width": "12.5%" },
                { "width": "12.5%" },
                { "width": "12.5%" },
                { "width": "12.5%" },
                { "width": "12.5%" },
                { "width": "12.5%" },


            ],
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
                url: '/benguetlivestock/backend/poultry-population-code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/poultry-population.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }
    </script>

    <script src="/benguetlivestock/assets/js/content-js/poultry-population-script.js"></script>
</body>

</html>