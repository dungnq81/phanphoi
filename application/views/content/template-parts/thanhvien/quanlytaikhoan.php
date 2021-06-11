<?php
	$str_replace='<i>(chưa có thông tin)</i>';
	global $user_email;
	global $user_sodienthoai;
	global $user_hoten;
	global $user_id;
	global $user_matkhau;
	global $user_trangthai;
	global $user_typethanhvien;
	global $user_anhdaidien;
	global $user_ngaydangky;
	global $user_ngaysinh;
	global $user_honnhan;
	global $user_gioitinh;
	global $user_diachi;
	global $user_tinh;
	
	
	$user_anhdaidien=$this->xulychuoi->set_defause_user($user_anhdaidien,$str_replace);
	$user_ngaydangky=$this->xulychuoi->set_defause_user($user_ngaydangky,$str_replace);
	$user_ngaysinh=$this->xulychuoi->set_defause_user($user_ngaysinh,$str_replace);	
	$user_diachi=$this->xulychuoi->set_defause_user($user_diachi,$str_replace);	
	$user_honnhan=$this->xulychuoi->set_defause_user($user_honnhan,$str_replace);	
	$user_gioitinh=$this->xulychuoi->set_defause_user($user_gioitinh,$str_replace);
	$user_tinh=$this->xulychuoi->set_defause_user($user_tinh,$str_replace);
	
	if($user_honnhan!=0){
		$user_honnhan=$this->page_model->select_value_table_dk_col('post','id','="'.$user_honnhan.'"','ten');
	}
	if($user_gioitinh!=0){
		$user_gioitinh=$this->page_model->select_value_table_dk_col('post','id','="'.$user_gioitinh.'"','ten');
	}
	if($user_tinh!=0){
		$user_tinh=$this->page_model->select_value_table_dk_col('post','id','="'.$user_tinh.'"','ten');
	}
