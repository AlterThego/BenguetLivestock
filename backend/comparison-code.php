<?php
// Define an array of municipalities and their IDs
$municipalities = [
    'Tuba' => 2603,
    'Bokod' => 2605,
    'Itogon' => 2604,
    'Atok' => 2612,
    'Sablan' => 2614,
    'Bakun' => 2610,
    'Buguias' => 2607,
    'Kabayan' => 2606,
    'Kibungan' => 2611,
    'LaTrinidad' => 2601,
    'Kapangan' => 2613,
    'Mankayan' => 2608,
    'Tublay' => 2615,

];

// Function to generate the content for a municipality
function generateMunicipalityContent($municipalityName, $municipalityId)
{
    ?>
    <div id="<?php echo strtolower($municipalityName); ?>-content" class="municipality-container" style="display: none;">
        <div class="card">
            <!-- <div class="card text-center p-2">
                <h4><b>
                        
                    </b></h4>
            </div> -->

            <!-- Title -->
            <div class="container-fluid">
                <div class="row justify-content-center ">
                    <div class="card p-3">
                        <h5 class="text-left font-weight-bold"><?php echo $municipalityName; ?>
                        </h5>
                    </div>
                </div>
            </div>

            <table class="row-border m-1" id="<?php echo strtolower($municipalityName); ?>-table">
                <?php
                $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                $fetch_query = "SELECT * FROM animalpopulation;";

                $fetch_query_run = mysqli_query($connection, $fetch_query);

                if (mysqli_num_rows($fetch_query_run) > 0) {
                    while ($row = mysqli_fetch_array($fetch_query_run)) {
                        if ($row['municipality_id'] == $municipalityId) {
                            // Iterate over columns and display data
                            foreach (['Carabao', 'Cattle', 'Swine', 'Goat', 'Dog', 'Sheep', 'Horse'] as $columnName) {
                                ?>
                                <tr>
                                    <th>
                                        <?php echo $columnName; ?>
                                    </th>
                                    <td>
                                        <?php
                                        // Display the formatted count
                                        echo number_format($row[strtolower(str_replace(' ', '_', $columnName)) . '_count' . ''], 0, '.', ',');

                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                }


                ?>


            </table>
        </div>
    </div>
    <?php
}

// Generate content for each municipality
foreach ($municipalities as $municipalityName => $municipalityId) {
    generateMunicipalityContent($municipalityName, $municipalityId);
}

?>