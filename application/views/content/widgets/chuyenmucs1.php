<?php 
	$id_post=$id_wg;
	$text_widgetcat_home=$this->page_model->select_table_dk_col_get_1value('post','id="'.$id_post.'"','ten');
?>
<div class="wg-nxkh">
	<div class="background-overlay"></div>
	<div class="container no-padding">
		<div class="list-post-cat">
			<?php $list_post=$this->page_model->select_table_dk_col_get('post','idpostpr IN('.$id_post.') and typepost ="widget" and trangthai=1 order by id ASC LIMIT 5','url,ten,anhdaidien,mota,noidung,id');
			if($list_post){
				$text_widgetcat_home=$this->page_model->select_table_dk_col_get_1value('post','id=1217','ten'); ?>
					<div class="animation about-item">
						<h2 class="title_cat_wg"><?php echo $text_widgetcat_home; ?></h2>
						<div class="pgl-bg-dark gallery-slider-ct-cs owl-carousel owl-theme owl-loaded owl-drag ">
							<?php 
								foreach($list_post as $post){
										$url_post_slider=$post->url;
										$ten_slider_related=$post->ten;
										$anhdaidien_slider=$post->anhdaidien;
										$noidung_slider=$post->noidung;
										$ex_slider=$post->mota;
									?>
									<div class="col-content">
										<div class="testimonial-author">
											<div class="img-thumbnail-small img-circle">
												<img loading="lazy" src="<?php echo UPLOAD_URL.$anhdaidien_slider; ?>" class="img-circle" alt="<?php echo $ten_slider_related;?>">
											</div>
											<h4><?php echo $ten_slider_related;?></h4>
											<p><strong><?php echo $ex_slider;?></strong></p>
										</div>
										<div class="divider-quote-sign"><span>“</span></div>
										<blockquote class="testimonial">
											<p><?php echo $noidung_slider;?></p>
										</blockquote>
									</div>
							<?php } ?>
						</div>
					</div>
			<?php } ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.gallery-slider-ct-cs').owlCarousel({
	    loop:true,
	    margin:0,
	    nav:false,
	    dots:false,
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:false
	        },
	        600:{
	            items:2,
	            margin:15
	        },
	        1000:{
	            items:3,
	            margin:15,
	            nav:true,
	            loop:true
	        }
	    }
	})
</script>
