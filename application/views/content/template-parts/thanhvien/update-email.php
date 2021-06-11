<?php
	global $user_email;;
	global $user_id;
	global $user_typethanhvien;
?>
<div class="content-middle3 marginCenter">
	<div class="mh680-pc">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 marginBottom22 relative hidden-xs marginTop39">
			<a title="back" href="javascript: window.history.go(-1)" class="button-back"><span class="icon-24 icon-button-back marginRight15"></span>Quay lại</a>
			<div class="title-content-page">Đổi email</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-white-content marginBottom25-pc marginBottom10-mb paddingBottom15-mb pl12mb pr12mb">
			<form class="form-06b" method="POST" id="frm_update_email_user">
			<div class="content-box-white">
				<div class="col-xs-12 padding0-pc form-group pst-relative marginTop12">
					<label for="" class="col-sm-4 control-label label-register2">Email cũ</label>
					<div class="col-sm-8 padding0">
						 <div class="text-gray pt11 paddingTop0-mb"><?php echo $user_email; ?></div>
					</div>
				</div>

				<div class="col-xs-12 padding0-pc form-group pst-relative marginTop12">
					<label for="" class="col-sm-4 control-label label-register2">Nhập Email mới</label>
					<div class="col-sm-8 padding0">
						<input type="text" id="email" name="email" class="form-control h40" placeholder="Email">                                            	        
						<p id="error_email" class="hidden text-red error"></p>
					</div>
				</div>
				<input type="text" id="old_email" name="old_email" class="hidden form-control h40" value="<?php echo $user_email; ?>" hidden readonly>                                            	        
				<input type="text" id="typethanhvien" name="typethanhvien" class="hidden form-control h40" value="<?php echo $user_typethanhvien; ?>" hidden readonly>                                            	        
				<input type="text" id="link_xuly" name="link_xuly" class="hidden form-control h40" value="<?php echo URL; ?>page/update_email_user" hidden readonly>                                            	        
				<input type="text" id="link_dr" name="link_dr" class="hidden form-control h40" value="<?php echo URL; ?>dang-xuat" hidden readonly>                                            	        

				<div class="col-xs-12 form-group padding0-pc marginBottom25 marginBottom0-mb marginTop10 ">
					<label for="" class="col-sm-4 control-label label-register2 hidden-xs">&nbsp;</label>
					<div class="col-sm-8 padding0">
						<button type="button" class="btn btn-default fontSize16 button-green button-save-06b" id="btn_update_email_user">LƯU THAY ĐỔI</button>
						<button type="button" class="btn btn-default fontSize16 button-gray button-cancel-06b" onclick="cancel();">HỦY</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
    function cancel() {
        window.location.href = "<?php echo URL;?>quan-ly-tai-khoan";
    }
</script> 