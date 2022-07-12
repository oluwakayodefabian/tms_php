<?php
require '../config/config.php';
if (empty($_SESSION['username']))
    header('Location: login.php');

if (isset($_GET['application_id'])) {
    $applicant_id = $_GET['application_id'];
    
    try {
        if ($_SESSION['role'] == 'agent') {
            $stmt = $connect->prepare('SELECT * FROM application_for_property JOIN properties ON application_for_property.property_id=properties.property_id WHERE application_id=:application_id');
            $stmt->execute([':application_id' => $applicant_id]);
            $data2 = $stmt->fetch(PDO::FETCH_ASSOC);
            $data = $data2;

            $stmt2 = $connect->prepare('DELETE FROM application_for_property WHERE application_id=:application_id');
            $stmt2->execute(array(
                ':application_id' => $applicant_id,
            ));
            header('Location: applyFor_rent_list.php?property_id=' . $data['property_id'] . '&successMsg=You rejected the application of ' . $data['first_name'] . ' ' . $data['last_name']);
            exit;
        }
    } catch (PDOException $e) {
        $errMsg = $e->getMessage();
    }
}
