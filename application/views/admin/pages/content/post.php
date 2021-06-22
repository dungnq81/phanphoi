<?php

	$col_bt='col-md-12';

	if($post_type!='message' && $post_type!='post' and $post_type!='page'  and $post_type!='sanpham' and $post_type!='widget' and $post_type!='slider' and $post_type!='lienhe'){

		$col_bt='col-md-8';

	}

	

	$count_dakichhoat= $this->admin_model->count_table_dk_cus('post','typepost="'.$post_type.'" and trangthai=1');

	$count_chuakichhoat= $this->admin_model->count_table_dk_cus('post','typepost="'.$post_type.'" and trangthai=0');

	//---------

?>

<section class="content" id="content_<?php echo $page_slug?>_page">

  <div class="row">

	<div class="col-xs-12">

	  <div class="box">

		<div class="box-header">

			<h3 class="box-title"><?php echo $page_des; ?></h3>

			<p class="login-box-msg" id="result_<?php echo $table; ?>_alert" style="display: inline;"></p>

		</div>

		<!-- /.box-header -->

		<div class="box-body">

			<?php 

				if($post_type!='message' && $post_type!='post' and $post_type!='page' and $post_type!='sanpham' and $post_type!='widget' and $post_type!='slider' and $post_type!='lienhe'){

					echo '<div class="col-md-4">';

						$data['id_post_edit']='';

						$data['ten_post_edit']='';

						$data['url_post_edit']='';

						$data['idpostpr_post_edit']='';

						$data['mota_post_edit']='';

						$data['ten_cat_edit']='';

						$data['url_cat_edit']='';

						$data['link_anhdaidien_post_edit']='';

						$data['id_related_post_edit']='';

						$data['seo_title_post_edit']='';

						// $data['ngaycapnhat_post_edit']='';

						

						if(!empty($_GET['edit'])){

							$id_post_get=$_GET['edit'];

							$get_post=$this->admin_model->select_table_dk('post','id','='.$id_post_get.'');

							foreach($get_post as $row_get_post){

								$data['id_post_edit']=$row_get_post->id;

								$data['ten_post_edit']=$row_get_post->ten;

								$data['seo_title_post_edit']=$row_get_post->seo_title;

								$data['url_post_edit']=$row_get_post->url;

								$data['idpostpr_post_edit']=$row_get_post->idpostpr;

								$data['mota_post_edit']=$row_get_post->mota;

								$data['ngaycapnhat_post_edit']=$row_get_post->ngaycapnhat;

								$data['anhdaidien_post_edit']=$row_get_post->anhdaidien;

								$data['link_anhdaidien_post_edit']=$row_get_post->link_anhdaidien;

								$data['id_related_post_edit']=$row_get_post->id_related;

								if($post_type=='thuoctinhsanpham'){



									if($row_get_post->idpostpr==0){

										$data['ten_cat_edit']='Lựa chọn';

										$data['url_cat_edit']=$row_get_post->idpostpr;

									}else{

										$data['ten_cat_edit']='Color';

										$data['url_cat_edit']=$row_get_post->idpostpr;

									}

									

								}else{

									$name_cat=$this->admin_model->select_table_dk('post','id','='.$row_get_post->idpostpr.'');

									foreach($name_cat as $row_name_cat){

										$data['ten_cat_edit']=$row_name_cat->ten;

										$data['id_cat_edit']=$row_name_cat->id;

									}

								}

							}

						}

						$this->load->view('admin/pages/content/cat_new',$data);

					echo '</div>';

				}

			?>

			<div class="<?php echo $col_bt?>">

				<p class="login-box-msg" id="result_action_alert" style="display: inline;"></p>

				

				<div class="form-group col-lg-4 col-xs-12 group-action-right"> 

					<div class="col-lg-8 col-xs-8" style="padding: 0 2px;"><input type="text" name="title_post_filter" class="form-control" placeholder="Nhập tên bài viết"></div>

					<button class="btn btn-default col-lg-4 col-xs-4" id="filter_title_post">Tìm kiếm</button>

				</div>

				

			    <div class="form-group col-lg-3 col-xs-12 group-action">

					<select class="form-control" id="action_post_all">

						<option value="0">Tác vụ</option>

						<option value="unactive">Hủy kích hoạt</option>

						<option value="active">Kích hoạt</option>

						<option value="remove">Xóa</option>

					</select>

					<button class="btn btn-default" id="action_post_all_btn">Áp dụng</button>

					<div class="group_active col-md-12"><a href="?post_type=<?php echo $post_type; ?>&post_status=1">Đã kích hoạt(<?php echo $count_dakichhoat; ?>)</a> | <a href="?post_type=<?php echo $post_type;?>&post_status=0">Chưa kích hoạt(<?php echo $count_chuakichhoat; ?>)</a></div>

					<input type="text" name="link_dr" value="?post_type=<?php echo $post_type;?>" hidden>

				</div>



				<?php if($post_type=='sliderss'){//sort?>

					<button type="button" class="btn btn-primary btn_update_order_table">Cập nhật thứ tự</button>

				<?php } ?>



				<?php if($post_type=='sanpham'){ ?>

					<div class="col-lg-12 col-sm-12 col-xs-12 no-padding hidden">

						<a class="pull-left btn btn-primary btn-xs" href="<?php echo URL_AD; ?>export_sp" style="padding: 5px 10px;font-size: 13px;"><i class="fa fa-file-excel-o"></i> Export sản phẩm</a></div>

				<?php } ?>

				<table id="tbl_<?php echo $page_slug;?>" class="table table-bordered table-striped">

					<thead>

						<tr>

							<th><input type="checkbox" id="select_all"></th>

							<th>Tiêu đề</th>

							<?php

							if($post_type=='thuoctinhsanpham'){

								echo '<th>Loại</th>';

							} elseif ($post_type=='message') {echo NULL;}
							else if($post_type =='page') {echo NULL; }
							else{

								echo '<th>Chuyên mục</th>';

							}

							?>

							<th>Ngày đăng</th>

							<?php if ($post_type=='message') : ?>
								<th>URL</th>
							<?php else: ?>
								<th>Ngày cập nhật</th>
							<?php endif;?>

							<th>Trạng thái</th>

							<th>Thao tác</th>

						</tr>

					</thead>

					<tbody class="post-list" id="postList">

						<?php $stt=0; if(!empty($posts)): foreach($posts as $post): ?>

								<?php

									$id=$post['id'];

									$tieude=$post['ten'];

									$chuyenmuc=$post['idpostpr'];

									$ngaydang=$post['ngaydang'];

									$ngaycapnhat=$post['ngaycapnhat'];

									$trangthai=$post['trangthai'];

									$url_post=$post['url'];

									$type_thuoctinh=$post['idpostpr'];



									if($trangthai==1){

										$trangthai='Bật';

										if($post_type=='lienhe'){

											$trangthai='Đã xem';

										}



										$btn_khoa_table='btn_khoa_table';

										$lock_fa='lock';

									}else{

										$trangthai='Ẩn';

										if($post_type=='lienhe'){

											$trangthai='Chưa xem';

										}

										$btn_khoa_table='btn_mokhoa_table';

										$lock_fa='unlock-alt';

									}

									//-----

									if($chuyenmuc==0){

										if($post_type=='thuoctinhsanpham'){

											$ten_chuyenmuc_rs='Lựa chọn';		

										}else{

											$ten_chuyenmuc_rs='';

										}



									}else{

										if($post_type=='thuoctinhsanpham'){

											$ten_chuyenmuc_rs='Color';		

										}else{

											$list_chuyenmuc=$chuyenmuc;

											$list_chuyenmuc_ex=explode(',',$list_chuyenmuc);

											$ten_chuyenmuc_arr=array();

											foreach($list_chuyenmuc_ex as $chuyenmuc){

												$ten_chuyenmuc=$this->admin_model->select_table_dk('post','id','='.$chuyenmuc.' ');

												foreach($ten_chuyenmuc as $row_ten_chuyenmuc){

													array_push($ten_chuyenmuc_arr, $row_ten_chuyenmuc->ten);

													$ten_chuyenmuc_rs = implode(", ", $ten_chuyenmuc_arr);

												}

											}

										}

											

									}

									//----

									

									if($post_type!='post' and $post_type!='page' and $post_type!='sanpham' and $post_type!='widget' and $post_type!='slider' and $post_type!='lienhe' and $post_type!='giatrithuoctinhsanpham' ){

										$href_edit=URL_AD."post?post_type=".$post_type."&edit=".$id." ";

									}

									else if($post_type=='lienhe'){

										$href_edit=URL_AD."mail_view?post_type=".$post_type."&view=".$id." ";

										$tieude=$this->xulychuoi->replace_name_form($tieude);

									}

									else if($post_type=='giatrithuoctinhsanpham'){

										$href_edit=URL_AD."post?post_type=".$post_type."&thuoctinhsanpham=".$_GET['thuoctinhsanpham']."&edit=".$id."&typethuoctinh=".$_GET['typethuoctinh']." ";

									}

									else{

										$href_edit=URL_AD."post_new?post_type=".$post_type."&edit=".$id." ";

									}

									

								?>	

								<tr class="list-item" id="item-<?php echo $table?>-<?php echo $id;?>" >

									<th><input type="checkbox" class="cb_post" value="<?php echo $id;?>"></th>

									<td><?php echo $tieude; ?></td>
									<?php if($post_type != 'page' && $post_type != 'message') : ?>
									<td class="cm_post"><?php echo $ten_chuyenmuc_rs; ?></td>
									<?php endif;?>
									<td><?php echo $ngaydang; ?></td>

									<td><?php echo $ngaycapnhat; ?></td>

									<td id="trangthai_<?php echo $table; ?>_<?php echo $id; ?>"><?php echo $trangthai; ?></td>	

									<td>

										<?php if($post_type!='lienhe' and $post_type!='menu' and $post_type!='widget' and $post_type!='slider'){ ?>

											<a target="_blank" class="btn btn-primary btn_xem_table" id="btn_sua_<?php echo $table ?>_<?php echo $id ?>" href="<?php echo URL_POST.$url_post;?>" title="Xem bài viết"><i class="fa fa-eye"></i></a>

										<?php } ?>



										<button type="button" class="btn btn-primary <?php echo $btn_khoa_table; ?>" id="btn_khoa_<?php echo $table; ?>_<?php echo $id ?>" title="Khóa bài viết"><i class="fa fa-<?php echo $lock_fa; ?>"></i></button>



										<?php if($post_type=='lienhe'){ ?>

											<a class="btn btn-primary btn_sua_table" id="btn_sua_<?php echo $table ?>_<?php echo $id ?>" href="<?php echo $href_edit;?>" title="Xem chi tiết"><i class="fa fa-eye"></i></a>

										<?php } ?>



										<?php if($post_type!='lienhe'){ ?>

											<a class="btn btn-primary btn_sua_table" id="btn_sua_<?php echo $table ?>_<?php echo $id ?>" href="<?php echo $href_edit;?>" title="Sửa bài viết"><i class="fa fa-edit"></i></a>

										<?php } ?>



										<button type="button" class="btn btn-primary btn_xoa_table" id="btn_xoa_<?php echo $table ?>_<?php echo $id ?>" title="Xóa bài viết"><i class="fa fa-trash"></i></button>

										<?php 

											if($post_type=='thuoctinhsanpham'){

													$href_config=URL_AD."post?post_type=giatrithuoctinhsanpham&thuoctinhsanpham=".$id."&typethuoctinh=".$type_thuoctinh." ";

												?>

												<a class="btn btn-primary" href="<?php echo $href_config;?>" title="Cấu hình chủng loại"><i class="fa fa-cog"></i></a>

											<?php }

											//----------- clone sp -----------//

											if($post_type=='sanpham'){

													$href_edit_clone=URL_AD."post_new?post_type=".$post_type."&edit=".$id."&clone=true ";

												?>

												<a class="btn btn-primary btn-red btn_clone_post" href="<?php echo $href_edit_clone;?>" title="Nhân bản sản phẩm"><i class="fa fa-clone"></i></a>

											<?php }

											//---------------------------------//

										?>

									</td>

								</tr>

						<?php endforeach; else: ?>

							<p>Hiện tại không có bài viết</p>

						<?php endif; ?>

						<div class="pagination"><?php echo $pagination; ?></div>

							<div class="loading" style="display: none;"><div class="content"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i></div></div>

					</tbody>

					<tfoot>

						<tr>

							<th><input type="checkbox" id="select_all"></th>

							<th>Tiêu đề</th>

							<?php

							if($post_type=='thuoctinhsanpham'){

								echo '<th>Loại</th>';

							} elseif ($post_type=='message') {echo NULL;}
							else if($post_type =='page') {echo NULL; }
							else{

								echo '<th>Chuyên mục</th>';

							}

							?>

							<th>Ngày đăng</th>
							<?php if ($post_type=='message') : ?>
								<th>URL</th>
							<?php else: ?>
							<th>Ngày cập nhật</th>
							<?php endif;?>
							<th>Trạng thái</th>

							<th>Thao tác</th>

						</tr>

					</tfoot>

			  </table>

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

	$('#select_all').click(function() {

		var c = this.checked;

		$(':checkbox').prop('checked',c);

	});

</script>
