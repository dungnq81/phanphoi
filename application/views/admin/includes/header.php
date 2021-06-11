<?php

	//------- get infor user ----------//

	$user_infor=$this->admin_model->get_user_by_email($_SESSION['user_admin'],'admin');

	foreach($user_infor as $row_user_infor){

		$hoten=$row_user_infor->hoten;

		$ngaydangky=$row_user_infor->ngaydangky;

		$anhdaidien=$row_user_infor->anhdaidien;

		$typethanhvien=$row_user_infor->typethanhvien;

	}

	//------ coutn history ----------//

	$count_history_thanhvien=$this->admin_model->count_history_table_today('thanhvien','ngaydangky');

	$count_history_all=$count_history_thanhvien;

?>

<header class="main-header">

	<a href="<?php echo URL_AD; ?>" class="logo">

		<span class="logo-mini"><b>AD</b></span>

		<span class="logo-lg"><b>Quản trị website</b></span>

	</a>

	<nav class="navbar navbar-static-top">

		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

			<span class="sr-only">Toggle navigation</span>

		</a>

		<div class="navbar-custom-menu">

			<ul class="nav navbar-nav">

			  <!-- User Account: style can be found in dropdown.less -->

			  <li class="dropdown user user-menu">

				<a href="#" class="dropdown-toggle" data-toggle="dropdown">

				  <img loading="lazy" src="<?php echo UP_POST.$anhdaidien; ?>" class="user-image" alt="User Image">

				  <span class="hidden-xs"><?php echo $hoten; ?></span>

				</a>

				<ul class="dropdown-menu">

				  <!-- User image -->

				  <li class="user-header">

					<img loading="lazy" src="<?php echo UP_POST.$anhdaidien; ?>" class="img-circle" alt="User Image">

					<p>

					 <?php echo $hoten; ?>

					  <small><?php echo $ngaydangky; ?></small>

					</p>

				  </li>

				  <!-- Menu Body -->

				  <!-- Menu Footer-->

				  <li class="user-footer">

					<div class="pull-left">

						<?php 

							if($typethanhvien=='admin'){

								echo '<a href="'.URL_AD.'infor_admin" class="btn btn-default btn-flat">Thông tin</a>';

							}else{

								echo '<a href="'.URL_AD.'infor_user" class="btn btn-default btn-flat">Thông tin</a>';

							}

						?>

					</div>

					<div class="pull-right">

					  <a href="<?php echo (URL.'logout')?>" class="btn btn-default btn-flat">Đăng xuất</a>

					</div>

				  </li>

				</ul>

			  </li>

			  <!-- Control Sidebar Toggle Button -->

			</ul>

	  </div>

	</nav>

</header>
