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
				<div class="col-md-9">
					<form role="form">
						<div class="form-group">
							<input type="text" class="form-control" name="ten" value="<?php echo $ten_post_edit; ?>"placeholder="Nhập tiêu đề tại đây">
						</div>
						<?php 
							if($post_type=='slider'){?>
								<div class="form-group"> 
									<label>Link liên kết: </label>
									<input type="text" class="form-control" name="url" value="<?php echo $url_post_edit; ?>" placeholder="Nhập link liên kết">
								</div>
							<?php }else{?>
								<div class="form-group"> 
									<label>Link liên kết: </label><?php echo URL; ?><input type="text" value="<?php echo $url_post_edit; ?>" name="url" size="60" style="    border: 1px solid #ccc;background: white;height: 30px;outline: none; padding-left: 4px;"> <a href="<?php echo URL.$url_post_edit; ?>" title="<?php echo $ten_post_edit; ?>" target="_blank"/><i class="fa fa-link"></i></a>
								</div>
								<i class="note" style="font-size: 13px;color: #c70606;display: block;margin-bottom: 15px;">Không nhập ký tự có dấu, và phải có ký tự gạch ngang</i> 
							<?php } ?>
						<div class="form-group">
							<textarea class="form-control tinymce"" name="noidung" rows="25" cols="80"><?php echo $noidung_post_edit; ?></textarea>
						</div>
						<?php //if(empty($post_type) || ($post_type=='post')){?>
						<div class="form-group">
							<label>Mô tả</label>
							<textarea class="form-control tinymce"" name="mota" rows="4" cols="115"><?php echo $mota_post_edit; ?></textarea>
						</div>
						<?php if($post_type=='sanpham'){//them gia san pham
							$this->load->view('admin/pages/content/product_new');
						}?>
						<div class="form-group">
							<label>SEO title</label>
							<input type="text" class="form-control" name="seo_title" value="<?php echo $seo_title_post_edit; ?>" placeholder="Nhập seo title">
						</div>
						<div class="form-group">
							<label>Focus Keywords (Từ khóa SEO)</label>
							<input type="text" class="form-control" name="focus_keywords" value="<?php echo $focus_keywords_post_edit; ?>" placeholder="Nhập từ khóa chính">
						</div>
						<?php if(($post_type=='post' || $post_type=='page' || $post_type=='sanpham' ) and (isset($_GET['edit']))){?>
							<div class="form-group">
								<label>Phân tích SEO</label> 
								<?php
									if($focus_keywords_post_edit=='' || $mota_post_edit=='' || $noidung_post_edit==''){?>
										<div class="checklist-seo">
											<span><b><i class="fa fa-circle not-seo"></i> Vui lòng thêm từ khóa SEO, mô tả và nội dung bài viết</b></span>
										</div>
									<?php }else{
										$slug_focuskeywords=$this->xulychuoi->to_slug_style_1($this->xulychuoi->vn_str_filter($focus_keywords_post_edit));
										$count_words_title=strlen($ten_post_edit);
										// $count_words_post=str_word_count($noidung_post_edit);
										$count_words_post=strlen($noidung_post_edit);
										$check_focus_keyword_title=strpos($ten_post_edit,$focus_keywords_post_edit);
										$check_focus_keyword_nd=strpos($noidung_post_edit,$focus_keywords_post_edit);
										$check_focus_keyword_mota=strpos($mota_post_edit,$focus_keywords_post_edit);
										$check_focus_keyword_url=strpos($url_post_edit,$slug_focuskeywords);
										$count_repeat_words_post =substr_count($noidung_post_edit,$focus_keywords_post_edit);
										$count_img_post=substr_count($noidung_post_edit,'<img loading="lazy" ');
										$diem=0;
										if($check_focus_keyword_title!== false){
											$kq_check_focus_keyword_title='<i class="fa fa-circle ok-seo"></i> Tiêu đề của trang chứa từ khóa SEO';
											$diem++;
										}else{
											$kq_check_focus_keyword_title='<i class="fa fa-circle not-seo"></i> Tiêu đề của trang không chứa từ khóa SEO';
										}
										if($check_focus_keyword_nd!== false){
											$kq_check_focus_keyword_nd='<i class="fa fa-circle ok-seo"></i> Nội dung của trang chứa từ khóa SEO';
											$diem++;
										}else{
											$kq_check_focus_keyword_nd='<i class="fa fa-circle not-seo"></i> Nội dung của trang không chứa từ khóa SEO';
										}
										if($check_focus_keyword_mota!== false){
											$kq_check_focus_keyword_mota='<i class="fa fa-circle ok-seo"></i> Mô tả của trang chứa từ khóa SEO';
											$diem++;
										}else{
											$kq_check_focus_keyword_mota='<i class="fa fa-circle not-seo"></i> Mô tả của trang không chứa từ khóa SEO';
										}
										if($check_focus_keyword_url!== false){
											$kq_check_focus_keyword_url='<i class="fa fa-circle ok-seo"></i> URL của trang chứa từ khóa SEO';
											$diem++;
										}else{
											$kq_check_focus_keyword_url='<i class="fa fa-circle not-seo"></i> URL của trang không chứa từ khóa SEO';
										}
										if($count_words_title>=40 and $count_words_title<=70){
											$kq_count_words_title='<i class="fa fa-circle ok-seo"></i> Độ dài tiêu đề của trang là <b>'.$count_words_title.'</b> ký tự';
											$diem++;
										}else{
											$kq_count_words_title='<i class="fa fa-circle not-seo"></i> Độ dài tiêu đề của trang không đạt tiêu chuẩn >=40 và <=70 ký tự';
										}
										if($count_words_post>=300){
											$kq_count_words_post='<i class="fa fa-circle ok-seo"></i> Độ dài nội dung của trang là <b>'.$count_words_post.'</b> ký tự';
											$diem++;
										}else{
											$kq_count_words_post='<i class="fa fa-circle not-seo"></i> Độ dài nội dung của trang không đạt tiêu chuẩn >=300 ký tự';
										}
										if($count_repeat_words_post>0){
											$kq_count_repeat_words_post='<i class="fa fa-circle ok-seo"></i> Từ khóa lặp lại trong văn bản là <b>'.$count_repeat_words_post.'</b> lần';
											$diem++;
										}else{
											$kq_count_repeat_words_post='<i class="fa fa-circle not-seo"></i> Không có từ khóa trong văn bản';
										}
										if($count_img_post>0){
											$kq_count_img_post='<i class="fa fa-circle ok-seo"></i> Hình xuất hiện trong văn bản là '.$count_repeat_words_post.' lần';
											$diem++;
										}else{
											$kq_count_img_post='<i class="fa fa-circle not-seo"></i> Không có hình ảnh trong văn bản';
										}
										if($diem>=5 and $diem<=8){
											$diem_rs='<i class="fa fa-circle ok-seo"></i>';
										}else if($diem>=3 and $diem<5){
											$diem_rs='<i class="fa fa-circle tb-seo"></i>';
										}
										else{
											$diem_rs='<i class="fa fa-circle not-seo"></i>';
										}
										?>
										<div class="checklist-seo">
											<span><?php echo $diem_rs; ?> <b>Tổng quan: <?php echo $diem;?>/8 điểm</b></span>
											<span><?php echo $kq_check_focus_keyword_title; ?></span>
											<span><?php echo $kq_check_focus_keyword_nd; ?></span>
											<span><?php echo $kq_check_focus_keyword_mota; ?></span>
											<span><?php echo $kq_check_focus_keyword_url; ?></span>
											<span><?php echo $kq_count_words_title; ?></span>
											<span><?php echo $kq_count_words_post; ?></span>
											<span><?php echo $kq_count_repeat_words_post; ?></span>
											<span><?php echo $kq_count_img_post; ?></span>
										</div>
									<?php } ?>
							</div>	
						<?php } ?>
					</form>
				</div>
				<div class="col-md-3">
					<?php if(!empty($ngaycapnhat_post_edit)){ ?>
						<div class="form-group">
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title">Thời gian cập nhật</h3>
									<span class="note">Nhập đúng format: yyyy/mm/dd h:m:s</span>
									<span class="note">Đổi thời gian thứ tự cũng sẽ thay đổi</span>
								</div>
								<div class="box-body">									
									<input class="form-control" id="ngaycapnhat" type="text" value="<?php echo $ngaycapnhat_post_edit; ?>" name="ngaycapnhat" hidden>
									<span class="btn btn-primary iframe-btn get_current_time">Click để lấy thời gian hiện tại</span>
								</div>
							</div>	
						</div>
					<?php } ?>
					<?php if($post_type=='post' || $post_type=='page'){?>
						<div class="form-group">
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title">Slider</h3>
								</div>
								<div class="box-body">									
									<?php
										$get_slider=$this->admin_model->select_table_dk_col_get('post','typepost="slider_cat" and trangthai=1','id,ten');
										if($id_post_edit){
											$get_id_slider_current=$this->admin_model->select_value_table_dk_col_1value('post','id='.$id_post_edit.'','id_slider');
											if($get_id_slider_current){
												$get_ten_slider_current=$this->admin_model->select_value_table_dk_col_1value('post','typepost="slider_cat" and trangthai=1 and id="'.$get_id_slider_current.'"','ten');
											}
										}
										if($get_slider){
											echo '<select name="id_slider" class="slider_post">';
												if($get_id_slider_current){
													echo '<option value="'.$get_id_slider_current.'">'.$get_ten_slider_current.'</option>';
												}
												echo '<option value="0">Chọn slider hiển thị</option>';
												foreach($get_slider as $row_get_slider){
													$id_slider=$row_get_slider->id;
													$ten_slider=$row_get_slider->ten;
													echo '<option value="'.$id_slider.'">'.$ten_slider.'</option>';
												}
											echo '</select>';
										}
									?>
								</div>
							</div>	
						</div>
					<?php } ?>	
						<!--<div class="form-group">
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title">Ảnh đại diện</h3>
									<span class="note">Kích thước < 1Mb</span>
								</div>
								<div id="img-avt-post">
									<?php 
										//if(!empty($anhdaidien_post_edit)){?>
											<img loading="lazy" src="<?php //echo UP_POST.$anhdaidien_post_edit; ?>"  width="90%" >
										<?php //}?>
								</div>
								<div class="box-body">
									<input type="file" id="file" name="anhdaidien" class="inputfile" value="<?php //echo $anhdaidien_post_edit; ?>"></input>
									<label for="file" id="upload_avt_post"><i class="fa fa-upload"></i>Chọn file</label>
								</div>
							</div>
						</div>-->
						<div class="form-group" id="group-anhdaidien-ad">
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title">Ảnh đại diện</h3>
									<span class="note">Cắt ảnh kích thước nhỏ nhất 300x325px</span>
								</div>
								<div class="box-body input-append">
									<div class="list-img" id="img-avt-post">
										<?php
											if(!empty($anhdaidien_post_edit)){
												echo '<img loading="lazy" src="'.UPLOAD_URL.$anhdaidien_post_edit.'" alt="Ảnh đại diện" width="90%"/>';
											}
										?>
									</div>
									<input class="form-control" id="anhdaidien" type="text" value="<?php if(!empty($anhdaidien_post_edit)) echo $anhdaidien_post_edit; ?>" name="anhdaidien" hidden style="display: none;"> 
									<a href="javascript:open_popup('<?php echo URL; ?>filemanager/dialog.php?type=1&amp;field_id=anhdaidien&amp;relative_url=1&amp;multiple=0&akey=adkey_dmsKHpm5624sf&popup=1')" class="btn btn btn-primary iframe-btn" type="button">Chọn ảnh đại diện</a>
									<span id="close-anhdaidien" class="close-anhdaidien-tva btn btn btn-primary iframe-btn">Xóa ảnh</span>
								</div>
							</div>
						</div>
						<?php if($post_type=='post' || $post_type=='page' || $post_type=='sanpham'){//gallery img ?>
							<div class="form-group" id="group-thuvienanh-ad">
								<div class="box box-info">
									<div class="box-header with-border">
										<h3 class="box-title">Gallery ảnh</h3>
										<span class="note">Ảnh phải cắt cùng 1 kích thước</span>
									</div>
									<div class="box-body input-append">
										<div class="list-img">
											<?php
												if(!empty($thuvienanh_post_edit)){
													$thuvienanh_post_edit_arr=explode(',',$thuvienanh_post_edit);
													foreach($thuvienanh_post_edit_arr as $img){
														echo '<img loading="lazy" src="'.THUMBS_URL.$img.'" alt="Thư viện ảnh" />';
													}
												}
											?>
										</div>
										<input class="form-control" id="thuvienanh" type="text" value="<?php if(!empty($thuvienanh_post_edit)) echo $thuvienanh_post_edit; ?>" name="thuvienanh" hidden>
										<a href="javascript:open_popup('<?php echo URL; ?>filemanager/dialog.php?type=1&amp;field_id=thuvienanh&amp;relative_url=1&amp;multiple=1&akey=adkey_dmsKHpm5624sf&popup=1')" class="btn btn btn-primary iframe-btn" type="button">Thư viện ảnh</a>
										<span id="close-thuvienanh" class="close-anhdaidien-tva btn btn btn-primary iframe-btn">Xóa ảnh</span>
									</div>
								</div>
							</div>
						<?php } ?>
						<?php if(empty($post_type) || ($post_type=='post') || ($post_type=='sanpham') || ($post_type=='widget')|| ($post_type=='slider')){
							if($post_type=='post'){
								$post_cat_type='cat';
							}else if($post_type=='widget'){
								$post_cat_type='widget_cat';
							}else if($post_type=='slider'){
								$post_cat_type='slider_cat';
							}else if($post_type=='sanpham'){
								$post_cat_type='danhmucsanpham';
							}
						?>
							<div class="form-group">
								<div class="box box-info">
									<div class="box-header with-border">
										<h3 class="box-title">Chuyên mục</h3>
									</div>
									<div class="box-body" style="height: 250px;overflow-y: scroll;">
										<?php
											$get_post=$this->admin_model->select_table_dk('post','typepost','="'.$post_cat_type.'"');
											$checked='';
											$ten_chuyenmuc_cbox_arr=array();
											foreach($get_post as $row_get_post){
												$id_cat1_edit=$row_get_post->id;
												$ten_post_edit=$row_get_post->ten;
												$idpostpr_post_edit=$row_get_post->idpostpr;
												
												if($idpostpr_post_edit==0){
													if(!empty($id_cat_edit)){
														$ten_chuyenmuc_cbox_arr=explode(',', $id_cat_edit);
													}
														// var_dump($ten_chuyenmuc_cbox_arr);
													if (in_array($id_cat1_edit, $ten_chuyenmuc_cbox_arr)) {//check cat_id in array id of post
														$checked='checked';
													}else{
														$checked='';
													}
												

													//$child='level-1';
													echo '<span class="list_cb"><input type="checkbox" class="level-0 idpostpr_post_edit" value="'.$id_cat1_edit.'" '.$checked.'>'.$ten_post_edit.'</span>';

													$get_post_child=$this->admin_model->select_table_dk_col_get('post','typepost="'.$post_cat_type.'" and idpostpr LIKE "%'.$id_cat1_edit.'%"','id,ten');
													
													foreach($get_post_child as $row_get_post_child){
														$id_cat1_child_edit=$row_get_post_child->id;
														$ten_post_child_edit=$row_get_post_child->ten;

														
														if (in_array($id_cat1_child_edit, $ten_chuyenmuc_cbox_arr)) {//check cat_id in array id of post
															$checked_child='checked';
														}else{
															$checked_child='';
														}
														

														echo '<span class="list_cb"><input type="checkbox" class="level-1 idpostpr_post_edit" value="'.$id_cat1_child_edit.'" '.$checked_child.'>'.$ten_post_child_edit.'</span>';
													}
												}
												
													
											}
										?>
									</div>
								</div>
							</div>
						<?php }/*else{?>
							<input type="file" id="file" name="anhdaidien" class="inputfile" value="<?php echo $anhdaidien_post_edit; ?>" hidden>
						<?php }*/ ?>
						<div class="form-group">
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title">Từ khóa</h3>
								</div>
								<div class="box-body">
									<input type="text" class="form-control" name="keyword" value="<?php echo $keyword_post_edit; ?>"placeholder="Nhập từ khóa tại đây">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title">Thao tác</h3>
								</div>
								<div class="box-body">
									<?php
										// $btn_action_post='btn_add_post';
										// $add_typepost_post='add_typepost_'.$post_type;
										// $btn_action_title='Thêm';
										// $link_dr=URL.'admin/post?post_type='.$post_type;
										if(isset($_GET['edit']) and (!isset($_GET['clone']))) {
											$btn_action_post='btn_edit_post';
											$add_typepost_post='edit_typepost_'.$post_type.'_'.$id_post_edit;
											$btn_action_title='Cập nhật';
											$link_dr=URL.'admin/post_new?post_type='.$post_type.'&edit='.$id_post_edit;
										}
										else{
											$btn_action_post='btn_add_post';
											$add_typepost_post='add_typepost_'.$post_type;
											$btn_action_title='Thêm';
											$link_dr=URL.'admin/post?post_type='.$post_type;
										}
									?>
									<span class="list_cb"><input type="checkbox" class="level-0" name="draft_post" id="draft_post" value="1">Lưu dưới dạng bản nháp</span>
									<input type="text" name="link_dr" value="<?php echo $link_dr; ?>" hidden>
									<button class="btn btn-primary <?php echo $btn_action_post; ?>" id="<?php echo $add_typepost_post; ?>"><?php echo $btn_action_title; ?></button>
								</div>
							</div>
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
<script>
	function open_popup(url)
	{
			var w = 880;
			var h = 570;
			var l = Math.floor((screen.width-w)/2);
			var t = Math.floor((screen.height-h)/2);
			var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
	}
</script>
