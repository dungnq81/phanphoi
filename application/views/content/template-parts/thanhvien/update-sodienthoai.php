<?php
	global $user_email;
	global $user_sodienthoai;
	global $user_typethanhvien;
?>
<div class="content-middle3 marginCenter">
	<div class="">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 marginBottom22 relative hidden-xs marginTop39">
			<a title="back" href="https://viectotnhat.com/" class="button-back"><span class="icon-24 icon-button-back marginRight15"></span>Quay lại</a>
			<div class="title-content-page">Đổi số điện thoại</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-white-content marginBottom25-pc marginTop15-mb pl12mb pr12mb">
		<form class="form-06b" action="" method="post">
			<div class="col-xs-12 content-box-white">
				<div class="col-xs-12 padding0-pc form-group">
					<label for="" class="col-sm-4 label-register paddingLeft0">Số điện thoại cũ</label>
					<div class="col-sm-8 padding0 marginTop8">
						<span class="txt-numberphone text-gray"><?php echo $user_sodienthoai;?></span>
					</div>
				</div>
				<div class="col-xs-12 padding0-pc form-group ">
					<label for="" class="col-sm-4 label-register paddingLeft0">Nhập số điện thoại mới</label>
					<div class="col-sm-8 padding0">
						<input type="text" id="input-mobile" name="sodienthoai" class="form-control h40 input-password" placeholder="Số điện thoại mới" maxlength="11">                                            	        
						<p id="error_mobile" class="hidden text-red error"></p>
					</div>
				</div>
				<input type="text" id="old_email" name="old_email" class="hidden form-control h40" value="<?php echo $user_email; ?>" hidden readonly>                                            	        
				<input type="text" id="typethanhvien" name="typethanhvien" class="hidden form-control h40" value="<?php echo $user_typethanhvien; ?>" hidden readonly>                                            	        
				<input type="text" id="link_xuly" name="link_xuly" class="hidden form-control h40" value="<?php echo URL; ?>page/update_sodienthoai_user" hidden readonly>                                            	        
				<input type="text" id="link_dr" name="link_dr" class="hidden form-control h40" value="<?php echo URL; ?>quan-ly-tai-khoan" hidden readonly>                                            	        


				<div class="col-xs-12 form-group padding0-pc marginTop10">
					<label for="" class="col-sm-4 label-register2 hidden-xs">&nbsp;</label>
					<div class="col-sm-8 padding0">
						<button type="button" class="btn btn-default fontSize16 fontSize14-mb button-green button-save-06b" id="btn_update_sodienthoai_user">LƯU THAY ĐỔI</button>
						<button type="button" class="btn btn-default fontSize16 fontSize14-mb button-gray button-cancel-06b" onclick="history.go(-1)">HỦY</button>
					</div>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>