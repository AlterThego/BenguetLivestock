<!-- Add Modal -->
<div class="modal fade" id="addModalProvincial" tabindex="-1" role="dialog" aria-labelledby="addModalLabelProvincial"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabelProvincial">Add data</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/benguetlivestock/backend/breeding-stations-code.php" method="POST">
                <!-- Body -->
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="add_year">Year</label>
                        <?php
                        // Get the current year
                        $currentYear = date("Y");

                        // Set the default year to the next year
                        $defaultYear = $currentYear;
                        ?>
                        <input type="number" class="form-control" name="add_year" placeholder="Enter Year" min="1900"
                            max="2099" value="<?php echo $defaultYear; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="station_number">Stations/ Farms</label>
                                <input type="number" class="form-control" name="station_number"
                                    placeholder="Enter Breeding Stations/Muliplier or Demo Farms Count">
                            </div>
                        </div>
                        <div class="col-md-6">
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
                    <button type="submit" name="savedataProvincial" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModalProvincial" tabindex="-1" role="dialog" aria-labelledby="updateModalProvincial"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalProvincial">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/benguetlivestock/backend/breeding-stations-code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="update_year">Year</label>
                        <input type="text" class="form-control" name="update_year" id="update_year" readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_number">Update Stations/Farms</label>
                                <input type="number" class="form-control" name="update_number" id="update_number" ?>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                    <button type="submit" name="updateDataProvincial" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteConfirmationModalProvincial" tabindex="-1" role="dialog"
    aria-labelledby="deleteConfirmationModalLabelProvincial" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabelProvincial">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteProvincial">Delete</button>
            </div>
        </div>
    </div>
</div>


