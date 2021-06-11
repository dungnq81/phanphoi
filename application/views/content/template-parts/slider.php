<?php 
	if(empty($slider_cat)){
		header( 'Location: '.base_url());
	}else{ //echo $slider_cat;
		$slider=$this->page_model->select_table_dk_col_get('post','idpostpr='.$slider_cat.' and typepost="slider" and trangthai=1 order by ngaycapnhat DESC limit 5','url,ten,anhdaidien,noidung');
		if($slider){
			echo '<div class="gallery-slider-ct owl-carousel owl-theme owl-loaded owl-drag no-padding">';
				$i=0;
				foreach($slider as $post){
					$url_post_slider=$post->url;
					$ten_slider_related=$post->ten;
					$anhdaidien_slider=$post->anhdaidien;
					$noidung_slider=$post->noidung;
					?>
						<?php if($anhdaidien_slider){	?>													
							<div class="slider-img col-lg-12 col-md-12 col-xs-12 no-padding" id="slider_home<?php echo $i; ?>">									
								<a href="<?php echo $url_post_slider; ?>" title="<?php echo $ten_slider_related; ?>" target="_blank">
									<img alt="" loading="lazy" src="<?php echo UPLOAD_URL.$anhdaidien_slider; ?>" class="img-post-avt"/>
								</a>							
							</div>								
						<?php }?>	
				<?php $i++; }
			echo '</div>';
			echo '<div class="slider-banner gallery-slider-ct-dots owl-carousel owl-theme owl-loaded owl-drag no-padding hidden">';
				$j=0;
				foreach($slider as $post){
					$url_post_slider=$post->url;
					$ten_slider_related=$post->ten;
					$anhdaidien_slider=$post->anhdaidien;
					$noidung_slider=$post->noidung;?>					
						<?php if($anhdaidien_slider){	?>													
							<div class="slider-img banner-slider-item-dots slider_home<?php echo $j; ?>" data="<?php echo $j; ?>">						
								<span><?php echo $ten_slider_related; ?></span>								
							</div>								
						<?php }?>
				<?php $j++;}
			echo '</div>'; ?>
			<script type="text/javascript">
				var action = false, clicked = false;
				var Owl = {
				    init: function() {
				      Owl.carousel();
				    },
					carousel: function() {
						var owl;
						$(document).ready(function() {
							owl = $('.gallery-slider-ct').owlCarousel({
								items 	 : 1,
								center	   : true, 
								nav        : true,
								dots       : true,
								loop       : true,
								margin     : 0,
								autoplay   :true,
								dotsContainer: '.gallery-slider-ct-dots',
							});
							  $('.owl-next').on('click',function(){
							  	action = 'next';
							  });
							  $('.owl-prev').on('click',function(){
							  	action = 'prev';
							  });
							 $('.slider-banner').on('click', '.banner-slider-item-dots', function(e) {
							    owl.trigger('to.owl.carousel', [$(this).index(), 300]);
							  });
						});
					}
				};
				$(document).ready(function() {
				  Owl.init();
				});
				</script>
		<?php }
} ?>
