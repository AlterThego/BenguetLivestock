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
            <form action="/benguetlivestock/backend/fish-production-code.php" method="POST">
                <!-- Body -->
                <div class="modal-body">

                    <div class="form-group mb-3">
                        <label for="id" hidden>ID</label>
                        <input type="number" class="form-control" name="id" value="1" hidden>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="fish_pond_count">Fish Pond</label>
                                <input type="text" class="form-control" name="fish_pond_count"
                                    placeholder="Fish Pond Area" autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <label for="fish_tank_count">Fish in Tank</label>
                                <input type="text" class="form-control" name="fish_tank_count"
                                    placeholder="Fish in Tank Area" autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <label for="communal_water_count">Communal Bodies</label>
                                <input type="text" class="form-control" name="communal_water_count"
                                    placeholder="Communal Bodies of Water Area" autocomplete="off">
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="fish_cage_count">Fish Cage</label>
                                <input type="text" class="form-control" name="fish_cage_count"
                                    placeholder="Fish Cage Area" autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <label for="rice_fish_count">Rice-Fish Culture</label>
                                <input type="text" class="form-control" name="rice_fish_count"
                                    placeholder="Rice-Fish Culture Area" autocomplete="off">
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
            <form action="../backend/fish-production-code.php" method="POST">
                <div class="modal-body">

                    <div class="form-group mb-3" hidden>
                        <label for="update_fish_id">Fish ID</label>
                        <input type="text" class="form-control" name="update_fish_id" id="update_fish_id" hidden>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_pond_count">Update Fish Pond</label>
                                <input type="text" class="form-control" name="update_pond_count" id="update_pond_count">
                            </div>

                            <div class="form-group mb-3">
                                <label for="update_tank_count">Update Fish Tank</label>
                                <input type="text" class="form-control" name="update_tank_count" id="update_tank_count">
                            </div>
                            <div class="form-group mb-3">
                                <label for="update_communal_count">Update Communal Bodies</label>
                                <input type="text" class="form-control" name="update_communal_count"
                                    id="update_communal_count">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_cage_count">Update Fish Cage</label>
                                <input type="text" class="form-control" name="update_cage_count" id="update_cage_count">
                            </div>
                            <div class="form-group mb-3">
                                <label for="update_rice_count">Update Rice-Fish Culture</label>
                                <input type="text" class="form-control" name="update_rice_count" id="update_rice_count">
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
            <form method="post" action="/benguetlivestock/backend/fish-production-code.php">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="fishYear">Fish Production Year</label>
                        <input type="number" class="form-control" name="fishYear" value="<?php echo date('Y'); ?>"
                            min="1900" max="<?php echo date('Y'); ?>" required>
                    </div>

                    <table class="table table-bordered">
                        <tbody id="totalTableBody">

                        </tbody>

                        <tfoot>
                            <input type="hidden" name="totalPond" value="<?php echo $totalPond; ?>">
                            <input type="hidden" name="totalCage" value="<?php echo $totalCage; ?>">
                            <input type="hidden" name="totalTank" value="<?php echo $totalTank; ?>">
                            <input type="hidden" name="totalRiceCulture" value="<?php echo $totalRiceCulture; ?>">
                            <input type="hidden" name="totalCommunal" value="<?php echo $totalCommunal; ?>">
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


<!-- Update Modal Yearly-->
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
            <form action="/benguetlivestock/backend/fish-production-code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="update_year">Year</label>
                        <input type="text" class="form-control" name="update_year" id="update_year" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_pond_yearly">Yearly Fish Pond</label>
                        <input type="text" class="form-control" name="update_pond_yearly" id="update_pond_yearly" ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="update_cage_yearly">Yearly Fish Cage</label>
                        <input type="text" class="form-control" name="update_cage_yearly" id="update_cage_yearly" ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="update_tank_yearly">Yearly Fish Tank</label>
                        <input type="text" class="form-control" name="update_tank_yearly" id="update_tank_yearly" ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="update_rice_yearly">Yearly Rice-Fish Culture</label>
                        <input type="text" class="form-control" name="update_rice_yearly" id="update_rice_yearly" ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="update_communal_yearly">Yearly Communal Bodies of Water</label>
                        <input type="text" class="form-control" name="update_communal_yearly"
                            id="update_communal_yearly" ?>
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