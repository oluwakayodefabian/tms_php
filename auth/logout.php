<?php
require '../config/config.php';
$stmt = $connect->prepare('UPDATE login_activity SET logout_time=:logout_time WHERE id=:id');
$stmt->execute(array(
	':id' => $_SESSION['login_activity_id'],
	':logout_time' => date('Y-m-d H:i:s')
));
session_destroy();
header('Location: login.php');
