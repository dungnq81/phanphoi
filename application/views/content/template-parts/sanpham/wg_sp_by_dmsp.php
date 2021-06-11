<?php
	$list_post = $this->page_model->select_table_dk_col_get('post','(idpostpr LIKE "%'.$id_dmsp.'%" or idpostpr IN('.$id_dmsp.')) and typepost ="sanpham" and trangthai=1 order by ngaycapnhat DESC LIMIT 0,8 ','url,ten,anhdaidien,mota,noidung,id');
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
				<div class="item-sanpham col-lg-2 col-ms-3 col-xs-6" id="sanpham-<?php echo $id_post_related; ?>">
					<?php //echo $this->functions->edit_sanpham_with_user($id_post_related); ?>
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
