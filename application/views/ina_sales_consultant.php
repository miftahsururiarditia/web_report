<html>

<head>
    <?php $this->load->view('_partials/head.php'); ?>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <?php $this->load->view('_partials/header.php'); ?>

    <div class="page-wrapper">
        <div class="container-fluid">
            <h3>Ina Sales Consultant</h3>
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card" style="padding: 10px;">
                        <div class="card-body">
                            <form method="GET" action="<?php echo base_url(); ?>index.php/ina_sales_consultant"> 
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
                                <a href="<?php echo base_url().'index.php/report/ina_sales_consultant_export/'.$tgl_awal.'/'.$tgl_akhir; ?>" class="btn btn-success" style="padding-right: 10px">
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
                                <th scope='col'>Career Path</th>
                                <th scope='col'>Rank</th>
                                <!-- <th scope='col'>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($result as $key) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $key->sales_consultant; ?></td>
                                    <td><?php echo $key->harcourts; ?></td>
                                    <td><?php echo ""; ?></td>
                                    <td><?php echo ""; ?></td>
                                    <!-- <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-idconsultant="<?php echo $key->sales_consultant_id; ?>" data-consultantname="<?php echo $key->sales_consultant; ?>">Edit</button></td> -->
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

    <!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Sales Consultant</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
            <div class="form-group">
                <label for="sales-name" class="col-form-label">Sales Consultant Name:</label>
                <input type="text" class="form-control" id="sales-name" readonly>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Career Path:</label>
                <input type="text" class="form-control" id="career-path">
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
        </div>
        </div>
    </div>
    </div> -->

    <?php $this->load->view('_partials/footer.php'); ?>

</body>
</html>