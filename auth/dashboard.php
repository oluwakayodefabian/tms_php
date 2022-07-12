<?php
require '../config/config.php';
if (empty($_SESSION['username']))
	header('Location: login.php');

if ($_SESSION['role'] == 'agent') {
	// Total number of tenants
	// $stmt = $connect->prepare('SELECT count(*) as registered_tenants FROM tenants');
	$stmt = $connect->prepare('SELECT count(*) as registered_tenants FROM properties WHERE admin_id=:admin_id');
	$stmt->execute([':admin_id' => $_SESSION['admin_id']]);
	$total_num_of_tenants = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif ($_SESSION['role'] == 'super_admin') {
	// Total number of tenants
	// $stmt = $connect->prepare('SELECT count(*) as registered_tenants FROM tenants');
	$stmt = $connect->prepare('SELECT count(*) as registered_tenants FROM properties');
	$stmt->execute();
	$total_num_of_tenants = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SESSION['role'] == 'agent') {
	// Total number of properties
	$stmt = $connect->prepare('SELECT count(*) as total_num_of_properties FROM properties WHERE admin_id=:admin_id');
	$stmt->execute([':admin_id' => $_SESSION['admin_id']]);
	$total_num_of_properties = $stmt->fetch(PDO::FETCH_ASSOC);
} else if ($_SESSION['role'] == 'super_admin') {
	// Total number of properties
	$stmt = $connect->prepare('SELECT count(*) as total_num_of_properties FROM properties');
	$stmt->execute();
	$total_num_of_properties = $stmt->fetch(PDO::FETCH_ASSOC);

	// total number of properties assigned
	$stmt2 = $connect->prepare('SELECT count(*) as total_num_of_properties_assigned FROM properties WHERE assigned_status=:assigned_status');
	$stmt2->execute([':assigned_status' => 'assigned']);
	$total_num_of_properties_assigned = $stmt2->fetch(PDO::FETCH_ASSOC);
}

if ($_SESSION['role'] == 'super_admin') {
	$stmt = $connect->prepare('SELECT count(*) as total_agents FROM admin_users WHERE admin_type=:admin_type');
	$stmt->execute(['admin_type' => 'agent']);
	$total_agent = $stmt->fetch(PDO::FETCH_ASSOC);
}
if ($_SESSION['role'] == 'agent') {
	$stmt = $connect->prepare('SELECT count(*) as total_complaints FROM complaints');
	$stmt->execute();
	$total_complaints = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<?php require_once "../include/header.php" ?>

<!-- Sidebar -->
<?php require_once "../include/sideBar.php" ?>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

	<!-- Main Content -->
	<div id="content">
		<!-- Topbar -->
		<?php require_once("../include/topBar.php") ?>
		<!-- End of Topbar -->



		<!-- Begin Page Content -->
		<div class="container-fluid">
			<?php if (isset($_GET['errMsg'])) : ?>
				<div class="alert alert-danger">
					<?= $_GET['errMsg'] ?>
				</div>
			<?php endif; ?>
			<!-- Page Heading -->
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
			</div>

			<!-- Content Row -->
			<div class="row">

				<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'super_admin') : ?>
					<!-- Agents Card -->
					<div class="col-xl-3 col-md-6 mb-4">
						<div class="card border-left-primary shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
											Registered Agents</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800" id="numOfAdminUsers">
											<?= $total_agent['total_agents'] ?>
										</div>
									</div>
									<div class="col-auto">
										<i class="fas fa-users fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Assigned properties -->
					<div class="col-xl-3 col-md-6 mb-4">
						<div class="card border-left-danger shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
											Properties Assigned to agents</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800" id="numOfProperties">
											<?= $total_num_of_properties_assigned['total_num_of_properties_assigned'] ?>
										</div>
									</div>
									<div class="col-auto">
										<i class="fas fa-house-damage fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<!-- Properties Card -->
				<div class="col-xl-3 col-md-6 mb-4">
					<div class="card border-left-success shadow h-100 py-2">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
										<?= ($_SESSION['role'] == 'super_admin') ? 'Properties' : 'Assigned Property' ?></div>
									<div class="h5 mb-0 font-weight-bold text-gray-800" id="numOfProperties">
										<?= $total_num_of_properties['total_num_of_properties'] ?>
									</div>
								</div>
								<div class="col-auto">
									<i class="fas fa-house-damage fa-2x text-gray-300"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Tenants Card -->
				<div class="col-xl-3 col-md-6 mb-4">
					<div class="card border-left-info shadow h-100 py-2">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tenants
									</div>
									<div class="row no-gutters align-items-center">
										<div class="col-auto">
											<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="numOfTenants">
												<?= $total_num_of_tenants['registered_tenants'] ?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-auto">
									<i class="fas fa-users fa-2x text-gray-300"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'agent') : ?>
					<!-- Number of Complaints card -->
					<!-- <div class="col-xl-3 col-md-6 mb-4">
						<div class="card border-left-danger shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
											Complaints</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_complaints['total_complaints'] ?></div>
									</div>
									<div class="col-auto">
										<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div> -->
				<?php endif; ?>

			</div>
			<!-- // Content Row -->

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
<!-- End of Content Wrapper -->
<?php require_once "../include/footer.php" ?>