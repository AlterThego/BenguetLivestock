<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['savedata'])) {
    // Insert new data
    $combined_value = $connection->real_escape_string($_POST['zip']);
    list($municipality_id, $municipality_name) = explode('-', $combined_value);

    $cattle = $connection->real_escape_string($_POST['cattle_volume']);
    $swine = $connection->real_escape_string($_POST['swine_volume']);
    $carabao = $connection->real_escape_string($_POST['carabao_volume']);
    $goat = $connection->real_escape_string($_POST['goat_volume']);
    $chicken = $connection->real_escape_string($_POST['chicken_volume']);
    $duck = $connection->real_escape_string($_POST['duck_volume']);
    $fish = $connection->real_escape_string($_POST['fish_volume']);
    $date = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO livestockvolume (municipality_id, municipality_name, cattle_volume, swine_volume, 
        carabao_volume, goat_volume, chicken_volume, duck_volume, fish_volume, date_updated) 
        VALUES ('$municipality_id', '$municipality_name', '$cattle', '$swine', '$carabao', '$goat',
        '$chicken', '$duck', '$fish', '$date')";

        // Execute the query
        $insert_query_run = $connection->query($insert_query);
        if ($municipality_id == 0) {
            throw new Exception("Municipality ID cannot be 0");
        }

        

        if ($insert_query_run === true) {
            $_SESSION['status'] = 'Created Successfully';
            header('location: /benguetlivestock/frontend/livestock-volume.php');
        } else {
            throw new Exception("Creation failed");
        }
    } catch (Exception $e) {
        $_SESSION['status'] = 'Failed to Add: Update or delete existing data. Error: ' . $e->getMessage();
        header('location: /benguetlivestock/frontend/livestock-volume.php');
    }
} elseif (isset($_POST['updateData'])) {
    // Update existing data
    $update_id = mysqli_real_escape_string($connection, $_POST['update_id']);
    $update_cattle = mysqli_real_escape_string($connection, $_POST['update_cattle_volume']);
    $update_swine = mysqli_real_escape_string($connection, $_POST['update_swine_volume']);
    $update_carabao = mysqli_real_escape_string($connection, $_POST['update_carabao_volume']);
    $update_goat = mysqli_real_escape_string($connection, $_POST['update_goat_volume']);
    $update_chicken = mysqli_real_escape_string($connection, $_POST['update_chicken_volume']);
    $update_duck = mysqli_real_escape_string($connection, $_POST['update_duck_volume']);
    $update_fish = mysqli_real_escape_string($connection, $_POST['update_fish_volume']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE livestockvolume SET cattle_volume=?, swine_volume=?, carabao_volume=?, goat_volume=?, chicken_volume=?, duck_volume=?, fish_volume=?, date_updated=? WHERE municipality_id=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "iiiiiiisi", $update_cattle, $update_swine, $update_carabao, $update_goat, $update_chicken, $update_duck, $update_fish, $update_date, $update_id);

    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: /benguetlivestock/frontend/livestock-volume.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: /benguetlivestock/frontend/livestock-volume.php');
    }

} elseif (isset($_POST['deleteData'])) {
    // Delete data
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM livestockvolume WHERE municipality_id='$id'";
    $delete_query_run = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        $_SESSION['status'] = 'Deleted Successfully';
        exit(); // Stop further execution
    } else {
        $_SESSION['status'] = 'Failed to Delete: ' . mysqli_error($connection);
        exit(); // Stop further execution
    }
} elseif (isset($_POST['submitVolumeData'])) {
    try {
        // Update variables with values from the form submission
        $Cattle = isset($_POST['totalCattleVolume']) ? $_POST['totalCattleVolume'] : 0;
        $Swine = isset($_POST['totalSwineVolume']) ? $_POST['totalSwineVolume'] : 0;
        $Carabao = isset($_POST['totalCarabaoVolume']) ? $_POST['totalCarabaoVolume'] : 0;
        $Goat = isset($_POST['totalGoatVolume']) ? $_POST['totalGoatVolume'] : 0;
        $Chicken = isset($_POST['totalChickenVolume']) ? $_POST['totalChickenVolume'] : 0;
        $Duck = isset($_POST['totalDuckVolume']) ? $_POST['totalDuckVolume'] : 0;
        $Fish = isset($_POST['totalFishVolume']) ? $_POST['totalFishVolume'] : 0;

        $livestockVolumeYear = isset($_POST['livestockVolumeYear']) ? $_POST['livestockVolumeYear'] : 0;
        $submitVolumeDateUpdated = isset($_POST['submitVolumeDateUpdated']) ? $_POST['submitVolumeDateUpdated'] : 0;

        // Perform the database insertion using prepared statements to prevent SQL injection
        $insertQuery = "INSERT INTO livestockvolumetrend (year, cattle_volume, swine_volume, carabao_volume, goat_volume, chicken_volume, duck_volume, fish_volume, date_updated) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($connection, $insertQuery);
        mysqli_stmt_bind_param($stmt, "iiiiiiiis", $livestockVolumeYear, $Cattle, $Swine, $Carabao, $Goat, $Chicken, $Duck, $Fish, $submitVolumeDateUpdated);

        if (mysqli_stmt_execute($stmt)) {
            session_start();
            $_SESSION['status'] = 'Total Count Submitted Successfully';
            header('location: /benguetlivestock/frontend/livestock-volume.php');
            exit();
        } else {
            throw new Exception('Failed to execute the database insertion');
        }
    } catch (Exception $e) {
        session_start();
        $_SESSION['status'] = 'Failed: Year Already Exists!! '; //. $e->getMessage()
        header('location: /benguetlivestock/frontend/livestock-volume.php');
        exit();
    }
}

mysqli_close($connection);
?>