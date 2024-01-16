<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['savedata'])) {
    // Insert new data
    $year = $connection->real_escape_string($_POST['year']);
    $Colonies = $connection->real_escape_string($_POST['colonies_count']);
    $Beekeepers = $connection->real_escape_string($_POST['beekeepers_count']);
    $date_updated = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO beetrend (bee_year, colonies_count, beekeepers_count, date_updated) VALUES ('$year', '$Colonies', '$Beekeepers', '$date_updated')";
        $insert_query_run = $connection->query($insert_query);

        if ($insert_query_run === true) {
            $_SESSION['status'] = 'Created Successfully';
            header('location: /benguetlivestock/frontend/bee-trend.php');
        } else {
            throw new Exception("Creation failed");
        }
    } catch (Exception $e) {
        $_SESSION['status'] = 'Failed to Add: Update or delete existing data.';
        header('location: /benguetlivestock/frontend/bee-trend.php');
    }


} elseif (isset($_POST['updateData'])) {
    // Update existing data
    $update_id = mysqli_real_escape_string($connection, $_POST['update_year']);
    $update_colonies = mysqli_real_escape_string($connection, $_POST['update_colonies']);
    $update_beekeepers = mysqli_real_escape_string($connection, $_POST['update_beekeepers']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE beetrend SET colonies_count=?, beekeepers_count=?, date_updated=? WHERE bee_year=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "iisi", $update_colonies, $update_beekeepers, $update_date, $update_id);
    $update_query_run = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: /benguetlivestock/frontend/bee-trend.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: /benguetlivestock/frontend/bee-trend.php');
    }
} elseif (isset($_POST['deleteData'])) {
    // Delete data
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM beetrend WHERE bee_year='$id'";
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