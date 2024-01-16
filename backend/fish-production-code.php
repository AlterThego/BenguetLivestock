<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['savedata'])) {
    // Insert new data
    $fish_id = $connection->real_escape_string($_POST['fish_id']);

    $fish_pond_count = $connection->real_escape_string($_POST['fish_pond_count']);
    $fish_cage_count = $connection->real_escape_string($_POST['fish_cage_count']);
    $fish_tank_count = $connection->real_escape_string($_POST['fish_tank_count']);
    $rice_fish_count = $connection->real_escape_string($_POST['rice_fish_count']);
    $communal_water_count = $connection->real_escape_string($_POST['communal_water_count']);

    $date_updated = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO fishproduction (id, fish_pond, fish_cage, fish_in_tank, rice_fish_culture, communal_water, date_updated) 
        VALUES ('$fish_id','$fish_pond_count','$fish_cage_count', '$fish_tank_count', '$rice_fish_count', '$communal_water_count','$date_updated')";

        // Execute the query
        $insert_query_run = $connection->query($insert_query);

        if ($insert_query_run === true) {
            $_SESSION['status'] = 'Created Successfully';
            header('location: /benguetlivestock/frontend/fish-production.php');
        } else {
            throw new Exception("Creation failed");
        }
    } catch (Exception $e) {
        $_SESSION['status'] = 'Failed to Add: Update or delete existing data.';
        header('location: /benguetlivestock/frontend/fish-production.php');
    }
} elseif (isset($_POST['updateData'])) {
    // Update existing data
    $update_fish_id = mysqli_real_escape_string($connection, $_POST['update_fish_id']);
    $update_pond_count = mysqli_real_escape_string($connection, $_POST['update_pond_count']);
    $update_cage_count = mysqli_real_escape_string($connection, $_POST['update_cage_count']);
    $update_tank_count = mysqli_real_escape_string($connection, $_POST['update_tank_count']);
    $update_rice_count = mysqli_real_escape_string($connection, $_POST['update_rice_count']);
    $update_communal_count = mysqli_real_escape_string($connection, $_POST['update_communal_count']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE fishproduction SET fish_pond=?, fish_cage=?, fish_in_tank=?, rice_fish_culture=? ,communal_water=?, date_updated=? WHERE id=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "dddddsi", $update_pond_count, $update_cage_count, $update_tank_count, $update_rice_count, $update_communal_count, $update_date, $update_fish_id);

    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: ../frontend/fish-production.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: ../frontend/fish-production.php');
    }

} elseif (isset($_POST['deleteData'])) {
    // Delete data
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM fishproduction WHERE id='$id'";
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
        $Pond = isset($_POST['totalPond']) ? $_POST['totalPond'] : 0;
        $Cage = isset($_POST['totalCage']) ? $_POST['totalCage'] : 0;
        $Tank = isset($_POST['totalTank']) ? $_POST['totalTank'] : 0;
        $RiceCulture = isset($_POST['totalRiceCulture']) ? $_POST['totalRiceCulture'] : 0;
        $Communal = isset($_POST['totalCommunal']) ? $_POST['totalCommunal'] : 0;

        $fishYear = isset($_POST['fishYear']) ? $_POST['fishYear'] : 0;
        $submitDateUpdated = isset($_POST['submitDateUpdated']) ? $_POST['submitDateUpdated'] : date('Y-m-d');

        // Perform the database insertion using prepared statements to prevent SQL injection
        $insertQuery = "INSERT INTO yearlyfishproduction (year, yearly_pond, yearly_cage, yearly_tank, yearly_rice_culture,yearly_communal, date_updated) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($connection, $insertQuery);
        mysqli_stmt_bind_param($stmt, "iddddds", $fishYear, $Pond, $Cage, $Tank, $RiceCulture, $Communal, $submitDateUpdated);

        if (mysqli_stmt_execute($stmt)) {
            session_start();
            $_SESSION['status'] = 'Total Count Submitted Successfully';
            header('location: ../frontend/fish-production.php');
            exit();
        } else {
            throw new Exception('Failed to execute the database insertion');
        }
    } catch (Exception $e) {
        session_start();
        $_SESSION['status'] = 'Failed: Year Already Exists!! '; //. $e->getMessage()
        header('location: ../frontend/fish-production.php');
        exit();
    }
} elseif (isset($_POST['deleteDataYearly'])) {
    // Delete data
    $id_yearly = mysqli_real_escape_string($connection, $_POST['id_yearly']);

    $delete_query = "DELETE FROM yearlyfishproduction WHERE year='$id_yearly'";
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
    $update_pond_yearly = mysqli_real_escape_string($connection, $_POST['update_pond_yearly']);
    $update_cage_yearly = mysqli_real_escape_string($connection, $_POST['update_cage_yearly']);
    $update_tank_yearly = mysqli_real_escape_string($connection, $_POST['update_tank_yearly']);
    $update_rice_yearly = mysqli_real_escape_string($connection, $_POST['update_rice_yearly']);
    $update_communal_yearly = mysqli_real_escape_string($connection, $_POST['update_communal_yearly']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE yearlyfishproduction SET yearly_pond=?,yearly_cage=?,yearly_tank=?,yearly_rice_culture=?,yearly_communal=?, date_updated=? WHERE year=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param(
        $stmt,
        "dddddsi",
        $update_pond_yearly,
        $update_cage_yearly,
        $update_tank_yearly,
        $update_rice_yearly,
        $update_communal_yearly,
        $update_date,
        $update_id
    );

    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: /benguetlivestock/frontend/fish-production.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: /benguetlivestock/frontend/fish-production.php');
    }
}


mysqli_close($connection);
?>