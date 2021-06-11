<aside id="wg-danhmucsanpham" class="widget widget_nav_menu widget-toggle hidden-xs">

	<h3 class="widget-title">Danh mục sản phẩm <i class="fa fa-caret-up"></i></h3>

	<?php

		$list_danhmucsp= $this->page_model->select_table_dk_col_get('post','typepost ="danhmucsanpham" and trangthai=1 order by ngaycapnhat','url,ten,id,idpostpr,menu_link,anhdaidien'); 

		if(empty($url_post)){

			$url_post=base_url();	

		}

		$this->functions->menu($list_danhmucsp,$url_post); 

	?>

</aside>

<aside id="wg-new-product" class="widget widget_sp_moi widget-toggle hidden-xs">

	<h3 class="widget-title">Sản phẩm mới <i class="fa fa-caret-up"></i></h3>

	<div class="list_post_new_wg">

		<?php

			$list_post = $this->page_model->select_table_dk_col_get('post',' typepost ="sanpham" and trangthai=1 order by ngaycapnhat DESC LIMIT 0,5 ','url,ten,anhdaidien,mota,noidung,id');	

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

						<div class="item-sanpham col-lg-12 col-md-12 col-xs-6" id="sanpham-<?php echo $id_post_related; ?>">

							<a href="<?php echo $url_post_related; ?>" title="<?php echo $ten_post_related; ?>">

								<div class="box-img col-lg-3 col-ms-3 col-xs-12 no-padding">

									<?php 

										if($anhdaidien_post_related){?>

											<img alt="<?php echo $ten_post_related; ?>" loading="lazy" src="<?php echo UPLOAD_URL.$anhdaidien_post_related; ?>" class="img-post-avt"/>

										<?php }else{?>

											<img alt="<?php echo $ten_post_related; ?>" loading="lazy" src="<?php echo UP_POST_SM ?>no_image.jpg" class="img-post-avt"/>

										<?php }

									?>

								</div>

								<div class="group-price col-lg-9 col-ms-9 col-xs-12 no-padding">

									<h3 class="title"><?php echo $this->xulychuoi->ex_post($ten_post_related,50);?></h3>

									<?php $this->load->view('content/template-parts/sanpham/price_sp_danhmuc',$data_sp);  ?>

								</div>

							</a>

						</div>

			<?php }

			} ?>

	</div>

</aside>

<?php if($slug=='danhmucsanpham'){?>

	<aside id="wg-fillter-product" class="widget widget_fillter_product widget-toggle hidden-xs" hidden="">

		<h3 class="widget-title">Lọc sản phẩm <i class="fa fa-caret-up"></i></h3>

		<div class="list_post_new_wg">

			<?php

				$thuoctinhsanpham=$this->page_model->select_table_dk_col_get('post','typepost = "thuoctinhsanpham" ','id,ten');

				if($thuoctinhsanpham){ ?>

					<div class="thuoctinhsanpham_sl">

						<?php

							 foreach ($thuoctinhsanpham as $value) {

								$ten_thuoctinh=$value->ten;

								$id_thuoctinh=$value->id; ?>

									<div class="thuoctinhsanpham_gr_fillter" id="thuoctinhsanpham_gr_<?php echo $id_thuoctinh; ?>">

										<span class="title-thuoctinh"><?php echo $ten_thuoctinh; ?> <i class="fa fa-caret-up"></i></span>

										<div class="list_thuoctinh_fillter">

											<?php 

												$giatri_thuoctinhsanpham=$this->page_model->select_table_dk_col_get('post','typepost = "giatrithuoctinhsanpham" and idpostpr='.$id_thuoctinh.' ','id,ten');

												if($giatri_thuoctinhsanpham){

													$checked_css='';

													foreach ($giatri_thuoctinhsanpham as $value_giatri) {

														$value_giatri_id_rs=$id_thuoctinh.'+++'.$value_giatri->id;

														echo '<span class="list_cb"><input type="checkbox" name="giatrithuoctinhsanpham_ip_'.$id_thuoctinh.'" value="'.$value_giatri->ten.'" id="'.$value_giatri->id.'" '.$checked_css.' >'.$value_giatri->ten.'</span>';

													}

												}

											?>

										</div>

									</div>

						<?php } ?>

					</div>

					<input type="text" name="link_cat" value="<?php echo base_url(uri_string()); ?>" readonly="" hidden>

					<button type="button" class="button filter_thuoctinhsanpham">Lọc sản phẩm</button>

			<?php } ?>

		</div>

	</aside>

<?php } ?>
