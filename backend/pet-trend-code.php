<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['savedata'])) {
    // Insert new data
    $year = $connection->real_escape_string($_POST['year']);
    $Dog = $connection->real_escape_string($_POST['dog_count']);
    $Cat = $connection->real_escape_string($_POST['cat_count']);
    $date_updated = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO pettrend (pet_year, dog_count, cat_count, date_updated) VALUES ('$year', '$Dog', '$Cat', '$date_updated')";
        $insert_query_run = $connection->query($insert_query);

        if ($insert_query_run === true) {
            $_SESSION['status'] = 'Created Successfully';
            header('location: /benguetlivestock/frontend/pet-trend.php');
        } else {
            throw new Exception("Creation failed");
        }
    } catch (Exception $e) {
        $_SESSION['status'] = 'Failed to Add: Year Already Existed!';
        header('location: /benguetlivestock/frontend/pet-trend.php');
    }


} elseif (isset($_POST['updateData'])) {
    // Update existing data
    $update_id = mysqli_real_escape_string($connection, $_POST['update_year']);
    $update_dog = mysqli_real_escape_string($connection, $_POST['update_dog']);
    $update_cat = mysqli_real_escape_string($connection, $_POST['update_cat']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE pettrend SET dog_count=?, cat_count=?, date_updated=? WHERE pet_year=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "iisi", $update_dog, $update_cat, $update_date, $update_id);
    $update_query_run = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: /benguetlivestock/frontend/pet-trend.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: /benguetlivestock/frontend/pet-trend.php');
    }
} elseif (isset($_POST['deleteData'])) {
    // Delete data
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM pettrend WHERE pet_year='$id'";
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