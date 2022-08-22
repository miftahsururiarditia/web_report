<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
</div>
<div id="main-wrapper" style="position: fixed; z-index: 50">
    <header class="topbar">
        <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= site_url('all_report') ?>">
                    <span>
                        <img src="<?php echo base_url(); ?>assets/assets/images/harcourts-logo-fill.png" alt="homepage" class="dark-logo" />
                    </span>
                </a>
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav mr-auto mt-md-0 ">
                    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    <li class="nav-item hidden-sm-down">
                    </li>
                </ul>
                <ul class="navbar-nav-cust my-lg-0-cust">
                    <li class="nav-item dropdown">
                        <a class="nav-link-cust text-white-cust" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/assets/images/users/profile.png" alt="user" class="profile-pic m-r-5" /><?= isset($meta['user']) ? $meta['user'] : 'User' ?></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link-sub-cust text-white-sub-cust" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= isset($meta['role']) ? $meta['role'] : 'Role' ?></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <?php $this->load->view('_partials/navbar.php'); ?>

</div>
<br>
<br>