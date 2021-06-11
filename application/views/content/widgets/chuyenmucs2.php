<div class="wg-lichhoc">
	<div class="container no-padding">
		<div class="title_cat_wg"><?php echo $title_wg;?></div>
		<div class="list-post-cat">
			<?php
			$id_post=$id_wg;
			$list_post=$this->page_model->select_table_dk_col_get('post','idpostpr IN('.$id_post.') and typepost ="post" and trangthai=1 order by id DESC LIMIT 4','url,ten,anhdaidien,mota,noidung,id');
			if($list_post){
				foreach($list_post as $post){
					$url_post_related=URL_POST.$post->url;
					$ten_post_related=$post->ten;
					$anhdaidien_post_related=$post->anhdaidien;
					$mota_post_related=$this->xulychuoi->ex_post($post->mota);
					if(empty($mota_post_related)){
						$mota_post_related=$this->xulychuoi->ex_post($post->noidung,100);
					}?>
						<div class="item-post col-lg-6 col-md-6 col-xs-6">
							<a href="<?php echo $url_post_related; ?>" title="<?php echo $ten_post_related; ?>">
								<div class="box-img">
									<?php 
										if($anhdaidien_post_related){?>
											<img alt="<?php echo $ten_post_related; ?>" loading="lazy" src="<?php echo UP_POST.$anhdaidien_post_related; ?>" class="img-post-avt"/>
										<?php }else{?>
											<img alt="<?php echo $ten_post_related; ?>" loading="lazy" src="<?php echo UP_POST_THUMB ?>no_image.jpg" class="img-post-avt"/>
										<?php }
									?>
								</div>
								<div class="gr_text">
									<h3 class="title"><?php echo $this->xulychuoi->ex_post($ten_post_related,50);?></h3>
									<div class="ex_post"><?php echo $mota_post_related; ?></div>
									<div class="btn_view_post">Xem chi tiết</div>
								</div>
							</a>
						</div>
				<?php } 
			} ?>
		</div>
	</div>
</div>
