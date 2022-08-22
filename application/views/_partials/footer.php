<footer class="footer">
	&copy; <?= Date('Y') ?> harcourts.co.id
</footer>

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