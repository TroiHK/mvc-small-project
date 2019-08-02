<?php if (!defined('PATH_SYSTEM')) die('Bad requested!'); ?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/?lang=<?php echo LANGUAGE_CODE ?>">
        <div class="sidebar-brand-icon">
            <!-- <i class="fab fa-battle-net"></i> -->
            <img class="mw-100" src="/data/images/logo_ki.svg" />
        </div>
        <div class="sidebar-brand-text mx-3">BackNumber</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $page_slug === 'index.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="/admin/?lang=<?php echo LANGUAGE_CODE ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span><?php echo _pll('Dashboard'); ?></span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Charts -->
    <li class="nav-item <?php echo $page_slug === 'vol' ? 'active' : '' ?>">
        <a class="nav-link" href="/admin/vol/?lang=<?php echo LANGUAGE_CODE ?>">
            <i class="fas fa-book"></i>
            <span><?php echo _pll('Vol'); ?></span></a>
    </li>

    <li class="nav-item <?php echo $page_slug === 'category' ? 'active' : '' ?>">
        <a class="nav-link" href="/admin/category/?lang=<?php echo LANGUAGE_CODE ?>">
            <i class="fas fa-list"></i>
            <span><?php echo _pll('Category'); ?></span></a>
    </li>

    <li class="nav-item <?php echo $page_slug === 'backnumber' ? 'active' : '' ?>">
        <a class="nav-link" href="/admin/backnumber/?lang=<?php echo LANGUAGE_CODE ?>">
            <i class="fas fa-columns"></i>
            <span><?php echo _pll('BackNumber'); ?></span></a>
    </li>

    <?php if ($_SESSION["permission"] == 1) { ?>
        <li class="nav-item <?php echo $page_slug === 'user' ? 'active' : '' ?>">
            <a class="nav-link" href="/admin/user/?lang=<?php echo LANGUAGE_CODE ?>">
                <i class="fas fa-users"></i>
                <span><?php echo _pll('User'); ?></span></a>
        </li>
    <?php } ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item <?php echo $page_slug === 'setting' ? 'active' : '' ?>">
        <a class="nav-link" href="/admin/setting/?lang=<?php echo LANGUAGE_CODE ?>">
            <i class="fas fa-cog"></i>
            <span><?php echo _pll('Setting'); ?></span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item <?php echo $page_slug === 'helper' ? 'active' : '' ?>">
        <a class="nav-link" href="/admin/helper/?lang=<?php echo LANGUAGE_CODE ?>">
            <i class="far fa-life-ring"></i>
            <span><?php echo _pll('Helper'); ?></span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>