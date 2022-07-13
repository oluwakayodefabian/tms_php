<?php
require_once './helper/validator.php';
require_once '../config/config.php';
if (empty($_SESSION['username']))
	header('Location: login.php');

$country = '';
$state = '';
$city = '';
$rent_amount = '';
$description = '';
$address = '';
$property_status = '';

if (isset($_POST['register_properties'])) {
	$errMsg = '';
	$validationErrors = '';
	$validationErrors = validateProperties($_POST);
	if (count($validationErrors) > 0) {
		// return error messages with the details that has being filled in previously
		$country   = $_POST['country'];
		$state   = $_POST['state'];
		$city   = $_POST['city'];
		$address = $_POST['address'];
		$description = $_POST['description'];
		$rent_amount = $_POST['rent_amount'];
		$property_status = $_POST['property_status'];
	} else {
		// Get data from FROM
		$admin_id = $_SESSION['admin_id'];
		$country = $_POST['country'];
		$state = $_POST['state'];
		$city = $_POST['city'];
		$address = $_POST['address'];
		$rent = $_POST['rent_amount'];
		$description = $_POST['description'];
		$property_status = $_POST['property_status'];

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
		//end of image upload

		try {
			$stmt = $connect->prepare('INSERT INTO properties (country, state, city, address, rent_amount, description, image, property_status) VALUES (:country, :state, :city, :address, :rent_amount, :description, :image, :property_status)');
			$stmt->execute(array(
				':country' => $country,
				':state' => $state,
				':city' => $city,
				':address' => $address,
				':rent_amount' => $rent,
				':description' => $description,
				':image' => $target_file,
				':property_status' => $property_status,
			));

			header('Location: list.php?successMsg=Property created');
			exit;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}

// try {
// 	$stmt2 = $connect->prepare('SELECT * FROM properties');
// 	$stmt2->execute();
// 	$data2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// 	foreach ($data2 as $property) {
// 		if (is_null($property['admin_id'])) {
// 			$stmt3 = $connect->prepare('UPDATE properties SET assigned_status=:assigned_status WHERE admin_id=:admin_id');
// 			$stmt3->execute(array(
// 				':admin_id' => NULL,
// 				':assigned_status' => 'not_assigned'
// 			));
// 		}
// 	}
// 	$data = $data2;
// } catch (\PDOException $e) {
// 	echo $e->getMessage();
// }

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
				<div class="card-body">
					<?php include 'partials/property.php'; ?>
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