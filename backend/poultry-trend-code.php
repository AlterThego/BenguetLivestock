<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['savedata'])) {
    // Insert new data
    $year = $connection->real_escape_string($_POST['year']);
    $layers_count = $connection->real_escape_string($_POST['layers_count']);
    $broiler_count = $connection->real_escape_string($_POST['broiler_count']);
    $native_count = $connection->real_escape_string($_POST['native_count']);
    $fighting_count = $connection->real_escape_string($_POST['fighting_count']);
    $date_updated = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO poultrytrend (poultry_year, layers_count, broiler_count, native_count, fighting_count,
         date_updated) VALUES ('$year', '$layers_count', '$broiler_count', '$native_count', '$fighting_count', '$date_updated')";
        $insert_query_run = $connection->query($insert_query);

        if ($insert_query_run === true) {
            $_SESSION['status'] = 'Created Successfully';
            header('location: /benguetlivestock/frontend/poultry-trend.php');
        } else {
            throw new Exception("Creation failed");
        }
    } catch (Exception $e) {
        $_SESSION['status'] = 'Failed to Add: Update or delete existing data. Error: ' . $e->getMessage();
        header('location: /benguetlivestock/frontend/poultry-trend.php');
    }


} elseif (isset($_POST['updateData'])) {
    // Update existing data
    $id = mysqli_real_escape_string($connection, $_POST['update_year']);
    $update_layers = mysqli_real_escape_string($connection, $_POST['update_layers']);
    $update_broiler = mysqli_real_escape_string($connection, $_POST['update_broiler']);
    $update_native = mysqli_real_escape_string($connection, $_POST['update_native']);
    $update_fighting = mysqli_real_escape_string($connection, $_POST['update_fighting']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE poultrytrend SET layers_count=?, broiler_count=?, native_count=?, fighting_count=?, date_updated=? WHERE poultry_year=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "iiiisi", $update_layers, $update_broiler, $update_native, $update_fighting, $update_date, $id);
    $update_query_run = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: /benguetlivestock/frontend/poultry-trend.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: /benguetlivestock/frontend/poultry-trend.php');
    }
} elseif (isset($_POST['deleteData'])) {
    // Delete data
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM poultrytrend WHERE poultry_year='$id'";
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