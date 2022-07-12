<?php
// if (empty($_SESSION['role']))
//     header('Location: login.php');

// 
?>

<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menupos-fixed menu-light brand-blue ">
    <div class="navbar-wrapper ">
        <div class="navbar-brand header-logo">
            <a href="index.html" class="b-brand">
                <img src="../assets/images/logo.svg" alt="" class="logo images">
                <img src="../assets/images/logo-icon.svg" alt="" class="logo-thumb images">
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item">
                    <a href="../auth/tenant_dashboard.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Actions</label>
                </li>
                <li class="nav-item">
                    <a href="../app/complaint.php" class=""><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Make a complaint</span></a>
                </li>
                <li class="nav-item">
                    <a href="../app/view_response_to_complaints.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">view complaints</span></a>
                </li>

            </ul>
            <div class="card text-center">
                <div class="card-block">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="feather icon-sunset f-40"></i>
                    <h6 class="mt-3">Coming soon!</h6>
                    <p>Tenant Dashboard is in development mode</p>

                </div>
            </div>
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->