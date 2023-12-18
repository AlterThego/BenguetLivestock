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



    <title>Animal Trend</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/animal-trend-sidebar.php';
        ?>

        <!-- Main Component -->
        <div class="main" id="main-component">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <!-- Button for sidebar toggle -->
                <button class="btn" type="button">
                    <img src="../assets/images/sidebar-toggle.png" style="width: 20px; height: 20px;" />
                </button>
            </nav>
            <main class="content px-3 py-2">
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
                                    <h3 class="text-center font-weight-bold ">Animal Trend</h3>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Add data
                                    </button>
                                </div>
                                <table class="display table-bordered table-responsive" id="main-table">
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
                                                        <button class="btn btn-update btn-success btn-sm center"
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
            </main>
        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/animal-trend-modal.php'; ?>

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
        });
    </script>
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
</body>

</html>