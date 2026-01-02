<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('includes/meta_info'); ?>
    <?php $this->load->view('includes/css_includes'); ?>

    <link rel='shortcut icon' type='image/x-icon' href='<?= site_url() ?>resources/img/spec_logo.jfif' />
</head>

<body class="barossa-sidebar theme-allports">

    <?php
    $modules = $this->config->item("modules");
    ?>

    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i class="fas fa-expand"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= site_url() ?>resources/img/default_image.png"
                                class="user-img-radious-style" style="background-color:darkslategrey;">
                            <span class="d-sm-none d-lg-inline-block"></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title"><?= $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?>
                            </div>
                            <!-- <a href="profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a> -->
                            <div class="dropdown-divider"></div>
                            <a href="<?= site_url('logout') ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="<?= site_url() ?>">
                            <img alt="image" src="<?= site_url() ?>resources/img/spec_logo.jfif" class="header-logo" />
                            <span class="logo-name">Spec Portal</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="dropdown active" style="display: block;">
                            <div class="sidebar-profile">
                                <div class="siderbar-profile-pic">
                                    <img src="<?= site_url() ?>resources/img/default_image.png"
                                        class="profile-img-circle box-center" alt="User Image"
                                        style="background-color:darkslategrey;">
                                </div>
                                <div class="siderbar-profile-details">
                                    <div class="siderbar-profile-name">
                                        <?= $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></div>
                                </div>
                            </div>
                        </li>
                        <li class="menu-header">Main</li>
                        <li class="dropdown">
                            <a href="<?= site_url() ?>" class="nav-link"><i
                                    class="fas fa-desktop"></i><span>Dashboard</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="" class="nav-link has-dropdown toggle"><i
                                    class="fa fa-laptop-medical"></i><span>Transaction</span></a>
                            <ul class="dropdown-menu">
                                <?php
                                if (check_modules_access($modules['ticket_master']['module_id']) == true)
                                {
                                ?>
                                <li><a class="nav-link" href="<?= site_url('normal_user') ?>">Add Ticket Master User</a>
                                </li>
                                <?php
                                }
                                ?>

                                <?php
                                if (check_modules_access($modules['all_transaction']['module_id']) == true)
                                {
                                ?>
                                <li><a class="nav-link" href="<?= site_url('all_transaction') ?>">All transaction</a>
                                </li>
                                <?php
                                }
                                ?>

                                <?php if ( (check_modules_access($modules['all_transaction']['module_id']) == true) || (check_modules_access($modules['ticket_master']['module_id']) == true)  ) { ?>
                                    <li><a class="nav-link" href="<?= site_url('add_transaction') ?>">Add Transaction</a>
                                    </li>
                                <?php } ?>

                                <?php
                                if (check_modules_access($modules['buy']['module_id']) == true)
                                {
                                ?>
                                <li><a class="nav-link" href="<?= site_url('download_transaction') ?>">Buy</a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>

                        <?php
                        if (check_modules_access($modules['users']['module_id']) == true)
                        {
                        ?>
                        <li class="dropdown">
                            <a href="" class="nav-link has-dropdown toggle"><i
                                    class="fa fa-user"></i><span>Users</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= site_url('list') ?>">List Portal Users</a>
                                </li>
                                <li><a class="nav-link" href="<?= site_url('add') ?>">Add Portal User</a>
                                </li>
                            </ul>
                        </li>

                        <?php
                        }
                        ?>
                        <?php
                        if (check_modules_access($modules['charts']['module_id']) == true)
                        {
                        ?>
                        <li class="dropdown">
                            <a href="" class="nav-link has-dropdown toggle"><i
                                    class="fa fa-user"></i><span>Charts</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= site_url('charts') ?>">View Charts</a>
                                </li>
                            </ul>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </aside>
            </div>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">

                    <?php
                    if (isset($_view) && $_view)
                        $this->load->view($_view);
                    ?>

                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; <?= date("Y"); ?> <div class="bullet"></div> Developed By <a target="_blank"
                        href="https://conviersolutions.com" style="color:cornflowerblue">Convier Solutions</a>
                </div>
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>
    <?php $this->load->view('includes/js_includes'); ?>

</body>

</html>