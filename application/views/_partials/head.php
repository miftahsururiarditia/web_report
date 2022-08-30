<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($meta['title']) ? $meta['title'] : 'harcourts.co.id' ?></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/colors/blue.css" id="theme">
<link rel="icon" href="<?php echo base_url(); ?>assets/img/admin-logo.png" type="image/gif">
<link href="<?php echo base_url(); ?>assets/report/css/pagination.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.css" rel="stylesheet">

<style>
    .navbar-nav-cust {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
        align-items: flex-end;
    }

    .my-lg-0-cust {
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }

    .nav-link-cust {
        display: block;
        padding: 0.1em 0.1em;
    }

    .nav-link-sub-cust {
        display: block;
        margin-top: -8px;
        margin-right: 3px;
    }

    .text-white-cust {
        color: #fff !important;
        font-size: 15px;
    }
    .text-white-sub-cust {
        color: #606060 !important;
        font-size: 12px;
    }
</style>