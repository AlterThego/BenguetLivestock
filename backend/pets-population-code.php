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
    $combined_value = $connection->real_escape_string($_POST['zip']);
    list($municipality_id, $municipality_name) = explode('-', $combined_value);

    $dog_count = $connection->real_escape_string($_POST['dog_count']);
    $cat_count = $connection->real_escape_string($_POST['cat_count']);
    $date_updated = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO petspopulation (municipality_id, municipality_name, dog_count, cat_count, date_updated) 
        VALUES ('$municipality_id','$municipality_name','$dog_count', '$cat_count', '$date_updated')";

        // Execute the query
        $insert_query_run = $connection->query($insert_query);

        if ($insert_query_run === true) {
            $_SESSION['status'] = 'Created Successfully';
            header('location: /benguetlivestock/frontend/pets-population.php');
        } else {
            throw new Exception("Creation failed");
        }
    } catch (Exception $e) {
        $_SESSION['status'] = 'Failed to Add: Update or delete existing data. Error: ' . $e->getMessage();
        echo "<script>
            toastr.warning('Failed to Add: Update or delete existing data. Error: " . $e->getMessage() . "', 'Warning', {
                closeButton: true,
                progressBar: true,
            });
        </script>";
        header('location: /benguetlivestock/frontend/pets-population.php');
    }
} elseif (isset($_POST['updateData'])) {
    // Update existing data
    $update_id = mysqli_real_escape_string($connection, $_POST['update_id']);
    $update_dog = mysqli_real_escape_string($connection, $_POST['update_dog_count']);
    $update_cat = mysqli_real_escape_string($connection, $_POST['update_cat_count']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE petspopulation SET dog_count=?, cat_count=?, date_updated=? WHERE municipality_id=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "iisi", $update_dog, $update_cat, $update_date, $update_id);

    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: ../frontend/pets-population.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: ../frontend/pets-population.php');
    }

} elseif (isset($_POST['deleteData'])) {
    // Delete data
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM petspopulation WHERE municipality_id='$id'";
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
        $Dog = isset($_POST['totalDog']) ? $_POST['totalDog'] : 0;
        $Cat = isset($_POST['totalCat']) ? $_POST['totalCat'] : 0;

        $petYear = isset($_POST['petYear']) ? $_POST['petYear'] : 0;
        $submitDateUpdated = isset($_POST['submitDateUpdated']) ? $_POST['submitDateUpdated'] : date('Y-m-d');

        // Perform the database insertion using prepared statements to prevent SQL injection
        $insertQuery = "INSERT INTO pettrend (pet_year, dog_count, cat_count, date_updated) 
                        VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($connection, $insertQuery);
        mysqli_stmt_bind_param($stmt, "iiis", $petYear, $Dog, $Cat, $submitDateUpdated);

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