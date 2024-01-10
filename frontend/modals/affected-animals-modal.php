<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add data</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/benguetlivestock/backend/affected-animals-code.php" method="POST">
                <!-- Body -->
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="zip">ZIP Code and Municipality</label>
                        <select class="form-control" name="zip">
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                            // Modify the query to exclude existing municipality_id values
                            $existing_ids_query = "SELECT DISTINCT municipality_id FROM affectedanimals";
                            $existing_ids_result = mysqli_query($connection, $existing_ids_query);

                            $existing_ids = [];
                            while ($existing_row = mysqli_fetch_array($existing_ids_result)) {
                                $existing_ids[] = $existing_row['municipality_id'];
                            }

                            $fetch_types_query = "SELECT * FROM municipalities ORDER BY municipality_id ASC";
                            $fetch_types_query_run = mysqli_query($connection, $fetch_types_query);

                            $choices_available = false; // Flag to check if any choices are available
                            
                            while ($type_row = mysqli_fetch_array($fetch_types_query_run)) {
                                // Exclude existing ids from the dropdown
                                if (!in_array($type_row['municipality_id'], $existing_ids)) {
                                    $option_value = $type_row['municipality_id'] . ' - ' . $type_row['municipality_name'];
                                    echo "<option value='" . $option_value . "'>" . $option_value . "</option>";
                                    $choices_available = true; // Set the flag to true
                                }
                            }

                            // Check if there are no choices available
                            if (!$choices_available) {
                                echo "<option value='' disabled>No available choices anymore. Either update or delete</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="chicken_count">Chicken</label>
                        <input type="number" class="form-control" name="chicken_count" id="chicken_count"
                            placeholder="Enter Affected Chickens">
                    </div>
                    <div class="form-group mb-3">
                        <label for="duck_count">Duck</label>
                        <input type="number" class="form-control" name="duck_count" id="duck_count"
                            placeholder="Enter Affected Ducks">
                    </div>

                    <div class="form-group mb-3">
                        <label for="cattle_count">Cattle</label>
                        <input type="number" class="form-control" name="cattle_count" id="cattle_count"
                            placeholder="Enter Affected Cattles">
                    </div>

                    <div class="form-group mb-3">
                        <label for="swine_count">Swine</label>
                        <input type="number" class="form-control" name="swine_count" id="swine_count"
                            placeholder="Enter Affected Swine">
                    </div>

                    <div class="form-group mb-3">
                        <label for="carabao_count">Carabao</label>
                        <input type="number" class="form-control" name="carabao_count" id="carabao_count"
                            placeholder="Enter Affected Carabao">
                    </div>

                    <div class="form-group mb-3">
                        <label for="goat_count">Goat</label>
                        <input type="number" class="form-control" name="goat_count" id="goat_count"
                            placeholder="Enter Affected Goat">
                    </div>

                    <div class="form-group mb-3">
                        <label for="horse_count">Horse</label>
                        <input type="number" class="form-control" name="horse_count" id="horse_count"
                            placeholder="Enter Affected Horse">
                    </div>

                    <div class="form-group mb-3">
                        <label for="dog_count">Dog</label>
                        <input type="number" class="form-control" name="dog_count" id="dog_count"
                            placeholder="Enter Affected Dog">
                    </div>

                    <div class="form-group mb-3">
                        <label for="sheep_count">Sheep</label>
                        <input type="number" class="form-control" name="sheep_count" id="sheep_count"
                            placeholder="Enter Affected Sheep">
                    </div>



                    <div class="form-group mb-3">
                        <label for="date_updated">Date Updated</label>
                        <input type="date" class="form-control" name="date_updated"
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="savedata" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModal">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/benguetlivestock/backend/affected-animals-code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="update_name">ZIP Code and Municipality</label>
                        <input type="text" class="form-control" name="update_name" id="update_name" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_chicken">Chicken</label>
                        <input type="number" class="form-control" name="update_chicken" id="update_chicken" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_duck">Duck</label>
                        <input type="number" class="form-control" name="update_duck" id="update_duck" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_cattle">Cattle</label>
                        <input type="number" class="form-control" name="update_cattle" id="update_cattle" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_swine">Swine</label>
                        <input type="number" class="form-control" name="update_swine" id="update_swine" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_carabao">Carabao</label>
                        <input type="number" class="form-control" name="update_carabao" id="update_carabao" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_goat">Goat</label>
                        <input type="number" class="form-control" name="update_goat" id="update_goat" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_horse">Horse</label>
                        <input type="number" class="form-control" name="update_horse" id="update_horse" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_dog">Dog</label>
                        <input type="number" class="form-control" name="update_dog" id="update_dog" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_sheep">Sheep</label>
                        <input type="number" class="form-control" name="update_sheep" id="update_sheep" ?>
                    </div>


                    <div class="form-group mb-3">
                        <label for="update_date">Date Updated</label>
                        <input type="date" class="form-control" name="update_date" id="update_date"
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="update_id" id="update_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="updateData" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
    aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Submit -->
<div class="modal fade" id="submitTotalModal" tabindex="-1" role="dialog" aria-labelledby="submitTotalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTotalModalLabel">Total Count</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/benguetlivestock/backend/affected-animals-code.php">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="year">Year</label>
                        <input type="number" class="form-control" name="year" value="<?php echo date('Y'); ?>"
                            min="1900" max="<?php echo date('Y'); ?>" required>
                    </div>

                    <table class="table table-bordered">
                        <tbody id="totalTableBody">

                        </tbody>

                        <tfoot>
                            <input type="hidden" name="totalChicken" value="<?php echo $totalChicken; ?>">
                            <input type="hidden" name="totalDuck" value="<?php echo $totalDuck; ?>">
                            <input type="hidden" name="totalCattle" value="<?php echo $totalCattle; ?>">
                            <input type="hidden" name="totalSwine" value="<?php echo $totalSwine; ?>">
                            <input type="hidden" name="totalCarabao" value="<?php echo $totalCarabao; ?>">
                            <input type="hidden" name="totalGoat" value="<?php echo $totalGoat; ?>">
                            <input type="hidden" name="totalHorse" value="<?php echo $totalHorse; ?>">
                            <input type="hidden" name="totalDog" value="<?php echo $totalDog; ?>">
                            <input type="hidden" name="totalSheep" value="<?php echo $totalSheep; ?>">
                        </tfoot>
                    </table>

                    <div class="form-group mb-3">
                        <label for="submitDateUpdated">Date Updated</label>
                        <input type="date" class="form-control" name="submitDateUpdated" id="submitDateUpdated"
                            value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <h6>
                        Make sure the data is correct before submitting!
                    </h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submitData" class="btn btn-warning">Submit Total Count</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Delete Modal Yearly -->
<div class="modal fade" id="deleteConfirmationModalYearly" tabindex="-1" role="dialog"
    aria-labelledby="deleteConfirmationModalLabelYearly" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabelYearly">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteYearly">Delete</button>
            </div>
        </div>
    </div>
</div>


<!-- Update Modal -->
<div class="modal fade" id="updateModalYearly" tabindex="-1" role="dialog" aria-labelledby="updateModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalYearly">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/benguetlivestock/backend/affected-animals-code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="update_year">Year</label>
                        <input type="text" class="form-control" name="update_year" id="update_year" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_chicken_yearly">Chicken</label>
                        <input type="number" class="form-control" name="update_chicken_yearly"
                            id="update_chicken_yearly" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_duck_yearly">Duck</label>
                        <input type="number" class="form-control" name="update_duck_yearly" id="update_duck_yearly" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_cattle_yearly">Cattle</label>
                        <input type="number" class="form-control" name="update_cattle_yearly" id="update_cattle_yearly"
                            ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_swine_yearly">Swine</label>
                        <input type="number" class="form-control" name="update_swine_yearly" id="update_swine_yearly" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_carabao_yearly">Carabao</label>
                        <input type="number" class="form-control" name="update_carabao_yearly"
                            id="update_carabao_yearly" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_goat_yearly">Goat</label>
                        <input type="number" class="form-control" name="update_goat_yearly" id="update_goat_yearly" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_horse_yearly">Horse</label>
                        <input type="number" class="form-control" name="update_horse_yearly" id="update_horse_yearly" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_dog_yearly">Dog</label>
                        <input type="number" class="form-control" name="update_dog_yearly" id="update_dog_yearly" ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_sheep_yearly">Sheep</label>
                        <input type="number" class="form-control" name="update_sheep_yearly" id="update_sheep_yearly" ?>
                    </div>


                    <div class="form-group mb-3">
                        <label for="update_date">Date Updated</label>
                        <input type="date" class="form-control" name="update_date" id="update_date"
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="update_id" id="update_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="updateDataYearly" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>