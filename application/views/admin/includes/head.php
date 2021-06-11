<?php

	$siteurl=$this->admin_model->select_value_table_dk_col('option','name','="siteurl"','value');
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $page_title;?> | <?php echo $siteurl; ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo(BC_AD.'bootstrap/dist/css/bootstrap.min.css');?>">
	<link rel="stylesheet" href="<?php echo(BC_AD.'font-awesome/css/font-awesome.min.css');?>">
	<link rel="stylesheet" href="<?php echo(DIST_AD.'css/AdminLTE.min.css');?>">
	<link rel="stylesheet" href="<?php echo(DIST_AD.'css/skins/_all-skins.min.css');?>">
	<link rel="stylesheet" href="<?php echo(CSS_AD.'custom.css');?>">
	<script src="<?php echo(BC_AD.'jquery/dist/jquery.min.js');?>"></script>
	<script>
		var hd = {'lang': {}},
				BASE_URL = '<?php echo URL;?>';
	</script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<script src="<?php echo(BC_AD.'jquery-ui/jquery-ui.min.js');?>"></script>
	<script src="<?php echo(BC_AD.'bootstrap/dist/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo(DIST_AD.'js/adminlte.min.js');?>"></script>
	<script src="<?php echo(BC_AD.'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
	<script src="<?php echo(BC_AD.'bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js'); ?>"></script>
	<link href="<?php echo(BC_AD.'bootstrap-timepicker/css/bootstrap-timepicker.min.css'); ?>" rel="stylesheet" >
	<link href="<?php echo(BC_AD.'bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css'); ?>" rel="stylesheet" >
	<script src="<?php echo(BC_AD.'bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>"></script>
	<script src="<?php echo(BC_AD.'Sorting-Select/jquery.dragoptions.js'); ?>"></script>
	<link rel="icon" href="<?php echo $this->admin_model->select_value_table_dk_col('option','name','="favicon"','value')?>" type="image/gif" sizes="32x32">

	<script src="<?php echo( PLUGINS_AD . 'tinymce/tinymce.min.js' ); ?>"></script>
	<script src="<?php echo( PLUGINS_AD . 'tinymce/jquery.tinymce.min.js' ); ?>"></script>
	<script src="<?php echo( JS_AD . 'wysiwyg.js' ); ?>"></script>
	<script src="<?php echo( JS_AD . 'xuly.js' ); ?>"></script>
	<script>
	$(function () {
		$('.datetimepicker').datepicker({
			format:'yyyy-mm-dd',
		});
	});
	$(function () {

		$('.timepicker').timepicker();

	});
	$.widget.bridge('uibutton', $.ui.button);
	$(function () {
		$(".col-order-sort-gr").sortable({
			update: function (event, ui) {
				var order = $(this).sortable('serialize');
			}
		}).disableSelection();
		$(".list_sp_varible").sortable({
			update: function (event, ui) {
				var order = $(this).sortable('serialize');
			}
		}).disableSelection();
		$(".multiple_sl").dragOptions({
		  highlight: "►"
		});
		$('.btn_update_order_table').on('click', function () {
			var a = $("#postList").sortable("serialize", {
				attribute: "id"
			});
			console.log(a);
			alert(a);
		});
	});
	</script>
</head>
