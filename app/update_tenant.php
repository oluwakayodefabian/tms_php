<?php
require '../config/config.php';

if (empty($_SESSION['username']))
    header('Location: login.php');
if ($_SESSION['role'] !== 'agent')
    header('Location: ../auth/dashboard.php');

if (isset($_GET['tenant_id'])) {
    $id = $_REQUEST['tenant_id'];

    try {
        $stmt = $connect->prepare('SELECT * FROM tenants where tenant_id = :tenant_id');
        $stmt->execute(array(
            ':tenant_id' => $id
        ));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

if (isset($_POST['edit_tenant_info'])) {
    $errMsg = '';
    // Get data from FORM
    $tenant_id = $_POST['tenant_id'];
    $rent_starting_date = $_POST['rent_starting_date'] . ' ' . $_POST['rent_starting_time'];
    $rent_ending_date = $_POST['rent_ending_date'] . ' ' . $_POST['rent_ending_time'];


    try {
        $stmt = $connect->prepare('UPDATE tenants SET rent_starting_date = ?, rent_ending_date = ? WHERE tenant_id = ?');
        $stmt->execute(array(
            $rent_starting_date,
            $rent_ending_date,
            $tenant_id
        ));

        header('Location: list_of_tenants.php?successMsg=Tenant information updated successfully!');
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
                <?php if ($_SESSION['role'] == 'agent') : ?>
                    <div class="card-body">
                        <?php include 'partials/edit/edit_tenant_form.php'; ?>
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