?>
<div class="container content-middle">
	<div class="row margin0-mb">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 marginBottom20 marginTop40 relative hidden-xs">
			<div class="title-content-page">Quản lý tài khoản</div>
		</div>
		<div class=" pl12mb pr12mb"></div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-white-content marginBottom25 box-white-content-06" style="border: 1px solid #71bf44;">
			<div class="content-box-manage paddingTop15-mb paddingBottom10-mb">
				Tài khoản Người tìm việc của bạn không được duyệt vì lý do:<br>
				<div style="background-color: #f1f8e9; padding: 5px 6px; margin: 8px 0;"> - Số điện thoại không chính xác.<br> - Dùng Tiếng Việt không dấu.<br> - Tài khoản không đầy đủ họ và tên.<br> - Thiếu thông tin ngày, tháng, năm sinh.<br></div>
				Hồ sơ của bạn sẽ không thể nộp đến Nhà tuyển dụng và không hiển thị khi Nhà tuyển dụng tìm kiếm.<br>
				Vui lòng cập nhật lại thông tin tài khoản để hiển thị lại hồ sơ và tiếp tục ứng tuyển vào các vị trí phù hợp.<br>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-white-content marginBottom25 box-white-content-06">
			<div class="title-box-white title-box-white-06">
				<div class="icon-24 icon-lock-06 floatLeft"></div>
				<div class="info-account ">Thông tin đăng nhập</div>
			</div>
			<hr class="margin0 mr-12-mb ml-12-mb">
			<div class="col-xs-12 content-box-manage">
				<div class="col-xs-12 padding0 form-group">
					<label for="" class="col-xs-12 col-sm-4 control-label textLeft paddingLeft0 fontSize16 label-06 paddingTop8-pc">Email</label>
					<div class="col-xs-12 col-sm-6 padding0">
						<p class="text-gray paddingTop8 fontSize16 marginBottom0 text-06"><?php echo $user_email; ?></p>
					</div>
					<div class="col-sm-2 padding0 div-edit">
						<button class="btn btn-edit" onclick="window.location.href='<?php echo URL;?>cap-nhat-thong-tin-email'"><i class="icon-24 icon-penedit"></i><span class="txt hidden-xs">Chỉnh sửa</span></button>
					</div>
				</div>
				<div class="col-xs-12 padding0 form-group">
					<label for="" class="col-xs-12 col-sm-4 control-label textLeft paddingLeft0 fontSize16 label-06 paddingTop8-pc">Số điện thoại</label>
					<div class="col-xs-12 col-sm-6 padding0">
						<p class="text-gray paddingTop8 fontSize16 marginBottom0 text-06"><?php echo $user_sodienthoai; ?></p>
					</div>
					<div class="col-sm-2 padding0 div-edit">
						<button class="btn btn-edit" onclick="window.location.href='<?php echo URL;?>doi-so-dien-thoai'"><i class="icon-24 icon-penedit"></i><span class="txt hidden-xs">Chỉnh sửa</span></button>
					</div>
				</div>
				<div class="col-xs-12 padding0 form-group">
					<label for="" class="col-sm-4 control-label textLeft paddingLeft0 fontSize16 label-06 paddingTop8-pc">Mật khẩu</label>
					<div class="col-sm-6 padding0">
						<p class="text-gray paddingTop8 fontSize16 marginBottom0 text-06">*********</p>
					</div>
					<div class="col-sm-2 padding0 div-edit">
						<button class="btn btn-edit" onclick="window.location.href='<?php echo URL;?>thay-doi-mat-khau'"><i class="icon-24 icon-penedit"></i><span class="txt hidden-xs">Chỉnh sửa</span></button>
					</div>
				</div>
			</div>
		</div>

		<form id="frm-profile" role="form" action="" method="POST" enctype="multipart/form-data">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-white-content marginBottom25 box-white-content-06">
				<div class="title-box-white title-box-white2-06 ">
					<div class="icon-24 icon-user-green floatLeft"></div>
					<div class="info-user">Thông tin cá nhân</div>
				</div>
				<hr class="margin0">
				<div class="content-box-manage content-box-manage2 row margin0" id="box-kinh-nghiem">
					<div class="col-xs-12 padding0 form-group pst-relative marginBottom0 marginBottom12-mb ">
						<label for="" class="col-sm-4 control-label textLeft paddingLeft0 fontSize16 label-06 paddingTop8-pc">Họ tên<span class="visible-xs inline-mb">: </span></label>
						<div class="col-sm-8 padding0 inline-mb">
							<p class="text-gray paddingTop8 fontSize16 text-06"><?php echo $user_hoten; ?></p>
						</div>
					</div>
					<div class="col-xs-12 padding0 form-group pst-relative marginBottom0 marginBottom12-mb">
						<label for="" class="col-sm-4 control-label textLeft paddingLeft0 fontSize16 label-06 paddingTop8-pc">Ngày sinh<span class="visible-xs inline-mb">: </span></label>
						<div class="col-sm-8 padding0 inline-mb">
							<p class="text-gray paddingTop8 fontSize16 text-06"><?php echo $user_ngaysinh; ?></p>
						</div>
					</div>
					<div class="col-xs-12 padding0 form-group pst-relative marginBottom0 marginBottom12-mb">
						<label for="" class="col-sm-4 control-label textLeft paddingLeft0 fontSize16 label-06 paddingTop8-pc">Giới tính<span class="visible-xs inline-mb">: </span></label>
						<div class="col-sm-8 padding0 inline-mb">
							<p class="text-gray paddingTop8 fontSize16 text-06"><?php echo $user_gioitinh; ?></p>
						</div>
					</div>
					<div class="col-xs-12 padding0 form-group pst-relative marginBottom0 marginBottom12-mb">
						<label for="" class="col-sm-4 control-label textLeft paddingLeft0 fontSize16 label-06 paddingTop8-pc">Hôn nhân<span class="visible-xs inline-mb">: </span></label>
						<div class="col-sm-8 padding0 inline-mb">
							<p class="text-gray paddingTop8 fontSize16 text-06"><?php echo $user_honnhan; ?></p>
						</div>
					</div>
					<div class="col-xs-12 padding0 form-group pst-relative marginBottom0 marginBottom12-mb">
						<label for="" class="col-sm-4 control-label textLeft paddingLeft0 fontSize16 label-06 paddingTop8-pc">Địa chỉ<span class="visible-xs inline-mb">: </span></label>
						<div class="col-sm-8 padding0 inline-mb">
							<p class="text-gray paddingTop8 fontSize16 text-06"><?php echo $user_diachi; ?></p>
						</div>
					</div>
					<div class="col-xs-12 padding0 form-group pst-relative marginBottom0 marginBottom12-mb">
						<label for="" class="col-sm-4 control-label textLeft paddingLeft0 fontSize16 label-06 paddingTop8-pc">Tỉnh/thành phố<span class="visible-xs inline-mb">: </span></label>
						<div class="col-sm-8 padding0 inline-mb">
							<p class="text-gray paddingTop8 fontSize16 text-06"><?php echo $user_tinh; ?></i></p>
						</div>
					</div>
					<div class="col-xs-12 form-group padding0 marginBottom25 marginBottom15-mb marginTop5-mb">
						<div class="col-sm-4 padding0">
							<a href="<?php echo URL;?>thay-doi-thong-tin" class="btn btn-default fontSize14 button-green button-06 fontSize16mb" id="login"><i class="icon-24-white icon-pencil2"></i>Sửa thông tin</a>
						</div>
					</div>
				</div>
				<hr class="margin0">
				<div class="title-box-white title-box-white2-06 ">
					<div class="icon-24 icon-user-green floatLeft"></div>
					<div class="info-user">Trình độ chuyên môn</div>
				</div>
				<hr class="margin0">
			</div>	
		</form>
	</div>
</div>