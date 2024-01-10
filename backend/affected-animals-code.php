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

    $chicken = $connection->real_escape_string($_POST['chicken_count']);
    $duck = $connection->real_escape_string($_POST['duck_count']);
    $cattle = $connection->real_escape_string($_POST['cattle_count']);
    $swine = $connection->real_escape_string($_POST['swine_count']);
    $carabao = $connection->real_escape_string($_POST['carabao_count']);
    $goat = $connection->real_escape_string($_POST['goat_count']);
    $horse = $connection->real_escape_string($_POST['horse_count']);
    $dog = $connection->real_escape_string($_POST['dog_count']);
    $sheep = $connection->real_escape_string($_POST['sheep_count']);

    $date = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO affectedanimals (municipality_id, municipality_name, chicken, duck, cattle, swine, carabao, goat, horse, dog, sheep, date_updated) 
        VALUES ('$municipality_id', '$municipality_name', '$chicken','$duck','$cattle','$swine','$carabao','$goat','$horse','$dog','$sheep','$date')";

        // Execute the query
        $insert_query_run = $connection->query($insert_query);

        if ($insert_query_run === true) {
            $_SESSION['status'] = 'Created Successfully';
            header('location: /benguetlivestock/frontend/affected-animals.php');
        } else {
            throw new Exception("Creation failed");
        }
    } catch (Exception $e) {
        $_SESSION['status'] = 'Failed to Add: Update or delete existing data. Error: ' . $e->getMessage();
        header('location: /benguetlivestock/frontend/affected-animals.php');
    }
} elseif (isset($_POST['updateData'])) {
    // Update existing data
    $update_id = mysqli_real_escape_string($connection, $_POST['update_id']);

    $update_chicken = mysqli_real_escape_string($connection, $_POST['update_chicken']);
    $update_duck = mysqli_real_escape_string($connection, $_POST['update_duck']);
    $update_cattle = mysqli_real_escape_string($connection, $_POST['update_cattle']);
    $update_swine = mysqli_real_escape_string($connection, $_POST['update_swine']);
    $update_carabao = mysqli_real_escape_string($connection, $_POST['update_carabao']);
    $update_goat = mysqli_real_escape_string($connection, $_POST['update_goat']);
    $update_horse = mysqli_real_escape_string($connection, $_POST['update_horse']);
    $update_dog = mysqli_real_escape_string($connection, $_POST['update_dog']);
    $update_sheep = mysqli_real_escape_string($connection, $_POST['update_sheep']);

    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE affectedanimals SET chicken=?, duck=?,cattle=?,swine=?,carabao=?,goat=?,horse=?,dog=?,sheep=?,date_updated=? WHERE municipality_id=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "iiiiiiiiisi", $update_chicken, $update_duck, $update_cattle, $update_swine, $update_carabao, $update_goat, $update_horse, $update_dog, $update_sheep, $update_date, $update_id);

    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: /benguetlivestock/frontend/affected-animals.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: /benguetlivestock/frontend/affected-animals.php');
    }

} elseif (isset($_POST['deleteData'])) {
    // Delete data
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM affectedanimals WHERE municipality_id='$id'";
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
        $Chicken = isset($_POST['totalChicken']) ? $_POST['totalChicken'] : 0;
        $Duck = isset($_POST['totalDuck']) ? $_POST['totalDuck'] : 0;
        $Cattle = isset($_POST['totalCattle']) ? $_POST['totalCattle'] : 0;
        $Swine = isset($_POST['totalSwine']) ? $_POST['totalSwine'] : 0;
        $Carabao = isset($_POST['totalCarabao']) ? $_POST['totalCarabao'] : 0;
        $Goat = isset($_POST['totalGoat']) ? $_POST['totalGoat'] : 0;
        $Horse = isset($_POST['totalHorse']) ? $_POST['totalHorse'] : 0;
        $Dog = isset($_POST['totalDog']) ? $_POST['totalDog'] : 0;
        $Sheep = isset($_POST['totalSheep']) ? $_POST['totalSheep'] : 0;


        $affectedyear = isset($_POST['year']) ? $_POST['year'] : 0;
        $submitDateUpdated = isset($_POST['submitDateUpdated']) ? $_POST['submitDateUpdated'] : date('Y-m-d');

        // Perform the database insertion using prepared statements to prevent SQL injection
        $insertQuery = "INSERT INTO yearlyaffectedanimals (year, chicken, duck, cattle, swine, carabao, goat,
         horse, dog, sheep, date_updated) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($connection, $insertQuery);
        mysqli_stmt_bind_param(
            $stmt,
            "iiiiiiiiiis",
            $affectedyear,
            $Chicken,
            $Duck,
            $Cattle,
            $Swine,
            $Carabao,
            $Goat,
            $Horse,
            $Dog,
            $Sheep,
            $submitDateUpdated
        );

        if (mysqli_stmt_execute($stmt)) {
            session_start();
            $_SESSION['status'] = 'Total Count Submitted Successfully';
            header('location: /benguetlivestock/frontend/affected-animals.php');
            exit();
        } else {
            throw new Exception('Failed to execute the database insertion');
        }
    } catch (Exception $e) {
        session_start();
        $_SESSION['status'] = 'Failed: Year Already Exists!! '; //. $e->getMessage()
        header('location: /benguetlivestock/frontend/affected-animals.php');
        exit();
    }
} // Check if the delete request for the yearly form is received
elseif (isset($_POST['deleteDataYearly'])) {
    // Delete data
    $id_yearly = mysqli_real_escape_string($connection, $_POST['id_yearly']);

    $delete_query = "DELETE FROM yearlyaffectedanimals WHERE year='$id_yearly'";
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

    $update_chicken_yearly = mysqli_real_escape_string($connection, $_POST['update_chicken_yearly']);
    $update_duck_yearly = mysqli_real_escape_string($connection, $_POST['update_duck_yearly']);
    $update_cattle_yearly = mysqli_real_escape_string($connection, $_POST['update_cattle_yearly']);
    $update_swine_yearly = mysqli_real_escape_string($connection, $_POST['update_swine_yearly']);
    $update_carabao_yearly = mysqli_real_escape_string($connection, $_POST['update_carabao_yearly']);
    $update_goat_yearly = mysqli_real_escape_string($connection, $_POST['update_goat_yearly']);
    $update_horse_yearly = mysqli_real_escape_string($connection, $_POST['update_horse_yearly']);
    $update_dog_yearly = mysqli_real_escape_string($connection, $_POST['update_dog_yearly']);
    $update_sheep_yearly = mysqli_real_escape_string($connection, $_POST['update_sheep_yearly']);

    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE yearlyaffectedanimals SET chicken=?,duck=?, cattle=?, swine=?, 
    carabao=?, goat=?, horse=?, dog=?, sheep=?,  date_updated=? WHERE year=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param(
        $stmt,
        "iiiiiiiiisi",
        $update_chicken_yearly,
        $update_duck_yearly,
        $update_cattle_yearly,
        $update_swine_yearly,
        $update_carabao_yearly,
        $update_goat_yearly,
        $update_horse_yearly,
        $update_dog_yearly,
        $update_sheep_yearly,
        $update_date,
        $update_id
    );

    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: /benguetlivestock/frontend/affected-animals.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: /benguetlivestock/frontend/affected-animalstry.php');
    }
}


mysqli_close($connection);
?>