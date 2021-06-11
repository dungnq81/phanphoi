<section class="content" id="content_<?php echo $page_slug?>_page">
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Thông tin</h3>
				</div>
				
				<div class="col-lg-12 col-md-12 col-xs-12 col-infor-details">
					<form role="form" method="post" id="frm_infor_ad">
						<div class="box-body">
							<div class="form-group col-lg-4 col-md-4 col-xs-12">
								<label for="exampleInputEmail1">Email (Không được thay đổi) *</label>							
								<input type="email" class="form-control" name="email" placeholder="Vui lòng nhập email" name="email" required>	
							</div>
							<div class="form-group col-lg-4 col-md-4 col-xs-12">
								<label for="exampleInputEmail1">Mật khẩu *</label>							
								<input type="password" class="form-control" name="matkhau" placeholder="Vui lòng nhập mật khẩu" required>	
							</div>
							<div class="form-group col-lg-4 col-md-4 col-xs-12">
								<label for="exampleInputEmail1">Họ tên</label>							
								<input type="text" class="form-control" name="hoten" placeholder="Vui lòng nhập họ tên" name="hoten">	
							</div>
							<input type="text" class="form-control" name="link_dr" value="<?php echo URL_AD.'member'?>" hidden disabled style="display:none !important">	
						</div>
						<!-- /.box-body -->
					</form>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary btn_add_user">Thêm</button>
						<p class="login-box-msg" id="result_capnhat_infor_ad_alert" style="display: inline;"></p>	
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

