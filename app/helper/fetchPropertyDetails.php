<?php
require_once "../../config/config.php";
$stmt2 = $connect->prepare('SELECT * FROM properties WHERE property_id=:property_id');
$stmt2->execute([':property_id' => $_GET['property_id'] ? $_GET['property_id'] : '']);
$data3 = $stmt2->fetch(PDO::FETCH_ASSOC);
$info = $data3;

echo json_encode($info);
