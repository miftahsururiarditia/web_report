<html>

<head>
    <?php $this->load->view('_partials/head.php'); ?>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <?php $this->load->view('_partials/header.php'); ?>

    <div class="page-wrapper">
        <div class="container-fluid">
            <h3>Total Unit</h3>
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card" style="padding: 10px;">
                        <div class="card-body">
                            <form method="GET" action="<?php echo base_url(); ?>index.php/total_unit"> 
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Tgl Awal</label>
                                        <div class="input-group date datepicker">
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                            <input placeholder="" type="text" class="form-control" name="tgl_awal" value="<?php echo $tgl_awal; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                    <label>Tgl Akhir</label>
                                        <div class="input-group date datepicker2">
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                            <input placeholder="" type="text" class="form-control" name="tgl_akhir" value="<?php echo $tgl_akhir; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Apply Filter</button>
                            </form>
                            <br>
                            <div class="pull-right">
                                <a href="<?php echo base_url().'index.php/report/total_unit_export/'.$tgl_awal.'/'.$tgl_akhir; ?>" class="btn btn-success" style="padding-right: 10px">
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
                    <div class="card">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope='col'>NO</th>
                                <th scope='col'>Sales Consultant</th>
                                <th scope='col'>Harcourts</th>
                                <th scope='col'>Unit Jual</th>
                                <th scope='col'>Unit Sewa</th>
                                <th scope='col'>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($result as $key) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $key->sales_consultant; ?></td>
                                    <td><?php echo $key->harcourts; ?></td>
                                    <td><?php echo $key->unit_jual; ?></td>
                                    <td><?php echo $key->unit_sewa; ?></td>
                                    <td><?php echo $key->total; ?></td>
                                </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    </div>
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
        pickerPosition: "bottom-right"
    });

    $(".datepicker2").datetimepicker({
        format: "yyyy-mm-dd",
        startView: 'month',
        minView: 'month',
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-right"
    });
  })
</script> 
</html>