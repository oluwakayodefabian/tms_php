<?php
require '../config/config.php';
if (empty($_SESSION['username']))
	header('Location: login.php');
if ($_SESSION['role'] !== 'super_admin')
	header('Location: ../auth/dashboard.php');
$country = '';
$state = '';
$city = '';
$rent_amount = '';
$description = '';
$address = '';
$property_status = '';

if (isset($_GET['id'])) {
	$id = $_REQUEST['id'];

	try {
		$stmt = $connect->prepare('SELECT * FROM properties where property_id = :id');
		$stmt->execute(array(
			':id' => $id
		));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);

		// Get all registered agents
		$stmt2 = $connect->prepare('SELECT * FROM admin_users WHERE admin_type=:admin_type');
		$stmt2->execute([':admin_type' => 'agent']);
		$agents = $stmt2->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}

if (isset($_POST['edit_property'])) {
	$errMsg = '';
	// Get data from FROM
	$property_id = $_POST['property_id'];
	$country = $_POST['country'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$address = $_POST['address'];
	$rent = $_POST['rent_amount'];
	$description = $_POST['description'];
	$property_status = $_POST['property_status'];
	$agent_id = $_POST['agent_id'];
	$assigned_status = 'assigned';

	//upload an images
	$target_file = "";
	if (isset($_FILES["image"]["name"])) {
		$target_file = "uploads/" . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["image"]["tmp_name"]);
		if ($check !== false) {
			move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $_FILES["image"]["name"]);
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}

	try {
		$stmt = $connect->prepare('UPDATE properties SET country = ?, state = ?, city = ?, address = ?, rent_amount = ?, description = ?, image = ?, property_status = ?, admin_id=?, assigned_status=?  WHERE property_id = ?');
		$stmt->execute(array(
			$country,
			$state,
			$city,
			$address,
			$rent,
			$description,
			$target_file,
			$property_status,
			$agent_id,
			$assigned_status,
			$property_id,
		));

		$stmt2 = $connect->prepare('UPDATE admin_users SET property_assigned=:property_assigned WHERE admin_id=:admin_id');
		$stmt2->execute(array(
			':property_assigned' => $property_id,
			':admin_id' => $agent_id
		));


		header('Location: list.php?successMsg=Property updated successfully!');
		exit;
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}

?>
<?php include '../include/header.php'; ?>
<?php include '../include/sideBar.php'; ?>

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
				<?php if ($_SESSION['role'] == 'super_admin') : ?>
					<div class="card-body">
						<?php include 'partials/edit/edit_property.php'; ?>
					</div>
				<?php endif; ?>
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