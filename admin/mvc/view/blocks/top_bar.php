<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!'); ?>

<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <div class="from-search__language col-auto mr-3 d-flex justify-content-center">
        <ul class="align-self-center lang-items">
            <li>
                <a href="<?php echo $url; ?>?lang=vi" class="<?php echo $class_menu_vi; ?> text-white shadow">VN</a>
            </li>
            <li>
                <a href="<?php echo $url; ?>?lang=ja" class="<?php echo $class_menu_ja; ?> text-white shadow">JP</a>
            </li>
        </ul>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">


        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline small" style="text-transform: capitalize; color: #000;"><?php echo $_SESSION['fullname']; ?></span>
                <i class="fas fa-user-circle text-dark" style="font-size: 26px;"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/admin/user/?lang=<?php echo LANGUAGE_CODE ?>&action=edit&id=<?php echo $_SESSION['user_id']; ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?php echo _pll('Profile'); ?>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?php echo _pll('Logout'); ?>
                </a>
            </div>
        </li>

    </ul>

</nav>