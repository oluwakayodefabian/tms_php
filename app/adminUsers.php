<?php
require_once '../config/config.php';
if (empty($_SESSION['username']))
    header('Location: login.php');
if ($_SESSION['role'] !== 'super_admin') {
    header('Location: ../auth/dashboard.php?errMsg=You can\'t view requested page');
}

try {
    $stmt = $connect->prepare('SELECT * FROM Admin_users WHERE admin_type != :admin_type');
    $stmt->execute([':admin_type' => 'super_admin']);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

            <!-- Page Heading -->
            <h1 class="h3 m-4 text-gray-800">Manage Agents</h1>

            <!-- Button trigger modal -->
            <a href="../app/create_admin.php" class="btn btn-info my-5 mx-4">
                Add Agents
            </a>
            <?php if (isset($_GET['successMsg'])) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $_GET['successMsg'] ?>
                </div>
            <?php endif; ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">List of Agents</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-hover" id="userTable">
                            <caption>List of Agents</caption>
                            <thead>
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col" colspan="1">Action</th>
                                </tr>
                            </thead>
                            <?php if ($_SESSION['role'] == 'super_admin') : ?>
                                <tbody>
                                    <?php
                                    foreach ($data as $key => $value) {
                                        # code...	
                                        $count = $key + 1;
                                        echo '<tr>';
                                        echo '<th scope="row">' . $count . '</th>';
                                        echo '<td>' . $value['first_name'] . ' ' . $value['last_name'] . '</td>';
                                        echo '<td>' . $value['admin_email'] . '</td>';
                                        echo '<td>' . $value['admin_type'] . '</td>';
                                        echo '<td><a href=' . './login_activity.php?adminId=' . $value['admin_id'] . ' class="btn btn-info">view login activity</td>';
                                        echo '<td><a href=' . './list.php' . ' class="btn btn-primary">assign a property</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            <?php endif; ?>

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