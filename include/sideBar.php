<?php
require_once '../config/config.php';
if (empty($_SESSION['role']))
    header('Location: ../auth/login.php');

?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas far fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">TMS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="../auth/dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php if ($_SESSION['role'] == 'super_admin') : ?>
        <!-- Nav Item - Admin Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-users"></i>
                <span>Agents</span>

            </a>
            <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="../app/create_admin.php">create Agent</a>
                    <a class="collapse-item" href="../app/adminUsers.php">Manage Agents</a>
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    <?php endif; ?>

    <!-- Nav Item - Tenants Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
            <i class="fas fa-fw fa-users"></i>
            <span>Tenants</span>

        </a>
        <?php if ($_SESSION['role'] == 'agent') : ?>
            <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <!-- <a class="collapse-item" href="../app/create_tenant.php">Add tenant</a> -->
                    <a class="collapse-item" href="../app/list_of_tenants.php">Manage tenants</a>
                </div>
            </div>
        <?php elseif ($_SESSION['role'] == 'super_admin') : ?>
            <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="../app/list_of_tenants.php">View tenants</a>
                </div>
            </div>
        <?php endif; ?>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Nav Item - Properties Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3" aria-expanded="true" aria-controls="collapseUtilities3">
            <i class="fas fa-building"></i>
            <span>Properties</span>
        </a>
        <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if ($_SESSION['role'] == 'super_admin') : ?>
                    <a class="collapse-item" href="../app/register.php">Add property</a>
                    <a class="collapse-item" href="../app/list.php">Assign properties</a>
                    <a class="collapse-item" href="../app/applyFor_rent_list.php">View applicants</a>
                <?php else : ?>
                    <a class="collapse-item" href="../app/list.php">Manage properties</a>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <?php if ($_SESSION['role'] == 'agent') : ?>
        <!-- Nav Item - Complaints Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities4" aria-expanded="true" aria-controls="collapseUtilities4">
                <i class="fab fa-accusoft"></i>
                <span>Complaints</span>
            </a>
            <div id="collapseUtilities4" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="../app/cmplist.php">Manage complaints</a>
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    <?php endif; ?>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>