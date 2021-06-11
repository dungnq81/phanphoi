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
<div class="content-middle3 marginCenter">
	<div class="mh680-pc row margin0">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 marginBottom22 relative hidden-xs marginTop39">
			<a title="back" href="javascript: window.history.go(-1)" class="button-back">
				<span class="icon-24 icon-button-back marginRight15"/>
			</span>Quay lại</a>
		<div class="title-content-page">Sửa thông tin</div>
	</div>
	<div class=" pl12mb pr12mb"/>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-white-content marginBottom70-pc marginBottom0-mb bgWhite-mb  pl12mb pr12mb">
		<form id="frm-main" class="form-06b hidden-xs hidden-sm">
			<div class="content-box-white">
				<div class="col-xs-12 padding0-pc form-group pst-relative marginTop12">
					<label for="" class="col-sm-4 control-label label-register2 hidden-xs">Họ tên<span class="text-red">*</span>
					</label>
					<label for="" class="col-sm-4 control-label label-register2 alignLeft visible-xs">Họ và tên<span class="text-red">*</span>
					</label>
					<div class="col-sm-8 padding0">
						<input type="text" id="name" name="name" value="<?php echo $user_hoten;?>" class="form-control h40" />
						<p id="error_name" class="hidden text-red error"/>
						<p class="text-red hidden error_submit error"/>
					</div>
				</div>

				<div class="col-xs-12 padding0-pc form-group marginBottom11">
					<label for="" class="col-sm-4 control-label label-register2 paddingTop15mb marginTop0-mb">Ngày sinh<span class="text-red">*</span></label>
					<div class="col-sm-8 padding0" >
						<div class="col-xs-4 padding0 select-day">
							<select id="day" name="day" class="select2" style="width:100%" data-disS="1">
								<?php 
									if($ngay_ngaysinh==''){
										echo '<option selected="selected" value="">Ngày</option>';
									}else{
										echo '<option selected="selected" value="'.$ngay_ngaysinh.'">'.$ngay_ngaysinh.'</option>';	
									}

									for($i=1;$i<=31;$i++){
										echo '<option value="'.$i.'">'.$i.'</option>';
									}
								?>
							</select>
						</div>

						<div class="col-xs-4 padding0 select-day margin-slt-month">
							<select id="month" name="month" class="select2 12345" style="width:100%" data-disS="1">
								<?php
									if($ngay_ngaysinh==''){
										echo '<option selected="selected" value="">Tháng</option>';
									}else{
										echo '<option selected="selected" value="'.$thang_ngaysinh.'">'.$thang_ngaysinh.'</option>';	
									}
									
									for($i=1;$i<=12;$i++){
										echo '<option value="'.$i.'">'.$i.'</option>';
									}
									?>
							</select>
						</div>

						<div class="col-xs-4 padding0 select-day">
							<select id="year" name="year" class="select2" style="width:100%" data-disS="1">
								<?php
									$day_now=date('Y');
									if($ngay_ngaysinh==''){
										echo '<option selected="selected" value="">Năm</option>';
									}else{
										echo '<option selected="selected" value="'.$nam_ngaysinh.'">'.$nam_ngaysinh.'</option>';	
									}
									
									for($i=$day_now;$i>=1968;$i--){
										echo '<option value="'.$i.'">'.$i.'</option>';
									}
								?>
							</select>
						</div>
						<div class="clearfix"></div>
						<p class="text-red hidden error_submit error"></p>	
					</div>
				</div>

				<div class="col-xs-12 padding0-pc  form-group " id="box_gender">
					<label for="" class="col-sm-4 control-label margin0 label-register2 paddingTop4-pc paddingTop15mb marginTop0-mb marginBottom5-mb">Giới tính<span class="text-red">*</span>
					</label>
					<div class="col-sm-8 padding0 margin0  radio">
						<?php
							$list_gioitinh=$this->page_model->select_table_dk('post','typepost','="gioitinh"');
							foreach($list_gioitinh as $row_list_gioitinh){
								$id_giotinh=$row_list_gioitinh->id;
								$ten_gioitinh=$row_list_gioitinh->ten;
								$checked_gioitinh='';
								$checked='';
								if($id_giotinh==$user_gioitinh){
									$checked_gioitinh="checked='$checked'";
								}
								?>
									<label class="paddingLeft0 paddingTop4">
										<input type="radio" id="genderY" name="gioitinh" value="<?php echo $id_giotinh; ?>" class="icheck" <?php echo $checked_gioitinh; ?> />
										<?php echo $ten_gioitinh;?>                                    
									</label>
							<?php }
						?>
						<div class="clearfix"></div>
						<p class="text-red hidden error_submit error"></p>
						<p id="error_gender" class="hidden text-red error"></p>
					</div>
				</div>

				<div class="col-xs-12 padding0-pc form-group marginBottom19 marginTop5-mb" id="box_marital_status">
					<label for="" class="col-sm-4 control-label margin0 label-register2 paddingTop4-pc paddingTop15mb marginTop0-mb marginBottom5-mb ">Tình trạng hôn nhân<span class="text-red">*</span>
					</label>
					<div class="col-sm-8 padding0 margin0 radio">
						<?php
							$list_gioitinh=$this->page_model->select_table_dk('post','typepost','="tinhtrang"');
							foreach($list_gioitinh as $row_list_gioitinh){
								$id_tinhtrang=$row_list_gioitinh->id;
								$ten_tinhtrang=$row_list_gioitinh->ten;
								$checked='';
								if($id_tinhtrang==$user_honnhan){
									$checked="checked='$checked'";
								}
								?>
									<label class="paddingLeft0 paddingTop4">
										<input type="radio" id="tinhtrang" name="tinhtrang" value="<?php echo $id_tinhtrang; ?>" class="icheck" <?php echo $checked; ?> />
										<?php echo $ten_tinhtrang;?>                                    
									</label>
							<?php }
						?>
						<div class="clearfix"></div>
						<p class="text-red hidden error_submit error"></p>
						<p id="error_gender" class="hidden text-red error"></p>
					</div>
				</div>

				<div class="col-xs-12 padding0-pc form-group pst-relative ">
					<label for="" class="col-sm-4 control-label label-register2">Địa chỉ<span class="text-red">*</span></label>
					<div class="col-sm-8 padding0">
						<input type="text" id="address" name="diachi" value="<?php echo $user_diachi; ?>" class="form-control h40" />
						<p class="text-red hidden error_submit error"></p>
						<p id="error_gender" class="hidden text-red error"></p>
					</div>
				</div>
				<div class="col-xs-12 padding0-pc form-group">
					<label for="" class="col-sm-4 control-label label-register2 paddingTop15mb marginTop0-mb">Tỉnh/Thành Phố<span class="text-red">*</span>
					</label>
					<div class="col-sm-8 padding0 margin0 ">
						<div class="select-city" style="width:100%;">
							<select id="province" name="thanhpho" class="select2 12345" style="width:100%">
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
				<p id="error_update_infor" class="hidden text-red error"></p>
				<input type="text" id="id_user" name="id_user" class="hidden form-control h40" value="<?php echo $user_id; ?>" hidden readonly>                                            	        
				<input type="text" id="link_xuly" name="link_xuly" class="hidden form-control h40" value="<?php echo URL; ?>page/update_infor_user" hidden readonly>                                            	        
				<input type="text" id="link_dr" name="link_dr" class="hidden form-control h40" value="<?php echo URL; ?>quan-ly-tai-khoan" hidden readonly>                                            	        
				<div class="col-xs-12 form-group padding0-pc marginBottom25 marginBottom0-mb marginTop10 marginTop0-mb">
					<label for="" class="col-sm-4 control-label label-register2 hidden-xs">&nbsp</label>
					<div class="col-sm-8 padding0">
						<button type="button" class="btn btn-default fontSize16 button-green button-save-06b" id="btn_update_infor_user">LƯU <span class="hidden-xs">THAY ĐỔI</span>
						</button>
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
            radioClass: 'iradio_minimal-grey',
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