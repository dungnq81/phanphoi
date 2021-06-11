<!DOCTYPE html>
<html>
<?php $this->load->view('admin/includes/head');?>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php $this->load->view('admin/includes/header.php'); ?>	
		<?php $this->load->view('admin/includes/main-sidebar.php'); ?>
		<div class="content-wrapper">
			<section class="content-header">
				  <h1><?php echo $page_title; ?>
					<small><?php echo $page_des; ?></small>
				  </h1>
				  <ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
					<li class="active"><?php echo $page_title; ?></li>
				  </ol>
			</section>
		<section class="content">
			<?php $this->load->view('admin/pages/content/'.$page_slug) ?>
		</section>
	  </div>
		<?php $this->load->view('admin/includes/footer');?>
		<?php //$this->load->view('admin/includes/control-sidebar');?>
	</div>
</body>
</html>
