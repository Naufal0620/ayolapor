<?php
$ci = &get_instance();
$page = $ci->uri->segment(2);
?>

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="dashboard" class="nav-link <?= $page == "dashboard" ? "active" : "" ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="pengaduan" class="nav-link <?= $page == "pengaduan" ? "active" : "" ?>">
                <i class="nav-icon fas fa-bullhorn"></i>
                <p>
                Pengaduan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="users" class="nav-link <?= $page == "users" ? "active" : "" ?>">
                <i class="fas fa-user-cog nav-icon"></i>
                <p>Users</p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->