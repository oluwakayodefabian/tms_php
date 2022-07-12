<?php
require '../config/config.php';
if (empty($_SESSION['admin_id']) && empty($_SESSION['username']))
    header('Location: login.php?errMsg=You need to be logged in to view requested page!');

$data = '';
$errMsg = '';
try {
    $stmt1 = $connect->prepare('SELECT * FROM complaints WHERE complaint_id = :complaint_id');
    $stmt1->execute(array(
        ':complaint_id' => $_GET['cmp_id'],
    ));
    $data = $stmt1->fetch(PDO::FETCH_ASSOC);
} catch (\PDOException $e) {
    $errMsg = $e->getMessage();
}

if (isset($_POST['response_btn'])) {
    try {
        $stmt = $connect->prepare('UPDATE complaints SET response=:response, response_date=:response_date WHERE complaint_id=:complaint_id');
        $stmt->execute(array(
            ':complaint_id' => $_GET['cmp_id'],
            ':response' => $_POST['response'],
            ':response_date' => date('Y-m-d H:i:s'),
        ));
        header("Location: cmplist.php?successMsg=Response has been sent to " . $data['fullname']);
    } catch (\PDOException $e) {
        $errMsg = $e->getMessage();
    }
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
            <h1 class="h3 m-4 text-gray-800">Respond to the complaint of tenant <?= $data['fullname'] ?></h1>
            <?php
            if (isset($errMsg)) {
                echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
            }
            ?>
            <!-- List of tenants -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Make a Response</h6>
                </div>
                <div class="card-body">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Write A response to the tenant's complain</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="response">Response</label>
                                        <textarea name="response" id="response" class="form-control" placeholder="Write Your Response"><?= $data['response'] ?></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <a role="button" href="cmplist.php" class="btn btn-secondary">Cancel</a>
                                        <button type="submit" class="btn btn-primary" id="response_btn" name="response_btn">Send Response</button>
                                    </div>
                                </form>
                            </div>

                        </div>
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
                <span>Copyright &copy; Your Website 2020</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>