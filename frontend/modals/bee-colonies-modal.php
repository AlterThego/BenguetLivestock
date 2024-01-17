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
            <form action="/benguetlivestock/backend/bee-colonies-code.php" method="POST">
                <!-- Body -->
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="zip">ZIP Code and Municipality</label>
                        <select class="form-control" name="zip">
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                            // Modify the query to exclude existing municipality_id values
                            $existing_ids_query = "SELECT DISTINCT municipality_id FROM beecolonies";
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
                                <label for="colonies_count">Honey Bee Colonies</label>
                                <input type="number" class="form-control" name="colonies_count"
                                    placeholder="Colonies Count">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="beekeepers_count">No. of Beekeepers</label>
                                <input type="number" class="form-control" name="beekeepers_count"
                                    placeholder="Beekeepers Count">
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
            <form action="../backend/bee-colonies-code.php" method="POST">
                <div class="modal-body">


                    <div class="form-group mb-3">
                        <label for="update_name">ZIP Code and Municipality</label>
                        <input type="text" class="form-control" name="update_name" id="update_name" readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_colonies_count">Update Honey Bee Colonies</label>
                                <input type="number" class="form-control" name="update_colonies_count"
                                    id="update_colonies_count">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_beekeepers_count">Update Number of Beekeepers</label>
                                <input type="number" class="form-control" name="update_beekeepers_count"
                                    id="update_beekeepers_count">
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
            <form method="post" action="/benguetlivestock/backend/bee-colonies-code.php">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="beeYear">Bee Year</label>
                        <input type="number" class="form-control" name="beeYear" value="<?php echo date('Y'); ?>"
                            min="1900" max="<?php echo date('Y'); ?>" required>
                    </div>

                    <table class="table table-bordered">
                        <tbody id="totalTableBody">

                        </tbody>

                        <tfoot>
                            <input type="hidden" name="totalHoneyBeeColonies"
                                value="<?php echo $totalHoneyBeeColonies; ?>">
                            <input type="hidden" name="totalBeekeepers" value="<?php echo $totalBeekeepers; ?>">
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