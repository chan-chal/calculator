<!-- partial -->
<div class="container-fluid page-body-wrapper pl-0" style="background: #F5F7FF;">
    <!-- partial:partials/_settings-panel.html -->
    <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
            <i class="settings-close ti-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
            </div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme">
                <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
            </div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
                <div class="tiles success"></div>
                <div class="tiles warning"></div>
                <div class="tiles danger"></div>
                <div class="tiles info"></div>
                <div class="tiles dark"></div>
                <div class="tiles default"></div>
            </div>
        </div>
    </div>

    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
        <?php if($_SESSION['roleid']==1){  ?>
            <li class="nav-item">
            <a class="nav-link" href="home_page.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <?php } ?>
            <li class="nav-item">
            <a class="nav-link" href="welcome_home_page.php">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">My Profile</span>
            </a>
          </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title">Admin</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <!-- <li class="nav-item"> <a class="nav-link" href="login-form.php"> Login </a></li> -->
                       <?php if($_SESSION['roleid']==1){  ?>
                        <li class="nav-item"> <a class="nav-link" href="all_user_page.php"> All Users </a></li>
                       <?php } ?>
                        <!-- <li class="nav-item"> <a class="nav-link" href="admin_data.php"> All Admins </a></li> -->
                        <?php if($_SESSION['roleid']==1 || $_SESSION['roleid'] == 2){  ?>
                        <li class="nav-item"> <a class="nav-link" href="managers_data.php"> Managers </a></li>
                        <?php } ?>
                        <li class="nav-item"> <a class="nav-link" href="workers_data.php"> Workers </a></li>
                        <?php if($_SESSION['roleid']==1 || $_SESSION['roleid'] == 2){  ?>
                        <li class="nav-item"> <a class="nav-link" href="addnewuser.php"> Add New </a></li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
              <i class="icon-ban menu-icon"></i>
              <span class="menu-title">Admin access</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="home_page.php"> Users </a></li> 
            <li class="nav-item"> <a class="nav-link" href="addnewuser.php">Add users</a></li>
            </ul>
            </div>
            </li> -->

        </ul>
    </nav>