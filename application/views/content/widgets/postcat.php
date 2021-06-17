<?php 
	$id_post=$id_wg;
	$text_widgetcat_home=$this->page_model->select_table_dk_col_get_1value('post','id="'.$id_post.'"','ten');
?>
<div class="wg-dsl">
	<div class="container no-padding">
		<div class="list-post-cat">
			<?php
			$list_post=$this->page_model->select_table_dk_col_get('post','idpostpr IN('.$id_post.') and typepost ="post" and trangthai=1 order by id DESC LIMIT 5','url,ten,anhdaidien,mota,noidung,id,ngaydang');
			if($list_post){
				echo '<div class="col-xs-12 col-sm-12 col-lg-12 animation about-item no-padding">'; ?>
					<div class="title-wg-home">
						<p class="titleboxheading-home"><?php echo $text_widgetcat_home; ?></p>
					</div>
					<div class="list-post-cat_home owl-carousel owl-theme owl-loaded owl-drag no-padding"> 
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
								<div class="ex_post"><?php echo strip_tags($mota_post_related); ?></div>
								<a href="<?php echo $url_post_related; ?>" title="<?php echo $ten_post_related; ?>" class="view-more-cs"><span>Xem thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
								</a>
							</div>
					<?php $dem++;} 
					echo '</div>';
				echo '</div>';
			}  ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.list-post-cat_home').owlCarousel({
	    loop:true,
	    margin:0,
	    nav:false,
	    dots:false,
	    responsiveClass:true,
	    autoplay:true,
	    autoplayTimeout:3000,
	    responsive:{
	        0:{
	            items:2,
	            margin:10,
	        },
	        600:{
	            items:3,
	            margin:15,
	        },
	        1000:{
	            items:4,
	            margin:20,
	        }
	    }
	})
</script>
