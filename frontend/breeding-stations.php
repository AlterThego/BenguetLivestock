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

    <title>Breeding Stations</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once './sidebar/breeding-stations-sidebar.php';
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
                                    <h2 class="text-center font-weight-bold ">Animal and Fishery</h2>
                                    <h4 class="text-center font-weight-bold "> Provincial Breeding Stations</h4>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addModalProvincial">
                                        Add data
                                    </button>


                                </div>
                                <div class="table-responsive">
                                    <table class="display table-bordered" id="main-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Year</th>
                                                <th scope="col">Number</th>
                                                <th scope="col">Date Updated</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM provincialbreedingstations;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            $yearData = [];
                                            $numberData = [];

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                    $numberData[] = $row['number'];
                                                    $yearData[] = $row['year'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['year']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['number'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <button class="btn btn-update-provincial btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModalProvincial"
                                                                data-year="<?php echo $row['year'] ?>"
                                                                data-number="<?php echo $row['number'] ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">Update

                                                            </button>

                                                        </td>
                                                        <td class="text-center">
                                                            <form action="/benguetlivestock/backend/breeding-stations-code.php"
                                                                method="post">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $row['year']; ?>">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-delete-provincial btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#deleteConfirmationModalProvincial">
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

                <!-- Visual Representation -->
                <div class="container-fluid mb-5 mt-1">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <canvas class="canvas" id="stationsProvincialChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container-fluid mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <!-- 2nd table -->
                            <div class="card p-3 mt-5">
                                <div class="card-header mb-3">
                                    <h4 class="text-center font-weight-bold "> Municipality Breeding
                                        Stations</h4>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addModalMunicipality">
                                        Add data
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="display table-bordered" id="secondary-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Year</th>
                                                <th scope="col">La Trinidad</th>
                                                <th scope="col">Tuba</th>
                                                <th scope="col">Itogon</th>
                                                <th scope="col">Bokod</th>
                                                <th scope="col">Kabayan</th>
                                                <th scope="col">Buguias</th>
                                                <th scope="col">Mankayan</th>
                                                <th scope="col">Bakun</th>
                                                <th scope="col">Kibungan</th>
                                                <th scope="col">Atok</th>
                                                <th scope="col">Kapangan</th>
                                                <th scope="col">Sablan</th>
                                                <th scope="col">Tublay</th>

                                                <th scope="col">Date Updated</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM municipalitybreedingstations;";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            $yearData2 = [];
                                            $latrinidadData = [];
                                            $tubaData = [];
                                            $itogonData = [];
                                            $bokodData = [];
                                            $kabayanData = [];
                                            $buguiasData = [];
                                            $mankayanData = [];
                                            $bakunData = [];
                                            $kibunganData = [];
                                            $atokData = [];
                                            $kapanganData = [];
                                            $sablanData = [];
                                            $tublayData = [];

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {

                                                    $yearData2[] = $row['year'];
                                                    $latrinidadData[] = $row['latrinidad_count'];
                                                    $tubaData[] = $row['tuba_count'];
                                                    $itogonData[] = $row['itogon_count'];
                                                    $bokodData[] = $row['bokod_count'];
                                                    $kabayanData[] = $row['kabayan_count'];
                                                    $buguiasData[] = $row['buguias_count'];
                                                    $mankayanData[] = $row['mankayan_count'];
                                                    $bakunData[] = $row['bakun_count'];
                                                    $kibunganData[] = $row['kibungan_count'];
                                                    $atokData[] = $row['atok_count'];
                                                    $kapanganData[] = $row['kapangan_count'];
                                                    $sablanData[] = $row['sablan_count'];
                                                    $tublayData[] = $row['tublay_count'];


                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['year']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['latrinidad_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['tuba_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['itogon_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['bokod_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['kabayan_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['buguias_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['mankayan_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['bakun_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['kibungan_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['atok_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['kapangan_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['sablan_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['tublay_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['date_updated']; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <button class="btn btn-update-municipality btn-warning btn-sm"
                                                                data-toggle="modal" data-target="#updateModalMunicipality"
                                                                data-year="<?php echo $row['year'] ?>"
                                                                data-latrinidad="<?php echo $row['latrinidad_count'] ?>"
                                                                data-tuba="<?php echo $row['tuba_count'] ?>"
                                                                data-itogon="<?php echo $row['itogon_count'] ?>"
                                                                data-bokod="<?php echo $row['bokod_count'] ?>"
                                                                data-kabayan="<?php echo $row['kabayan_count'] ?>"
                                                                data-buguias="<?php echo $row['buguias_count'] ?>"
                                                                data-mankayan="<?php echo $row['mankayan_count'] ?>"
                                                                data-bakun="<?php echo $row['bakun_count'] ?>"
                                                                data-kibungan="<?php echo $row['kibungan_count'] ?>"
                                                                data-atok="<?php echo $row['atok_count'] ?>"
                                                                data-kapangan="<?php echo $row['kapangan_count'] ?>"
                                                                data-sablan="<?php echo $row['sablan_count'] ?>"
                                                                data-tublay="<?php echo $row['tublay_count'] ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">Update

                                                            </button>

                                                        </td>
                                                        <td class="text-center">
                                                            <form action="/benguetlivestock/backend/breeding-station-code.php"
                                                                method="post">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $row['year']; ?>">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-delete-municipality btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#deleteConfirmationModalMunicipality">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            $recentYears = array_slice($yearData2, -3);
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- Visual Representation -->
                <div class="container-fluid mb-5 mt-1">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <canvas class="canvas" id="stationsMunicipalityChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include './modals/breeding-stations-modal.php'; ?>

    <script>
        var dataTable = new DataTable('#main-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [3, 4], orderable: false },
                { "className": "dt-center", "targets": "_all" }
            ],
            columns: [
                { "width": "20%" },
                { "width": "20%" },
                { "width": "20%" },
                { "width": "20%" },
                { "width": "20%" }
            ],
            autoWidth: false,
            search: true,
            paging: true,
            dom: 'Bfrtip',
            order: [[0, 'desc']],
            buttons: [
                {
                    extend: 'copy',
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
                { targets: [15, 16], orderable: false },
                { "className": "dt-center", "targets": "_all" } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
            columns: [
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },
                { "width": "5.80%" },

            ],
            autoWidth: false,
            search: true,
            // info: false,
            paging: false,
            "drawCallback": function (settings) {
                // Manually set the font size for the DataTable
                $('#secondary-table').css('font-size', '14px'); // Adjust the size as needed
            },
        });
    </script>



    <script>
        $(document).ready(function () {
            $('.btn-delete-provincial').click(function () {
                var id = $(this).closest('form').find('input[name="id"]').val();
                $('#confirmDeleteProvincial').data('id', id);
                $('#confirmDeleteProvincial').on('hidden.bs.modal', function () {
                    $('.modal-backdrop').remove();
                });
            });

            $('#confirmDeleteProvincial').click(function () {
                var id = $(this).data('id');
                // Call the function to handle deletion in code.php
                deleteDataProvincial(id);
            });
        });

        // Function to handle deletion
        function deleteDataProvincial(id) {
            $.ajax({
                type: 'POST',
                url: '/benguetlivestock/backend/breeding-stations-code.php',
                data: { deleteDataProvincial: true, id: id },
                success: function (response) {
                    window.location.href = '/benguetlivestock/frontend/breeding-stations.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }

        $(document).ready(function () {
            $('.btn-delete-municipality').click(function () {
                var id = $(this).closest('form').find('input[name="id"]').val();
                $('#confirmDeleteMunicipality').data('id', id);
                $('#confirmDeleteMunicipality').on('hidden.bs.modal', function () {
                    $('.modal-backdrop').remove();
                });
            });

            $('#confirmDeleteMunicipality').click(function () {
                var id = $(this).data('id');
                // Call the function to handle deletion in code.php
                deleteDataMunicipality(id);
            });
        });

        // Function to handle deletion
        function deleteDataMunicipality(id) {
            $.ajax({
                type: 'POST',
                url: '/benguetlivestock/backend/breeding-stations-code.php',
                data: { deleteDataMunicipality: true, id: id },
                success: function (response) {
                    window.location.href = '/benguetlivestock/frontend/breeding-stations.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }

    </script>


    <!-- Provincial -->
    <script>
        var ctx = document.getElementById('stationsProvincialChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($yearData); ?>,
                datasets: [{
                    label: 'Animal and Fishery Breeding Stations and Multiplier Farms or Demo Farms',
                    data: <?php echo json_encode($numberData); ?>,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
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
                },
                plugins: {
                    legend: {
                        labels: {
                            boxWidth: 0, // Set boxWidth to 0 to remove the background color
                        }
                    }
                }
            }
        });
    </script>



    <!-- Municipalilty -->
    <script>
        var ctx = document.getElementById('stationsMunicipalityChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($yearData2); ?>,
                datasets: [
                    {
                        label: 'La Trinidad',
                        data: <?php echo json_encode($latrinidadData); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Tuba',
                        data: <?php echo json_encode($tubaData); ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Itogon',
                        data: <?php echo json_encode($itogonData); ?>,
                        backgroundColor: 'rgba(255, 205, 86, 0.2)',
                        borderColor: 'rgba(255, 205, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Bokod',
                        data: <?php echo json_encode($bokodData); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Kabayan',
                        data: <?php echo json_encode($kabayanData); ?>,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Buguias',
                        data: <?php echo json_encode($buguiasData); ?>,
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Mankayan',
                        data: <?php echo json_encode($mankayanData); ?>,
                        backgroundColor: 'rgba(255, 0, 0, 0.2)',
                        borderColor: 'rgba(255, 0, 0, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Bakun',
                        data: <?php echo json_encode($bakunData); ?>,
                        backgroundColor: 'rgba(0, 255, 0, 0.2)',
                        borderColor: 'rgba(0, 255, 0, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Kibungan',
                        data: <?php echo json_encode($kibunganData); ?>,
                        backgroundColor: 'rgba(255, 255, 0, 0.2)',
                        borderColor: 'rgba(255, 255, 0, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Atok',
                        data: <?php echo json_encode($atokData); ?>,
                        backgroundColor: 'rgba(0, 0, 255, 0.2)',
                        borderColor: 'rgba(0, 0, 255, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Kapangan',
                        data: <?php echo json_encode($kapanganData); ?>,
                        backgroundColor: 'rgba(128, 0, 128, 0.2)',
                        borderColor: 'rgba(128, 0, 128, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Sablan',
                        data: <?php echo json_encode($sablanData); ?>,
                        backgroundColor: 'rgba(255, 140, 0, 0.2)',
                        borderColor: 'rgba(255, 140, 0, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Tublay',
                        data: <?php echo json_encode($tublayData); ?>,
                        backgroundColor: 'rgba(0, 128, 0, 0.2)',
                        borderColor: 'rgba(0, 128, 0, 1)',
                        borderWidth: 1
                    },
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




    <!-- JS for Update and Delete 'script.js'-->
    <script src="/benguetlivestock/assets/js/content-js/breeding-stations-script.js"></script>

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