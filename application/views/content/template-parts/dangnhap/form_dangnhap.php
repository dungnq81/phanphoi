<div class="col-xs-12  padding0-xs">
	<div class="marginCenter width460">
		<form class="form-login form-login52" id="form-login">
			<div class="col-xs-12 padding0 form-group">
				<p class="title-form hidden-xs">Đăng nhập</p>
				<p class="visible-xs fontSize20 txt-36 txc-mb marginTop15-mb">Nhà tuyển dụng đăng nhập</p>
			</div>
			<div class="col-xs-12 padding0 form-group">
				<input type="text" id="input-email-login" name="email" class="form-control input-login" placeholder="Email">  
				<p id="error_email" class="hidden text-red error"></p>
				<p class="text-red hide error" id="error">Bạn không được để trống trường này</p>
				<input type="text" id="input-link-xuly" name="link_xuly" class="form-control input-register hidden" value="<?php echo URL;?>page/check_login_user" >			
				<input type="text" id="input-link-dr" name="link_dr" class="form-control input-register hidden" value="<?php echo URL;?>" >
				<input type="text" id="input-type" name="typethanhvien" class="form-control input-register hidden" value="<?php echo $typethanhvien;?>">			

			</div>
			<div class="col-xs-12 padding0  form-group">
				<input type="password" id="input-password" name="password" class="form-control input-login" placeholder="Mật Khẩu">                                <div class=" border-none button-input"></div>
				<p id="error_password" class="hidden text-red error"></p>
				<p class="text-red hide error" id="error2">Bạn không được để trống trường này</p>
				<div class="border-none button-input">
					<div class="bg-password top18" id="bg-password"></div>
					<div class="bg-password-show top18" id="bg-password-show"></div>
				</div>
			</div>
			<div class="col-xs-12 form-group padding0 ">
				<button type="button" class="btn btn-default button-login btn-green-ntd" id="btn_login_tv">ĐĂNG NHẬP</button>
			</div>
			<p class="result_action_alert text-red"></p>
			<div class="col-xs-12 form-group padding0 text-right txl-mb marginTop5-mb">
				<span class="forgot-password">
				<a class="text-right textGray" href="https://viectotnhat.com/quen-mat-khau/nha-tuyen-dung">Quên mật khẩu?</a>
				</span>
			</div>
		</form>
	</div>
	<div class="marginCenter width460">
		<div class="marginTop25 marginBottom35 marginCenter text-center floatLeft w100p-mb marginBottom15-mb marginTop10-mb">
			<?php
				if($typethanhvien=='giasu'){
					$link_dn=URL.'dang-nhap/phu-huynh';
					$title_dn='Phụ huynh';
				}else{
					$link_dn=URL.'dang-nhap/gia-su';
					$title_dn='Gia sư';
				}
			?>
			<p class="txc-mb">Bạn chưa có tài khoản? <a href="<?php echo URL;?>dang-ky" class="underline txt-green">Đăng ký</a><span class="hidden-xs">&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $link_dn;?>" class="taga2 underline txt-36"><?php echo $title_dn; ?> đăng nhập</a> </span></p>
		</div>
	</div>
</div>