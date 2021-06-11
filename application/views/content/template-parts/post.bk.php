<div class="container no-padding post-wrapper">

	<div class="details-post-gr">

		<?php $this->load->view('content/template-parts/breadcrumb',$ten_postpr_post);  ?>

		<div class="col-lg-3 col-md-3 col-xs-12 no-padding sidebar-page sidebar-dmsp">

			<?php $this->load->view('content/template-parts/sanpham/sidebar_dmsp');  ?>

		</div>	

		<div class="col-lg-9 col-md-9 col-xs-12 no-padding details-post main-page">

			<h1 class="title-post"><?php echo $ten_post; ?></h1>

			<?php //$this->load->view('content/template-parts/img-post',$anhdaidien_post);  ?>

			<div class="entry-post entry-post-wrapper" data-mucluc="0"><?php echo $noidung_post; ?></div>

			<?php $this->load->view('content/template-parts/share');  ?>

			<?php			

				if(!empty($id_postpr_post)){				

					$related_post=$this->page_model->select_table_4dk_limit_value('post','idpostpr','IN('.$id_postpr_post.')','id','!="'.$id_post.'"','typepost','="post"','trangthai','=1',6,'url,ten,anhdaidien,mota,noidung,ngaycapnhat');				

					if($related_post){ ?> 

							<div class="col-lg-12 col-md-12 col-xs-12 no-padding related-post">

								<div class="sidebar-wg related-post-wg no-padding">

									<h2 class="title-wg"><i class="fa fa-align-justify"></i> Bài viết liên quan</h2>

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

																	<img alt="" loading="lazy" src="<?php echo UPLOAD_URL.$anhdaidien_post_related; ?>" class="img-post-avt"/>

																<?php }else{?>

																	<img alt="" loading="lazy" src="<?php echo UP_POST_THUMB ?>no_image.jpg" class="img-post-avt"/>

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
