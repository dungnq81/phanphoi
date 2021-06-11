<?php
	$list_video_rs=explode(',', $list_video);
	if($list_video_rs){ ?>
		<div class="list-slider-video">
			<div class="title-wg-home text-center no-border">
				<p class="titleboxheading-home-cs" style="color:white;">VIDEO</p>
			</div>
			<div class="container no-padding">
				<div class="pgl-bg-dark gallery-slider-ct-video owl-carousel owl-theme owl-loaded owl-drag no-padding">
					<?php foreach ($list_video_rs as $value) { ?>
						<iframe loading="lazy" width="100%" height="250" src="https://www.youtube.com/embed/<?php echo $value; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php }

?>

<script type="text/javascript">
	$('.gallery-slider-ct-video').owlCarousel({
	    loop:true,
	    margin:0,
	    nav:false,
	    dots:false,
	    responsiveClass:true,
	    autoplay:true,
	    autoplayTimeout:3000,
	    autoplayHoverPause:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:false
	        },
	        600:{
	            items:2
	        },
	        1000:{
	            items:3,
	            margin:15,
	            nav:true,
	            loop:true
	        }
	    }
	});
</script>
