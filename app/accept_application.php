<?php
require '../config/config.php';
if (empty($_SESSION['username']))
    header('Location: login.php');

$data = [];

if (isset($_GET['application_id'])) {
    $applicant_id = $_GET['application_id'];
    try {
        if ($_SESSION['role'] == 'agent') {
            $stmt = $connect->prepare('SELECT * FROM application_for_property JOIN properties ON application_for_property.property_id=properties.property_id WHERE application_id=:application_id');
            $stmt->execute([':application_id' => $applicant_id]);
            $data2 = $stmt->fetch(PDO::FETCH_ASSOC);
            $data = $data2;

            $stmt = $connect->prepare('INSERT INTO tenants (property_id, agent_assigned_to, first_name, last_name, email, gender, state, lga, phone_no, amount_paid, unique_id) VALUES (:property_id, :agent_assigned_to, :first_name, :last_name, :email, :gender, :state, :lga, :phone_no, :amount_paid, :unique_id)');
            $stmt->execute(array(
                ':property_id' => $data['property_id'],
                ':agent_assigned_to' => $_SESSION['admin_id'],
                ':first_name' => $data['first_name'],
                ':last_name' => $data['last_name'],
                ':email'    => $data['email'],
                ':gender'   => $data['gender'],
                ':state'    => $data['applicant_state'],
                ':lga'      => $data['applicant_lga'],
                ':phone_no' => $data['phone_no'],
                ':amount_paid' => $data['rent_amount'],
                ':unique_id' => uniqid(),
            ));
            $stmt2 = $connect->prepare('UPDATE properties SET property_status=:property_status, tenant_id=:tenant_id WHERE property_id=:property_id');
            $stmt2->execute(array(
                ':property_id' => $data['property_id'],
                ':property_status' => 'occupied',
                ':tenant_id' => $connect->lastInsertId()
            ));

            $stmt3 = $connect->prepare('DELETE FROM application_for_property WHERE application_id=:application_id');
            $stmt3->execute(array(
                ':application_id' => $applicant_id,
            ));
            header('Location: applyFor_rent_list.php?property_id=' . $data['property_id'] . '&successMsg=You accepted the application of ' . $data['first_name'] . ' ' . $data['last_name'] . 'The applicant has been assigned this property! ');
            exit;
        }
    } catch (PDOException $e) {
        $errMsg = $e->getMessage();
    }
}
