<?php
require_once "../../config/config.php";
if ($_SESSION['role'] == 'super_admin') {
    $stmt2 = $connect->prepare('SELECT * FROM properties JOIN admin_users ON properties.admin_id=admin_users.admin_id WHERE properties.admin_id=:admin_id');
    $stmt2->execute([':admin_id' => $_GET['id'] ? $_GET['id'] : '']);
    $data3 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $info = $data3;

    echo json_encode($info);
}
