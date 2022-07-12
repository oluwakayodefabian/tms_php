<?php
require '../config/config.php';
if (empty($_SESSION['username']))
    header('Location: login.php');

$admin_id = isset($_GET['adminId']) ? $_GET['adminId'] : '';
$data = '';
try {
    if ($_SESSION['role'] == 'super_admin') {
        $stmt = $connect->prepare("SELECT login_activity.*, admin_users.first_name, admin_users.last_name, admin_users.admin_type FROM login_activity INNER JOIN admin_users ON login_activity.admin_id=admin_users.admin_id WHERE login_activity.admin_id = :admin_id");
        $stmt->execute(array(
            ':admin_id' => $admin_id
        ));
        $data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = $data2;
    }
} catch (PDOException $e) {
    $errMsg = $e->getMessage();
}

?>
<?php include '../include/header.php'; ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <?php require_once("../include/topBar.php") ?>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div>
                <?php
                if (isset($errMsg)) {
                    echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
                }
                ?>
            </div>
            <!-- Page Heading -->
            <div class="d-flex justify-content-between">
                <h1 class="h3 m-4 text-gray-800">Activity Log</h1>
                <a href="./adminUsers.php" class="btn btn-info btn-lg m-4 text-white">click me to see all agents</a>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <?php if (count($data) > 0) : ?>
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">
                            This is the log record of <?= $data[0]['first_name'] . ' ' . $data[0]['last_name'] . ' (' . $data[0]['admin_type'] . ')' ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div class="table-responsive-lg">
                                <table class="table table-responsive-sm table-borderless table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">IP Address</th>
                                            <th scope="col">login date & time</th>
                                            <th scope="col">logout date and time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data as $key => $value) {
                                            # code for storing the data...
                                            $count = $key + 1;
                                            echo '<tr>';
                                            echo '<td scope="row">' . $count . '</th>';
                                            echo '<td>' . $value['ip_address'] . '</td>';
                                            echo '<td> ' . $value['login_time'] . '</td>';
                                            echo '<td>' . $value['logout_time'] . '</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                            <h1 align='center'>No login activity for this user yet</h1>
                        <?php endif; ?>
                        </div>
                    </div>

            </div>

        </div>
        <!-- /.container-fluid -->
    </div>

    <?php include '../include/footer.php'; ?>