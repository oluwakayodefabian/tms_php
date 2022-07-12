<div class="bg-primary w-100">
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <!-- rent reminder -->
        <div class="countDown-container border w-75 bg-primary" style="padding: 1rem">
            <h1 class="rent-text">Your rent is due for expiration! please renew</h1>
        </div>
        <!-- rent reminder -->
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item no-arrow mr-5">

            </li>
            <li class="nav-item no-arrow mr-5">
                <span class="mr-2 d-none d-lg-inline text-gray-600 h5"><?php echo $_SESSION['fullname'] . ' (' . $_SESSION['role'] . ')'; ?></span>
                <img class="img-profile rounded-circle" src="../assets/sb_admin/img/undraw_profile.svg" style="width: 50px; height: 50px">
                <a class="dropdown-item" href="../index.php">
                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                    Go back Home
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>

</div>
</li>

</ul>

</nav>
</div>