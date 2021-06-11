<?php

	//------- get infor user ----------//

	$user_infor=$this->admin_model->get_user_by_email($_SESSION['user_admin'],'admin');

	foreach($user_infor as $row_user_infor){

		$hoten=$row_user_infor->hoten;

		$ngaydangky=$row_user_infor->ngaydangky;

		$anhdaidien=$row_user_infor->anhdaidien;

		$typethanhvien=$row_user_infor->typethanhvien;

	}

?>

<aside class="main-sidebar">

	<section class="sidebar">

		<div class="user-panel">

			<div class="pull-left image">

				<img loading="lazy" src="<?php echo UP_POST.$anhdaidien; ?>" class="img-circle" alt="User Image">

			</div>

			<div class="pull-left info">

				<p><?php echo $hoten; ?></p>

				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>

			</div>

		</div>

	  <!-- search form -->

		<form action="#" method="get" class="sidebar-form" hidden>

			<div class="input-group">

				<input type="text" name="q" class="form-control" placeholder="Search...">

				<span class="input-group-btn">

					<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>

				</span>

			</div>

		</form>

	  <!-- /.search form -->

		<?php if($typethanhvien=='admin'){?>

		<ul class="sidebar-menu" data-widget="tree" id="sidebar-menu-ad">

			<li class="active">

				<a href="<?php echo URL_AD; ?>">

					<i class="fa fa-dashboard"></i> <span>Bảng tin</span>

				</a>

			</li>

			<li class="active">

				<a href="<?php echo URL; ?>" target="_blank">

					<i class="fa fa-home"></i> <span>Trang chủ</span>

				</a>

			</li>

			<li>

				<a href="<?php echo URL_AD.'setting'?>">

					<i class="fa fa-cogs"></i> <span>Cài đặt</span>

				</a>

			</li>

			<li>

				<a href="<?php echo URL_AD.'media'?>">

					<i class="fa fa-image"></i> <span>Thư viện</span>

				</a>

			</li>

			<li>

				<a href="<?php echo URL_AD.'post?post_type=menu'?>">

					<i class="fa fa-bars"></i> <span>Menu</span>

				</a>

			</li>

			<li class="treeview">

				<a href="#">

					<i class="fa fa-th-large"></i>

					<span>Sản phẩm</span>

					<span class="pull-right-container">

						<span class="label label-primary pull-right">4</span>

					</span>

				</a>

				<ul class="treeview-menu">

					<li><a href="<?php echo URL_AD.'post?post_type=sanpham'?>"><i class="fa fa-circle-o"></i> Tất cả sản phẩm</a></li>

					<li><a href="<?php echo URL_AD.'post_new?post_type=sanpham'?>"><i class="fa fa-circle-o"></i> Thêm sản phẩm mới</a></li>

					<li><a href="<?php echo URL_AD.'post?post_type=danhmucsanpham'?>"><i class="fa fa-circle-o"></i> Danh mục sản phẩm</a></li>

					<li><a href="<?php echo URL_AD.'post?post_type=thuoctinhsanpham'?>"><i class="fa fa-circle-o"></i> Các thuộc tính</a></li>

				</ul>

			</li>


			<li>

				<a href="<?php echo URL_AD.'donhang'?>">

					<i class="fa fa-database"></i><span>Đơn hàng</span>

				</a>

			</li>

			<li class="treeview">

				<a href="#">

					<i class="fa fa-windows"></i>

					<span>Slider</span>

					<span class="pull-right-container">

						<span class="label label-primary pull-right">3</span>

					</span>

				</a>

				<ul class="treeview-menu">

					<li><a href="<?php echo URL_AD.'post?post_type=slider'?>"><i class="fa fa-circle-o"></i> Tất cả hình slider</a></li>

					<li><a href="<?php echo URL_AD.'post_new?post_type=slider'?>"><i class="fa fa-circle-o"></i> Thêm ảnh mới</a></li>

					<li><a href="<?php echo URL_AD.'post?post_type=slider_cat'?>"><i class="fa fa-circle-o"></i> Nhóm slider</a></li>

				</ul>

			</li>

			<li class="treeview">

				<a href="#">

					<i class="fa fa-clone"></i>

						<span>Widget</span>

						<span class="pull-right-container">

							<span class="label label-primary pull-right">3</span>

						</span>

				</a>

				<ul class="treeview-menu">

					<li><a href="<?php echo URL_AD.'post?post_type=widget'?>"><i class="fa fa-circle-o"></i> Tất cả widget</a></li>

					<li><a href="<?php echo URL_AD.'post_new?post_type=widget'?>"><i class="fa fa-circle-o"></i> Viết widget mới</a></li>

					<li><a href="<?php echo URL_AD.'post?post_type=widget_cat'?>"><i class="fa fa-circle-o"></i> Chuyên mục widget</a></li>

				</ul>

			</li>

			<li class="treeview">

				<a href="#">

					<i class="fa fa-files-o"></i>

					<span>Bài viết</span>

					<span class="pull-right-container">

					  <span class="label label-primary pull-right">3</span>

					</span>

				</a>

				<ul class="treeview-menu">

					<li><a href="<?php echo URL_AD.'post'?>"><i class="fa fa-circle-o"></i> Tất cả bài viết</a></li>

					<li><a href="<?php echo URL_AD.'post_new'?>"><i class="fa fa-circle-o"></i> Viết bài mới</a></li>

					<li><a href="<?php echo URL_AD.'post?post_type=cat'?>"><i class="fa fa-circle-o"></i> Chuyên mục</a></li>

				</ul>

			</li>

			<li class="treeview">

				<a href="#">

					<i class="fa fa-book"></i>

					<span>Trang</span>

					<span class="pull-right-container">

					  <span class="label label-primary pull-right">2</span>

					</span>

				</a>

				<ul class="treeview-menu">

					<li><a href="<?php echo URL_AD.'post?post_type=page'?>"><i class="fa fa-circle-o"></i> Tất cả các trang</a></li>

					<li><a href="<?php echo URL_AD.'post_new?post_type=page'?>"><i class="fa fa-circle-o"></i> Thêm trang mới</a></li>

				</ul>

			</li>



			<li class="treeview">

				<a href="#">

					<i class="fa fa-cog"></i>

					<span>Cấu hình website</span>

					<span class="pull-right-container">

					  <span class="label label-primary pull-right">1</span>

					</span>

				</a>

				<ul class="treeview-menu">

					<li>

						<a href="<?php echo URL_AD.'post_new?post_type=home_config'; ?>"> 

							<i class="fa fa-circle-o"></i> <span>Trang chủ</span>

						</a>

					</li>

				</ul>

			</li>

			<li class="treeview">

				<a href="#">

					<i class="fa fa-users"></i>

					<span>Thành viên</span>

					<span class="pull-right-container">

					  <span class="label label-primary pull-right">2</span>

					</span>

				</a>

				<ul class="treeview-menu">

					<li><a href="<?php echo URL_AD.'member'?>"><i class="fa fa-circle-o"></i> Tất cả thành viên</a></li>

					<li><a href="<?php echo URL_AD.'add_member'?>"><i class="fa fa-circle-o"></i> Thêm thành viên</a></li>

				</ul>

			</li>

			<li><a href="<?php echo (URL.'logout')?>"><i class="fa fa-book"></i> <span>Đăng xuất</span></a></li>

		</ul>

		<?php } else if($typethanhvien=='tuyensinh'){?>

			<ul class="sidebar-menu" data-widget="tree">

				<li class="active">

					<a href="<?php echo URL_AD; ?>">

						<i class="fa fa-dashboard"></i> <span>Bảng tin</span>

					</a>

				</li>

				<li class="treeview">

					<a href="#">

						<i class="fa fa-windows"></i>

						<span>Slider</span>

						<span class="pull-right-container">

							<span class="label label-primary pull-right">3</span>

						</span>

					</a>

					<ul class="treeview-menu">

						<li><a href="<?php echo URL_AD.'post?post_type=slider'?>"><i class="fa fa-circle-o"></i> Tất cả slider</a></li>

						<li><a href="<?php echo URL_AD.'post_new?post_type=slider'?>"><i class="fa fa-circle-o"></i> Thêm slider mới</a></li>

						<li><a href="<?php echo URL_AD.'post?post_type=slider_cat'?>"><i class="fa fa-circle-o"></i> Chuyên mục slider</a></li>

					</ul>

				</li>

				<li class="treeview">

					<a href="#">

						<i class="fa fa-files-o"></i>

						<span>Bài viết</span>

						<span class="pull-right-container">

						  <span class="label label-primary pull-right">3</span>

						</span>

					</a>

					<ul class="treeview-menu">

						<li><a href="<?php echo URL_AD.'post'?>"><i class="fa fa-circle-o"></i> Tất cả bài viết</a></li>

						<li><a href="<?php echo URL_AD.'post_new'?>"><i class="fa fa-circle-o"></i> Viết bài mới</a></li>

						<li><a href="<?php echo URL_AD.'post?post_type=cat'?>"><i class="fa fa-circle-o"></i> Chuyên mục</a></li>

					</ul>

				</li>

				<li class="treeview">

					<a href="#">

						<i class="fa fa-book"></i>

						<span>Trang</span>

						<span class="pull-right-container">

						  <span class="label label-primary pull-right">2</span>

						</span>

					</a>

					<ul class="treeview-menu">

						<li><a href="<?php echo URL_AD.'post?post_type=page'?>"><i class="fa fa-circle-o"></i> Tất cả các trang</a></li>

						<li><a href="<?php echo URL_AD.'post_new?post_type=page'?>"><i class="fa fa-circle-o"></i> Thêm trang mới</a></li>

					</ul>

				</li>

				<li class="treeview">

					<a href="#">

						<i class="fa fa-th-large"></i>

						<span>Sản phẩm</span>

						<span class="pull-right-container">

							<span class="label label-primary pull-right">4</span>

						</span>

					</a>

					<ul class="treeview-menu">

						<li><a href="<?php echo URL_AD.'post?post_type=sanpham'?>"><i class="fa fa-circle-o"></i> Tất cả sản phẩm</a></li>

						<li><a href="<?php echo URL_AD.'post_new?post_type=sanpham'?>"><i class="fa fa-circle-o"></i> Thêm sản phẩm mới</a></li>

						<li><a href="<?php echo URL_AD.'post?post_type=danhmucsanpham'?>"><i class="fa fa-circle-o"></i> Danh mục sản phẩm</a></li>

						<li><a href="<?php echo URL_AD.'post?post_type=thuoctinhsanpham'?>"><i class="fa fa-circle-o"></i> Các thuộc tính</a></li>

					</ul>

				</li>

				<li><a href="<?php echo (URL.'logout')?>"><i class="fa fa-book"></i> <span>Đăng xuất</span></a></li>

			</ul>

		<?php } ?>

	</section>

</aside>



<script type="text/javascript">

	var loc = window.location;

	$('#sidebar-menu-ad').find('a').each(function() {

		$(this).parents( "li" ).toggleClass('active', $(this).attr('href') == loc);

	});

</script>
