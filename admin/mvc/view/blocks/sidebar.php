<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!'); ?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BackNumber</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $page_slug === 'index.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="/admin/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Charts -->
    <li class="nav-item <?php echo $page_slug === 'vol' ? 'active' : ''?>">
        <a class="nav-link" href="/admin/vol/">
            <i class="fas fa-coins"></i>
            <span>Vol</span></a>
    </li>

    <li class="nav-item <?php echo $page_slug === 'category' ? 'active' : ''?>">
        <a class="nav-link" href="/admin/category/">
            <i class="fas fa-clipboard-list"></i>
            <span>Category</span></a>
    </li>

    <li class="nav-item <?php echo $page_slug === 'backnumber' ? 'active' : ''?>">
        <a class="nav-link" href="/admin/backnumber/">
            <i class="fas fa-columns"></i>
            <span>BackNumber</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>