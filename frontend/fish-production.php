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




    <title>Fish Production</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/fish-production-sidebar.php';
        ?>

        <!-- Main Component -->
        <div class="main" id="main-component">
            <main class="content py-2 mb-5">
                <!-- Title + Add -->
                <div class="container-fluid mt-3">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="text-left font-weight-bold">Area of Fish Production</h5>
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
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <?php include_once '../assets/toastr.php';
                            ?>
                            <div class="card p-3">
                                <div class="table-responsive">
                                    <table class="row-border    " id="main-table">
                                        <thead class="thead-light">

                                            <tr>
                                                <th scope="col">Date Updated</th>
                                                <th scope="col">Fish Pond</th>
                                                <th scope="col">Fish Cage</th>
                                                <th scope="col">Fish in Tank</th>
                                                <th scope="col">Rice-Fish Culture</th>
                                                <th scope="col">Communal Bodies of Water</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM fishproduction;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            $totalPond = $totalTank = $totalCage = $totalRiceCulture = $totalCommunal = 0;

                                            $pondData = [];
                                            $tankData = [];
                                            $cageData = [];
                                            $riceCultureData = [];
                                            $communalData = [];

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    $totalPond += $row['fish_pond'];
                                                    $totalTank += $row['fish_in_tank'];
                                                    $totalCage += $row['fish_cage'];
                                                    $totalRiceCulture += $row['rice_fish_culture'];
                                                    $totalCommunal += $row['communal_water'];

                                                    $pondData[] = $row['fish_pond'];
                                                    $tankData[] = $row['fish_in_tank'];
                                                    $cageData[] = $row['fish_cage'];
                                                    $riceCultureData[] = $row['rice_fish_culture'];
                                                    $communalData[] = $row['communal_water'];
                                                    ?>
                                                    <tr>
                                                        <td style="display: none;">
                                                            <?php echo $row['id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo sprintf("%.2f", $row['fish_pond']); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo sprintf("%.2f", $row['fish_cage']); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo sprintf("%.2f", $row['fish_in_tank']); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo sprintf("%.2f", $row['rice_fish_culture']); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo sprintf("%.2f", $row['communal_water']); ?>
                                                        </td>


                                                        <td class="text-center">
                                                            <button class="btn btn-update btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModal"
                                                                data-id="<?php echo $row['id'] ?>"
                                                                data-pond="<?php echo $row['fish_pond']; ?>"
                                                                data-cage="<?php echo $row['fish_cage']; ?>"
                                                                data-tank="<?php echo $row['fish_in_tank']; ?>"
                                                                data-rice="<?php echo $row['rice_fish_culture']; ?>"
                                                                data-communal="<?php echo $row['communal_water']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">Update
                                                            </button>

                                                        </td>
                                                        <td class="text-center">
                                                            <form action="../backend/fish-production-code.php" method="post">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $row['id']; ?>">
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
                                                <?php echo sprintf("%.2f", $totalPond); ?>
                                            </td>
                                            <td>
                                                <?php echo sprintf("%.2f", $totalCage); ?>
                                            </td>
                                            <td>
                                                <?php echo sprintf("%.2f", $totalTank); ?>
                                            </td>
                                            <td>
                                                <?php echo sprintf("%.2f", $totalRiceCulture); ?>
                                            </td>
                                            <td>
                                                <?php echo sprintf("%.2f", $totalCommunal); ?>
                                            </td>
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
                                <canvas class="canvas" id="fishProductionChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Yearly Fish Production Supplies -->
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
                                    <h3 class="text-center font-weight-bold ">Yearly Fish Production</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="row-border" id="yearly-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Year</th>
                                                <th scope="col">Yearly Fish Pond</th>
                                                <th scope="col">Yearly Fish Cage</th>
                                                <th scope="col">Yearly Fish Tank</th>
                                                <th scope="col">Yearly Rice-Fish Culture</th>
                                                <th scope="col">Yearly Communal Bodies of Water</th>
                                                <th scope="col">Date Added</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM yearlyfishproduction;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);



                                            $yearlyLabel = [];

                                            $yearlyPond = [];
                                            $yearlyCage = [];
                                            $yearlyTank = [];
                                            $yearlyRiceCulture = [];
                                            $yearlyCommunal = [];

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {

                                                    $yearlyLabel[] = $row['year'];

                                                    $yearlyPond[] = $row['yearly_pond'];
                                                    $yearlyCage[] = $row['yearly_cage'];
                                                    $yearlyTank[] = $row['yearly_tank'];
                                                    $yearlyRiceCulture[] = $row['yearly_rice_culture'];
                                                    $yearlyCommunal[] = $row['yearly_communal'];
                                                    ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?php echo $row['year']; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo sprintf("%.2f", $row['yearly_pond']); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo sprintf("%.2f", $row['yearly_cage']); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo sprintf("%.2f", $row['yearly_tank']); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo sprintf("%.2f", $row['yearly_rice_culture']); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo sprintf("%.2f", $row['yearly_communal']); ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <button class="btn btn-update-yearly btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModalYearly"
                                                                data-year="<?php echo $row['year'] ?>"
                                                                data-yearly-pond="<?php echo $row['yearly_pond']; ?>"
                                                                data-yearly-cage="<?php echo $row['yearly_cage']; ?>"
                                                                data-yearly-tank="<?php echo $row['yearly_tank']; ?>"
                                                                data-yearly-rice-culture="<?php echo $row['yearly_rice_culture']; ?>"
                                                                data-yearly-communal="<?php echo $row['yearly_communal']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">Update

                                                            </button>

                                                        </td>

                                                        <td class="text-center">
                                                            <form action="/benguetlivestock/backend/fish-production-code.php"
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
                                <canvas class="canvas" id="yearlyFishProductionChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>





            </main>
        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/fish-production-modal.php'; ?>


    <!-- Main Table -->
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
                { "width": "12.5%" },


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
                $('#main-table').css('font-size', '14px'); // Adjust the size as needed
            }
        });

    </script>

    <!-- Main Visual Representation  -->
    <script>
        var ctx = document.getElementById('fishProductionChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Fish Pond', 'Fish Cage', 'Fish in Tank', 'Rice-Fish Culture', 'Communcal Bodies of Water'],
                datasets: [
                    {
                        label: 'Area in hectares (ha)',
                        data: [
                            <?php echo join(',', $pondData); ?>,
                            <?php echo join(',', $cageData); ?>,
                            <?php echo join(',', $tankData); ?>,
                            <?php echo join(',', $riceCultureData); ?>,
                            <?php echo join(',', $communalData); ?>
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 205, 86, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
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
        var dataTable = new DataTable('#yearly-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [7, 8], orderable: false },
                { "className": "dt-center", "targets": "_all" } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
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
            search: true,
            // info: false,
            paging: false,
            "drawCallback": function (settings) {
                // Manually set the font size for the DataTable
                $('#yearly-table').css('font-size', '14px'); // Adjust the size as needed
            }
        });
    </script>

    <!-- Main Visual Representation  -->
    <script>
        var ctx = document.getElementById('yearlyFishProductionChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($yearlyLabel); ?>,
                datasets: [
                    {
                        label: 'Pond Area (m^s)',
                        data: <?php echo json_encode($yearlyPond); ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Cage Area (m^s)',
                        data: <?php echo json_encode($yearlyCage); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Tank Area (m^s)',
                        data: <?php echo json_encode($yearlyTank); ?>,
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Rice Culture Area (m^s)',
                        data: <?php echo json_encode($yearlyRiceCulture); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Communal Area (m^s)',
                        data: <?php echo json_encode($yearlyCommunal); ?>,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
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
        var totalPond = <?php echo $totalPond; ?>;
        var totalCage = <?php echo $totalCage; ?>;
        var totalTank = <?php echo $totalTank; ?>;
        var totalRiceCulture = <?php echo $totalRiceCulture; ?>;
        var totalCommunal = <?php echo $totalCommunal; ?>;
    </script>

    <script>
        // Function to calculate and update totals in the modal
        function submitTotalModal() {
            <?php
            // Assuming these variables are already defined in your PHP code
            echo "var totalPond = $totalPond;\n";
            echo "var totalCage = $totalCage;\n";
            echo "var totalTank = $totalTank;\n";
            echo "var totalRiceCulture = $totalRiceCulture;\n";
            echo "var totalCommunal = $totalCommunal;\n";
            ?>

            // Update the modal content
            document.getElementById('totalTableBody').innerHTML = `
    <tr>
        <td>Fish Pond</td>
        <td>${totalPond}</td>
    </tr>
    <tr>
        <td>Fish Cage</td>
        <td>${totalCage}</td>
    </tr>
    <tr>
        <td>Fish in Tank</td>
        <td>${totalTank}</td>
    </tr>
    <tr>
        <td>Rice Fish Culture</td>
        <td>${totalRiceCulture}</td>
    </tr>
    <tr>
        <td>Communal Bodies of Water</td>
        <td>${totalCommunal}</td>
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
                url: '/benguetlivestock/backend/fish-production-code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/fish-production.php';
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
                url: '/benguetlivestock/backend/fish-production-code.php',
                data: { deleteDataYearly: true, id_yearly: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = '/benguetlivestock/frontend/fish-production.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }

    </script>

    <script src="/benguetlivestock/assets/js/content-js/fish-production-script.js"></script>

    <!-- Save State of Page Script -->
    <script src="/benguetlivestock/assets/js/save-state.js"></script>
    <!-- Sidebar Responsive Script -->
    <script src="/benguetlivestock/assets/js/sidebar.js"></script>
    <!-- Dropdown Script -->
    <script src="/benguetlivestock/assets/js/dropdown.js"></script>
</body>

</html>