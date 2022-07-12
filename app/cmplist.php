<?php
require '../config/config.php';
if (empty($_SESSION['username']))
	header('Location: login.php');

if ($_SESSION['role'] !== 'agent') {
	header('Location: ../auth/dashboard.php?errMsg=You can\'t view requested page');
}
$data = '';

try {
	if ($_SESSION['role'] == 'agent') {
		$stmt = $connect->prepare('SELECT * FROM complaints INNER JOIN properties ON complaints.property_id=properties.property_id');
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
			<h1 class="h3 m-4 text-gray-800">Manage Complaints</h1>
			<?php
			if (isset($errMsg)) {
				echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
			}
			?>
			<!-- List of tenants -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-info">List of Complaints</h6>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-hover table-responsive">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Property</th>
								<th scope="col">Complaint Title</th>
								<th scope="col">Complaints</th>
								<th scope="col">Full Name</th>
								<th scope="col">Is the person a tenant?</th>
								<th scope="col">Date of complaint</th>
								<th colspan="3">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($data as $key => $value) : ?>
								<tr>
									<td><?= $key + 1 ?></td>
									<td><?= $value['address'] . ', ' . $value['city'] . ', ' . $value['country'] ?></td>
									<td><?= $value['complaint_title'] ?></td>
									<td><?= $value['complaint'] ?></td>
									<td><?= $value['fullname'] ?></td>
									<td><?= $value['tenant'] ?></td>
									<td><?= date('M dS Y H:i:s A', strtotime($value['created_on'])) ?></td>
									<td><a href="respond.php?cmp_id=<?= $value['complaint_id'] ?>" class="btn btn-info">Respond</a></td>
								</tr>
							<?php endforeach; ?>

						</tbody>
					</table>
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
				<span>Copyright &copy; TMS 2022</span>
			</div>
		</div>
	</footer>
	<!-- End of Footer -->

</div>


<?php include '../include/footer.php'; ?>