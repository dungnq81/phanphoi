<?php
$id_post_related=$this->page_model->select_table_dk_col_get_1value('post','typepost="danhmucsanpham" and id="'.$id_dmsp.'" and trangthai=1','id');
$url_post_related=$this->page_model->select_table_dk_col_get_1value('post','typepost="danhmucsanpham" and id="'.$id_dmsp.'" and trangthai=1','url');
$ten_post_related=$this->page_model->select_table_dk_col_get_1value('post','typepost="danhmucsanpham" and id="'.$id_dmsp.'" and trangthai=1','ten');
$anhdaidien_post_related=$this->page_model->select_table_dk_col_get_1value('post','typepost="danhmucsanpham" and id="'.$id_dmsp.'" and trangthai=1','anhdaidien');
 ?>
<div class="item-sanpham" id="sanpham-<?php echo $id_post_related; ?>">
	<a href="<?php echo $url_post_related; ?>" title="<?php echo $ten_post_related; ?>">
		<div class="box-img no-padding">
			<?php 
				if($anhdaidien_post_related){?>
					<img alt="<?php echo $ten_post_related; ?>" loading="lazy" loading="lazy" src="<?php echo THUMBS_L_URL.$anhdaidien_post_related; ?>" class="img-post-avt"/>
				<?php }else{?>
					<img alt="<?php echo $ten_post_related; ?>" loading="lazy" loading="lazy" src="<?php echo UPLOAD_URL ?>no_image.jpg" class="img-post-avt"/>
				<?php }
			?>
		</div>
		<div class="group-price">
			<h3 class="title"><?php echo $this->xulychuoi->ex_post($ten_post_related,100);?></h3>
		</div>
	</a>
</div>
