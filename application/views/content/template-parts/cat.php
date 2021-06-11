<div class="container no-padding cat-wrapper">
	
	<div class="details-post-gr details-cat-gr">
		<?php $this->load->view('content/template-parts/breadcrumb',$ten_postpr_post);  ?>
		<div class="col-lg-3 col-md-3 col-xs-12 no-padding sidebar-page sidebar-dmsp">
			<?php $this->load->view('content/template-parts/sanpham/sidebar_dmsp');  ?>
		</div>	
		<div class="col-lg-9 col-md-9 col-xs-12 no-padding details-post main-page">
			<h1 class="title-post title-cat"><?php echo $ten_post; ?></h1>
			<div class="entry-post entry-cat">
				<div class="list-post-cat">
					<?php
					$total						= 	$this->page_model->count_table_dk_new('post','idpostpr LIKE "%'.$id_post.'%" or idpostpr IN('.$id_post.') and typepost ="post" and trangthai=1');
					$perpage					=	$phantrang; 
					$config['total_rows'] 		= 	$total;
					$config['per_page'] 		= 	$perpage;
					$config['next_link']		= 	'»';
					$config['prev_link']		= 	'«';
					$config['num_links']		= 	5;
					$config['cur_tag_open']		= 	'<a class="currentpage">';
					$config['cur_tag_close']	= 	'</a>';
					$config['base_url']			= 	URL.$url_post.'/';
					$config['uri_segment']		= 	2;
					$this->pagination->initialize($config);  
					$pagination					= 	$this->pagination->create_links(); 
					$offset 					= 	($this->uri->segment(2)=='') ? 0 : $this->uri->segment(2);
					$list_post					= 	$this->page_model->select_table_dk_col_get('post','idpostpr LIKE "%'.$id_post.'%" or idpostpr IN('.$id_post.') and typepost ="post" and trangthai=1 order by ngaycapnhat DESC LIMIT '.$offset.','.$perpage.' ','url,ten,anhdaidien,mota,noidung,id,ngaycapnhat');
					if($list_post){
						foreach($list_post as $post){
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
					<?php }
						echo '<div class="pagination">'.$pagination.'</div>';
					}	
				?>
				</div>
				<?php if($mota_post){
					echo '<div class="ex_cat">'.$$mota_post.'</div>';
				} ?>
			</div>
		</div>
	</div>
</div>
