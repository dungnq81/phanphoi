<div class="container no-padding post-wrapper">

	<div class="details-post-gr">

		<?php $this->load->view('content/template-parts/breadcrumb',$ten_postpr_post);  ?>

		<div class="col-lg-3 col-md-3 col-xs-12 no-padding sidebar-page sidebar-dmsp">

			<?php $this->load->view('content/template-parts/sanpham/sidebar_dmsp');  ?>

		</div>	

		<div class="col-lg-9 col-md-9 col-xs-12 no-padding details-post main-page">

			<h1 class="title-post"><?php echo $ten_post; ?></h1>

			<?php vote_action( $id_post, 'rating-small' )?>

			<?php //$this->load->view('content/template-parts/img-post',$anhdaidien_post);  ?>

			<div class="entry-post entry-post-wrapper" data-mucluc="0"><?php echo $noidung_post; ?></div>

			<div class="rating-system">
				<h4>Đánh giá</h4>
				<?php vote_action( $id_post )?>
			</div>

			<!--FB comments-->
			<div class="facebook-comments-area">
				<h5 class="comments-title">Bình luận Facebook</h5>
				<div class="fb-comments" data-href="<?php echo base_url(uri_string()); ?>" data-numposts="10" data-colorscheme="light" data-order-by="social" data-mobile="true"></div>
			</div>

			<?php $this->load->view('content/template-parts/share');  ?>

			<?php			

				if(!empty($id_postpr_post)){

					//$related_post=$this->page_model->select_table_4dk_limit_value('post','idpostpr','IN('.$id_postpr_post.')','id','!="'.$id_post.'"','typepost','="post"','trangthai','=1',6,'url,ten,anhdaidien,mota,noidung,ngaycapnhat');
					$related_post = $this->db
							->where( 'trangthai', 1 )
							->where( 'id !=', $id_post  )
							->where( 'typepost', 'post' )
							->limit(10)
							->order_by( "ngaycapnhat", "desc" )
							->get('hd_post')
							->result();

					if($related_post){ ?> 

							<div class="col-lg-12 col-md-12 col-xs-12 no-padding related-post">

								<div class="sidebar-wg related-post-wg no-padding">

									<h2 class="title-wg"><i class="fa fa-align-justify"></i> Bài viết mới nhất</h2>

									<?php

										foreach($related_post as $post){

											$url_post_related=URL_POST.$post->url;

											$ten_post_related=$post->ten;

											$anhdaidien_post_related=$post->anhdaidien;

											$mota_post_related=$post->mota;

											$ngay_post_related=explode(' ',explode('-',$post->ngaycapnhat)[2])[0];

											$thang_post_related=explode('-',$post->ngaycapnhat)[1];

											if(empty($mota_post_related)){

												$mota_post_related=$this->xulychuoi->ex_post($post->noidung,500);

											}?>

												<div class="item-post col-lg-12 col-md-12 col-xs-12 no-padding">

													<a href="<?php echo $url_post_related; ?>" title="<?php echo $ten_post_related; ?>">

														<div class="box-img col-lg-3 col-md-3 col-xs-3 no-padding">

															<?php

																if($anhdaidien_post_related){?>

																	<img alt="<?php echo $ten_post_related; ?>" loading="lazy" src="<?php echo UPLOAD_URL.$anhdaidien_post_related; ?>" class="img-post-avt"/>

																<?php }else{?>

																	<img alt="<?php echo $ten_post_related; ?>" loading="lazy" src="<?php echo UP_POST_THUMB ?>no_image.jpg" class="img-post-avt"/>

																<?php }

															?>

														</div>

														<div class="box-ex col-lg-9 col-md-9 col-xs-9">

															<div class="entry-date">

																<span class="entry-day"><?php echo $ngay_post_related; ?></span>

																<span class="entry-month">Th<?php echo $thang_post_related; ?></span>

															</div>

															<h3 class="title"><?php echo $this->xulychuoi->ex_post($ten_post_related,150);?></h3>

															<div class="ex_post"><?php echo $mota_post_related; ?></div>

														</div>

													</a>

												</div>

										<?php } ?>			

									</div>		

								</div>

					<?php }		

						}		

					?>

		</div>		

	</div>

</div>
<script async src="<?php echo (JS . 'css.min.js'); ?>"></script>
<script defer src="<?php echo (JS . 'app.js'); ?>"></script>
<script>
	$(function () {
		var rating_inner = $(".rating--inner").not( $( ".selected" ) );
		rating_inner.find('li').on('click', function (e) {
			e.preventDefault();
			rating_inner.find('li').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: 'POST',
				url: "page/rating",
				data: {
					star: $(this).data('star'),
					post_id: <?=$post_id?>,
				},
				success: function (data) {
					$('.rating--inner').find('.votes').html(data);
				}
			});
		});
	});
</script>
