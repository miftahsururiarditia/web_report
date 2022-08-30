<html>

<head>
    <?php $this->load->view('_partials/head.php'); ?>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <?php $this->load->view('_partials/header.php'); ?>

    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <h1>WELCOME, <?php echo $meta['user']; ?></h1>
            </div>
        </div>
    </div>

    <?php $this->load->view('_partials/footer.php'); ?>

</body>

</html>