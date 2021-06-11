<div id="dangkythamquantruong_popup" class="modal" >

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<h2>Đăng ký tham quan trường</h2>

				<button type="button" class="close" data-dismiss="modal" id="close_modal">&times;</button>

			</div>

			<div class="modal-body">

				<form class="frm-lienhe"  method="POST" id="frm_mau_dk_thamquantruong">

					<div class="frm-gr">

						<img loading="lazy" src="<?php echo $logo; ?>" alt="Logo"/>

						<div class="content-frm">

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<input type="text" name="hotenphuhuynh" placeholder="* Tên/cha mẹ" required />

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<input type="text" name="sodienthoai" placeholder="* Số điện thoại" required />

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<input type="text" name="email" placeholder="* Email" required />

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<select name="lopdangky" required>

									<option value="0">Chọn lớp đăng ký</option>

									<?php

										$wg_ct=$this->page_model->select_table_2dk('post','idpostpr','=327','trangthai','=1');

										foreach($wg_ct as $row){

											echo '<option value="'.$row->ten.'">'.$row->ten.'</option>';

										}

									?>

								</select>

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<input type="text" name="thoigian" placeholder="* Thời gian" class="timepicker" required />

							</div>

							<div class="col-ip col-lg-6 col-md-6 col-xs-12">

								<input type="text" name="ngaygio" placeholder="* Ngày" class="datetimepicker" required autocomplete="false" />

							</div>

							

							<div class="col-alert col-lg-12 col-md-12 col-xs-12 hide">	

								<div class="alert alert-success"></div>			

							</div>

							<div class="col-ip col-lg-12 col-md-12 col-xs-12">

								<input type="submit" name="tenchame" value="Đăng ký"/>

							</div>

						</div>

					</div>

				</form>

			</div>

		</div>

	</div>

</div>

