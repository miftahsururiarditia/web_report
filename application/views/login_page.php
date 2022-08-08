<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/admin-logo.png" type="image/gif">
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</head>

<body style="background-image:url(<?php echo base_url(); ?>assets/img/Administrator.jpg)">
    <div class="container" style="margin:80px auto">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo base_url(); ?>login">
                            <fieldset>
                                <?php if ($this->session->flashdata('message_login_error')) : ?>
                                    <div class="alert alert-danger">
                                        <center><?php echo $this->session->flashdata('message_login_error'); ?></center>
                                    </div>
                                <?php endif; ?>
                                <div class="mb-3 mt-3" style="margin-bottom:5%">
                                    <!-- <span class="input-group-addon"><i class="fa fa-user"></i></span> -->
                                    <!-- <label for="email" class="form-label">Email : </label> -->
                                    <input class="form-control" placeholder="Enter email" name="email" type="text" autofocus style="margin-bottom:1%">
                                    <div class="text-danger"><?= form_error('email') ?></div>
                                </div>
                                <div class="mb-3" style="margin-bottom:5%">
                                    <!-- <label for="pass" class="form-label">Password : </label> -->
                                    <input class="form-control" placeholder="Enter password" name="pass" type="password" value="" style="margin-bottom:1%">
                                    <div class="text-danger"><?= form_error('pass') ?></div>
                                </div>

                                <button type="submit" class="btn btn-lg btn-warning btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>