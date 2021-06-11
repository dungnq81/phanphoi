<div class="container no-padding cat-wrapper">
	
	<div class="details-post-gr details-cat-gr">
		<?php $this->load->view('content/template-parts/breadcrumb',$ten_postpr_post);  ?>
		<div class="col-lg-3 col-md-3 col-xs-12 no-padding sidebar-page sidebar-dmsp">
			<?php $this->load->view('content/template-parts/sanpham/sidebar_dmsp');  ?>
		</div>	
		<div class="col-lg-9 col-md-9 col-xs-12 no-padding details-post details-dmsp main-page">
			<h1 class="title-post title-cat"><?php echo $ten_post; ?></h1>
			<div class="entry-post entry-cat">
				<div class="list-post-cat">
					<?php
					if(isset($_GET['meta'])){
						$meta_search=$_GET['meta'];
						$count_d=substr_count($meta_search, ','); 
						//echo str_replace(',','meta LIKE "%'.$_GET['meta'].'%" or' , $meta_search);
						if($count_d==0){
							$meta='and id IN (SELECT id_sanpham FROM '.$this->page_model->prefix.'sanpham WHERE meta LIKE "%'.$meta_search.'%")';
						}else{
							$rs_search='';
							for($i=0;$i<=$count_d;$i++){
								if($i==($count_d)){
									$or='';
								}else{
									$or='or';
								}
								$rs_search.='meta LIKE "%'.explode(',', $meta_search)[$i].'%" '.$or.' ';
							}
							$meta='and id IN (SELECT id_sanpham FROM '.$this->page_model->prefix.'sanpham WHERE '.$rs_search.' )';
						}
					}else{
						$meta='';
					}
					$total						= 	$this->page_model->count_table_dk_new('post','(idpostpr LIKE "%'.$id_post.'%" or idpostpr IN('.$id_post.'))  '.$meta.'  and typepost ="sanpham" and trangthai=1');
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
					$list_post					= 	$this->page_model->select_table_dk_col_get('post','(idpostpr LIKE "%'.$id_post.'%" or idpostpr IN('.$id_post.'))'.$meta.' and typepost ="sanpham" and trangthai=1 order by ngaycapnhat DESC LIMIT '.$offset.','.$perpage.' ','url,ten,anhdaidien,mota,noidung,id');
					if($list_post){
						foreach($list_post as $post){
							$id_post_related=$post->id;
							$url_post_related=URL_POST.$post->url;
							$ten_post_related=$post->ten;
							$anhdaidien_post_related=$post->anhdaidien;
							$mota_post_related=$this->xulychuoi->ex_post($post->mota);
							if(empty($mota_post_related)){
								$mota_post_related=$this->xulychuoi->ex_post($post->noidung,200);
							} 
							$data_sp['id_sanpham']=$id_post_related;
							?>
								<div class="item-sanpham col-lg-3 col-md-3 col-xs-6" id="sanpham-<?php echo $id_post_related; ?>">
									<div class="group-infor-pr">
										<div class="box-img no-padding">
											<a href="<?php echo $url_post_related; ?>" title="<?php echo $ten_post_related; ?>">
												<?php 
													if($anhdaidien_post_related){?>
														<img alt="<?php echo $ten_post_related; ?>" loading="lazy" src="<?php echo THUMBS_URL.$anhdaidien_post_related; ?>" class="img-post-avt"/>
													<?php }else{?>
														<img alt="<?php echo $ten_post_related; ?>" loading="lazy" src="<?php echo UPLOAD_URL ?>no_image.jpg" class="img-post-avt"/>
													<?php }
												?>
											</a>	
										</div>
										<div class="group-price no-padding">
											<a href="<?php echo $url_post_related; ?>" title="<?php echo $ten_post_related; ?>"><h3 class="title"><?php echo $this->xulychuoi->ex_post($ten_post_related,100);?></h3></a>
											<div class="ex_sp"><?php echo $mota_post_related; ?></div>
											<?php $this->load->view('content/template-parts/sanpham/price_sp_danhmuc',$data_sp);  ?>
											<a href="<?php echo $url_post_related; ?>" title="<?php echo $ten_post_related; ?>" class="view-more"><h3 class="title">Xem chi tiết</h3></a>
										</div>
									</div>
								</div>
						<?php }
					} ?>
				</div>
				<?php  
					if($pagination){
						echo '<div class="pagination">'.$pagination.'</div>';
					}
				?>
			</div>
			<?php if($mota_post){
				echo '<div class="ex_cat">'.$mota_post.'</div>';
			} ?>
		</div>
	</div>
</div>
