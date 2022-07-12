<!-- <div class="row"> -->
<div class="col-md-11 col-xs-12 col-sm-12">
	<div>
		<?php
		if (isset($errMsg)) {
			echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
		}
		?>
		<h2 class="text-center">Register Property</h2>
		<?php if (isset($validationErrors)) : ?>
			<?php if (is_array($validationErrors)) : ?>
				<?php foreach ($validationErrors as $error) : ?>
					<div class="alert alert-danger" role="alert"><?= $error ?></div>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php endif; ?>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="country">Country</label>
						<input type="country" class="form-control" id="country" placeholder="Country" name="country" value="<?= $country ?>" required>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="state">State</label>
						<input type="state" class="form-control" id="state" placeholder="State" name="state" value="<?= $state ?>" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="city">City</label>
						<input type="city" class="form-control" id="city" placeholder="City" name="city" value="<?= $city ?>" required>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="rent_amount">Rent</label>
						<input type="rent" class="form-control" id="rent_amount" placeholder="Rent" name="rent_amount" value="<?= $rent_amount ?>" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" id="description" class="form-control"><?= $description ?></textarea>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="address">Address</label>
						<input type="address" class="form-control" id="address" placeholder="Address" name="address" value="<?= $address ?>" required>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="property_status">Vacant/Occupied</label>
						<select class="form-control" id="property_status" name="property_status">
							<option value="vacant">Vacant</option>
							<option value="occupied">Occupied</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="image">Property Image</label>
						<input type="file" name="image" id="image" class="form-control">
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-success" name='register_properties' value="register_properties">Submit</button>
		</form>
	</div>
</div>
<!-- </div> -->