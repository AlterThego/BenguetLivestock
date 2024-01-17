<!-- Add Modal -->
<div class="modal fade p-0" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add data</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/benguetlivestock/backend/poultry-trend-code.php" method="POST">
                <!-- Body -->
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="year">Year</label>
                        <?php
                        // Get the current year
                        $currentYear = date("Y");

                        // Set the default year to the next year
                        $defaultYear = $currentYear;
                        ?>
                        <input type="number" class="form-control" name="year" placeholder="Enter Year" min="1900"
                            max="2099" value="<?php echo $defaultYear; ?>">
                    </div>

                    <div class="row">
                        <div class="col-md-6">


                            <div class="form-group mb-3">
                                <label for="layers_count">Layers</label>
                                <input type="number" class="form-control" name="layers_count"
                                    placeholder="Yearly Layers">
                            </div>
                            <div class="form-group mb-3">
                                <label for="native_count">Native/Range</label>
                                <input type="number" class="form-control" name="native_count"
                                    placeholder="Yearly Native">
                            </div>



                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="broiler_count">Broiler</label>
                                <input type="number" class="form-control" name="broiler_count"
                                    placeholder="Yearly Broiler">
                            </div>
                            <div class="form-group mb-3">
                                <label for="fighting_count">Fancy Fowl</label>
                                <input type="number" class="form-control" name="fighting_count"
                                    placeholder="Yearly Fancy Fowl">
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
            <form action="/benguetlivestock/backend/poultry-trend-code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="update_year">Year</label>
                        <input type="number" class="form-control" name="update_year" id="update_year" readonly>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_layers">Update Layers</label>
                                <input type="number" class="form-control" name="update_layers" id="update_layers">
                            </div>
                            <div class="form-group mb-3">
                                <label for="update_native">Update Native/Range</label>
                                <input type="number" class="form-control" name="update_native" id="update_native">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_broiler">Update Broiler</label>
                                <input type="number" class="form-control" name="update_broiler" id="update_broiler">
                            </div>
                            <div class="form-group mb-3">
                                <label for="update_fighting">Update Fancy Fowl</label>
                                <input type="number" class="form-control" name="update_fighting" id="update_fighting">
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