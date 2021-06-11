<div class="wg-hahd">

	<div class="container no-padding">

		<div class="title_cat_wg color-white"><?php echo $title_wg;?></div>

		<div id="hahh-slider" class="list-post-cat owl-carousel owl-theme owl-loaded owl-drag no-padding">

			<?php

			$id_post=$id_wg;

			$count_post=$this->page_model->count_table_3dk_limit('post','idpostpr','='.$id_post.'','typepost','="post"','trangthai','=1',24);

			$list_post=$this->page_model->select_table_dk_col_get('post','idpostpr IN('.$id_post.') and typepost ="post" and trangthai=1 order by id DESC LIMIT 24','url,ten,anhdaidien,mota,noidung,id');



			$group_nr = 1;

			$last_row = $count_post-1; 

			$wrapper  = 8; 

			

			if($list_post){

				foreach($list_post as $id=>$post){

					$url_post_related=URL_POST.$post->url;

					$ten_post_related=$post->ten;

					$anhdaidien_post_related=$post->anhdaidien;

					$mota_post_related=$this->xulychuoi->ex_post($post->mota);

					if(empty($mota_post_related)){

						$mota_post_related=$this->xulychuoi->ex_post($post->noidung,100);

					}

					?>

						<?php if ($id % $wrapper == 0) { ?>

							<div class="group group-<?php echo $group_nr; ?>">

								<?php $i = 0; $group_nr++; } ?>

								<div class="views-row-<?php print $id+1; ?>">

									<div class="item-post col-lg-3 col-md-3 col-xs-6">

										<a href="<?php echo $url_post_related; ?>" title="<?php echo $ten_post_related; ?>">

											<div class="box-img">

												<?php 

													if($anhdaidien_post_related){?>

														<img alt="" loading="lazy" src="<?php echo UP_POST_THUMB.$anhdaidien_post_related; ?>" class="img-post-avt"/>

													<?php }else{?>

														<img alt="" loading="lazy" src="<?php echo UP_POST_THUMB ?>no_image.jpg" class="img-post-avt"/>

													<?php }

												?>

											</div>

											<div class="gr-text hide-cs">

												<h3 class="title color-white"><?php echo $this->xulychuoi->ex_post($ten_post_related,50);?></h3>

												<div class="ex_post color-white"><?php echo $mota_post_related; ?></div>

											</div>

										</a>

									</div>

								</div>

						<?php $i++; if ($i == $wrapper || $id == $last_row){ echo '</div>'; } ?>

				<?php } 

			} ?>

		</div>

	</div>

</div>

<script>

	jQuery('#hahh-slider').owlCarousel({

		items:1,

		loop:false,

		nav:true,

		dots:false,

		autoplay:false,

		loop:false,

		margin:0,

		smartSpeed:450

	});

</script>
