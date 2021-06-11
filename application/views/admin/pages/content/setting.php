<section class="content" id="content_<?php echo $page_slug?>_page">
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Cài đặt chung</h3>
				</div>

				<form role="form" method="post" id="frm_setting_ad">
					<div class="box-body">
						<?php $get_rows=$this->admin_model->select_table_dk('option','trangthai','=1'); 
						foreach($get_rows as $row_get_rows){ 
							$id=$row_get_rows->id; $name=$row_get_rows->name; 
							$title=$row_get_rows->title; 
							$value=$row_get_rows->value; ?>
						<div class="form-group col-lg-6 col-md-6 col-xs-12" id="settinggr_<?php echo $id; ?>">
							<label for="exampleInputEmail1">
								<?php echo $title; ?>
							</label>
							<?php if($name=='fanpage'|| $name=='machat'|| $name=='bando'){ ?>
							<textarea class="form-control" id="<?php echo $name;?>" name="setting_<?php echo $id; ?>" placeholder="Vui lòng nhập <?php echo $title; ?>" name="<?php echo $name;?>" rows="3" style="height: 90px;"><?php echo $value; ?></textarea>
							<?php }else if($name=='share_bv'){?>
								<select id="<?php echo $name;?>" name="setting_<?php echo $id; ?>">
									<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
									<option value="Bật">Chọn Bật/Tắt chia sẻ</option>
									<option value="Bật">Bật</option>
									<option value="Tắt">Tắt</option>
								</select>
							<?php }
							else if($name=='bao_tri'){?>
								<select id="<?php echo $name;?>" name="setting_<?php echo $id; ?>">
									<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
									<option value="Bật">Chọn Bật/Tắt chia sẻ</option>
									<option value="Bật">Bật</option>
									<option value="Tắt">Tắt</option>
								</select>
							<?php }else{?>
							<input type="text" class="form-control" id="<?php echo $name;?>" name="setting_<?php echo $id; ?>" placeholder="Vui lòng nhập <?php echo $title; ?>" name="<?php echo $name;?>" value="<?php echo $value; ?>">
							<?php } ?>
						</div>
						<?php } ?>
					</div>
					<!-- /.box-body -->
				</form>

				<div class="box-footer">
					<button type="submit" class="btn btn-primary" id="btn_capnhat_setting">Cập nhật</button>
					<p class="login-box-msg" id="result_setting_alert" style="display: inline;"></p>
				</div>
			</div>
		</div>
	</div>
</section>