<!-- SECOND TABLE -->
<!-- Add Modal -->
<div class="modal fade" id="addModalMunicipality" tabindex="-1" role="dialog"
    aria-labelledby="addModalLabelMunicipality" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add data</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/benguetlivestock/backend/breeding-stations-code.php" method="POST">
                <!-- Body -->
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="year">Year</label>
                                <?php
                                // Get the current year
                                $currentYear = date("Y");

                                // Set the default year to the next year
                                $defaultYear = $currentYear;
                                ?>
                                <input type="number" class="form-control" name="year" placeholder="Enter Year"
                                    min="1900" max="2099" value="<?php echo $defaultYear; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="latrinidad_number">La Trinidad</label>
                                <input type="number" class="form-control" name="latrinidad_number"
                                    placeholder="La Trinidad Stations and Farms">
                            </div>
                            <div class="form-group mb-3">
                                <label for="itogon_number">Itogon</label>
                                <input type="number" class="form-control" name="itogon_number"
                                    placeholder="Itogon Stations and Farms">
                            </div>
                            <div class="form-group mb-3">
                                <label for="kabayan_number">Kabayan</label>
                                <input type="number" class="form-control" name="kabayan_number"
                                    placeholder="Kabayan Stations and Farms">
                            </div>

                            <div class="form-group mb-3">
                                <label for="mankayan_number">Mankayan</label>
                                <input type="number" class="form-control" name="mankayan_number"
                                    placeholder="Mankayan Stations and Farms">
                            </div>
                            <div class="form-group mb-3">
                                <label for="kibungan_number">Kibungan</label>
                                <input type="number" class="form-control" name="kibungan_number"
                                    placeholder="Kibungan Stations and Farms">
                            </div>

                            <div class="form-group mb-3">
                                <label for="kapangan_number">Kapangan</label>
                                <input type="number" class="form-control" name="kapangan_number"
                                    placeholder="Kapangan Stations and Farms">
                            </div>

                            <div class="form-group mb-3">
                                <label for="tublay_number">Tublay</label>
                                <input type="number" class="form-control" name="tublay_number"
                                    placeholder="Tublay Stations and Farms">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="tuba_number">Tuba</label>
                                <input type="number" class="form-control" name="tuba_number"
                                    placeholder="Tuba Stations and Farms">
                            </div>

                            <div class="form-group mb-3">
                                <label for="bokod_number">Bokod</label>
                                <input type="number" class="form-control" name="bokod_number"
                                    placeholder="Bokod Stations and Farms">
                            </div>
                            <div class="form-group mb-3">
                                <label for="buguias_number">Buguias</label>
                                <input type="number" class="form-control" name="buguias_number"
                                    placeholder="Buguias Stations and Farms">
                            </div>
                            <div class="form-group mb-3">
                                <label for="bakun_number">Bakun</label>
                                <input type="number" class="form-control" name="bakun_number"
                                    placeholder="Bakun Stations and Farms">
                            </div>

                            <div class="form-group mb-3">
                                <label for="atok_number">Atok</label>
                                <input type="number" class="form-control" name="atok_number"
                                    placeholder="Atok Stations and Farms">
                            </div>
                            <div class="form-group mb-3">
                                <label for="sablan_number">Sablan</label>
                                <input type="number" class="form-control" name="sablan_number"
                                    placeholder="Sablan Stations and Farms">
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
                    <button type="submit" name="savedataMunicipality" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModalMunicipality" tabindex="-1" role="dialog"
    aria-labelledby="updateModalMunicipality" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalMunicipality">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/benguetlivestock/backend/breeding-stations-code.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_year_municipality">Year</label>
                                <input type="number" class="form-control" name="update_year_municipality"
                                    id="update_year_municipality" readonly>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_latrinidad">Update La Trinidad</label>
                                <input type="number" class="form-control" name="update_latrinidad"
                                    id="update_latrinidad" ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="update_itogon">Update Itogon</label>
                                <input type="number" class="form-control" name="update_itogon" id="update_itogon">
                            </div>

                            <div class="form-group mb-3">
                                <label for="update_kabayan">Update Kabayan</label>
                                <input type="number" class="form-control" name="update_kabayan" id="update_kabayan">
                            </div>

                            <div class="form-group mb-3">
                                <label for="update_mankayan">Update Mankayan</label>
                                <input type="number" class="form-control" name="update_mankayan" id="update_mankayan">
                            </div>
                            <div class="form-group mb-3">
                                <label for="update_kibungan">Update Kibungan</label>
                                <input type="number" class="form-control" name="update_kibungan" id="update_kibungan">
                            </div>

                            <div class="form-group mb-3">
                                <label for="update_kapangan">Update Kapangan</label>
                                <input type="number" class="form-control" name="update_kapangan" id="update_kapangan">
                            </div>

                            <div class="form-group mb-3">
                                <label for="update_tublay">Update Tublay</label>
                                <input type="number" class="form-control" name="update_tublay" id="update_tublay">
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="update_tuba">Update Tuba</label>
                                <input type="number" class="form-control" name="update_tuba" id="update_tuba">
                            </div>
                            <div class="form-group mb-3">
                                <label for="update_bokod">Update Bokod</label>
                                <input type="number" class="form-control" name="update_bokod" id="update_bokod">
                            </div>
                            <div class="form-group mb-3">
                                <label for="update_buguias">Update Buguias</label>
                                <input type="number" class="form-control" name="update_buguias" id="update_buguias">
                            </div>

                            <div class="form-group mb-3">
                                <label for="update_bakun">Update Bakun</label>
                                <input type="number" class="form-control" name="update_bakun" id="update_bakun">
                            </div>
                            <div class="form-group mb-3">
                                <label for="update_atok">Update Atok</label>
                                <input type="number" class="form-control" name="update_atok" id="update_atok">
                            </div>

                            <div class="form-group mb-3">
                                <label for="update_sablan">Update Sablan</label>
                                <input type="number" class="form-control" name="update_sablan" id="update_sablan">
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
                    <button type="submit" name="updateDataMunicipality" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteConfirmationModalMunicipality" tabindex="-1" role="dialog"
    aria-labelledby="deleteConfirmationModalLabelMunicipality" aria-hidden="true">
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
                <button type="button" class="btn btn-danger" id="confirmDeleteMunicipality">Delete</button>
            </div>
        </div>
    </div>
</div>