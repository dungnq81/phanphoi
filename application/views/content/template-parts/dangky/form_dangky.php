<div class="col-xs-12  padding0-xs">
	<div class="marginCenter width620">
		<form class="form-register paddingTop20" id="form-register">
			<div class="col-xs-12 padding0 form-group marginBottom5">
				<p class="col-xs-12  text-center color-363636 fontSize28 marginBottom10 fontSize20-mb marginBottom15-mb">Người tìm việc đăng ký</p>
				<div class="col-xs-12 error-info paddingLeft0 paddingRight0"></div>
			</div>
			<div class="col-xs-12 padding0 form-group marginBottom0 hidden-xs">
				<i class="text-right marginBottom17 displayBlock fontSize12">(<span class="text-red">*</span>) Thông tin bắt buộc nhập&nbsp;&nbsp;</i>
			</div>

			<div class="col-xs-12 padding0 form-group pst-relative">
				<input type="text" id="input-hoten" name="link_dr" class="form-control input-register hidden" value="<?php echo URL;?>" >			
				<input type="text" id="input-link-xuly" name="link_xuly" class="form-control input-register hidden" value="<?php echo URL;?>page/check_register_user" >			
				<input type="text" id="input-link-xuly-tengiasu" name="link_xuly_tengiasu" class="form-control input-register hidden" value="<?php echo URL;?>page/check_name_register_user" >
				<input type="text" id="input-type" name="type_register" class="form-control input-register hidden" value="<?php echo $typethanhvien;?>">			
				<label for="" class="col-sm-4 control-label label-register">Họ và tên <span class="text-red">*</span></label>
				<div class="col-sm-8 padding0 div-input-margin-moblile">
					<input type="text" id="input-name" name="name" class="form-control input-register">									        	        <p id="error_name" class="hidden text-red error"></p>
					<p class="text-red hidden error_submit error italic fontSize12"></p>
				</div>
			</div>

			<div class="col-xs-12 padding0  form-group pst-relative">
				<label for="" class="col-sm-4 control-label label-register">Email <span class="text-red">*</span></label>
				<div class="col-sm-8 padding0 div-input-margin-moblile">
					<input type="email" id="input-email" name="email" class="form-control input-register">									        	        <p id="error_email" class="hidden text-red error"></p>
					<p class="text-red hidden error_submit error italic fontSize12"></p>
				</div>
			</div>

			<div class="col-xs-12 padding0  form-group pst-relative">
				<label for="" class="col-sm-4 control-label label-register">Số điện thoại <span class="text-red">*</span></label>
				<div class="col-sm-8 padding0 div-input-margin-moblile">
					<input type="text" id="input-sdt" name="mobile" class="form-control input-register">									        	        <p id="error_mobile" class="hidden text-red error"></p>
					<p class="text-red hidden error_submit error italic fontSize12"></p>
				</div>
			</div>

			<div class="col-xs-12 padding0  form-group ">
				<label for="" class="col-sm-4 control-label label-register">Mật Khẩu <span class="text-red">*</span></label>
				<div class="col-sm-8 padding0 div-input-margin-moblile pst-relative">
					<input type="password" id="input-password" name="password" class="form-control input-register" required="required">									
					<p id="error_password" class="hidden text-red error"></p>
					<p class="text-red hidden error_submit error italic fontSize12"></p>
					<i class="fontSize12 note">Mật khẩu tối thiểu 8 ký tự.</i>
				</div>
			</div>

			<div class="col-xs-12 padding0  form-group ">
				<label for="" class="col-sm-4 control-label label-register">Nhập lại mật Khẩu <span class="text-red">*</span></label>
				<div class="col-sm-8 padding0 div-input-margin-moblile pst-relative">
					<input type="password" id="input-retype-password" name="retype_password" class="form-control input-register" required="required">		
					<p id="error_retype_password" class="hidden text-red error"></p>
					<p class="text-red hidden error_submit error italic fontSize12"></p>
				</div>
			</div>

			<div class="col-xs-12 form-group padding0 marginBottom25 marginBottom0-mb">
				<label for="" class="col-sm-4 control-label label-register hidden-xs">&nbsp;</label>
				<div class="col-sm-8 padding0 div-input-margin-moblile">
					<button type="button" class="btn btn-default button-login fontSize16 button-register" id="register_btn">ĐĂNG KÝ</button>
				</div>
			</div>
			
			<div class="col-xs-12 form-group padding0 marginBottom25 div-hr">
				<p class="result_action_alert"></p>
				<hr class="hr-login marginTop0 marginBottom0">
			</div>
		</form>
	</div>
	
	<div class="marginCenter width620">
		<div class="marginTop25 marginCenter text-center register register2 logintk marginTop5-mb marginBottom35-mb">
			<p class="">Bạn đã có tài khoản?
				<a href="https://viectotnhat.com/dang-nhap/nguoi-tim-viec" class="active">Đăng nhập</a>
				<span class="marginLeft5 marginRight5 hidden-xs">|</span>
				<a href="https://viectotnhat.com/dang-ky/nha-tuyen-dung-dang-ky" class="hidden-xs">Nhà tuyển dụng đăng ký</a>
			</p>
		</div>
	</div>
</div>