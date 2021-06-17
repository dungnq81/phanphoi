<?php //echo $this->md5_system->hsc_md5_password('admin@gmail.com','m@admin123.com');?>
<header>
	<div class="header-content logo-gr">
		<div id="logo_main" class="header-content">
			<div class="container no-padding">
				<div class="header-col col-lg-1 col-md-1 col-xs-2 header-logo no-padding">
					<div class="logo"><a href="<?php echo base_url(); ?>"><img loading="lazy" src="<?php echo @$logo; ?>" alt="Logo"/></a></div>
				</div>
				<div class="header-col col-lg-3 col-md-3 col-xs-8 header-register no-padding">
					<div class="box-name">
						<div class="company-title"><?php echo @$blogname; ?></div>
						<p><?php echo @$blogdescription; ?></p>
					</div>
				</div>
				<div class="header-col col-lg-8 col-md-8 col-xs-12 header-right no-padding">
					<div class="header-top">
						<div class="container no-padding">
							<div class="header-top-left"></div>
							<div class="header-top-right">
								<?php if ( ! $this->current_user ) : ?>
								<ul class="users-box">
									<li><a href="/users/login" data-target="#user-login" data-toggle="modal" data-backdrop="static" data-keyboard="false" title="<?php echo esc_attr_( 'index_heading' ) ?>"><?php echo __( 'index_heading' ) ?></a></li>
									<li><a href="/users/register" title="<?php echo esc_attr_( 'create_user_heading' ) ?>"><?php echo __( 'index_create_user_link' ) ?></a></li>
								</ul>
								<div class="modal-wrapper">
									<div id="user-login" class="modal fade modal-login" tabindex="-1" role="dialog">
										<div class="modal-dialog" role="document"><!--modal-dialog-centered-->
											<div class="modal-content"></div>
										</div>
									</div>
								</div>
								<?php else : ?>
								<ul class="users-box logged">
									<li class="profile dropdown">
										<a class="avatar" href="#" data-toggle="dropdown">
											<span class="avatar-inner">D</span>
											<span class="user-name">Dũng Ngô</span>
										</a>
										<ul class="dropdown-menu user_status" role="menu" aria-labelledby="profile">
											<li class="account">
												<span class="avatar-inner">D</span>
												<span class="user-name">Dũng Ngô</span>
											</li>
											<li><a href="#">Đơn hàng của tôi</a></li>
											<li><a href="#">Tài khoản của tôi</a></li>
											<li class="points">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12,2C6.486,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.514,2,12,2z M13,16.915V18h-2v-1.08 C8.661,16.553,8,14.918,8,14h2c0.011,0.143,0.159,1,2,1c1.38,0,2-0.585,2-1c0-0.324,0-1-2-1c-3.48,0-4-1.88-4-3 c0-1.288,1.029-2.584,3-2.915V6.012h2v1.109c1.734,0.41,2.4,1.853,2.4,2.879h-1l-1,0.018C13.386,9.638,13.185,9,12,9 c-1.299,0-2,0.516-2,1c0,0.374,0,1,2,1c3.48,0,4,1.88,4,3C16,15.288,14.971,16.584,13,16.915z"></path></svg>
												<span class="content">
													<span>Thông tin điểm thưởng</span>
													<span>Bạn đang có <b>234</b> điểm</span>
												</span>
											</li>
											<li>
												<a href="/users/logout" class="logout_link">
													Thoát tài khoản
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M2 12L7 16 7 13 16 13 16 11 7 11 7 8z"></path><path d="M13.001,2.999c-2.405,0-4.665,0.937-6.364,2.637L8.051,7.05c1.322-1.322,3.08-2.051,4.95-2.051s3.628,0.729,4.95,2.051 s2.051,3.08,2.051,4.95s-0.729,3.628-2.051,4.95s-3.08,2.051-4.95,2.051s-3.628-0.729-4.95-2.051l-1.414,1.414 c1.699,1.7,3.959,2.637,6.364,2.637s4.665-0.937,6.364-2.637c1.7-1.699,2.637-3.959,2.637-6.364s-0.937-4.665-2.637-6.364 C17.666,3.936,15.406,2.999,13.001,2.999z"></path></svg>
												</a>
											</li>
										</ul>
									</li>
									<li class="notification dropdown active">
										<a href="#" data-toggle="dropdown">
											<svg id="Bell" viewBox="0 0 32 32">
												<path d="M30 21.713v0.573c0 0.95-0.752 1.713-1.681 1.713h-24.638c-0.929 0-1.681-0.767-1.681-1.713v-0.573c0-1.891 1.504-3.425 3.36-3.428v-7.429c0-5.998 4.763-10.857 10.64-10.857s10.64 4.86 10.64 10.857v7.429c1.859 0.003 3.36 1.535 3.36 3.428z"></path>
												<path d="M12 26c0 2.209 1.791 4 4 4s4-1.791 4-4h-8z"></path>
											</svg>
										</a>
										<ul class="notify-box dropdown-menu" aria-labelledby="notification">
											<li>
												<a href="#" data-id="1033189714">
													<strong>Nữ giúp việc đánh bé gái hơn một tháng tuổi bị bắt</strong>
													<span class="time">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(51, 51, 51, 1);"><path d="M12,2C6.486,2,2,6.486,2,12s4.486,10,10,10c5.514,0,10-4.486,10-10S17.514,2,12,2z M12,20c-4.411,0-8-3.589-8-8 s3.589-8,8-8s8,3.589,8,8S16.411,20,12,20z"></path><path d="M13 7L11 7 11 13 17 13 17 11 13 11z"></path></svg>
														 11:17 24/11/2017
													</span>
												</a>
											</li>
											<li class="unread">
												<a href="#" data-id="1033189714">
													<strong>Nữ giúp việc đánh bé gái hơn một tháng tuổi bị bắt</strong>
													<span class="time">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(51, 51, 51, 1);"><path d="M12,2C6.486,2,2,6.486,2,12s4.486,10,10,10c5.514,0,10-4.486,10-10S17.514,2,12,2z M12,20c-4.411,0-8-3.589-8-8 s3.589-8,8-8s8,3.589,8,8S16.411,20,12,20z"></path><path d="M13 7L11 7 11 13 17 13 17 11 13 11z"></path></svg>
														 11:17 24/11/2017
													</span>
												</a>
											</li>
										</ul>
									</li>
								</ul>
								<?php endif;?>
							</div>
						</div>
					</div>
					<div class="header-diachi">
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
