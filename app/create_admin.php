<?php
require '../config/config.php';
require_once './helper/validator.php';

if (empty($_SESSION['username']))
	header('Location: login.php');

if ($_SESSION['role'] !== 'super_admin') {
	header('Location: ../auth/dashboard.php?errMsg=You can\'t view requested page');
}

$id         = '';
$first_name = '';
$last_name  = '';
$username   = '';
$email      = '';
$role = '';

if ($_SESSION['role'] == 'super_admin') {
	try {
		$stmt = $connect->prepare('SELECT *  FROM properties WHERE assigned_status=:assigned_status');
		$stmt->execute([':assigned_status' => 'not_assigned']);
		$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$data = $data2;
	} catch (\PDOException $th) {
		$errMsg = $e->getMessage();
	}
	if (isset($_POST['admin_register'])) {
		$errMsg = '';
		$validationErrors = '';
		$validationErrors = validateRegistration($_POST);
		if (count($validationErrors) > 0) {
			// return error messages with the details that has being filled in previously
			$first_name   = $_POST['first_name'];
			$last_name   = $_POST['last_name'];
			$username   = $_POST['admin_username'];
			$email      = $_POST['admin_email'];
			$property_id      = $_POST['property_id'];
		} else {
			// Get data from add_adminUser FORM
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$admin_username = $_POST['admin_username'];
			$admin_email = $_POST['admin_email'];
			$admin_password = password_hash($_POST['admin_password'], PASSWORD_BCRYPT);
			$role = $_POST['role'];
			$property_id = $_POST['property_id'];
			$unique_id = uniqid();

			try {
				$stmt = $connect->prepare('INSERT INTO admin_users (property_assigned, first_name, last_name, admin_username, admin_email, password, admin_type, unique_id) VALUES (:property_assigned, :first_name, :last_name, :admin_username, :admin_email, :password, :admin_type, :unique_id)');
				$stmt->execute(array(
					':property_assigned' => $property_id,
					':first_name' => $first_name,
					':last_name' => $last_name,
					':admin_username' => $admin_username,
					':admin_email' => $admin_email,
					':password' => $admin_password,
					':admin_type' => $role,
					':unique_id' => $unique_id,
				));

				$stmt2 = $connect->prepare('UPDATE properties SET assigned_status=:assigned_status, admin_id=:admin_id WHERE property_id=:property_id');
				$stmt2->execute(array(
					':property_id' => $property_id,
					':assigned_status' => 'assigned',
					':admin_id' => $connect->lastInsertId()
				));
				header('Location: adminUsers.php?successMsg=Agent created');
				exit;
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
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

			<!-- card -->
			<div class="card shadow mb-4">
				<div class="card-body">
					<!-- Nav tabs -->
					<?php if ($_SESSION['role'] == 'super_admin') : ?>
						<?php include 'partials/add_adminUser_form.php'; ?>
					<?php endif; ?>
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