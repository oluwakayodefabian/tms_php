</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="adminLogoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="../auth/logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../assets/sb_admin/vendor/jquery/jquery.min.js"></script>
<script src="../assets/sb_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../assets/sb_admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../assets/sb_admin/js/sb-admin-2.min.js"></script>
<script src="../assets/js/lga.js"></script>
<script src="../assets/alertify/alertify.min.js"></script>
</div>
<?php if (isset($_SESSION['successMsg'])) : ?>
    <script>
        alertify.alert('Success', "<?= $_SESSION['successMsg'] ?>", function() {
            alertify.success('Welcome!');
        });
    </script>
<?php endif; ?>
<?php unset($_SESSION['successMsg']) ?>

<script>
    $(document).ready(function() {
        console.log('first')
        $(document).on('click', '#showAssignedAgent', function() {
            const id = $(this).attr('value');
            console.log(id)
            $.ajax({
                url: "../app/helper/fetchData.php?id=" + id,
                method: 'GET',
                type: 'json',
                success: function(data) {
                    const convertToObject = JSON.parse(data);
                    const image = document.querySelector('#property_image');
                    image.src = `../app/${convertToObject.image}`;
                    $('#info').text(`This property has been assigned to agent ${convertToObject.first_name} ${convertToObject.last_name}`)
                }
            })
        })
    })
</script>
<script>
    let currentPassword = document.getElementById('current-password')
    let togglePwd = document.getElementById("toggle-pwd");
    let icon = document.querySelector("#toggle-pwd i")

    togglePwd.addEventListener('click', () => {
        if (currentPassword.getAttribute('type') == 'password') {
            currentPassword.setAttribute('type', 'text');
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash')
        } else {
            currentPassword.setAttribute('type', 'password');
            icon.classList.add('fa-eye');
            icon.classList.remove('fa-eye-slash')
        }
    })
</script>
</body>

</html>