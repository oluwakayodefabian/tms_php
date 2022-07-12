<?php
require_once '../app/helper/middleware.php';
guestOnly();
require '../config/config.php';

if (isset($_POST['login'])) {

	// Get data from FORM
	$username = $_POST['username'];
	$email = $_POST['username'];
	$password = $_POST['password'];

	try {
		$stmt = $connect->prepare('SELECT * FROM admin_users WHERE admin_username = :admin_username OR admin_email = :admin_email');
		$stmt->execute(array(
			':admin_username' => $username,
			':admin_email' => $email
		));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);


		if ($data == false) {
			$errMsg = "User $username not found.";
		} else {
			if (password_verify($password, $data['password'])) {
				$_SESSION['admin_id'] = $data['admin_id'];
				$_SESSION['username'] = $data['admin_username'];
				$_SESSION['fullname'] = $data['first_name'] . ' ' . $data['last_name'];
				$_SESSION['role'] = $data['admin_type'];

				$admin_id = $_SESSION['admin_id'];
				$browser = $_SERVER['HTTP_USER_AGENT'];
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$login_dateTime = date("Y-m-d H:i:s");

				$stmt = $connect->prepare('INSERT INTO login_activity (admin_id, agent, ip_address, login_time, logout_time) VALUES (:admin_id, :agent, :ip_address, :login_time, :logout_time)');
				$stmt->execute(array(
					':admin_id' => $admin_id,
					':agent' => $browser,
					':ip_address' => $ip_address,
					':login_time' => $login_dateTime,
					':logout_time' => '00-00-00 00:00:00',
				));
				$login_activity_id = $connect->lastInsertId();
				$_SESSION['login_activity_id'] = $login_activity_id;
				$_SESSION['successMsg'] = 'Welcome ' . $_SESSION['fullname'] . ', You are now logged in!';
				header('Location: dashboard.php');
				exit;
			} else
				$errMsg = 'Password not match.';
		}
	} catch (PDOException $e) {
		$errMsg = $e->getMessage();
	}
}
?>

<?php include '../include/header.php'; ?>

<div class="container mt-5">
	<?php require_once "../include/navBar.php" ?>
	<!-- Outer Row -->
	<div class="row justify-content-center">

		<div class="col-xl-10 col-lg-12 col-md-9">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
						<div class="col-lg-6">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
									<!-- Alert messages -->
									<?php if (isset($errMsg)) : ?>
										<div class="alert alert-info" role="alert">
											<p style="color:#FF0000;text-align:center;font-size:17px;"><?= $errMsg ?></p>
										</div>
									<?php endif; ?>
									<?php if (isset($_GET['errMsg'])) : ?>
										<div class="alert alert-info" role="alert">
											<div style="color:#FF0000;text-align:center;font-size:17px;"><?= $_GET['errMsg'] ?></div>
										</div>
									<?php endif; ?>

									<!-- Logout message -->
									<?php if (isset($_GET['msg'])) : ?>
										<div class="alert alert-info">
											<?= $_GET['msg'] ?>
										</div>
									<?php endif; ?>
									<!-- // Alert messages -->
								</div>
								<form action="" method="post">
									<div class="form-group">
										<input type="text" class="form-control form-control-user" id="username" aria-describedby="usernameHelp" placeholder="Enter username" name="username" value="">
									</div>
									<div class="form-group">
										<div id="current-pwd-container">
											<span id="toggle-pwd" title="see password"><i class="fas fa-eye fa-2x"></i></span>
											<input type="password" class="form-control form-control-user" id="current-password" placeholder="Enter Password" name="password">
										</div>
									</div>
									<button type="submit" class="btn btn-primary btn-user btn-block" name="login">
										Login
									</button>
								</form>
								<hr>
								<div class="text-center">
									<a class="small" href="#">Forgot Password?</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>

<?php include '../include/footer.php'; ?>