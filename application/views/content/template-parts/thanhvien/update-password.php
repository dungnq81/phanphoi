<?php
	global $user_email;
	global $user_typethanhvien;
?>
<div class="content-middle3 marginCenter">
	<div class="">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 marginBottom22 relative hidden-xs marginTop39">
			<a title="back" href="javascript: window.history.go(-1)" class="button-back"><span class="icon-24 icon-button-back marginRight15"></span>Quay lại</a>
			<div class="title-content-page">Đổi mật khẩu</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-white-content marginBottom25-pc marginBottom10-mb paddingBottom15-mb pl12mb pr12mb">
		<form class="form-06b" name="frmMain" action="" method="post">
			<div class="content-box-white">
				<div class="col-xs-12 padding0-pc pst-relative  marginBottom0-mb">
					<div class="col-sm-12 padding0 error-info">
				</div>
				</div>

				<div class="col-xs-12 padding0-pc form-group pst-relative marginTop12 marginTop20-mb marginBottom0-mb">
					<label for="" class="col-sm-4 control-label label-register2">Mật khẩu hiện tại<span class="text-red">*</span></label>
					<div class="col-sm-8 padding0 ippass">
						 <input type="password" id="old_password" name="old_password" class="form-control h40 input-password">                                            	        
						 <p id="error_old_password" class="hidden text-red error"></p>
							 <div class="border-none button-input h40">
							<div class="bg-password top11" id="bg-password"></div>
							<div class="bg-password-show top11" id="bg-password-show"></div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 padding0-pc form-group pst-relative marginTop12 marginTop15-mb marginBottom0-mb">
					<label for="" class="col-sm-4 control-label label-register2">Mật khẩu mới<span class="text-red">*</span></label>
					<div class="col-sm-8 padding0 ippass">
						<input type="password" id="password" name="password" class="form-control h40 input-password">                                            	        
						<p id="error_password" class="hidden text-red error"></p>
						<div class="border-none button-input h40">
							<div class="bg-password top11" id="bg-password-new"></div>
							<div class="bg-password-show top11" id="bg-password-new-show"></div>
						</div>
						<i class="fontSize12">Mật khẩu tối thiểu 8 ký tự.</i>
					</div>
				</div>
				<div class="col-xs-12 padding0-pc form-group pst-relative marginTop12 marginTop15-mb marginBottom0-mb">
					<label for="" class="col-sm-4 control-label label-register2">Nhập lại mật khẩu<span class="text-red">*</span></label>
					<div class="col-sm-8 padding0 ippass">
						<input type="password" id="confirm_password" name="confirm_password" class="form-control h40 input-password">                                            	        
						<p id="error_confirm_password" class="hidden text-red error"></p>
						<div class="border-none button-input h40">
							<div class="bg-password top11" id="bg-confirm-password"></div>
							<div class="bg-password-show top11" id="bg-confirm-password-show"></div>
						</div>
					</div>
				</div>
				<input type="text" id="email" name="email" class="hidden form-control h40" value="<?php echo $user_email; ?>" hidden readonly>                                            	        
				<input type="text" id="typethanhvien" name="typethanhvien" class="hidden form-control h40" value="<?php echo $user_typethanhvien; ?>" hidden readonly>                                            	        
				<input type="text" id="link_xuly" name="link_xuly" class="hidden form-control h40" value="<?php echo URL; ?>page/update_password_user" hidden readonly>                                            	        
				<input type="text" id="link_dr" name="link_dr" class="hidden form-control h40" value="<?php echo URL; ?>dang-xuat" hidden readonly>                                            	        

				<div class="col-xs-12 form-group padding0-pc marginBottom25 marginBottom0-mb marginTop10 marginTop15-mb ">
					<label for="" class="col-sm-4 control-label label-register2 hidden-xs">&nbsp;</label>
					<div class="col-sm-8 padding0">
						<button type="button" class="btn btn-default fontSize16 fontSize14-mb button-green button-save-06b" id="btn_update_password_user">LƯU THAY ĐỔI</button>
						<button type="button" class="btn btn-default fontSize16 fontSize14-mb button-gray button-cancel-06b" id="login" onclick="javascript: window.history.go(-1)">HỦY</button>
					</div>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>