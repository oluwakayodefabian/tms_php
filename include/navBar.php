<nav class="navbar navbar-expand-lg fixed-top bg-light">
    <div class="container">
        <a class="navbar-brand" href="../index.php" style="background-color: transparent; color: #000">
            TMS
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="mdi mdi-menu"> </i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="d-lg-none d-flex justify-content-between px-4 py-3 align-items-center">
                <img src="images/logo-dark.svg" class="logo-mobile-menu" alt="logo">
                <a href="javascript:;" class="close-menu"><i class="mdi mdi-close"></i></a>
            </div>
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php
                if (empty($_SESSION['username']) || empty($_SESSION['tenant_username'])) {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link btn btn-success" href="login.php">Login</a>';
                    echo '</li>';
                } else {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link btn btn-primary" href="./auth/dashboard.php">Dashboard</a>';
                    echo '</li>';
                }
                ?>

            </ul>
        </div>
    </div>
</nav>