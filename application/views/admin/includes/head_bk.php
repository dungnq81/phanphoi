<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $page_title;?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo(BC_AD.'bootstrap/dist/css/bootstrap.min.css');?>">
	<link rel="stylesheet" href="<?php echo(BC_AD.'font-awesome/css/font-awesome.min.css');?>">
	<link rel="stylesheet" href="<?php echo(BC_AD.'Ionicons/css/ionicons.min.css');?>">
	<link rel="stylesheet" href="<?php echo(DIST_AD.'css/AdminLTE.min.css');?>">
	<link rel="stylesheet" href="<?php echo(DIST_AD.'css/skins/_all-skins.min.css');?>">
	<link rel="stylesheet" href="<?php echo(BC_AD.'morris.js/morris.css');?>">
	<link rel="stylesheet" href="<?php echo(BC_AD.'jvectormap/jquery-jvectormap.css');?>">
	<link rel="stylesheet" href="<?php echo(BC_AD.'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>">
	<link rel="stylesheet" href="<?php echo(BC_AD.'bootstrap-daterangepicker/daterangepicker.css');?>">
	<link rel="stylesheet" href="<?php echo(PLUGINS_AD.'bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">
	<link rel="stylesheet" href="<?php echo(CSS_AD.'custom.css');?>">
	<script src="<?php echo(BC_AD.'jquery/dist/jquery.min.js');?>"></script>
	<script src="<?php echo(JS_AD.'xuly.js');?>"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<script src="<?php echo(BC_AD.'jquery/dist/jquery.min.js');?>"></script>
	<script src="<?php echo(BC_AD.'jquery-ui/jquery-ui.min.js');?>"></script>
	<script src="<?php echo(BC_AD.'bootstrap/dist/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo(BC_AD.'raphael/raphael.min.js');?>"></script>
	<!--<script src="<?php //echo(BC_AD.'morris.js/morris.min.js');?>"></script>-->
	<script src="<?php echo(BC_AD.'jquery-sparkline/dist/jquery.sparkline.min.js');?>"></script>
	<script src="<?php echo(PLUGINS_AD.'jvectormap/jquery-jvectormap-1.2.2.min.js');?>"></script>
	<script src="<?php echo(PLUGINS_AD.'jvectormap/jquery-jvectormap-world-mill-en.js');?>"></script>
	<script src="<?php echo(BC_AD.'jquery-knob/dist/jquery.knob.min.js');?>"></script>
	<script src="<?php echo(BC_AD.'moment/min/moment.min.js');?>"></script>
	<script src="<?php echo(BC_AD.'bootstrap-daterangepicker/daterangepicker.js');?>"></script>
	<script src="<?php echo(BC_AD.'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>
	<script src="<?php echo(PLUGINS_AD.'bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"></script>
	<script src="<?php echo(BC_AD.'jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
	<script src="<?php echo(BC_AD.'fastclick/lib/fastclick.js');?>"></script>
	<script src="<?php echo(DIST_AD.'js/adminlte.min.js');?>"></script>
	<!--<script src="<?php //echo(DIST_AD.'js/pages/dashboard.js"');?>"></script>-->
	<script src="<?php echo(DIST_AD.'js/demo.js');?>"></script>
	<!--<script src="<?php //echo(BC_AD.'ckeditor/ckeditor.js');?>"></script>-->
	<script src="<?php echo(PLUGINS_AD.'tinymce/tinymce.min.js');?>"></script>
	<script>
	$.widget.bridge('uibutton', $.ui.button);
	  
	$(function () {
		$("#postList").sortable({
			update: function (event, ui) {
				var order = $(this).sortable('serialize');
			}
		}).disableSelection();
		$('.btn_update_order_table').on('click', function () {
			
			var a = $("#postList").sortable("serialize", {
				attribute: "id"
			});
			console.log(a);
			alert(a);
			// $.ajax({
				// data: a,
				// type: 'POST',
				// url: 'saverank.php'
			// });
		});
	});
	</script>
</head>