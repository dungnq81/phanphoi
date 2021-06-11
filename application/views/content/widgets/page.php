<div class="wg-noiquy">
	<div class="container no-padding">
			<?php
			$id_post=$id_wg;
			$list_post=$this->page_model->select_table_3dk_limit_value('post','id','='.$id_post.'','typepost','="page"','trangthai','=1',1,'url,ten,noidung');
			if($list_post){
				foreach($list_post as $post){ 
					$url_post_related=URL_POST.$post->url;
					$ten_post_related=$post->ten;
					$nd_post_related=$post->noidung;
					?>
					<div class="title_cat_wg"><?php echo $ten_post_related; ?></div>
					<p class="crown hidden"></p>
					<div class="list-post-cat">
						<div class="item-post col-lg-12 col-md-12 col-xs-12 no-padding">
							
							<div class="gr_text">
								<div class="nd_post"><?php echo $nd_post_related; ?></div>
							</div>
							
						</div>
					</div>
				<?php } 
			} ?>						
	</div>
</div>