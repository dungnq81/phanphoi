<div class="container no-padding cat-wrapper">
	<h2 class="title-post title-cat">Kết quả tìm kiếm</h2>
	<div class="details-post-gr details-cat-gr">
		<div class="col-lg-3 col-md-3 col-xs-12 no-padding sidebar-page sidebar-dmsp">
			<?php $this->load->view('content/template-parts/sanpham/sidebar_dmsp');  ?>
		</div>	
		<div class="col-lg-9 col-md-9 col-xs-12 no-padding details-post main-page search_page_content details-post details-dmsp main-page">
			<div class="entry-post entry-cat">
				<div class="list-post-cat">
					<?php
					if($search_id_postpr!=0){
						$search_id_postpr='(idpostpr LIKE "%'.$search_id_postpr.'%" or idpostpr IN('.$search_id_postpr.')) and ';
					}else{
						$search_id_postpr='';
					}
					
					$total						= 	$this->page_model->count_table_dk_new('post','(ten LIKE "%'.$search_value.'%") and '.$search_id_postpr.'typepost="sanpham" and trangthai=1');
					$perpage					=	20; 
					$config['total_rows'] 		= 	$total;
					$config['per_page'] 		= 	$perpage;
					$config['next_link']		= 	'»';
					$config['prev_link']		= 	'«';
					$config['num_links']		= 	5;
					$config['cur_tag_open']		= 	'<a class="currentpage">';
					$config['cur_tag_close']	= 	'</a>';
					$config['base_url']			= 	URL.'/?id_postpr='.$_GET['id_postpr'].'&s='.$_GET['s'];
					$config['enable_query_strings']=TRUE;
					$config['page_query_string']=TRUE;
					$config['query_string_segment']	='per_page';
					$this->pagination->initialize($config);  
					$pagination					= 	$this->pagination->create_links(); 
					$offset 					= 	(!isset($_GET['per_page'])) ? 0 : $_GET['per_page'];
					$list_post1					= 	$this->page_model->select_table_dk_col_get('post','(ten LIKE "%'.$search_value.'%") and '.$search_id_postpr.'typepost="sanpham" and trangthai=1 order by ngaycapnhat DESC LIMIT '.$offset.','.$perpage.' ','url,ten,anhdaidien,mota,noidung,id');
					if($list_post1){
						foreach($list_post1 as $post){
							$id_post_related=$post->id;
							$url_post_related=URL_POST.$post->url;
							$ten_post_related=$post->ten;
							$anhdaidien_post_related=$post->anhdaidien;
							$mota_post_related=$this->xulychuoi->ex_post($post->mota);
							if(empty($mota_post_related)){
								$mota_post_related=$this->xulychuoi->ex_post($post->noidung,100);
							} 
							$data_sp['id_sanpham']=$id_post_related;
							?>
								<div class="item-sanpham col-lg-3 col-md-3 col-xs-6" id="sanpham-<?php echo $id_post_related; ?>">
									<a href="<?php echo $url_post_related; ?>" title="<?php echo $ten_post_related; ?>">
										<div class="box-img">
											<?php 
												if($anhdaidien_post_related){?>
													<img alt="<?php echo $ten_post_related; ?>" loading="lazy" src="<?php echo UPLOAD_URL.$anhdaidien_post_related; ?>" class="img-post-avt"/>
												<?php }else{?>
													<img alt="<?php echo $ten_post_related; ?>" loading="lazy" src="<?php echo UP_POST_THUMB ?>no_image.jpg" class="img-post-avt"/>
												<?php }
											?>
										</div>
										<h3 class="title"><?php echo $this->xulychuoi->ex_post($ten_post_related,50);?></h3>
										<?php $this->load->view('content/template-parts/sanpham/price_sp_danhmuc',$data_sp);  ?>
									</a>
								</div>
					<?php }
						if($pagination){
							echo '<div class="pagination">'.$pagination.'</div>';
						}
					}
					?>	
				</div>
			</div>
		</div>
	</div>
</div>
