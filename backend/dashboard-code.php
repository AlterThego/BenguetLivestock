<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT carabao_count, cattle_count, swine_count, goat_count, dog_count, sheep_count, horse_count, livestock_year FROM animaltrend";
$result = mysqli_query($connection, $sql);

$labels = [];
$carabaoData = [];
$cattleData = [];
$swineData = [];
$goatData = [];
$dogData = [];
$sheepData = [];
$horseData = [];
// Add similar arrays for other livestock

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['livestock_year'];
    $carabaoData[] = $row['carabao_count'];
    $cattleData[] = $row['cattle_count'];
    $swineData[] = $row['swine_count'];
    $goatData[] = $row['goat_count'];
    $dogData[] = $row['dog_count'];
    $sheepData[] = $row['sheep_count'];
    $horseData[] = $row['horse_count'];
    // Add similar lines for other livestock
}

$sql = "SELECT municipality_name, number FROM veterinarypoultrysupplies";
$resultveterinary = mysqli_query($connection, $sql);

$labels = [];
$numberData = [];

while ($row = mysqli_fetch_assoc($resultveterinary)) {
    $labels[] = $row['municipality_name'];
    $numberData[] = $row['number'];
}


// Close the database connection
mysqli_close($connection);
?>