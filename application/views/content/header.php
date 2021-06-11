<?php //echo $this->md5_system->hsc_md5_password('admin@gmail.com','m@admin123.com');?>
<header>
	<div class="header-content logo-gr">
		<div id="logo_main" class="header-content">
			<div class="container no-padding">
				<div class="header-col col-lg-1 col-md-1 col-xs-2 header-logo no-padding">
					<div class="logo"><a href="<?php echo base_url(); ?>"><img loading="lazy" src="<?php echo $logo; ?>" alt="Logo"/></a></div>
				</div>
				<div class="header-col col-lg-3 col-md-3 col-xs-8 header-register no-padding">
					<div class="box-name">
						<div class="company-title"><?php echo $blogname; ?></div>
						<p><?php echo $blogdescription; ?></p>
					</div>
				</div>

				<div class="header-col col-lg-8 col-md-8 col-xs-12 header-diachi no-padding">
					<?php 
						$hotline_home=$this->page_model->select_table_dk_col_get_1value('option','name="hotline"','value');
						$timework_home=$this->page_model->select_table_dk_col_get_1value('option','name="time_work"','value');
						
						$arr_total_cart_hd=array();
						$list_cart_hd=$this->cart->contents();
						$total_cart_hd=0;
						foreach ($list_cart_hd as $cart_vl) {
							$total_cart_hd=$cart_vl['qty'];
							array_push($arr_total_cart_hd, $total_cart_hd);
						}
						//var_dump($arr_total_cart_hd);
		        		$arr_total_cart_hd_rs=array_sum($arr_total_cart_hd);			
					?>  

					<div class="box-hthong-cuahang cart-icon-gr">
						 <div class="righttop flexCen">
							<div id="cart-header">
			                    <a href="<?php echo URL?>gio-hang" rel="nofollow"><i class="iconltd-cart fa fa-shopping-cart"></i></a>
			                    <span><?php echo $arr_total_cart_hd_rs; ?></span>
			                </div>
			            </div>
					</div>

					<div class="ega-top-message hidden-sm hidden-xs">
						<a class="ega-phone" title="Hotline: <?php echo $hotline_home; ?>" href="tel:<?php echo $hotline_home; ?>">
							<i class="fa fa-phone"></i><?php echo $hotline_home; ?>
						</a>
					</div>
					
					<div class="box-hthong-cuahang">
				   	 	<div class="box-list-htch">
				   	 		<div class="form-search"><?php $this->load->view('content/search-form');?></div>
						</div>
					</div>
						
					

					

				</div>
				
			</div>
		</div>
		<div id="menu_main" class="header-content">
			<div class="container no-padding">
				<div class="header-col col-lg-12 col-md-12 col-xs-12 header-menu no-padding">
					<div class="header-content menu-gr hidden-xs" id="header-menu-top">
						<div class="container no-padding">
							<div class="header-col col-lg-12 col-md-12 col-xs-12 header-menu no-padding">
								<?php 
									if($menu){
										$this->load->view('content/menu');
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<button class="navbar-toggle hidden-lg visible-xs">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
		</div>
		<?php
			$list_post=$this->page_model->select_table_dk_col_get('post','idpostpr IN(676) and typepost ="post" and trangthai=1 order by id DESC LIMIT 5','url,ten,anhdaidien,mota,noidung,id,ngaydang');
			if($list_post){ ?>
				<div class="news-new hidden-xs">
					<div class="container no-padding">
	      				<div class="col-md-12 col-sm-12 col-xs-12 prz-ap no-padding">
							<span class="label-hot">HOT</span>
							<ul class="news-new-list">
								<?php 
									foreach($list_post as $post){
										$url_post_related=URL_POST.$post->url;
										$ten_post_related=$post->ten; ?>
										 <li>
								            <a href="<?php echo $url_post_related; ?>" title="<?php echo $ten_post_related; ?>">
								                <span class="slider-caption-class"><?php echo $ten_post_related; ?></span>
								            </a>
								        </li>
								<?php } ?> 
							</ul>
						</div>
					</div>
				</div>
			<?php }  ?>
	</div>
</header>
