<div id="dangkyonline_popup" >

	<div class="modal-cs-dialog">

		<div class="modal-cs-body">

			<form class="frm-lienhe"  method="POST" id="frm_mau_dk_online">

				<div class="frm-gr">

					<div class="header-frm" hidden>

						<div class="col-ip col-lg-3 col-md-3 col-xs-12">

							<img loading="lazy" src="<?php echo $logo; ?>" alt="Logo"/>

						</div>

						<div class="col-ip col-lg-9 col-md-9 col-xs-12">

							<h2>Đăng ký học online</h2>

						</div>

					</div>

					<div class="content-frm">

						<div class="col-ip-gr col-lg-12 col-md-2 col-xs-12">

							<h3 class="title-frm">THÔNG TIN HỌC SINH</h3>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<label>* Họ tên</label><input type="text" name="hoten_be" required autofocus />

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<label>* Ngày sinh</label><input type="text" name="ngaysinh_be" class="datetimepicker" placeholder="Click vào để chọn ngày" required />

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<label>* Nơi sinh</label>

								<select name="noisinh_be" required>

									<option value="Hà Nội">--- Chọn nơi sinh ---</option>

									<?php

										$noisinh_be=$this->page_model->select_table_dk_col_get('post','typepost="diadiem" and trangthai=1','ten');

										if($noisinh_be){

											foreach ($noisinh_be as $noisinh){

												echo '<option value="'.$noisinh->ten.'">'.$noisinh->ten.'</option>';

											}

										}

									?>

								</select>

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<label>* Chọn giới tính</label>

								<select name="gioitinh_be">

									<option value="Nam">--- Chọn giới tính ---</option>

									<option value="Nam">Nam</option>

									<option value="Nữ">Nữ</option>

								</select>

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<label>* Quốc tịch</label><input type="text" name="quoctich_be" required />

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<label>* Địa chỉ thường trú</label><input type="text" name="diachithuongtru_be" required />

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<label>* Địa chỉ tạm trú</label><input type="text" name="diachitamtru_be" required />

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<label>* Dự tuyển vào lớp</label>

								<select name="lopdangky_be">

									<option value="12-15 tháng tuổi">--- Thời gian dự tuyển ---</option>

									<?php

										$lop_dangky=$this->page_model->select_table_dk_col_get('post','idpostpr="327" and trangthai=1','ten');

										if($lop_dangky){

											foreach ($lop_dangky as $lop){

												echo '<option value="'.$lop->ten.'">'.$lop->ten.'</option>';

											}

										}

									?>

								</select>

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<label>* Niên học</label>

								<select name="nienhoc_be" required>

									<option value="2000">--- Chọn niên học ---</option>

									<?php

										for($i=2000;$i<=date("Y");$i++){

											echo '<option value="'.$i.'">'.$i.'</option>';

										}

									?>

								</select>

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<label>* Ngày dự định vào học</label><input type="text" name="ngaydudinhvaohoc_be" class="datetimepicker" required placeholder="Click vào để chọn ngày" />

							</div>

						</div>

						

						<div class="col-ip-gr col-lg-12 col-md-2 col-xs-12">

						

							<h3 class="title-frm">THÔNG TIN PHỤ HUYNH</h3>

							<div class="col-ip-gr1 col-lg-6 col-md-12 col-xs-12">

								<h3 class="title-frm bg-red">THÔNG TIN CHA</h3>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Họ & tên</label><input type="text" name="hoten_cha" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Số CMND/Hộ chiếu</label><input type="number" name="cmnd_cha" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Ngày cấp</label><input type="text" name="ngaycapcmnd_cha" class="datetimepicker" required placeholder="Click vào để chọn ngày" />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Nơi cấp</label><input type="text" name="noicapcmnd_cha" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Quốc tịch</label><input type="text" name="quoctich_cha" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Nghề nghiệp</label><input type="text" name="nghenghiep_cha" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Tên công ty</label><input type="text" name="tencongty_cha" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Nơi làm việc</label><input type="text" name="noilamviec_cha" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* SĐT liên lạc</label><input type="number" name="sdt_cha" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Email</label><input type="email" name="email_cha" required />

								</div>				

							</div>

							

							<div class="col-ip-gr1 col-lg-6 col-md-6 col-xs-12">

								<h3 class="title-frm bg-red">THÔNG TIN MẸ</h3>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Họ & tên</label><input type="text" name="hoten_me" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Số CMND/Hộ chiếu</label><input type="number" name="cmnd_me" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Ngày cấp</label><input type="text" name="ngaycapcmnd_me" class="datetimepicker" required placeholder="Click vào để chọn ngày" />

								</div>

									<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Nơi cấp</label><input type="text" name="noicapcmnd_me" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Quốc tịch</label><input type="text" name="quoctich_me" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Nghề nghiệp</label><input type="text" name="nghenghiep_me" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Tên công ty</label><input type="text" name="tencongty_me" required />

								</div>

								<div class="col-ip col-lg-12 col-md-2 col-xs-12">

									<label>* Nơi làm việc</label><input type="text" name="noilamviec_me" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* SĐT liên lạc</label><input type="number" name="sdt_me" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Email</label><input type="email" name="email_me" required />

								</div>				

							</div>

							

						</div>

						

						<div class="col-ip-gr col-lg-12 col-md-12 col-xs-12">

							<h3 class="title-frm">BẠN BIẾT ĐẾN TRƯỜNG MẦM NON FUJISCHOOL BẰNG CÁCH NÀO</h3>

							<div class="col-ip col-lg-3 col-md-6 col-xs-12">

								<input type="radio" name="cachtimduoc" value="Báo/Tạp chí" required />

								<label>Báo/Tạp chí</label>

							</div>

							<div class="col-ip col-lg-3 col-md-6 col-xs-12">

								<input type="radio" name="cachtimduoc" value="Website" required />

								<label>Website</label>

							</div>

							<div class="col-ip col-lg-3 col-md-6 col-xs-12">

								<input type="radio" name="cachtimduoc" value="Người quen giới thiệu" required />

								<label>Người quen giới thiệu</label>

							</div>

							<div class="col-ip col-lg-3 col-md-6 col-xs-12">

								<input type="radio" name="cachtimduoc" value="Nguồn khác" required />

								<label>Nguồn khác</label>

							</div>

											

						</div>

							

						<div class="col-ip-gr col-lg-12 col-md-2 col-xs-12">

						

							<h3 class="title-frm">LIÊN LẠC TRONG TRƯỜNG HỢP KHẨN CẤP NẾU KHÔNG GỌI ĐƯỢC CHA MẸ</h3>

							<div class="col-ip-gr1 col-lg-6 col-md-6 col-xs-12">

								<h3 class="title-frm bg-red">Người thứ nhất</h3>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Họ & tên</label><input type="text" name="hoten_nguoi1" required />

								</div>

								<div class="col-ip col-lg-12 col-md-2 col-xs-12">

									<label>* Quan hệ với trẻ</label><input type="text" name="quanhe_nguoi1" required />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Điện thoại nhà</label><input type="number" name="dienthoainha_nguoi1" />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Điện thoại di động</label><input type="number" name="dienthoaididong_nguoi1" />

								</div>

								<div class="col-ip col-lg-12 col-md-2 col-xs-12">

									<label>* Điện thoại nơi làm việc</label><input type="number" name="dienthoainoilamviec_nguoi1" />

								</div>

							</div>

							

							<div class="col-ip-gr1 col-lg-6 col-md-6 col-xs-12">

								<h3 class="title-frm bg-red">Người thứ hai</h3>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Họ & tên</label><input type="text" name="hoten_nguoi2" />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Quan hệ với trẻ</label><input type="text" name="quanhe_nguoi2" />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Điện thoại nhà</label><input type="number" name="dienthoainha_nguoi2" />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Điện thoại di động</label><input type="number" name="dienthoaididong_nguoi2" />

								</div>

								<div class="col-ip col-lg-12 col-md-12 col-xs-12">

									<label>* Điện thoại nơi làm việc</label><input type="number" name="dienthoainoilamviec_nguoi2" />

								</div>

							</div>

							

						</div>	

							

						<div class="col-ip-gr col-lg-12 col-md-12 col-xs-12">

							<h3 class="title-frm">CHO PHÉP CHỮA TRỊ Y TẾ KHẨN CẤP</h3>

							<div class="col-ip col-lg-12 col-md-12 col-xs-12">

								<p>Tôi hiểu rằng nhà trường sẽ cố gắng liên lạc với tôi trước khi điều trị cho con (em) tôi. Tôi ủy quyền cho các nhân viên và giáo viên nhà trường thực hiện việc sơ cấp cứu cho con (em) tôi trong trường hợp cần thiết.</p>

							</div>

						</div>

						

						<div class="col-alert col-lg-12 col-md-12 col-xs-12 hide">		

							<div class="alert alert-success"></div>				

						</div>

						<div class="col-ip col-lg-12 col-md-12 col-xs-12 text-center">

							<input type="submit" name="btn_dangky_online" value="Đăng ký"/>

						</div>

					</div>

				</div>

			</form>

		</div>

	</div>

</div>

