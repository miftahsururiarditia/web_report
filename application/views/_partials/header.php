<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
</div>
<div id="main-wrapper">
    <header class="topbar">
        <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= site_url('all_report') ?>">
                    <span>
                        <img src="<?php echo base_url(); ?>assets/assets/images/harcourts-logo-small.png" alt="homepage" class="dark-logo" />
                    </span>
                    <!-- <span>
                        <img src="<?php echo base_url(); ?>assets/assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                    </span> -->
                </a>
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav mr-auto mt-md-0 ">
                    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    <li class="nav-item hidden-sm-down">
                        <!-- <form class="app-search p-l-20"> -->
                        <!-- <input type="text" class="form-control" placeholder="Search for...">  -->
                        <!-- <a class="srh-btn"><i class="ti-search"></i></a> -->
                        <!-- </form> -->
                    </li>
                </ul>
                <ul class="navbar-nav my-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/assets/images/users/profile.png" alt="user" class="profile-pic m-r-5" /><?= isset($meta['user']) ? $meta['user'] : 'User' ?></a>
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= isset($meta['role']) ? $meta['role'] : 'Role' ?></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <?php $this->load->view('_partials/navbar.php'); ?>

</div>