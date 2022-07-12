<?php
$property = '';

try {
	$stmt = $connect->prepare('SELECT * FROM properties WHERE property_id = :property_id');
	$stmt->execute([':property_id' => $_GET['property_id']]);
	$data2 = $stmt->fetch(PDO::FETCH_ASSOC);
	$property = $data2;
} catch (PDOException $e) {
	$errMsg = $e->getMessage();
}

?>
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
		<h2 class="text-center">Application Form</h2>
		<form action="" method="post">
			<div class="form-group row">
				<div class="col-sm-6 mb-3 mb-sm-0">
					<label for="first_name">First Name</label>
					<input type="text" class="form-control form-control-user" id="first_name" name="first_name" placeholder="Enter tenant's first name" value="" required>
				</div>
				<div class="col-sm-6 mb-3 mb-sm-0">
					<label for="last_name">Last Name</label>
					<input type="text" class="form-control form-control-user" id="last_name" name="last_name" placeholder="Enter tenant's last name" value="" required>
				</div>
				<!-- <div class="col-sm-4 mb-3 mb-sm-0">
					<label for="last_name">Give the tenant a password</label>
					<input type="text" class="form-control form-control-user" id="password" name="password" placeholder="Enter tenant's password" value="tms2022" required>
				</div> -->
			</div>
			<div class="form-group row">
				<div class="col-sm-6 mb-3 mb-sm-0">
					<div class="form-check">
						<p class="lead">Choose a gender</p>
						<input class="form-check-input" type="radio" name="gender" id="gender" value="male" required>
						<label class="form-check-label" for="gender">
							Male
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="gender" id="gender" value="female" required>
						<label class="form-check-label" for="gender">
							Female
						</label>
					</div>
				</div>
				<div class="col-sm-6 mb-3 mb-sm-0">
					<label for="email_address">Email Address</label>
					<input type="text" class="form-control form-control-user" id="email_address" name="email_address" placeholder="Enter tenant's email Address" value="" required>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-6 mb-3 mb-sm-0">
					<label for="admin">tenant's state of origin</label>
					<select onchange="toggleLGA(this);" name="state" id="state" class="custom-select" required>
						<option value="" selected="selected">- Select -</option>
						<option value="Abia">Abia</option>
						<option value="Adamawa">Adamawa</option>
						<option value="AkwaIbom">AkwaIbom</option>
						<option value="Anambra">Anambra</option>
						<option value="Bauchi">Bauchi</option>
						<option value="Bayelsa">Bayelsa</option>
						<option value="Benue">Benue</option>
						<option value="Borno">Borno</option>
						<option value="Cross River">Cross River</option>
						<option value="Delta">Delta</option>
						<option value="Ebonyi">Ebonyi</option>
						<option value="Edo">Edo</option>
						<option value="Ekiti">Ekiti</option>
						<option value="Enugu">Enugu</option>
						<option value="FCT">FCT</option>
						<option value="Gombe">Gombe</option>
						<option value="Imo">Imo</option>
						<option value="Jigawa">Jigawa</option>
						<option value="Kaduna">Kaduna</option>
						<option value="Kano">Kano</option>
						<option value="Katsina">Katsina</option>
						<option value="Kebbi">Kebbi</option>
						<option value="Kogi">Kogi</option>
						<option value="Kwara">Kwara</option>
						<option value="Lagos">Lagos</option>
						<option value="Nasarawa">Nasarawa</option>
						<option value="Niger">Niger</option>
						<option value="Ogun">Ogun</option>
						<option value="Ondo">Ondo</option>
						<option value="Osun">Osun</option>
						<option value="Oyo">Oyo</option>
						<option value="Plateau">Plateau</option>
						<option value="Rivers">Rivers</option>
						<option value="Sokoto">Sokoto</option>
						<option value="Taraba">Taraba</option>
						<option value="Yobe">Yobe</option>
						<option value="Zamfara">Zamafara</option>
					</select>
				</div>
				<div class="col-sm-6 mb-3 mb-sm-0">
					<label for="admin">Tenant's LGA</label>
					<select class="custom-select select-lga" id="lga" name="lga" required>

					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-6 mb-3 mb-sm-0">
					<label for="admin">Phone Number</label>
					<input type="tel" class="form-control form-control-user" id="phone_number" name="phone_number" placeholder="Enter your phone number" value="" required>
				</div>
				<div class="col-sm-6 mb-3 mb-sm-0">
					<label for="admin">Select a Property</label>
					<select class="custom-select" id="property" name="property" required>
						<option value="<?= $property['property_id'] ?>">The property at <?= $property['address'] . ', ' . $property['city'] . ', ' . $property['state'] ?></option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-6">
					<label for="admin">Select a Duration</label>
					<select class="custom-select" id="duration" name="duration" required>
						<option value="1">1 year</option>
						<option value="2">2 years</option>
						<option value="1">3 years</option>
						<option value="1">4 years</option>
					</select>
				</div>
			</div>
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
			<!-- <div class="form-group row">
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
			</div> -->
			<input type="submit" class="btn btn-primary btn-user btn-block" value="Apply" id="add_user_btn" name="application_btn">
			<hr>
			<a href='../index.php' role="button" class="btn btn-info btn-user btn-block">Cancel Action</a>

			<!-- <button type="submit" class="btn btn-danger" name='register_tenant' value="register_tenant">Submit</button> -->
		</form>
	</div>
</div>
</div>
</div>
<!-- </div> -->
<?php include '../include/footer.php'; ?>