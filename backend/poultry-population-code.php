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
    $poultry_id = $connection->real_escape_string($_POST['poultry_id']);

    $layers_count = $connection->real_escape_string($_POST['layers_count']);
    $broiler_count = $connection->real_escape_string($_POST['broiler_count']);
    $native_count = $connection->real_escape_string($_POST['native_count']);
    $fighting_count = $connection->real_escape_string($_POST['fighting_count']);

    $date_updated = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO poultrypopulation (poultry_id, layers_count, native_count, broiler_count, fighting_count, date_updated) 
        VALUES ('$poultry_id','$layers_count','$broiler_count', '$native_count', '$fighting_count', '$date_updated')";

        // Execute the query
        $insert_query_run = $connection->query($insert_query);

        if ($insert_query_run === true) {
            $_SESSION['status'] = 'Created Successfully';
            header('location: /benguetlivestock/frontend/poultry-population.php');
        } else {
            throw new Exception("Creation failed");
        }
    } catch (Exception $e) {
        $_SESSION['status'] = 'Failed to Add: Update or delete existing data. Error: ' . $e->getMessage();
        header('location: /benguetlivestock/frontend/poultry-population.php');
    }
} elseif (isset($_POST['updateData'])) {
    // Update existing data
    $update_poultry_id = mysqli_real_escape_string($connection, $_POST['update_poultry_id']);
    $update_layers = mysqli_real_escape_string($connection, $_POST['update_layers_count']);
    $update_broiler = mysqli_real_escape_string($connection, $_POST['update_broiler_count']);
    $update_native = mysqli_real_escape_string($connection, $_POST['update_native_count']);
    $update_fighting = mysqli_real_escape_string($connection, $_POST['update_fighting_count']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE poultrypopulation SET layers_count=?, broiler_count=?, native_count=?, fighting_count=?, date_updated=? WHERE poultry_id=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "iiiisi", $update_layers, $update_broiler, $update_native, $update_fighting, $update_date, $update_poultry_id);

    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: ../frontend/poultry-population.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: ../frontend/poultry-population.php');
    }

} elseif (isset($_POST['deleteData'])) {
    // Delete data
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM poultrypopulation WHERE poultry_id='$id'";
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
        $Carabao = isset($_POST['totalCarabao']) ? $_POST['totalCarabao'] : 0;
        $Cattle = isset($_POST['totalCattle']) ? $_POST['totalCattle'] : 0;
        $Swine = isset($_POST['totalSwine']) ? $_POST['totalSwine'] : 0;
        $Goat = isset($_POST['totalGoat']) ? $_POST['totalGoat'] : 0;
        $Dog = isset($_POST['totalDog']) ? $_POST['totalDog'] : 0;
        $Sheep = isset($_POST['totalSheep']) ? $_POST['totalSheep'] : 0;
        $Horse = isset($_POST['totalHorse']) ? $_POST['totalHorse'] : 0;

        $livestockYear = isset($_POST['livestockYear']) ? $_POST['livestockYear'] : 0;
        $submitDateUpdated = isset($_POST['submitDateUpdated']) ? $_POST['submitDateUpdated'] : date('Y-m-d');

        // Perform the database insertion using prepared statements to prevent SQL injection
        $insertQuery = "INSERT INTO livestocktrend (livestock_year, carabao_count, cattle_count, swine_count, goat_count, dog_count, sheep_count, horse_count, date_updated) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($connection, $insertQuery);
        mysqli_stmt_bind_param($stmt, "iiiiiiiss", $livestockYear, $Carabao, $Cattle, $Swine, $Goat, $Dog, $Sheep, $Horse, $submitDateUpdated);

        if (mysqli_stmt_execute($stmt)) {
            session_start();
            $_SESSION['status'] = 'Total Count Submitted Successfully';
            header('location: ../frontend/pets-population.php');
            exit();
        } else {
            throw new Exception('Failed to execute the database insertion');
        }
    } catch (Exception $e) {
        session_start();
        $_SESSION['status'] = 'Failed: Year Already Exists!! '; //. $e->getMessage()
        header('location: ../frontend/pets-population.php');
        exit();
    }
}


mysqli_close($connection);
?>