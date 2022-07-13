<?php
require '../config/config.php';
if (empty($_SESSION['username']))
	header('Location: login.php');

$data = '';
try {
	if ($_SESSION['role'] == 'agent') {
		$stmt = $connect->prepare('SELECT * FROM properties WHERE admin_id=:admin_id');
		$stmt->execute([
			":admin_id" => $_SESSION['admin_id']
		]);
		$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$data = $data2;
	} elseif ($_SESSION['role'] == 'super_admin') {
		$stmt = $connect->prepare('SELECT * FROM properties');
		$stmt->execute();
		$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$data = $data2;
	}
} catch (PDOException $e) {
	$errMsg = $e->getMessage();
}

?>
<?php include '../include/header.php'; ?>

<?php require_once '../include/sideBar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">

	<!-- Main Content -->
	<div id="content">
		<!-- Topbar -->
		<?php require_once("../include/topBar.php") ?>
		<!-- End of Topbar -->

		<!-- Begin Page Content -->
		<div class="container-fluid">
			<?php if (isset($_GET['successMsg'])) : ?>
				<div class="alert alert-success">
					<?= $_GET['successMsg'] ?>
				</div>
			<?php endif; ?>
			<!-- Page Heading -->
			<h1 class="h3 m-4 text-gray-800">Manage Properties</h1>
			<?php
			if (isset($errMsg)) {
				echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
			}
			?>
			<!-- List of properties -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-info">List of Properties</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-borderless table-hover">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Location</th>
									<th scope="col">Address</th>
									<th scope="col">Annual Rent</th>
									<th scope="col">Description</th>
									<th scope="col">Property Status</th>
									<?php if ($_SESSION['role'] == 'super_admin') : ?>
										<th scope="col">Assigned Status</th>
										<th scope="col">Assigned To</th>
									<?php endif; ?>
									<!-- <th scope="col">Tenant</th> -->
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if (count($data)) : ?>
									<?php foreach ($data as $key => $value) : ?>
										<tr>
											<td scope="row"><?= $key + 1 ?></th>
											<td><?= $value['country'] . ',' . $value['state'] . ' - ' . $value['city'] ?></td>
											<td><?= $value['address'] ?></td>
											<td><?= number_format($value['rent_amount'], 2) ?></td>
											<td><?= $value['description'] ?></td>
											<td><?= $value['property_status'] ?></td>
											<?php if ($_SESSION['role'] == 'super_admin') : ?>
												<td><?= $value['assigned_status'] ?></td>
												<?php if (!is_null($value['admin_id'])) : ?>
													<td><button class="btn btn-success float-right" value="<?= $value['admin_id'] ?>" data-toggle="modal" data-target="#exampleModal" id="showAssignedAgent">Click to view the agent it is assigned to</button></td>
												<?php else : ?>
													<td class="badge badge-danger">Not assigned to any agent yet</td>
												<?php endif; ?>
												<td> <a class="btn btn-warning float-right" href="update.php?id=<?= $value['property_id'] ?>">Edit</a></td>
											<?php else : ?>
												<td> <a class="btn btn-info float-right" href="applyFor_rent_list.php?property_id=<?= $value['property_id'] ?>">View applicants</a></td>

											<?php endif; ?>
										</tr>
									<?php endforeach; ?>
								<?php else : ?>
									<h1>No properties has been assigned to you yet!</h1>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- End of Main Content -->

	<!-- Footer -->
	<footer class="sticky-footer bg-white">
		<div class="container my-auto">
			<div class="copyright text-center my-auto">
				<span>Copyright &copy; Your Website 2020</span>
			</div>
		</div>
	</footer>
	<!-- End of Footer -->

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="card text-center" style="width: 100%;">
					<img src="" class="card-img-top" alt="image of property" id="property_image" style="height: 300px">
					<div class="card-body">
						<p class="h4 text-dark" id="info">
							<!-- data will be inserted using AJAX -->
						</p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<?php include '../include/footer.php'; ?>