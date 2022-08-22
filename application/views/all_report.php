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
                    <div class="card" style="padding: 10px;">
                        <div class="card-body">
                            <form method="GET" action="<?php echo base_url(); ?>index.php/report/all_report"> 
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
                                <a href="<?php echo base_url().'index.php/report/all_report_export/'.$tgl_awal.'/'.$tgl_akhir; ?>" class="btn btn-success" style="padding-right: 10px">
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope='col'>NO</th>
                                <th scope='col'>Sales Listing</th>
                                <th scope='col'>Sales Selling</th>
                                <th scope='col'>Harcourts Office</th>
                                <th scope='col'>Alamat Property</th>
                                <th scope='col'>Jual / Beli</th>
                                <th scope='col'>Sewa</th>
                                <th scope='col'>Harga Include PPN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($result as $key) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $key->sales_listing; ?></td>
                                    <td><?php echo $key->sales_selling; ?></td>
                                    <td><?php echo $key->harcourts_office; ?></td>
                                    <td><?php echo $key->alamat_property; ?></td>
                                    <td><?php echo $key->tipe_jual; ?></td>
                                    <td><?php echo $key->tipe_sewa; ?></td>
                                    <td><?php echo $key->include_ppn; ?></td>
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

</body>

</html>