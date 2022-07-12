<?php
require '../config/config.php';
if (empty($_SESSION['username']))
    header('Location: login.php');

$data = '';
try {
    if ($_SESSION['role'] == 'agent') {
        $stmt = $connect->prepare('SELECT * FROM application_for_property JOIN properties ON application_for_property.property_id=properties.property_id WHERE application_for_property.property_id=:property_id');
        $stmt->execute([':property_id' => $_GET['property_id']]);
        $data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = $data2;
    } else if ($_SESSION['role'] == 'super_admin') {
        $stmt = $connect->prepare('SELECT * FROM application_for_property JOIN properties ON application_for_property.property_id=properties.property_id');
        $stmt->execute();
        $data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = $data2;
    }
} catch (PDOException $e) {
    $errMsg = $e->getMessage();
}

?>
<?php include '../include/header.php'; ?>

<?php require_once '../include/sideBar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <?php require_once("../include/topBar.php") ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <?php if (isset($_GET['successMsg'])) : ?>
                <div class="alert alert-success">
                    <?= $_GET['successMsg'] ?>
                </div>
            <?php endif; ?>
            <!-- Page Heading -->
            <h1 class="h3 m-4 text-gray-800">Manage Properties</h1>
            <?php
            if (isset($errMsg)) {
                echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
            }
            ?>
            <!-- List of properties -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">List of Applicants</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Property applied for</th>
                                    <th scope="col">Duration applied for</th>
                                    <th scope="col">Property Status</th>
                                    <th scope="col">Applied on</th>
                                    <?php if ($_SESSION['role'] == 'super_admin') : ?>
                                        <th scope="col">Status</th>
                                    <?php endif; ?>
                                    <?php if ($_SESSION['role'] == 'agent') : ?>
                                        <th colspan="3">Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($data) > 0) : ?>
                                    <?php foreach ($data as $key => $value) : ?>
                                        <tr>
                                            <td scope="row"><?= $key + 1 ?></th>
                                            <td><?= $value['first_name'] . ' ' . $value['last_name']  ?></td>
                                            <td><?= $value['gender'] ?></td>
                                            <td>The property at <?= $value['city'] . ', ' . $value['state'] . ', ' . $value['country'] ?></td>
                                            <td><?= $value['duration'] ?> Year(s)</td>
                                            <td><?= $value['property_status'] ?></td>
                                            <td><?= date('M jS Y', strtotime($value['applied_on'])) ?></td>
                                            <?php if ($_SESSION['role'] == 'super_admin') : ?>
                                                <?php if ($value['property_status'] == 'occupied') : ?>
                                                    <td><span class="badge badge-success p-2">Application Accepted</span></td>
                                                <?php else : ?>
                                                    <td><span class="badge badge-secondary p-2">Application Pending</span></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($_SESSION['role'] == 'agent') : ?>
                                                <?php if ($value['property_status'] == 'vacant') : ?>
                                                    <td><a href="accept_application.php?application_id=<?= $value['application_id'] ?>" class="btn btn-success">Accept</a></td>
                                                    <td><a href="reject_application.php?application_id=<?= $value['application_id'] ?>" class="btn btn-danger">Reject</a></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <h1>No Application has been submitted yet!</h1>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
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