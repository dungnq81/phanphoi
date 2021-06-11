<div class="box box-primary">

	<div class="box-header with-border">

		<h3 class="box-title">Thêm danh mục</h3>

	</div>

	<div class="box-body">

		<form role="form">

			<?php if($post_type=='slider_cat'){?>

				<div class="form-group">

					<label>Kích thước slider</label>

					<span class="help-block">- Slider trang chủ: <b>893x400px</b></span>

					<span class="help-block">- Slider trang: <b>1531x400px</b></span>

				</div>

			<?php } ?>

			<div class="form-group">

				<label>Tên</label>

				<input type="text" name="ten" class="form-control" placeholder="Nhập tên ..." value="<?php echo $ten_post_edit; ?>">

				<span class="help-block">Tên riêng sẽ hiển thị trên trang mạng của bạn.</span>

			</div>

			<div class="form-group">

				<label>SEO title</label>

				<input type="text" class="form-control" name="seo_title" value="<?php echo $seo_title_post_edit; ?>" placeholder="Nhập seo title">

			</div>

			<?php if($post_type=='menu'){?>

				<div class="form-group">

					<label>Link từ bài chuyên mục/trang/bài viết</label>	

					<?php

					$list_post1=$this->admin_model->select_table_dk_col_get('post','(id="'.$id_post_edit.'") and trangthai=1','menu_link');

					if($list_post1){

						foreach($list_post1 as $row1){

							$id_menu_link=$row1->menu_link;

							if($id_menu_link!=""){

								$name_menu_link=$this->admin_model->select_value_table_dk_col('post','url','="'.$id_menu_link.'"','ten');

							}

						}

					}

					?>					

					<select class="form-control" name="menu_link">

						<?php

							if(!empty($name_menu_link)){

								echo '<option class="level_cat-0" value="'.$id_menu_link.'" selected>'.$name_menu_link.'</option>';

							}

							echo '<option value="0" class="bold" style="font-weight:bold" >Không chọn</option>';

							echo '<option value="0" class="bold" style="font-weight:bold" >Chuyên mục</option>';

							$list_post=$this->admin_model->select_table_dk_col_get('post','(typepost="cat") and trangthai=1','id,ten');

							foreach($list_post as $row){

								$id_post=$row->id;

								$ten_post=$row->ten;

								echo '<option value="'.$id_post.'">'.$ten_post.'</option>';

							}

							echo '<option value="0" class="bold" style="font-weight:bold" >Trang</option>';

							$list_post=$this->admin_model->select_table_dk_col_get('post','(typepost="page") and trangthai=1','id,ten');

							foreach($list_post as $row){

								$id_post=$row->id;

								$ten_post=$row->ten;

								echo '<option value="'.$id_post.'">'.$ten_post.'</option>';

							}

							echo '<option value="0" class="bold" style="font-weight:bold" >Bài viết</option>';

							$list_post=$this->admin_model->select_table_dk_col_get('post','(typepost="post") and trangthai=1','id,ten');

							foreach($list_post as $row){

								$id_post=$row->id;

								$ten_post=$row->ten;

								echo '<option value="'.$id_post.'">'.$ten_post.'</option>';

							}

							echo '<option value="0" class="bold" style="font-weight:bold" >Danh mục sản phẩm</option>';

							$list_post=$this->admin_model->select_table_dk_col_get('post','(typepost="danhmucsanpham") and trangthai=1','id,ten');

							foreach($list_post as $row){

								$id_post=$row->id;

								$ten_post=$row->ten;

								echo '<option value="'.$id_post.'">'.$ten_post.'</option>';

							}

						?>

					</select>				

			  </div>

			<?php } ?>

			<div class="form-group">

				<?php 

					if($post_type=='menu'){?>

						<label>Link tĩnh menu</label>

						<input type="text" name="url" class="form-control" placeholder="Nhập chuỗi cho đường dẫn tỉnh" value="<?php echo $url_post_edit; ?>">

						<span class="help-block">Đường dẫn tĩnh của menu nếu không chọn "Link từ chuyên mục/trang/bài viết"</span>

					<?php }else{ ?>

						<label>Chuỗi cho đường dẫn tỉnh</label>

						<input type="text" name="url" class="form-control" placeholder="Nhập chuỗi cho đường dẫn tỉnh" value="<?php echo $url_post_edit; ?>">

						<span class="help-block">Chuỗi cho đường dẫn tĩnh là phiên bản của tên hợp chuẩn với Đường dẫn (URL). Chuỗi này bao gồm chữ cái thường, số và dấu gạch ngang (-).</span>

					<?php }?>			

			</div>

			<?php if($post_type=='thuoctinhsanpham'){ ?>

				<div class="form-group">

					<label>Loại</label>

				 	<select class="form-control" name="idpostpr">

				 		<?php

							if(!empty($ten_cat_edit)){

								echo '<option value="'.$url_cat_edit.'" selected>'.$ten_cat_edit.'</option>';

						} ?>

						<option value="0">Lựa chọn</option>

						<option value="1">Color</option>

				 	</select>

				</div>	

			<?php } else if($post_type=='giatrithuoctinhsanpham'){ ?>

				<div class="form-group" hidden>

					<label>Cha</label>

				 	<select class="form-control" name="idpostpr">

						<option value="<?php echo $_GET['thuoctinhsanpham']; ?>"><?php echo $_GET['thuoctinhsanpham']; ?></option>

				 	</select>

				</div>	

			<?php } else{ ?>

				<div class="form-group">

					<label>Cha</label>

				 	<select class="form-control" name="idpostpr">

						<option value="0">Trống</option>

						<?php

							if(!empty($ten_cat_edit)){

								echo '<option class="level_cat-0" value="'.$id_cat_edit.'" selected>'.$ten_cat_edit.'</option>';

							}

							$list_chuyenmuc=$this->admin_model->select_table_dk('post','typepost','="'.$post_type.'"');

							foreach($list_chuyenmuc as $row_list_chuyenmuc){

								$id_chuyenmuc_sl=$row_list_chuyenmuc->id;

								$ten_chuyenmuc_sl=$row_list_chuyenmuc->ten;

								$idpostpr_chuyenmuc_sl=$row_list_chuyenmuc->idpostpr;

								$level_cat='level-cat-0';

								if($idpostpr_chuyenmuc_sl!=0){

									$level_cat='level-cat-1';

								}

								echo '<option class="'.$level_cat.'" value="'.$id_chuyenmuc_sl.'">'.$ten_chuyenmuc_sl.'</option>';

							}

						?>

				 	</select>

				</div>	

			<?php } ?>



			

		

			<?php

				$link_dr=URL.'admin/post?post_type='.$post_type;

				if($post_type=='giatrithuoctinhsanpham'){

					if(isset($_GET['thuoctinhsanpham'])){

						$link_dr=$link_dr.'&thuoctinhsanpham='.$_GET['thuoctinhsanpham']."&typethuoctinh=".$_GET['typethuoctinh'];

					}

				}

			?>

			<input type="text" name="link_dr" value="<?php echo $link_dr; ?>" hidden>

			<div class="form-group">

				<label>Mô tả</label>

				<textarea class="form-control" rows="3" placeholder="Nhập mô tả" name="mota"><?php if(!empty($mota_post_edit)){ echo $mota_post_edit; } ?></textarea>

				<!--<input type="file" id="file" name="anhdaidien" class="inputfile" hidden>-->

			</div>



			<?php if($post_type=='giatrithuoctinhsanpham' and $_GET['typethuoctinh']==1){//color picker ?>

				<div class="form-group">

					<label>Màu sắc</label>

					<div class="color_thuoctinh_gr">

						<div>

							<input type="text" id="color_thuoctinh"><i>Chọn màu</i>

						</div>

					</div>

				</div>

				<textarea class="form-control" id="editor" name="noidung" readonly style="display: none;">#000000</textarea>

			<?php }else{ ?>

				<textarea class="form-control" id="editor" name="noidung" readonly style="display: none;"></textarea>

			<?php } ?>



			<?php if($post_type!='thuoctinhsanpham' and $post_type!='giatrithuoctinhsanpham'){ ?>

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

				<div class="form-group">

					<div class="box box-info">

						<div class="box-header with-border">

							<h3 class="box-title">Link ảnh đại diện</h3>

							<span class="note">Nhập link tĩnh</span>

						</div>

						<div class="box-body">									

							<input class="form-control" id="link_anhdaidien" type="text" value="<?php echo $link_anhdaidien_post_edit; ?>" name="link_anhdaidien" hidden>

						</div>

					</div>	

				</div>

			<?php } ?>



			<?php if($post_type=='danhmucsanpham'){ ?>

				<div class="form-group">

					<label>Danh mục sản phẩm liên quan</label>

					<div class="list-id_related-gr col-order-sort-gr" style="height: 200px;overflow: hidden; overflow-y: scroll;"> 

					 	<?php

							$list_chuyenmuc=$this->admin_model->select_table_dk('post','typepost','="'.$post_type.'"');

							foreach($list_chuyenmuc as $row_list_chuyenmuc){

								$id_chuyenmuc_sl=$row_list_chuyenmuc->id;

								$ten_chuyenmuc_sl=$row_list_chuyenmuc->ten;

								$idpostpr_chuyenmuc_sl=$row_list_chuyenmuc->idpostpr;

								$level_cat='level-cat-0';

								if($idpostpr_chuyenmuc_sl!=0){

									$level_cat='level-cat-1';

								}

								if(!empty($id_related_post_edit)){

									$ten_chuyenmuc_cbox_arr=explode(',', $id_related_post_edit);

									// var_dump($ten_chuyenmuc_cbox_arr);

									if (in_array($id_chuyenmuc_sl, $ten_chuyenmuc_cbox_arr)) {//check cat_id in array id of post

										$checked='checked';

									}else{

										$checked='';

									}

								}else{

									$checked='';

								}

								echo '<div class="id_related"><input type="checkbox" class="'.$level_cat.'" value="'.$id_chuyenmuc_sl.'" '.$checked.'>'.$ten_chuyenmuc_sl.'</div>';

							}

						?>

				 	</div>

				</div>	

			<?php } ?>



			<?php if(!empty($ngaycapnhat_post_edit)){ ?>

				<div class="form-group">

					<div class="box box-info">

						<div class="box-header with-border">

							<h3 class="box-title">Thời gian cập nhật</h3>

							<span class="note">Nhập đúng format: yyyy/mm/đd h:m:s</span>

							<span class="note">Đổi thời gian thứ tự cũng sẽ thay đổi</span>

						</div>

						<div class="box-body">									

							<input class="form-control" id="ngaycapnhat" type="text" value="<?php echo $ngaycapnhat_post_edit; ?>" name="ngaycapnhat" hidden>

							<span class="btn btn-primary iframe-btn get_current_time">Click để lấy thời gian hiện tại</span>

						</div>

					</div>	

				</div>

			<?php } ?>

		</form>

		<div class="box-footer">

			<?php

				$btn_action_post='btn_add_post';

				$add_typepost_post='add_typepost_'.$post_type;

				$btn_action_title='Thêm';

				if(!empty($_GET['edit'])){

					$btn_action_post='btn_edit_post';

					$add_typepost_post='edit_typepost_'.$post_type.'_'.$id_post_edit;

					$btn_action_title='Cập nhật';

				}

			?>

			<button type="submit" class="btn btn-primary <?php echo $btn_action_post; ?>" id="<?php echo $add_typepost_post; ?>"><?php echo $btn_action_title; ?></button>

			<p class="login-box-msg" id="result_setting_alert" style="display: inline;"></p>	

		</div>

	</div>

</div>



<script>

	$('#color_thuoctinh').colorpicker();

    $("#color_thuoctinh").change(function(){

     	color_val=$(this).val();

		$("#editor").val(color_val);

	});



	function open_popup(url)

	{

			var w = 880;

			var h = 570;

			var l = Math.floor((screen.width-w)/2);

			var t = Math.floor((screen.height-h)/2);

			var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);

	}

  </script> 
