<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['savedataProvincial'])) {
    // Insert new data


    $pYear = $connection->real_escape_string($_POST['add_year']);
    $Number = $connection->real_escape_string($_POST['station_number']);
    $date = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO provincialbreedingstations (year, number, date_updated) 
        VALUES ('$pYear', '$Number', '$date')";

        // Execute the query
        $insert_query_run = $connection->query($insert_query);

        if ($insert_query_run === true) {
            $_SESSION['status'] = 'Created Successfully';
            header('location: /benguetlivestock/frontend/breeding-stations.php');
        } else {
            throw new Exception("Creation failed");
        }
    } catch (Exception $e) {
        $_SESSION['status'] = 'Failed to Add: Update or delete existing data.';
        header('location: /benguetlivestock/frontend/breeding-stations.php');
    }
} elseif (isset($_POST['updateDataProvincial'])) {
    // Update existing data
    $Year = mysqli_real_escape_string($connection, $_POST['update_year']);
    $Number = mysqli_real_escape_string($connection, $_POST['update_number']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE provincialbreedingstations SET number=?, date_updated=? WHERE year=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "isi", $Number, $update_date, $Year);

    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: /benguetlivestock/frontend/breeding-stations.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: /benguetlivestock/frontend/breeding-stations.php');
    }

} elseif (isset($_POST['deleteDataProvincial'])) {
    // Delete data
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM provincialbreedingstations WHERE year='$id'";
    $delete_query_run = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        $_SESSION['status'] = 'Deleted Successfully';
        exit(); // Stop further execution
    } else {
        $_SESSION['status'] = 'Failed to Delete: ' . mysqli_error($connection);
        exit(); // Stop further execution
    }
}
if (isset($_POST['savedataMunicipality'])) {
    // Insert new data

    $Year = $connection->real_escape_string($_POST['year']);

    $LaTrinidad = $connection->real_escape_string($_POST['latrinidad_number']);
    $Tuba = $connection->real_escape_string($_POST['tuba_number']);
    $Itogon = $connection->real_escape_string($_POST['itogon_number']);
    $Bokod = $connection->real_escape_string($_POST['bokod_number']);
    $Kabayan = $connection->real_escape_string($_POST['kabayan_number']);
    $Buguias = $connection->real_escape_string($_POST['buguias_number']);
    $Mankayan = $connection->real_escape_string($_POST['mankayan_number']);
    $Bakun = $connection->real_escape_string($_POST['bakun_number']);
    $Kibungan = $connection->real_escape_string($_POST['kibungan_number']);
    $Atok = $connection->real_escape_string($_POST['atok_number']);
    $Kapangan = $connection->real_escape_string($_POST['kapangan_number']);
    $Sablan = $connection->real_escape_string($_POST['sablan_number']);
    $Tublay = $connection->real_escape_string($_POST['tublay_number']);

    $date = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO municipalitybreedingstations (year, latrinidad_count,tuba_count,itogon_count,bokod_count
        ,kabayan_count, buguias_count, mankayan_count, bakun_count, kibungan_count,atok_count,kapangan_count,
        sablan_count,tublay_count, date_updated) 
        VALUES ('$Year', '$LaTrinidad','$Tuba','$Itogon','$Bokod','$Kabayan',
        '$Buguias','$Mankayan','$Bakun','$Kibungan','$Atok','$Kapangan','$Sablan','$Tublay', '$date')";

        // Execute the query
        $insert_query_run = $connection->query($insert_query);

        if ($insert_query_run === true) {
            $_SESSION['status'] = 'Created Successfully';
            header('location: /benguetlivestock/frontend/breeding-stations.php');
        } else {
            throw new Exception("Creation failed");
        }
    } catch (Exception $e) {
        $_SESSION['status'] = 'Failed to Add: Update or delete existing data. Error: ' . $e->getMessage();
        header('location: /benguetlivestock/frontend/breeding-stations.php');
    }
} elseif (isset($_POST['updateDataMunicipality'])) {
    // Update existing data
    $year = mysqli_real_escape_string($connection, $_POST['update_year_municipality']);

    $Ulatrinidad = mysqli_real_escape_string($connection, $_POST['update_latrinidad']);
    $uTuba = mysqli_real_escape_string($connection, $_POST['update_tuba']);
    $uItogon = mysqli_real_escape_string($connection, $_POST['update_itogon']);
    $uBokod = mysqli_real_escape_string($connection, $_POST['update_bokod']);
    $uKabayan = mysqli_real_escape_string($connection, $_POST['update_kabayan']);
    $uBuguias = mysqli_real_escape_string($connection, $_POST['update_buguias']);
    $uMankayan = mysqli_real_escape_string($connection, $_POST['update_mankayan']);
    $uBakun = mysqli_real_escape_string($connection, $_POST['update_bakun']);
    $uKibungan = mysqli_real_escape_string($connection, $_POST['update_kibungan']);
    $uAtok = mysqli_real_escape_string($connection, $_POST['update_atok']);
    $uKapangan = mysqli_real_escape_string($connection, $_POST['update_kapangan']);
    $uSablan = mysqli_real_escape_string($connection, $_POST['update_sablan']);
    $uTublay = mysqli_real_escape_string($connection, $_POST['update_tublay']);



    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE municipalitybreedingstations SET latrinidad_count=?, tuba_count=?, itogon_count=?, 
    bokod_count=?, kabayan_count=?, buguias_count=?,  mankayan_count=?, bakun_count=?, kibungan_count=?, 
    atok_count=?, kapangan_count=?, sablan_count=?, tublay_count=?, date_updated=? WHERE year=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param(
        $stmt,
        "iiiiiiiiiiiiisi",
        $Ulatrinidad,
        $uTuba,
        $uItogon,
        $uBokod,
        $uKabayan,
        $uBuguias,
        $uMankayan,
        $uBakun,
        $uKibungan,
        $uAtok,
        $uKapangan,
        $uSablan,
        $uTublay,
        $update_date,
        $year
    );

    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: /benguetlivestock/frontend/breeding-stations.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: /benguetlivestock/frontend/breeding-stations.php');
    }

} elseif (isset($_POST['deleteDataMunicipality'])) {
    // Delete data
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM municipalitybreedingstations WHERE year='$id'";
    $delete_query_run = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        $_SESSION['status'] = 'Deleted Successfully';
        exit(); // Stop further execution
    } else {
        $_SESSION['status'] = 'Failed to Delete: ' . mysqli_error($connection);
        exit(); // Stop further execution
    }
}


mysqli_close($connection);
?>