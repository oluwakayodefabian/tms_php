<!-- <div class="row"> -->
<div class="col-md-11 col-xs-12 col-sm-12">
    <div class="alert alert-info" role="alert">
        <?php if (isset($_GET['successMsg'])) : ?>
            <div class="text-success text-center h4 bg-light rounded"><?= $_GET['successMsg'] ?></div>;
        <?php endif; ?>
        <h2 class="text-center">Complaints</h2>
        <?php if (isset($validationErrors)) : ?>
            <?php if (is_array($validationErrors)) : ?>
                <?php foreach ($validationErrors as $error) : ?>
                    <div class="alert alert-danger" role="alert"><?= $error ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
        <form action="" method="post">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="complaint_title">Title of Complaint</label>
                        <input type="text" class="form-control" id="complaint_title" placeholder="Title of complaint" name="complaint_title" required>
                        <!-- HIDDEN FIELDS -->
                        <input type="hidden" class="form-control" id="property_id" placeholder="Name of property" name="property_id" value="<?= $data['property_id'] ?>">
                        <input type="hidden" name="tenant_id" value="<?php echo $_SESSION['tenant_id']; ?>">
                        <input type="hidden" name="fullname" value="<?php echo $_SESSION['fullname']; ?>">
                        <!-- // HIDDEN FIELDS -->
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="complaint">Complaint</label>
                        <textarea name="complaint" class="form-control" id="complaint" placeholder="Enter complaint" required></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name='register_complaint' value="register">Make Complaint</button>
        </form>
    </div>
</div>
<!-- </div> -->