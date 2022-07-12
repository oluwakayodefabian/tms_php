<?php
require '../config/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['register'])) {
	$errMsg = '';

	// Get data from FROM
	$username = $_POST['username'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$fullname = $_POST['fullname'];

	try {
		$stmt = $connect->prepare('INSERT INTO users (fullname, mobile, username, email, password) VALUES (:fullname, :mobile, :username, :email, :password)');
		$stmt->execute(array(
			':fullname' => $fullname,
			':username' => $username,
			':password' => md5($password),
			':email' => $email,
			':mobile' => $mobile,
		));
		header('Location: register.php?action=joined');
		exit;
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}

if (isset($_GET['action']) && $_GET['action'] == 'joined') {
	$errMsg = 'Registration successfull. Now you can login';
}
?>

<!-- <section> -->
	<!-- <div class="row">-->
		<div class="col-md-8 mx-auto">
			<div class="alert alert-info" role="alert">
				<?php
				if (isset($errMsg)) {
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
				}
				?>
				<h2 class="text-center">Register New Tenant</h2>
				<form action="" method="post">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="fullname">Full Name</label>
								<input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" required>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="username">User Name</label>
								<input type="text" class="form-control" id="username" placeholder="User Name" name="username" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="mobile">Mobile</label>
								<input type="text" class="form-control" pattern="^(\d{10})$" id="mobile" title="10 digit mobile number" placeholder="10 digit mobile number" name="mobile" required>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-danger" name='register' value="register">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- </section> -->
<?php include '../include/footer.php'; ?>