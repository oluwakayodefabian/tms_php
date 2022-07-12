<?php
require_once "../config/config.php";

if (isset($_SESSION['admin_id'])) {
    $_SESSION['errorMsg'] = 'Only prospective tenants can view requested page';
    header('Location: ../index.php');
}
if (isset($_POST['application_btn'])) {
    $errMsg = '';

    // Get data from FORM
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email_address'];
    $state = $_POST['state'];
    $lga = $_POST['lga'];
    $mobile = $_POST['phone_number'];
    $property_id = $_GET['property_id'];
    $duration = $_POST['duration'];

    try {
        $stmt = $connect->prepare('INSERT INTO application_for_property (property_id, first_name, last_name, email, gender, applicant_state, applicant_lga, phone_no, duration) VALUES (:property_id, :first_name, :last_name, :email, :gender, :applicant_state, :applicant_lga, :phone_no, :duration)');
        $stmt->execute(array(
            ':property_id' => $property_id,
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':gender' => $gender,
            ':applicant_state' => $state,
            ':applicant_lga' => $lga,
            ':phone_no' => $mobile,
            ':duration' => $duration,
        ));
        $_SESSION['successMsg'] = 'Your application form has been submitted! A mail will be sent to you if your application is accepted';
        header('Location: ../index.php');
        exit;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<?php include '../include/header.php'; ?>
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid mt-5">

            <!-- card -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <?php include '../app/partials/tenant.php'; ?>
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