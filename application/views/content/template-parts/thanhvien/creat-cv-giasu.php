<?php
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
	$nam_ngaysinh = date('Y', strtotime($user_ngaysinh));
	$thang_ngaysinh = date('m', strtotime($user_ngaysinh));
	$ngay_ngaysinh = date('d', strtotime($user_ngaysinh));
?>
<div class="content-middle marginCenter">
	<div class="mh680-pc row margin0">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 marginBottom22 relative hidden-xs marginTop39">
			<a title="back" href="javascript: window.history.go(-1)" class="button-back">
				<span class="icon-24 icon-button-back marginRight15"/>
			</span>Quay lại</a>
		<div class="title-content-page">Tạo hồ sơ</div>
		</div>
	<div class=" pl12mb pr12mb"/>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-white-content marginBottom70-pc marginBottom0-mb bgWhite-mb  pl12mb pr12mb">
		<form id="frm-main" class="form-06b hidden-xs hidden-sm">
			<div class="content-box-white">
				
				<div class="col-xs-12 padding0-pc form-group">
					<label for="" class="col-sm-3 control-label margin0 label-register2 paddingTop4-pc paddingTop15mb marginTop0-mb marginBottom5-mb">Môn dạy<span class="text-red">*</span></label>
					<div class="col-sm-9 padding0 margin0 checkbox">
						<?php
							$list_gioitinh=$this->page_model->select_table_dk('post','typepost','="monday"');
							foreach($list_gioitinh as $row_list_gioitinh){
								$id_giotinh=$row_list_gioitinh->id;
								$ten_gioitinh=$row_list_gioitinh->ten;
								$checked_gioitinh='';
								$checked='';
								if($id_giotinh==$user_gioitinh){
									$checked_gioitinh="checked='$checked'";
								}
								?>
									<label class="paddingLeft0 paddingTop4 col-md-4">
										<input type="checkbox" id="genderY" name="monday" value="<?php echo $id_giotinh; ?>" class="icheck" <?php echo $checked_gioitinh; ?> />
										<?php echo $ten_gioitinh;?>                                    
									</label>
							<?php }
						?>
						<div class="clearfix"></div>
					</div>
				</div>

				<div class="col-xs-12 padding0-pc form-group">
					<label for="" class="col-sm-3 control-label margin0 label-register2 paddingTop4-pc paddingTop15mb marginTop0-mb marginBottom5-mb">Lớp dạy<span class="text-red">*</span></label>
					<div class="col-sm-9 padding0 margin0 checkbox">
						<?php
							$list_gioitinh=$this->page_model->select_table_dk('post','typepost','="lopday"');
							foreach($list_gioitinh as $row_list_gioitinh){
								$id_giotinh=$row_list_gioitinh->id;
								$ten_gioitinh=$row_list_gioitinh->ten;
								$checked_gioitinh='';
								$checked='';
								if($id_giotinh==$user_gioitinh){
									$checked_gioitinh="checked='$checked'";
								}
								?>
									<label class="paddingLeft0 paddingTop4 col-md-4">
										<input type="checkbox" id="genderY" name="lopday" value="<?php echo $id_giotinh; ?>" class="icheck" <?php echo $checked_gioitinh; ?> />
										<?php echo $ten_gioitinh;?>                                    
									</label>
							<?php }
						?>
						<div class="clearfix"></div>
					</div>
				</div>
				
				<div class="col-xs-12 padding0-pc form-group">
					<label for="" class="col-sm-3 control-label margin0 label-register2 paddingTop4-pc paddingTop15mb marginTop0-mb marginBottom5-mb">Thời gian dạy<span class="text-red">*</span></label>
					<div class="col-sm-9 padding0 margin0 checkbox">
						<?php
							$list_gioitinh=$this->page_model->select_table_dk('post','typepost','="thoigianday"');
							foreach($list_gioitinh as $row_list_gioitinh){
								$id_giotinh=$row_list_gioitinh->id;
								$ten_gioitinh=$row_list_gioitinh->ten;
								$checked_gioitinh='';
								$checked='';
								if($id_giotinh==$user_gioitinh){
									$checked_gioitinh="checked='$checked'";
								}
								?>
									<label class="paddingLeft0 paddingTop4 col-md-4">
										<input type="checkbox" id="genderY" name="thoigianday" value="<?php echo $id_giotinh; ?>" class="icheck" <?php echo $checked_gioitinh; ?> />
										<?php echo $ten_gioitinh;?>                                    
									</label>
							<?php }
						?>
						<div class="clearfix"></div>
					</div>
				</div>
				
				<div class="col-xs-12 padding0-pc form-group">
					<label for="" class="col-sm-3 control-label label-register2 paddingTop15mb marginTop0-mb">Tỉnh/TP dạy<span class="text-red">*</span>
					</label>
					<div class="col-sm-9 padding0 margin0 ">
						<div class="select-city" style="width:100%;">
							<select id="province" name="tinhday" class="select2 12345" style="width:100%">
								<?php 
									$ten_tinh=$this->page_model->select_value_table_dk_col('post','id','="'.$user_tinh.'"','ten');
								?>
								<option value="<?php echo $user_tinh;?>" selected><?php echo $ten_tinh; ?></option>
								<?php
									$list_tp=$this->page_model->select_table_dk('post','typepost','="diadiem"');
									foreach($list_tp as $row_list_tp){
										echo '<option value="'.$row_list_tp->id.'">'.$row_list_tp->ten.'</option>';
									}
								?>
							</select>
						</div>
						<p id="error_province" class="hidden text-red error"/>
						<p class="text-red hidden error_submit error"/>
					</div>
				</div>
				
				<div class="col-xs-12 padding0-pc form-group">
					<label for="" class="col-sm-3 control-label label-register2 hidden-xs">Lương<span class="text-red">*</span></label>
					<div class="col-sm-9 padding0">
						<input type="text" id="name" name="luong" value="" class="form-control h40" />
						<p id="error_luong" class="hidden text-red error"></p>
					</div>
				</div>
				
				<div class="col-xs-12 padding0-pc form-group">
					<label for="" class="col-sm-3 control-label label-register2 hidden-xs">Yêu cầu khác
					</label>
					<div class="col-sm-9 padding0">
						<textarea id="yeucaukhac" name="yeucaukhac" class="form-control h100"></textarea>
					</div>
				</div>
				
				<p id="error_creat_cv_giasu" class="hidden text-red error"></p>
				<input type="text" id="id_user" name="id_user" class="hidden form-control h40" value="<?php echo $user_id; ?>" hidden readonly>                                            	        
				<input type="text" id="link_xuly" name="link_xuly" class="hidden form-control h40" value="<?php echo URL; ?>page/creat_cv_giasu_xuly" hidden readonly>                                            	        
				<input type="text" id="link_dr" name="link_dr" class="hidden form-control h40" value="<?php echo URL; ?>quan-ly-tai-khoan" hidden readonly>                                            	        
				<div class="col-xs-12 form-group padding0-pc marginBottom25 marginBottom0-mb marginTop10 marginTop0-mb">
					<label for="" class="col-sm-3 control-label label-register2 hidden-xs"></label>
					<div class="col-sm-9 padding0">
						<button type="button" class="btn btn-default fontSize16 button-green button-save-06b" id="btn_creat_cv_giasu">LƯU <span class="hidden-xs">THAY ĐỔI</span></button>
						<button type="button" class="btn btn-default fontSize16 button-gray button-cancel-06b" onclick="javascript: window.history.go(-1);">HỦY</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</div>

<script>
    $(document).ready(function() {
        /* add icheck to checkbox and radio */
        $('.icheck').iCheck({
            checkboxClass: 'icheckbox_minimal-grey',
            increaseArea: '20%' // optional
          });
        /* add icheck to checkbox and radio */

        $("#day").select2({
            placeholder: "Ngày",
            minimumResultsForSearch: Infinity
        });
        $("#day").on("select2:open", function (e) {
            set_enscroll_select2('day');
        });
        $("#month").select2({
            placeholder: "Tháng",
            minimumResultsForSearch: Infinity
        });
        $("#month").on("select2:open", function (e) {
            set_enscroll_select2('month');
        });
        $("#year").select2({
            placeholder: "Năm",
            minimumResultsForSearch: Infinity
        });
        $("#year").on("select2:open", function (e) {
            set_enscroll_select2('year');
        });

        $("#province").select2({
            placeholder: "Chọn tỉnh/Thành phố"
        });
        $("#province").on("select2:open", function (e) {
            set_enscroll_select2('province');
        });

        $("#boloc").click(function(){
            $("#filter-search").addClass("hidden");
        });
    });
</script>
<!-- footer -->