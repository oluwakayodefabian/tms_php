<!-- <div class="row"> -->
<div class="col-md-11 col-xs-12 col-sm-12">
	<div>
		<?php
		if (isset($errMsg)) {
			echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
		}
		?>
		<h2 class="text-center">Edit Property Details!</h2>
		<?php if (isset($validationErrors)) : ?>
			<?php if (is_array($validationErrors)) : ?>
				<?php foreach ($validationErrors as $error) : ?>
					<div class="alert alert-danger" role="alert"><?= $error ?></div>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php endif; ?>
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="property_id" value="<?= $data['property_id'] ?>">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="country">Country</label>
						<input type="country" class="form-control" id="country" placeholder="Country" name="country" value="<?php echo $data['country'] ? $data['country'] : ''; ?>" required>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="state">State</label>
						<input type="state" class="form-control" id="state" placeholder="State" name="state" value="<?php echo $data['state'] ? $data['state'] : ''; ?>" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="city">City</label>
						<input type="city" class="form-control" id="city" placeholder="City" name="city" value="<?php echo $data['city'] ? $data['city'] : ''; ?>" required>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="rent">Rent</label>
						<input type="rent" class="form-control" id="rent_amount" placeholder="Rent" name="rent_amount" value="<?php echo $data['rent_amount'] ? $data['rent_amount'] : ''; ?>" required>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="description">Description</label>
						<input type="description" class="form-control" id="description" placeholder="Description" name="description" value="<?php echo $data['description'] ? $data['description'] : ''; ?>" required>
					</div>
				</div>


				<div class="col-md-4">
					<div class="form-group">
						<label for="address">Address</label>
						<input type="address" class="form-control" id="address" placeholder="Address" name="address" value="<?php echo $data['address'] ? $data['address'] : ''; ?>" required>
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="vacant">Vacant/Occupied</label>
						<select class="form-control" id="vacant" name="property_status">
							<option value="vacant" <?php if ($data['property_status'] == 'vacant') {
														echo 'selected';
													} ?>>Vacant</option>
							<option value="occupied" <?php if ($data['property_status'] == 'occupied') {
															echo 'selected';
														} ?>>Occupied</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="image">Image</label>
						<input type="file" class="form-control" name="image" id="image" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="image">Assign the property to an agent</label>
						<select name="agent_id" id="agent_id" class="form-control" required>
							<option value="">select an agent</option>
							<?php foreach ($agents as $agent) : ?>
								<option value="<?= $agent['admin_id'] ?>"><?= $agent['first_name'] . ' ' . $agent['last_name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary" name='edit_property'>Submit</button>
		</form>
	</div>
</div>
<!-- </div> -->