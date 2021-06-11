<?php	

if($thuvienanh_post){?>	

	<div class="gallery-img-post owl-carousel owl-theme owl-loaded owl-drag no-padding">	

		<?php $thuvienanh_post_arr=explode(',',$thuvienanh_post);		

			foreach($thuvienanh_post_arr as $img){	

				echo '<img loading="lazy" src="'.THUMBS_L_URL.$img.'" alt="Thư viện ảnh" />';

			}?>		

	</div>	

<?php }else{

	if($anhdaidien_post){?>

		<img alt="" loading="lazy" src="<?php echo THUMBS_L_URL.$anhdaidien_post; ?>" class="img-post-avt"/>

	<?php }else{?>

		<img alt="" loading="lazy" src="<?php echo URL; ?>upload/baiviet/no_image.jpg" class="img-post-avt"/>

	<?php }	

} ?>

<script>	

jQuery('.gallery-img-post').owlCarousel({

	items:1,

	loop:false,

	nav:false,

	dots:true,

	autoplay:true,		

	loop:true,		

	margin:0,		

	smartSpeed:450	

})

</script>		
