<section class="content" id="content_<?php echo $page_slug?>_page">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
			<h3 class="box-title"><?php echo $page_des; ?></h3>
			<p class="login-box-msg" id="result_setting_alert" style="display: inline;"></p>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="box-body pad">
				<div class="col-md-12">		
					<div class="form-group">
						<?php
							$infor_home=$this->admin_model->select_table_dk_col_get('post','typepost="config" and ten="home_config"','noidung');
							$infor_home=json_decode($infor_home[0]->noidung);
							// var_dump($infor_home[0]->name);
							if($infor_home){
								foreach($infor_home as $value){
									$name=$this->xulychuoi->replace_name_form($value->name);
									$value=$value->value;
									if($name=='slider_home_1' ){
										$value_slider_home_1=$value;
										if($value!=0){
											$text_slider_home_1=$this->admin_model->select_value_table_dk_col_1value('post','id="'.$value.'"','ten');
										}
									}							
									if($name=='page_home_1'){
										$value_page_home_1=$value;
										if($value!=0){
											$text_page_home_1=$this->admin_model->select_value_table_dk_col_1value('post','id="'.$value.'"','ten');
										}
									}
									if($name=='cat_home_1' ){
										$value_cat_home_1=$value;
										if($value!=0){
											$text_cat_home_1=$this->admin_model->select_value_table_dk_col_1value('post','id="'.$value.'"','ten');
										}
									}
									if($name=='wgcat_home_1' ){
										$value_wgcat_home_1=$value;
										if($value!=0){
											$text_wgcat_home_1=$this->admin_model->select_value_table_dk_col_1value('post','id="'.$value.'"','ten');
										}
									}
									if($name=='cats2_home_1' ){
										$value_cats2_home_1=$value;
										if($value!=0){
											$text_cats2_home_1=$this->admin_model->select_value_table_dk_col_1value('post','id="'.$value.'"','ten');
										}
									}
									if($name=='video_home_1' ){
										$value_video_home_1=$value;
									}
									if($name=='videos2_home_1' ){
										$value_videos2_home_1=$value;
									}
									if($name=='form_home_1'){
										$value_form_home_1=$value;
										if($value==0){
											$text_form_home_1='Kh??ng';
										}else{
											$text_form_home_1='C??';
										}
									}
									
								}
							}
						?>
						<form class="frm-lienhe" method="POST" id="home_config">
							<div class="frm-gr">
								<div class="content-frm col-order-sort-gr">
									<div class="col-order-sort col-home-config col-ip col-lg-12 col-md-12 col-xs-12">
										<?php 
										$get_slider=$this->admin_model->select_table_dk_col_get('post','typepost="slider_cat" and trangthai=1','id,ten');
											echo '<select name="slider_home_1" class="slider_post">';
												if($value_slider_home_1){
													echo '<option value="'.$value_slider_home_1.'">'.$text_slider_home_1.'</option>';
												}
												echo '<option value="0">Ch???n slider 1 hi???n th???</option>';
												foreach($get_slider as $row_get_slider){
													$id_slider=$row_get_slider->id;
													$ten_slider=$row_get_slider->ten;
													echo '<option value="'.$id_slider.'">'.$ten_slider.'</option>';
												}
											echo '</select>';
										?>
										<i>Hi???n th??? slider</i>
									</div>
									<div class="col-order-sort col-home-config col-ip col-lg-12 col-md-12 col-xs-12 hidden">
										<?php 
										$get_slider=$this->admin_model->select_table_dk_col_get('post','typepost="page" and trangthai=1','id,ten');
										if($get_slider){
											echo '<select name="page_home_1" class="slider_post">';
												if($value_page_home_1){
													echo '<option value="'.$value_page_home_1.'">'.$text_page_home_1.'</option>'; 
												}
												echo '<option value="0">Ch???n trang hi???n th???</option>';
												foreach($get_slider as $row_get_slider){
													$id_slider=$row_get_slider->id;
													$ten_slider=$row_get_slider->ten;
													echo '<option value="'.$id_slider.'">'.$ten_slider.'</option>';
												}
											echo '</select>';
										}
										?>
										<i>Hi???n th??? trang b??i vi???t</i>
									</div>

									<div class="col-order-sort col-home-config col-ip col-lg-12 col-md-12 col-xs-12">
										<?php 
										$get_sp_by_danhmuc=$this->admin_model->select_table_dk_col_get('post','typepost="danhmucsanpham" and trangthai=1','id,ten');
										if($get_sp_by_danhmuc){
											echo '<label style="color:white;">Ch???n nh???ng danh m???c c???n hi???n th???</label>';
											echo '<select multiple name="sp_by_danhmucsanpham_sl" class="slider_post multiple_sl" data-mt=multiple_sl>';
												if($infor_home){
													foreach($infor_home as $value){
														//var_dump($value);
														
														if($value->name=='sp_by_danhmucsanpham_sl'){
															$ten_dmsp=$this->admin_model->select_value_table_dk_col_1value('post','id='.$value->value.' and trangthai=1','ten');
															$id_dmsp=$value->value;
															echo '<option value="'.$id_dmsp.'" selected>'.$ten_dmsp.'</option>';
														}						
													}
												}
												foreach($get_sp_by_danhmuc as $row_danhmuc){
													$id_dmsp=$row_danhmuc->id;
													$ten_dmsp=$row_danhmuc->ten;
													echo '<option value="'.$id_dmsp.'">'.$ten_dmsp.'</option>';
												}
											echo '</select>';
										}
										?>
										<i>Hi???n th??? s???n ph???m theo danh m???c d???ng slider</i>
									</div>

									<div class="col-order-sort col-home-config col-ip col-lg-12 col-md-12 col-xs-12 hidden">
										<?php 
										$get_sp_by_danhmuc=$this->admin_model->select_table_dk_col_get('post','typepost="danhmucsanpham" and trangthai=1','id,ten');
										if($get_sp_by_danhmuc){
											echo '<label style="color:white;">Ch???n nh???ng danh m???c c???n hi???n th???</label>';
											echo '<select multiple name="sp_by_danhmucsanpham" class="slider_post multiple_sl" data-mt=multiple_sl>';
												if($infor_home){
													foreach($infor_home as $value){
														//var_dump($value);
														
														if($value->name=='sp_by_danhmucsanpham'){
															$ten_dmsp=$this->admin_model->select_value_table_dk_col_1value('post','id='.$value->value.' and trangthai=1','ten');
															$id_dmsp=$value->value;
															echo '<option value="'.$id_dmsp.'" selected>'.$ten_dmsp.'</option>';
														}						
													}
												}
												foreach($get_sp_by_danhmuc as $row_danhmuc){
													$id_dmsp=$row_danhmuc->id;
													$ten_dmsp=$row_danhmuc->ten;
													echo '<option value="'.$id_dmsp.'">'.$ten_dmsp.'</option>';
												}
											echo '</select>';
										}
										?>
										<i>Hi???n th??? s???n ph???m theo danh m???c</i>
									</div>
									<div class="col-order-sort col-home-config col-ip col-lg-12 col-md-12 col-xs-12 hidden">
										<?php 
										$get_slider=$this->admin_model->select_table_dk_col_get('post','typepost="widget_cat" and trangthai=1','id,ten');
											echo '<select name="cat_home_1" class="slider_post">';
												if($value_cat_home_1){
													echo '<option value="'.$value_cat_home_1.'">'.$text_cat_home_1.'</option>';
												}
												echo '<option value="0">Ch???n chuy??n m???c widget hi???n th???</option>';
												foreach($get_slider as $row_get_slider){
													$id_slider=$row_get_slider->id;
													$ten_slider=$row_get_slider->ten;
													echo '<option value="'.$id_slider.'">'.$ten_slider.'</option>';
												}
											echo '</select>';
										?>
										<i>Hi???n th??? b??i vi???t theo widget cat</i>
									</div>
									<div class="col-order-sort col-home-config col-ip col-lg-12 col-md-12 col-xs-12 hidden">
										<input type="text" name="video_home_1" value="<?php echo $value_video_home_1; ?>">
										<i>Hi???n th??? slider video trang ch???</i>
									</div>
									<div class="col-order-sort col-home-config col-ip col-lg-12 col-md-12 col-xs-12">
										<?php 
										$get_slider=$this->admin_model->select_table_dk_col_get('post','typepost="cat" and trangthai=1','id,ten');
											echo '<select name="cats2_home_1" class="slider_post">';
												if($value_cats2_home_1){
													echo '<option value="'.$value_cats2_home_1.'">'.$text_cats2_home_1.'</option>';
												}
												echo '<option value="0">Ch???n chuy??n m???c hi???n th???</option>';
												foreach($get_slider as $row_get_slider){
													$id_slider=$row_get_slider->id;
													$ten_slider=$row_get_slider->ten;
													echo '<option value="'.$id_slider.'">'.$ten_slider.'</option>';
												}
											echo '</select>';
										?>
										<i>Hi???n th??? slider b??i vi???t theo chuy??n m???c</i>
									</div>
								
									

									<div class="col-order-sort col-home-config col-ip col-lg-12 col-md-12 col-xs-12 hidden">
										<select name="form_home_1" class="slider_post">
											<?php
												if($value_form_home_1){
													echo '<option value="'.$value_form_home_1.'">'.$text_form_home_1.'</option>'; 
												}
											?>
											<option value="0">Ch???n form ????ng k?? nh???n tin</option>	
											<option value="1">C??</option>
											<option value="0">Kh??ng</option>											
										</select>
										<i>Click ????? hi???n th??? form ????ng k?? nh???n tin</i>
									</div>
									
									<div class="col-order-sort col-home-config col-ip col-lg-12 col-md-12 col-xs-12 hidden">
										<?php 
										$get_slider=$this->admin_model->select_table_dk_col_get('post','typepost="widget_cat" and trangthai=1','id,ten');
											echo '<select name="wgcat_home_1" class="slider_post">';
												if($value_cat_home_1){
													echo '<option value="'.$value_wgcat_home_1.'">'.$text_wgcat_home_1.'</option>';
												}
												echo '<option value="0">Ch???n chuy??n m???c widget hi???n th???</option>';
												foreach($get_slider as $row_get_slider){
													$id_slider=$row_get_slider->id;
													$ten_slider=$row_get_slider->ten;
													echo '<option value="'.$id_slider.'">'.$ten_slider.'</option>';
												}
											echo '</select>';
										?>
										<i>Hi???n th??? b??i vi???t theo widget cat d???ng 2</i>
									</div>

									<div class="col-alert col-lg-12 col-md-12 col-xs-12 hide">
										<div class="alert alert-success"></div>
									</div>
									<div class="col-no-padding-right col-ip col-lg-12 col-md-12 col-xs-12">
										<input type="submit" name="tenchame" value="L??u c???u h??nh" class="btn btn-primary" /> 
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
            </div>
		</div>
		<!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>
