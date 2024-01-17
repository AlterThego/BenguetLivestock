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
            <form action="/benguetlivestock/backend/livestock-volume-code.php" method="POST">
                <!-- Body -->
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="zip">ZIP Code and Municipality</label>
                        <select class="form-control" name="zip">
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                            // Modify the query to exclude existing municipality_id values
                            $existing_ids_query = "SELECT DISTINCT municipality_id FROM livestockvolume";
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="cattle_volume">Cattle</label>
                                <input type="number" class="form-control" name="cattle_volume"
                                    placeholder="Cattle Count">
                            </div>
                            <div class="form-group mb-3">
                                <label for="carabao_volume">Carabao</label>
                                <input type="number" class="form-control" name="carabao_volume"
                                    placeholder="Carabao Count">
                            </div>
                            <div class="form-group mb-3">
                                <label for="chicken_volume">Chicken</label>
                                <input type="number" class="form-control" name="chicken_volume"
                                    placeholder="Chicken Count">
                            </div>


                            <div class="form-group mb-3">
                                <label for="fish_volume">Fish</label>
                                <input type="number" class="form-control" name="fish_volume" placeholder="Fish Count">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="swine_volume">Swine</label>
                                <input type="number" class="form-control" name="swine_volume" placeholder="Swine Count">
                            </div>


                            <div class="form-group mb-3">
                                <label for="goat_volume">Goat</label>
                                <input type="number" class="form-control" name="goat_volume" placeholder="Goat Count">
                            </div>


                            <div class="form-group mb-3">
                                <label for="duck_volume">Duck</label>
                                <input type="number" class="form-control" name="duck_volume" placeholder="Duck Count">
                            </div>

                            <div class="form-group mb-3">
                                <label for="date_updated">Date Updated</label>
                                <input type="date" class="form-control" name="date_updated"
                                    value="<?php echo date('Y-m-d'); ?>">
                            </div>

                        </div>
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
            <form action="/benguetlivestock/backend/livestock-volume-code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="update_name">ZIP Code and Municipality</label>
                        <input type="text" class="form-control" name="update_name" id="update_name" readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_cattle_volume">Update Cattle</label>
                                <input type="number" class="form-control" name="update_cattle_volume"
                                    id="update_cattle_volume" ?>
                            </div>

                            <div class="form-group mb-3">
                                <label for="update_carabao_volume">Update Carabao</label>
                                <input type="number" class="form-control" name="update_carabao_volume"
                                    id="update_carabao_volume">
                            </div>

                            <div class="form-group mb-3">
                                <label for="update_chicken_volume">Update Chicken</label>
                                <input type="number" class="form-control" name="update_chicken_volume"
                                    id="update_chicken_volume">
                            </div>


                            <div class="form-group mb-3">
                                <label for="update_fish_volume">Update Fish</label>
                                <input type="number" class="form-control" name="update_fish_volume"
                                    id="update_fish_volume">
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_swine_volume">Update Swine</label>
                                <input type="number" class="form-control" name="update_swine_volume"
                                    id="update_swine_volume">
                            </div>

                            <div class="form-group mb-3">
                                <label for="update_goat_volume">Update Goat</label>
                                <input type="number" class="form-control" name="update_goat_volume"
                                    id="update_goat_volume">
                            </div>


                            <div class="form-group mb-3">
                                <label for="update_duck_volume">Update Duck</label>
                                <input type="number" class="form-control" name="update_duck_volume"
                                    id="update_duck_volume">
                            </div>


                            <div class="form-group mb-3">
                                <label for="update_date">Date Updated</label>
                                <input type="date" class="form-control" name="update_date" id="update_date"
                                    value="<?php echo date('Y-m-d'); ?>">
                            </div>


                        </div>
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
<div class="modal fade" id="submitTotalVolumeModal" tabindex="-1" role="dialog"
    aria-labelledby="submitTotalVolumeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTotalModalLabel">Total Count</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/benguetlivestock/backend/livestock-volume-code.php">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="livestockVolumeYear">Livestock Year</label>
                        <input type="number" class="form-control" name="livestockVolumeYear"
                            value="<?php echo date('Y'); ?>" min="1900" max="<?php echo date('Y'); ?>" required>
                    </div>

                    <table class="table table-bordered">
                        <tbody id="totalVolumeTableBody">

                        </tbody>

                        <tfoot>
                            <input type="hidden" name="totalCattleVolume" value="<?php echo $totalCattleVolume; ?>">
                            <input type="hidden" name="totalSwineVolume" value="<?php echo $totalSwineVolume; ?>">
                            <input type="hidden" name="totalCarabaoVolume" value="<?php echo $totalCarabaoVolume; ?>">
                            <input type="hidden" name="totalGoatVolume" value="<?php echo $totalGoatVolume; ?>">
                            <input type="hidden" name="totalChickenVolume" value="<?php echo $totalChickenVolume; ?>">
                            <input type="hidden" name="totalDuckVolume" value="<?php echo $totalDuckVolume; ?>">
                            <input type="hidden" name="totalFishVolume" value="<?php echo $totalFishVolume; ?>">
                        </tfoot>
                    </table>

                    <div class="form-group mb-3">
                        <label for="submitVolumeDateUpdated">Date Updated</label>
                        <input type="date" class="form-control" name="submitVolumeDateUpdated"
                            id="submitVolumeDateUpdated" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <h6>
                        Make sure the data is correct before submitting!
                    </h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submitVolumeData" class="btn btn-warning">Submit Total Count</button>
                </div>
            </form>
        </div>
    </div>
</div>