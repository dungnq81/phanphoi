<?php 
	$id_post=$id_wg;
	$text_widgetcat_home=$this->page_model->select_table_dk_col_get_1value('post','id="'.$id_post.'"','ten');
?>
<div class="wg-dsl">
	<div class="container no-padding">
		<div class="list-post-cat">
			<?php
			$list_post=$this->page_model->select_table_dk_col_get('post','idpostpr IN(676) and typepost ="post" and trangthai=1 order by id DESC LIMIT 5','url,ten,anhdaidien,mota,noidung,id,ngaydang');
			if($list_post){
				echo '<div class="col-xs-12 col-sm-8 col-lg-8 animation about-item">';
					echo '<h2 class="title_cat_wg">Tin tức</h2>'; ?>
					<div class="list-post-cat_home"> 
					<?php 
					$dem=0;
					foreach($list_post as $post){
						$url_post_related=URL_POST.$post->url;
						$ten_post_related=$post->ten;
						$anhdaidien_post_related=$post->anhdaidien;
						$ngaydang_post_related=$post->ngaydang;
						$mota_post_related=$post->mota;
						if(empty($mota_post_related)){
							$mota_post_related=$this->xulychuoi->ex_post($post->noidung,300);
						}?>
							<div class="item-post-wg">
								<a href="<?php echo $url_post_related; ?>" title="<?php echo $ten_post_related; ?>">
									<div class="box-img-gr">
										<?php 
											if($anhdaidien_post_related){?>
												<img alt="<?php echo $ten_post_related; ?>" loading="lazy" src="<?php echo UPLOAD_URL.$anhdaidien_post_related; ?>" class="img-post-avt"/>
											<?php }else{?>
												<img alt="<?php echo $ten_post_related; ?>" loading="lazy" src="<?php echo UP_POST_THUMB ?>no_image.jpg" class="img-post-avt"/>
											<?php }
										?>
									</div>
									<div class="title-gr">
										<h3 class="title"><?php echo $ten_post_related;?></h3>
										<i class="date-post"><?php echo $ngaydang_post_related; ?></i>
									</div>
								</a>
								<?php 
									if($dem==0){ ?>
										<div class="ex_post"><?php echo $mota_post_related; ?></div>
								<?php } ?>
								
								
							</div>
					<?php $dem++;} 
					echo '</div>';
				echo '</div>';
			} 

			$list_video_rs=$id_wg;
			if($list_video_rs){ 
				$list_video_rs=explode(',', $list_video); ?>
				<div class="col-xs-12 col-sm-4 col-lg-4 animation about-item">
					<h2 class="title_cat_wg">Tư vấn</h2>
					<div class="pgl-bg-dark no-padđing gallery-slider-ct owl-carousel owl-theme owl-loaded owl-drag no-padding">
						<?php foreach ($list_video_rs as $value) { ?>
							<iframe loading="lazy" width="100%" height="250" src="https://www.youtube.com/embed/<?php echo $value; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
