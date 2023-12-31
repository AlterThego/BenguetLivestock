<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['savedata'])) {
    // Insert new data
    $year = $connection->real_escape_string($_POST['year']);
    $carabao = $connection->real_escape_string($_POST['carabao_yearly']);
    $cattle = $connection->real_escape_string($_POST['cattle_yearly']);
    $swine = $connection->real_escape_string($_POST['swine_yearly']);
    $goat = $connection->real_escape_string($_POST['goat_yearly']);
    $dog = $connection->real_escape_string($_POST['dog_yearly']);
    $sheep = $connection->real_escape_string($_POST['sheep_yearly']);
    $horse = $connection->real_escape_string($_POST['horse_yearly']);
    $date_updated = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO animaltrend (livestock_year, carabao_count, cattle_count, 
        swine_count, goat_count, dog_count, sheep_count, horse_count, date_updated) 
        VALUES ('$year', '$carabao', '$cattle', '$swine', '$goat', '$dog', '$sheep', '$horse','$date_updated')";
        $insert_query_run = $connection->query($insert_query);

        if ($insert_query_run === true) {
            $_SESSION['status'] = 'Created Successfully';
            header('location: /benguetlivestock/frontend/animal-trend.php');
        } else {
            throw new Exception("Creation failed");
        }
    } catch (Exception $e) {
        $_SESSION['status'] = 'Failed to Add: Update or delete existing data. Error: ' . $e->getMessage();
        header('location: /benguetlivestock/frontend/animal-trend.php');
    }


} elseif (isset($_POST['updateData'])) {
    // Update existing data
    $update_year = mysqli_real_escape_string($connection, $_POST['update_year']);
    $update_carabao = mysqli_real_escape_string($connection, $_POST['update_carabao']);
    $update_cattle = mysqli_real_escape_string($connection, $_POST['update_cattle']);
    $update_swine = mysqli_real_escape_string($connection, $_POST['update_swine']);
    $update_goat = mysqli_real_escape_string($connection, $_POST['update_goat']);
    $update_dog = mysqli_real_escape_string($connection, $_POST['update_dog']);
    $update_sheep = mysqli_real_escape_string($connection, $_POST['update_sheep']);
    $update_horse = mysqli_real_escape_string($connection, $_POST['update_horse']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE animaltrend 
    SET carabao_count=?, cattle_count=?, swine_count=?, goat_count=?, dog_count=?, sheep_count=?, horse_count=?, date_updated=? 
    WHERE livestock_year=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param(
        $stmt,
        "iiiiiiisi",
        $update_carabao,
        $update_cattle,
        $update_swine,
        $update_goat,
        $update_dog,
        $update_sheep,
        $update_horse,
        $update_date,
        $update_year
    );
    $update_query_run = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: /benguetlivestock/frontend/animal-trend.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: /benguetlivestock/frontend/animal-trend.php');
    }
} elseif (isset($_POST['deleteData'])) {
    // Delete data
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM animaltrend WHERE livestock_year='$id'";
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