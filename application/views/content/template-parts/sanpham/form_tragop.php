<div class="frm-tragop-gr" hidden="">
	<div class="frm-tragop-pn">
		<div class="frm-tragop" id="form-content-tragop">
			<h3>TRẢ GÓP LÃI SUẤT THẤP <i class="fa fa-times"></i></h3>
			<div role="form" class="wpcf7">
				<form class="wpcf7-form" name="form-tragop">
					<input type="text" name="hoten" placeholder="Vui lòng nhập tên" required="" autofocus="">
					<input type="number" name="sodienthoai" placeholder="Vui lòng nhập số điện thoại" required="">
					<input type="text" name="link_sp" placeholder="Vui lòng nhập số điện thoại" required="" hidden="" disabled="" value="<?php echo base_url($this->uri->uri_string()); ?>" style="display: none">
					<input type="submit" name="submit_tragop" value="Gửi">
					<div class="wpcf7-response-output"></div>
				</form>
			</div>
		</div>
	</div>
</div>