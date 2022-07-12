<?php
require '../config/config.php';
if (empty($_SESSION['username']))
    header('Location: login.php');

$data = '';
try {
    if ($_SESSION['role'] == 'agent') {
        $stmt = $connect->prepare('SELECT *  FROM tenants INNER JOIN properties ON tenants.property_id=properties.property_id WHERE properties.admin_id=:admin_id');
        $stmt->execute([':admin_id' => $_SESSION['admin_id']]);
        $data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = $data2;
    } elseif ($_SESSION['role'] == 'super_admin') {
        $stmt = $connect->prepare('SELECT *  FROM tenants INNER JOIN properties ON tenants.property_id=properties.property_id');
        $stmt->execute();
        $data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = $data2;
    }
} catch (PDOException $e) {
    $errMsg = $e->getMessage();
}
?>
<?php require_once '../include/header.php'; ?>

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
            <?php if ($_SESSION['role'] == 'agent') : ?>
                <h1 class="h3 m-4 text-gray-800">Manage Tenants</h1>
            <?php endif; ?>
            <?php
            if (isset($errMsg)) {
                echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
            }
            ?>
            <!-- List of tenants -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">List of Tenants</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table table-borderless table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Phone No</th>
                                    <th scope="col">Property rented</th>
                                    <th scope="col">Rent Amount</th>
                                    <th scope="col">Amount paid</th>
                                    <!-- <th scope="col">Balance</th> -->
                                    <th scope="col">Rent Duration</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $key => $value) : ?>
                                    <tr>
                                        <th scope="row"><?= $key + 1 ?></th>
                                        <td><strong><?= $value['first_name'] . ' ' . $value['last_name'] ?></strong></td>
                                        <td><?= $value['email'] ?></td>
                                        <td><?= $value['gender'] ?></td>
                                        <td><?= $value['phone_no'] ?></td>
                                        <td> The property at<?= $value['address'] . ', ' . $value['city'] . ', ' . $value['state'] ?></td>
                                        <td><?= $value['rent_amount'] ?></td>
                                        <td>NGN<?= number_format($value['amount_paid'], 2) ?></td>
                                        <td><?= date('F d, Y', strtotime($value['rent_starting_date'])) . ' - ' . date('F d, Y', strtotime($value['rent_ending_date'])) ?></td>
                                        <?php if ($_SESSION['role'] == 'agent') : ?>
                                            <td> <a class="btn btn-warning float-right" href="update_tenant.php?tenant_id=<?= $value['tenant_id'] ?>">Edit</a></td>
                                        <?php elseif ($_SESSION['role'] == 'super_admin') : ?>
                                            <td> <button class="btn btn-primary float-right" value="<?= $value['admin_id'] ?>" data-toggle="modal" data-target="#exampleModal" id="showAssignedAgent">view agent this tenant is assigned to</button></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
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



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card text-center" style="width: 100%;">
                    <img src="" class="card-img-top" alt="image of property" id="property_image" style="height: 300px">
                    <div class="card-body">
                        <p class="h4 text-dark" id="info">
                            <!-- data will be inserted using AJAX -->
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include '../include/footer.php'; ?>