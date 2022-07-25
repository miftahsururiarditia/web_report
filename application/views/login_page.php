<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
    <link rel="icon" href="<?php echo base_url();?>assets/img/blue-k.png" type="image/gif">
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
                        <form role="form" method="post" action="<?php echo base_url(); ?>login/cek_user">
                            <fieldset>
                                <?php if($this->session->flashdata('info')): ?>
                                    <div class="alert alert-danger"><center><?php echo $this->session->flashdata('info'); ?></center></div>
                                <?php endif; ?>
                                <div class="input-group" style="margin-bottom:5%">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control" placeholder="Username" name="user" type="text" autofocus>
                                </div>
                                <div class="input-group" style="margin-bottom:5%">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                                </div>
                              
                                <button  type="submit" class="btn btn-lg btn-warning btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>