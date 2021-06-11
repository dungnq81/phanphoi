<?php

	$thongtin_sp=$this->page_model->select_table_dk('sanpham','id_sanpham=',$id_post);

	if($thongtin_sp){

		foreach ($thongtin_sp as $value_sp) {

			$gia=$value_sp->gia;

			$giakhuyenmai=$value_sp->giakhuyenmai;

			$thongsokythuat=$value_sp->thongsokythuat;

			$hotro=$value_sp->hotro;

			$meta=$value_sp->meta;

			$meta_value=$value_sp->meta_value;

			$meta_baohanh=$value_sp->meta_baohanh;

			$meta_value_baohanh=$value_sp->meta_value_baohanh;

			$data_sp['gia']=$gia;

			$data_sp['giakhuyenmai']=$giakhuyenmai;

			$data_sp['meta']=$meta;

			$data_sp['meta_value']=$meta_value;

			$data_sp['meta_baohanh']=$meta_baohanh;

			$data_sp['meta_value_baohanh']=$meta_value_baohanh;

		}

	}

?>

<div class="container no-padding post-wrapper">

	<h1 class="title-post"><?php echo $ten_post; ?></h1>

	<div class="details-post-gr">

		<span id="id_sanpham" hidden><?php echo $id_post; ?></span>

		<span id="name_sanpham" hidden><?php echo $ten_post; ?></span>

		<span id="link_giohang" hidden><?php echo base_url(),'gio-hang'; ?></span>

		<span id="link_tragop" hidden><?php echo base_url(),'tra-gop'; ?></span>

		<?php $this->load->view('content/template-parts/breadcrumb',$ten_postpr_post);  ?>

		<div class="col-lg-9 col-md-9 col-xs-12 no-padding details-post details-sp main-page">

			<div class="img-sp_group">

				<?php echo $this->functions->edit_sanpham_with_user($id_post); ?>

				<div class="col-lg-6 col-md-6 col-xs-12 no-padding img-sp-gr main-page">

					<?php $this->load->view('content/template-parts/img-post',$anhdaidien_post);  ?>

				</div>

				<div class="col-lg-6 col-md-6 col-xs-12 no-padding-right price-sp-gr main-page">

					<?php $this->load->view('content/template-parts/sanpham/price_sp',$data_sp);  ?>

				</div>

				<?php $this->load->view('content/template-parts/sanpham/form_tragop');  ?>

			</div>

			<div class="entry-post">

				<div class="col" id="product-review">

					<div class="block-title"><h3><i class="fa fa-bars"></i> Chi tiết sản phẩm</h3></div>

					<div class="block-content">

						<?php echo $noidung_post; ?>

					</div>

				</div>

				<div class="col" id="product-comment">

					<div class="block-title"><h3><i class="fa fa-comment"></i> Bình luận</h3></div>

					<div class="fb-comments" data-href="<?php echo base_url(uri_string()); ?>" data-width="100%" data-numposts="10"></div>

				</div>

			</div>

			<?php $this->load->view('content/template-parts/share');  ?>

		</div>		

		<div class="col-lg-3 col-md-3 col-xs-12 no-padding sidebar-page" style="padding-right: 0">

			<div class="group_field_ct">

				<div class="col large-4">

					<div id="promotion_sp" class="block-info">

						<h3 class="title">Chính sách giao hàng</h3>

						<?php

							$wg_ct=$this->page_model->select_table_2dk('post','id','=711','trangthai','=1');

						?>

						<div class="block-content">

							<div class="scrollbar"><?php echo $this->functions->widget_content($wg_ct,''); ?></div>

						</div>

					</div>

					<div id="sp_related" class="block-info">

						<h3 class="title">Sản phẩm liên quan</h3>

						<div class="block-content">

							<?php

								$id_dmsp=$this->page_model->select_table_dk_col_get_1value('post','id= '.$id_post.' ','idpostpr');

								$list_post = $this->page_model->select_table_dk_col_get('post','(idpostpr LIKE "%'.$id_dmsp.'%" or idpostpr IN('.$id_dmsp.')) and typepost ="sanpham" and id!='.$id_post.' and trangthai=1 order by ngaycapnhat DESC LIMIT 0,6 ','url,ten,anhdaidien,mota,noidung,id');

								if($list_post){

									foreach($list_post as $post){

										$id_post_related=$post->id;

										$url_post_related=URL_POST.$post->url;

										$ten_post_related=$post->ten;

										$anhdaidien_post_related=$post->anhdaidien;

										$mota_post_related=$this->xulychuoi->ex_post($post->mota);

										if(empty($mota_post_related)){

											$mota_post_related=$this->xulychuoi->ex_post($post->noidung,100);

										} 

										$data_sp['id_sanpham']=$id_post_related;

										?>

											<div class="item-sanpham col-lg-6 col-ms-6 col-xs-6" id="sanpham-<?php echo $id_post_related; ?>">

												<a href="<?php echo $url_post_related; ?>" title="<?php echo $ten_post_related; ?>">

													<div class="box-img no-padding">

														<?php 

															if($anhdaidien_post_related){?>

																<img alt="" loading="lazy" src="<?php echo THUMBS_URL.$anhdaidien_post_related; ?>" class="img-post-avt"/>

															<?php }else{?>

																<img alt="" loading="lazy" src="<?php echo UP_POST_THUMB ?>no_image.jpg" class="img-post-avt"/>

															<?php }

														?>

													</div>

													<div class="group-price no-padding">

														<h3 class="title"><?php echo $this->xulychuoi->ex_post($ten_post_related,50);?></h3>

														<?php $this->load->view('content/template-parts/sanpham/price_sp_danhmuc',$data_sp);  ?>

													</div>

												</a>

											</div>

								<?php }

								}

							?>

						</div>

					</div>

				</div>

			</div>

		</div>		

	</div>

</div>
