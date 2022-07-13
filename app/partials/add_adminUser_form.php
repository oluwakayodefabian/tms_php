<!-- <section> -->
<!-- <div class="row">-->
<div class="col-md-11 col-xs-12 col-sm-12"><br>
    <div>
        <?php
        if (isset($errMsg)) {
            echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
        }
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h2 text-gray-900 mb-4">Create an Agent Account!</h1>
                    </div>
                    <?php if (isset($validationErrors)) : ?>
                        <?php if (is_array($validationErrors)) : ?>
                            <?php foreach ($validationErrors as $error) : ?>
                                <div class="alert alert-danger" role="alert"><?= $error ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="first_name">First name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First name" value="<?= $first_name ?>" />
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="last_name">Last name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last name" value="<?= $last_name ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="admin_username">Username<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="admin_username" name="admin_username" placeholder="Enter username" value="<?= $username == '' ?  uniqid('username') : $username ?>" />
                                <small id="usernameHelpBlock" class="form-text text-primary">
                                    The username above was generated automatically be the system. You can change it to a preferred username of your choice.
                                </small>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="admin_email">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-user" id="admin_email" name="admin_email" placeholder="Email Address" value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="current-password">Password<span class="text-danger">*</span></label>
                                <div id="current-pwd-container">
                                    <span id="toggle-pwd" title="see password"><i class="fas fa-eye fa-2x"></i></span>
                                    <input type="password" class="form-control form-control-user" id="current-password" placeholder="Enter Password" name="admin_password">
                                </div>
                                <small id="passwordHelpBlock" class="form-text text-primary">
                                    The password above was generated automatically be the system.
                                </small>
                            </div>
                            <div class="col-sm-6">
                                <label for="admin">Choose a role for the user<span class="text-danger">*</span></label>
                                <select class="custom-select" id="role" name="role">
                                    <option value="agent">agent</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="admin">Assign a property to this agent <span class="text-danger">*</span></label>
                                <select class="custom-select" id="property_id" name="property_id">
                                    <option value="">
                                        select a property
                                    </option>
                                    <?php foreach ($data as $property) : ?>
                                        <option value="<?= $property['property_id'] ?>">The property at <?= $property['address'] . ', ' . $property['city'] . ', ' . $property['state'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Register Account" id="admin_register" name="admin_register">
                        <hr>
                        <a href="../app/adminUsers.php" class="btn btn-info btn-user btn-block">Cancel</a>
                    </form>
                </div>
            </div>
        </div>



    </div>
</div>
</div>
</div>
<!-- </div> -->
<?php include '../include/footer.php'; ?>