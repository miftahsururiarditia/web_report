<html>

<head>
    <?php $this->load->view('_partials/head.php'); ?>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <?php $this->load->view('_partials/header.php'); ?>

    <div class="page-wrapper">
        <div class="container-fluid">
            <h3>All Report</h3>
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h7 class="card-title mb-0">Filter Data</h7>
                        </div>
                        <div class="card-body">
                        <div class="row">
                            <!-- <form method="POST" action="<?php echo base_url(); ?>index.php/report">  -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tgl Awal</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                            <input placeholder="" type="text" class="form-control datepicker" name="tgl_awal">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label>Tgl Akhir</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                            <input placeholder="" type="text" class="form-control datepicker2" name="tgl_akhir">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit">Apply</button>
                            <!-- </form> -->
                            <br>
                            <div class="pull-right">
                                <a href="<?php echo base_url(); ?>index.php/report/export" class="btn btn-success" style="padding-right: 10px">
                                    <i class="fa fa-file-excel-o"></i>
                                    Export Data
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-12">
                <br>
                <?=  $this->pagination->create_links(); ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope='col'>ID</th>
                                <th scope='col'>Post Author</th>
                                <th scope='col'>Post Date</th>
                                <th scope='col'>Post Title</th>
                                <th scope='col'>Post Status</th>
                                <th scope='col'>Post Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $key) { ?>
                                <tr>
                                    <td><?php echo $key->ID; ?></td>
                                    <td><?php echo $key->post_author; ?></td>
                                    <td><?php echo $key->post_date; ?></td>
                                    <td><?php echo $key->post_title; ?></td>
                                    <td><?php echo $key->post_status; ?></td>
                                    <td><?php echo $key->post_name; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?=  $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('_partials/footer.php'); ?>

    <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sidebarmenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script>

</body>

<script type="text/javascript">
  $(document).ready(function() {
    $(".datepicker").datetimepicker({
        format: "yyyy-mm-dd",
        startView: 'month',
        minView: 'month',
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left"
    });

    $(".datepicker2").datetimepicker({
        format: "yyyy-mm-dd",
        startView: 'month',
        minView: 'month',
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left"
    });
  })
</script> 

</html>