<?php 



	$slider=$this->page_model->select_table_dk_col_get('post','idpostpr='.$slider_cat.' and typepost="slider" and trangthai=1 order by ngaycapnhat DESC limit 5','url,ten,anhdaidien,noidung');



	if($slider){



		echo '<div id="gallery-slider2" class=" owl-carousel owl-theme owl-loaded owl-drag">';



			$i=0;



			foreach($slider as $post){



				$url_post_slider=$post->url;



				$ten_slider_related=$post->ten;



				$anhdaidien_slider=$post->anhdaidien;



				$noidung_slider=$post->noidung;?>



					<?php if($anhdaidien_slider){	?>													



						<div class="col-lg-12 col-md-12 col-xs-12 no-padding">	



							<a href="<?php echo $url_post_slider; ?>" title="<?php echo $ten_slider_related; ?>" target="_blank">								



								<img alt="" loading="lazy" src="<?php echo UPLOAD_URL.$anhdaidien_slider; ?>" class="img-post-avt"/>



							</a>							



						</div>								



					<?php }?>	



			<?php $i++; }



		echo '</div>'; ?>



		<script>



			jQuery('#gallery-slider2').owlCarousel({



				items:5,



				loop:false,



				nav:true,



				dots:false,



				autoplay:false,



				margin:10,



				responsive:{



			        0:{



			            items:2,



			            nav:false



			        },



			        600:{



			            items:2,



			            nav:false



			        },



			        1000:{



			            items:5,



			            nav:true,



			            loop:false



			        }



			    }



			})



		</script>	



	



	<?php }	



?>



