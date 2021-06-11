<section class="content" id="content_<?php echo $page_slug?>_page">

	<div class="row">

		<div class="col-lg-12">

			<div class="box box-primary">

				<div class="box-header with-border">

					<h3 class="box-title">Thông tin</h3>

				</div>

				

				<div class="col-lg-6 col-md-6 col-xs-12 col-infor-details">

					<form role="form" method="post" id="frm_infor_ad">

						<div class="box-body">

						<?php

							$get_rows=$this->admin_model->select_table_dk('thanhvien','typethanhvien','="admin"');

							foreach($get_rows as $row_get_rows){

								$id=$row_get_rows->id;

								$sodienthoai=$row_get_rows->sodienthoai;

								$matkhau=$row_get_rows->matkhau;

								$email=$row_get_rows->email;

								$hoten=$row_get_rows->hoten;

								$ngaysinh=$row_get_rows->ngaysinh;

								$gioitinh=$row_get_rows->gioitinh;

								$anhdaidien=$row_get_rows->anhdaidien;

								?>	

								<div class="form-group col-lg-6 col-md-6 col-xs-12">

									<label for="exampleInputEmail1">Email (Không được thay đổi)</label>							

									<input type="text" class="form-control" name="email" placeholder="Vui lòng nhập email" name="email" value="<?php echo $email; ?>" readonly>	

								</div>

								<div class="form-group col-lg-6 col-md-6 col-xs-12">

									<label for="exampleInputEmail1">Họ tên</label>							

									<input type="text" class="form-control" name="hoten" placeholder="Vui lòng nhập họ tên" name="hoten" value="<?php echo $hoten; ?>">	

								</div>

								<div class="form-group col-lg-6 col-md-6 col-xs-12">

									<label for="exampleInputEmail1">Số điện thoại</label>							

									<input type="text" class="form-control" name="sodienthoai" placeholder="Vui lòng nhập số điện thoại" name="sodienthoai" value="<?php echo $sodienthoai; ?>">	

								</div>

								<div class="form-group col-lg-6 col-md-6 col-xs-12">

									<label for="exampleInputEmail1">Giới tinh</label>

									<select name="gioitinh">

									<?php

										$gioitinh_id_current=$this->admin_model->select_value_table_dk_col_1value('post','id="'.$gioitinh.'"','id');

										$gioitinh_name_current=$this->admin_model->select_value_table_dk_col_1value('post','id="'.$gioitinh.'"','ten');

										if($gioitinh_id_current and $gioitinh_name_current){

											echo '<option value="'.$gioitinh_id_current.'">'.$gioitinh_name_current.'</option>';

										}

										$gioitinh=$this->admin_model->select_table_dk_col_get('post','typepost="gioitinh" and trangthai=1','id,ten');

										foreach($gioitinh as $row){

											$id=$row->id;

											$ten=$row->ten;

											echo '<option value="'.$id.'">'.$ten.'</option>';

										}

									?>

									</select>

								</div>

								<div class="form-group col-lg-6 col-md-6 col-xs-12">

									<label for="exampleInputEmail1">Ngày sinh</label>							

									<input type="text" class="form-control datepicker data-date-format='mm/dd/yyyy' datetimepicker" placeholder="Vui lòng nhập ngày sinh" name="ngaysinh" value="<?php echo $ngaysinh; ?>">	

								</div>

								<div class="form-group col-lg-6 col-md-6 col-xs-12">

									<div class="box box-info">

										<div class="box-header with-border">

											<h3 class="box-title">Ảnh đại diện</h3>

										</div>

										<div id="img-avt-post-ad" hidden>

											<?php 

												if(!empty($anhdaidien)){?>

													<img loading="lazy" src="<?php echo UP_POST.$anhdaidien; ?>" width="90px" >

												<?php }?>

										</div>

										<div class="box-body">

											<input type="file" id="file" name="anhdaidien" class="inputfile" value="<?php echo $anhdaidien; ?>"></textarea>

											<label for="file" id="upload_avt_post"><i class="fa fa-upload"></i>Chọn file</label>

										</div>

									</div>

								</div>

						<?php } ?>

						</div>

						<!-- /.box-body -->

					</form>

					

					<div class="box-footer">

						<button type="submit" class="btn btn-primary" id="btn_capnhat_infor_ad">Cập nhật</button>

						<p class="login-box-msg" id="result_capnhat_infor_ad_alert" style="display: inline;"></p>	

					</div>

				</div>

				

				<div class="col-lg-6 col-md-6 col-xs-12">

					<form role="form" method="post" id="frm_password_ad">

						<div class="box-body">

							<div class="form-group col-lg-12 col-md-12 col-xs-12">

								<label for="exampleInputEmail1">Mật khẩu mới</label>							

								<input type="password" class="form-control" name="matkhau_ad" placeholder="Vui lòng nhập mật khẩu">	

							</div>

							<div class="form-group col-lg-12 col-md-12 col-xs-12">

								<label for="exampleInputEmail1">Xác nhận mật khẩu</label>							

								<input type="password" class="form-control" name="matkhau_ad_rep" placeholder="Vui lòng xác nhận mật khẩu">	

							</div>

						</div>

					</form>

					

					<div class="box-footer">

						<button type="submit" class="btn btn-primary" id="btn_capnhat_password_ad">Cập nhật</button>

						<p class="login-box-msg" id="result_password_alert" style="display: inline;"></p>	

					</div>

				</div>

			</div>

		</div>

	</div>

</section>
