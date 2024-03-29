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
            <form action="/benguetlivestock/backend/poultry-population-code.php" method="POST">
                <!-- Body -->
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="poultry_id" hidden>ID</label>
                        <input type="number" class="form-control" name="poultry_id" value="1" hidden>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="layers_count">Layers</label>
                                <input type="number" class="form-control" name="layers_count"
                                    placeholder="Layers Count">
                            </div>
                            <div class="form-group mb-3">
                                <label for="native_count">Native/ Range</label>
                                <input type="number" class="form-control" name="native_count"
                                    placeholder="Native Count">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="broiler_count">Broiler</label>
                                <input type="number" class="form-control" name="broiler_count"
                                    placeholder="Broiler Count">
                            </div>
                            <div class="form-group mb-3">
                                <label for="fighting_count">Fighting/ Fancy Fowl</label>
                                <input type="number" class="form-control" name="fighting_count"
                                    placeholder="Fighting Count">
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
            <form action="../backend/poultry-population-code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3" hidden>
                        <label for="update_poultry_id">Poultry ID</label>
                        <input type="text" class="form-control" name="update_poultry_id" id="update_poultry_id" hidden>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_layers_count">Update Layers</label>
                                <input type="number" class="form-control" name="update_layers_count"
                                    id="update_layers_count">
                            </div>
                            <div class="form-group mb-3">
                                <label for="update_native_count">Update Native</label>
                                <input type="number" class="form-control" name="update_native_count"
                                    id="update_native_count">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_broiler_count">Update Broiler</label>
                                <input type="number" class="form-control" name="update_broiler_count"
                                    id="update_broiler_count">
                            </div>
                            <div class="form-group mb-3">
                                <label for="update_fighting_count">Update Fighting</label>
                                <input type="number" class="form-control" name="update_fighting_count"
                                    id="update_fighting_count">
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
            <form method="post" action="/benguetlivestock/backend/poultry-population-code.php">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="poultryYear">Poultry Population Year</label>
                        <input type="number" class="form-control" name="poultryYear" value="<?php echo date('Y'); ?>"
                            min="1900" max="<?php echo date('Y'); ?>" required>
                    </div>

                    <table class="table table-bordered">
                        <tbody id="totalTableBody">

                        </tbody>

                        <tfoot>
                            <input type="hidden" name="totalLayers" value="<?php echo $totalLayers; ?>">
                            <input type="hidden" name="totalBroiler" value="<?php echo $totalBroiler; ?>">
                            <input type="hidden" name="totalNative" value="<?php echo $totalNative; ?>">
                            <input type="hidden" name="totalFighting" value="<?php echo $totalFighting; ?>">
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