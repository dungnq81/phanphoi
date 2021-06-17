<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1.0, user-scalable=no" name="viewport" />
	<meta name="google-site-verification" content="2xOiC7UfqrfaJXmzCZNsXI_qCS8qfOsIIUU_NV33UF8" />
	<?php $this->load->view('/content/title-seo'); ?>
	<?php
	$uri_arr = $this->uri->segment_array();
	if(isset($uri_arr[2]))
		unset($uri_arr[2]);

	$ca_url = rtrim(base_url(), '/');
	if(isset($uri_arr[1]))
		$ca_url = $ca_url . '/' . $uri_arr[1];

	?>
	<link rel="canonical" href="<?php echo $ca_url; ?>" />
    <meta name="robots" content="index, follow, noodp, noydir" />
	<link rel="dns-prefetch" href="//ajax.googleapis.com" />
	<link rel="dns-prefetch" href="//code.jquery.com" />
	<script>
		var hd = {'lang': {}}, BASE_URL = '<?php echo URL;?>';
		hd.css = '<?php echo CSS;?>';
		hd.js = '<?php echo JS;?>';
	</script>
	<link href="<?php echo(CSS.'bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo(BC_AD.'bootstrap/dist/css/bootstrap-theme.min.css'); ?>" rel="stylesheet" >
	<link href="<?php echo(JS.'OwlCarousel/dist/assets/owl.carousel.min.css'); ?>" rel="stylesheet" >
	<link href="<?php echo(JS.'OwlCarousel/dist/assets/owl.theme.default.min.css'); ?>" rel="stylesheet" >
	<link href="<?php echo(JS.'WOW/css/libs/animate.css'); ?>" rel="stylesheet" >
	<link href="<?php echo(BC_AD.'bootstrap-datepicker/dist/css/bootstrap-datepicker.css'); ?>" rel="stylesheet" >
	<link href="<?php echo(BC_AD.'bootstrap-timepicker/css/bootstrap-timepicker.min.css'); ?>" rel="stylesheet" >
	<?php asset_css([ 'asset::fontawesome.min.css', 'asset::style.css', 'asset::app.css' ]); ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!--<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>-->
	<script src="<?php echo(BC_AD.'bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
 	<script src="<?php echo(BC_AD.'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
	<script src="<?php echo(BC_AD.'bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>"></script>	
	<link rel="icon" href="<?php echo $this->page_model->select_value_table_dk_col('option','name','="favicon"','value')?>" type="image/gif" sizes="32x32">
	<?php $this->load->view('content/libs/infor_user.php'); ?>
	<meta property="fb:app_id" content="814744095763933" />
	<?php asset_js( [ 'asset::jquery.query.min.js', 'asset::WOW/dist/wow.min.js', 'asset::OwlCarousel/dist/owl.carousel.min.js', 'asset::functions.js' ] ); ?>
</head>
