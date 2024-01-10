<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

$connection->set_charset("utf8mb4");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['savedata'])) {
    // Insert new data
    $combined_value = $connection->real_escape_string($_POST['id-name']);
    list($barangay_id, $barangay_name) = explode('-', $combined_value);

    $area = $connection->real_escape_string($_POST['area']);
    $date_updated = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO fishsanctuary (barangay_id, barangay_name, area, date_updated) 
        VALUES ('$barangay_id','$barangay_name','$area', '$date_updated')";

        // Execute the query
        $insert_query_run = $connection->query($insert_query);

        if ($insert_query_run === true) {
            $_SESSION['status'] = 'Created Successfully';
            header('location: /benguetlivestock/frontend/fish-sanctuary.php');
        } else {
            throw new Exception("Creation failed");
        }
    } catch (Exception $e) {
        $_SESSION['status'] = 'Failed to Add: Update or delete existing data. Error: ' . $e->getMessage();
        header('location: /benguetlivestock/frontend/fish-sanctuary.php');
    }
} elseif (isset($_POST['updateData'])) {
    // Update existing data
    $update_id = mysqli_real_escape_string($connection, $_POST['update_id']);
    $update_area = mysqli_real_escape_string($connection, $_POST['update_area']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE fishsanctuary SET area=?, date_updated=? WHERE barangay_id=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "dsi", $update_area, $update_date, $update_id);

    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: /benguetlivestock/frontend/fish-sanctuary.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: /benguetlivestock/frontend/fish-sanctuary.php');
    }

} elseif (isset($_POST['deleteData'])) {
    // Delete data
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM fishsanctuary WHERE barangay_id='$id'";
    $delete_query_run = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        $_SESSION['status'] = 'Deleted Successfully';
        exit(); // Stop further execution
    } else {
        $_SESSION['status'] = 'Failed to Delete: ' . mysqli_error($connection);
        exit(); // Stop further execution
    }

} elseif (isset($_POST['submitData'])) {
    try {
        // Update variables with values from the form submission
        $totalArea = isset($_POST['totalArea']) ? $_POST['totalArea'] : 0;

        $fishYear = isset($_POST['fishYear']) ? $_POST['fishYear'] : 0;
        $submitDateUpdated = isset($_POST['submitDateUpdated']) ? $_POST['submitDateUpdated'] : date('Y-m-d');

        // Perform the database insertion using prepared statements to prevent SQL injection
        $insertQuery = "INSERT INTO yearlyfishsanctuary (year, total_area, date_updated) 
                        VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($connection, $insertQuery);
        mysqli_stmt_bind_param($stmt, "ids", $fishYear, $totalArea, $submitDateUpdated);

        if (mysqli_stmt_execute($stmt)) {
            session_start();
            $_SESSION['status'] = 'Total Count Submitted Successfully';
            header('location: /benguetlivestock/frontend/fish-sanctuary.php');
            exit();
        } else {
            throw new Exception('Failed to execute the database insertion');
        }
    } catch (Exception $e) {
        session_start();
        $_SESSION['status'] = 'Failed: Year Already Exists!! '; //. $e->getMessage()
        header('location: /benguetlivestock/frontend/fish-sanctuary.php');
        exit();
    }
} elseif (isset($_POST['deleteDataYearly'])) {
    // Delete data
    $id_yearly = mysqli_real_escape_string($connection, $_POST['id_yearly']);

    $delete_query = "DELETE FROM yearlyfishsanctuary WHERE year='$id_yearly'";
    $delete_query_run = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        $_SESSION['status'] = 'Deleted Successfully';
        exit(); // Stop further execution
    } else {
        $_SESSION['status'] = 'Failed to Delete: ' . mysqli_error($connection);
        exit(); // Stop further execution
    }
} elseif (isset($_POST['updateDataYearly'])) {
    // Update existing data
    $update_id = mysqli_real_escape_string($connection, $_POST['update_year']);
    $update_area = mysqli_real_escape_string($connection, $_POST['update_area_yearly']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE yearlyfishsanctuary SET total_area=?, date_updated=? WHERE year=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "idi", $update_area, $update_date, $update_id);

    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: /benguetlivestock/frontend/fish-sanctuary.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: /benguetlivestock/frontend/fish-sanctuary.php');
    }
}



mysqli_close($connection);
?>