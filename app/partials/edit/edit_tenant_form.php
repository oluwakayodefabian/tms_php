<!-- <section> -->
<!-- <div class="row">-->
<div class="col-md-11 col-xs-12 col-sm-12"><br>
    <div class="alert alert-info" role="alert">
        <?php
        if (isset($errMsg)) {
            echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
        }
        ?>
        <?php if (isset($_GET['successMsg'])) : ?>
            <div class="alert alert-success">
                <?= $_GET['successMsg'] ?>
            </div>
        <?php endif; ?>
        <h2 class="text-center">Update Tenant Information!</h2>
        <form action="" method="post">
            <input type="hidden" name="tenant_id" value="<?= $data['tenant_id'] ?>">
            <!-- <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0 row border-right mr-2">
                    <label for="amount_paid">Amount Paid<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="amount_paid" name="amount_paid" value="" required>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0 row border-right mr-2">
                    <label for="remaining_balance">Remaining Balance<span class="text-info">(enter balance if there's any)</span></label>
                    <input type="text" class="form-control" id="remaining_balance" name="remaining_balance" value="" required>
                </div>
            </div> -->
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0 row border-right mr-2">
                    <div class="col-sm-6">
                        <label for="rent_starting_date">Rent starting date<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="rent_starting_date" name="rent_starting_date" value="" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="rent_starting_time">Rent starting time<span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="rent_starting_time" name="rent_starting_time" value="" required>
                    </div>
                </div>
                <div class="col-sm-6 row">
                    <div class="col-sm-6">
                        <label for="rent_ending_date">Rent Expiry Date<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="rent_ending_date" name="rent_ending_date" value="" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="property_status">Rent Expiry time<span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="rent_ending_time" name="rent_ending_time" value="" required>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary btn-user btn-block" value="Edit" id="edit_tenant_btn" name="edit_tenant_info">
            <hr>
            <a href='../../tms_php/app/list_of_tenants.php' role="button" class="btn btn-info btn-user btn-block">Cancel Action</a>
        </form>
    </div>
</div>
</div>
</div>
<!-- </div> -->
<?php include '../include/footer.php'; ?>