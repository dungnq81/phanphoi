<?php 
	$id_post=$id_wg;
	$text_widgetcat_home=$this->page_model->select_table_dk_col_get_1value('post','id="'.$id_post.'"','ten');
?>
<div class="wg-quangcao hidden-xs hidden-sm">
	<div class="container no-padding">
		<div class="list-post-cat col-lg-12 col-sm-12 col-xs-12 no-padding">
			<?php $list_post1=$this->page_model->select_table_dk_col_get('post','idpostpr IN('.$id_post.') and typepost ="widget" and trangthai=1 order by id ASC LIMIT 4','url,ten,anhdaidien,mota,noidung,id');
			if($list_post1){ 
				foreach($list_post1 as $post){
						$url_post_slider=$post->url;
						$ten_slider_related=$post->ten;
						$anhdaidien_slider=$post->anhdaidien;
						$noidung_slider=$post->noidung;
						$ex_slider=$post->mota;
					?>
					<div class="col-content col-lg-3 col-sm-3 col-xs-6 no-padding">
						<div class="testimonial-author d-flex">
							<div class="img-thumbnail-small">
								<img loading="lazy" src="<?php echo UPLOAD_URL.$anhdaidien_slider; ?>" class="img-circle" alt="<?php echo $ten_slider_related;?>">
							</div>
							<div class="title-gr">
								<h4><?php echo $ten_slider_related;?></h4>
								<div class="ex_post_cs"><?php echo $noidung_slider;?></div>
							</div>
						</div>
					</div>
			<?php }

			} ?>
		</div>
	</div>
</div>
