<footer>
	<div class="content-footer" id="top-ft">
		<div class="col-lg-12 col-md-12 col-xs-12 no-padding">
			<div class="container no-padding">
				<?php $this->load->view('content/widgets/form');?>
			</div>
		</div>
	</div>
	<div class="content-footer" id="middle-ft">
		<div class="container no-padding">
			<?php 
				$id_wg_ft=$this->page_model->select_table_dk_col_get_1value('post','id=1157 and typepost="widget_cat" and trangthai=1','id');
				if($id_wg_ft){
					$id_list_wg=$this->page_model->select_table_dk_col_get('post','idpostpr='.$id_wg_ft.' and typepost="widget" and trangthai=1 limit 0,3','id');
					if($id_list_wg){
						foreach ($id_list_wg as $id_rs) { ?>
							 <div class="col-lg-3 col-md-3 col-xs-12 coso-gr">
								<?php
									$wg_ct=$this->page_model->select_table_2dk('post','id','="'.$id_rs->id.'" ','trangthai','=1');
									echo $this->functions->widget_content($wg_ct,'');
								?>
							</div>
						<?php }
					}
				}
			?>

			<div class="col-lg-3 col-md-3 col-xs-12 gioithieu-gr">
				<h3 class="wg-title">Fanpage</h3>
				<?php echo $fanpage_link; ?>
			</div>
		</div>
	</div>
	<div class="content-footer" id="end-ft">
		<div class="container no-padding">
			<?php 
				if($logo){ ?>
					<div class="logo logo-ft">
						<a href="<?php echo URL; ?>">
							<img loading="lazy" src="<?php echo $logo; ?>" alt="Logo">
						</a>
						<div class="mxh-group col-lg-12 col-md-12 col-xs-12 no-padding">	
							<ul class="ul-mxh">
								<li><a href="<?php echo $facebook_link; ?>" title="Facebook"><span><i class="fab fa-facebook-f"></i></span></a></li>
								<li><a href="<?php echo $twister_link; ?>" title="Twitter"><span><i class="fab fa-twitter"></i></span></a></li>
								<li><a href="<?php echo $instagram_link; ?>" title="Instagram"><span><i class="fab fa-instagram"></i></span></a>
								</li>
							</ul>
						</div>
					</div>
			<?php } ?>

			<?php 
				$id_wg_ft=$this->page_model->select_table_dk_col_get_1value('post','id=1368 and typepost="widget_cat" and trangthai=1','id');
				if($id_wg_ft){
					$id_list_wg=$this->page_model->select_table_dk_col_get('post','idpostpr='.$id_wg_ft.' and typepost="widget" and trangthai=1 limit 0,1','id');
					if($id_list_wg){
						foreach ($id_list_wg as $id_rs) { ?>
							 <div class="col-lg-3 col-md-3 col-xs-12 coso-gr">
								<?php
									$wg_ct=$this->page_model->select_table_2dk('post','id','="'.$id_rs->id.'" ','trangthai','=1');
									echo $this->functions->widget_content($wg_ct,'');
								?>
							</div>
						<?php }
					}
				}
			?>


		</div>
	</div>
	<div class="content-footer site-info">
		<?php $siteurl=$this->page_model->select_table_dk_col_get_1value('option','name="siteurl"','value'); ?>
		<span>Copyright @2019 by <?php echo $siteurl; ?>. Designed by WebHD</span>
	</div>
</footer>
<?php 	

	$hotline=$this->page_model->select_table_dk_col_get_1value('option','name="hotline"','value');
	$facebook=$this->page_model->select_table_dk_col_get_1value('option','name="facebook"','value');
	$sms=$this->page_model->select_table_dk_col_get_1value('option','name="sms"','value');

?>
<a href="javascript:;" class="scroll-top-link back-top" id="back-top" style="display: block;"><i class="fa fa-angle-up"></i></a>
<script type="text/javascript">
	jQuery( document ).ready( function() {
		new WOW().init();
	});
		$(function () {
		$('.datetimepicker').datepicker();
	});
	$(function () {
		$('.timepicker').timepicker();
	});
	$('.list-dmsp-home').owlCarousel({
	    loop:true,
	    margin:0, 
	    nav:true,
	    dots:false,
	    responsiveClass:true,
	    autoplay:false,
	    autoplayTimeout:3000,
	    responsive:{
	        0:{
	            items:2,
	            margin:10,
	        },
	        600:{
	            items:2,
	            margin:10,
	        },
	        1000:{
	            items:4,
	            margin:10,
	
	        },
			1200:{
				items:5,
				margin:15,

			}
	    }
	})
</script>
<div class="group-call">
	<div class="support-online support-online-zalo">
		<a href="https://zalo.me/<?php echo $hotline; ?>" rel="nofollow">
			<img loading="lazy" src="<?php echo URL;?>assets/themes/img/icon-zalo.png" alt="Chat zalo">
			<div class="animated infinite zoomIn alo-circle"></div>
			<div class="animated infinite pulse alo-circle-fill"></div>
		</a>
	</div>
	<div class="support-online support-online-fb">
		<a href="<?php echo $facebook; ?>" rel="nofollow" target="_blank">
			<img loading="lazy" src="<?php echo URL;?>assets/themes/img/icon_mess.png" alt="Chat zalo">
			<div class="animated infinite zoomIn alo-circle"></div>
			<div class="animated infinite pulse alo-circle-fill"></div>
		</a>
	</div>
	<div class="support-online support-online-hotline">
		<a href="tel:<?php echo $hotline; ?>" class="call-now" rel="nofollow">
			<i class="fa fa-phone" aria-hidden="true"></i><span><?php echo $hotline; ?></span>
			<div class="animated infinite zoomIn alo-circle"></div>
			<div class="animated infinite pulse alo-circle-fill"></div>
		</a>
	</div>
</div>
<div id="menufooter">
	<ul>
		<li>
			<a href="tel:<?php echo $hotline; ?>" class="text-success blink_me">
				<img src="<?php echo URL;?>assets/themes/img/svg/phone.svg" alt="Chat zalo">
				<span>Gọi điện</span>
			</a>
		</li>
		<li>
			<a href="https://zalo.me/<?php echo $hotline; ?>">
				<img src="<?php echo URL;?>assets/themes/img/svg/zalo.svg" alt="Chat zalo">
				<span>Zalo</span>
			</a>
		</li>
		<li>
			<a href="<?php echo $facebook; ?>" class="js-facebook-messenger-box rubberBand animated">
				<img src="<?php echo URL;?>assets/themes/img/svg/facebook-messenger.svg" alt="Chat facebook">
				<span>Messenger</span>
			</a>
		</li>
		<li>
			<a href="sms:<?php echo $sms; ?>" class="js-sms-box rubberBand animated">
				<img src="<?php echo URL;?>assets/themes/img/svg/sms.svg" alt="Gửi SMS">
				<span>SMS</span>
			</a>
		</li>
	</ul>
</div>
<script defer src="<?php echo(JS.'xuly_themes.js'); ?>"></script>
<script defer src="<?php echo (JS . 'app.js'); ?>"></script>
<?php
$machat=$this->page_model->select_table_dk_col_get_1value('option','name="machat"','value');
if($machat){echo $machat; }
?>
<script>window.fbAsyncInit = function() {
		FB.init({
			appId : '814744095763933',
			status: true,
			xfbml: true,
			autoLogAppEvents: true,
			version: 'v9.0',
		});
	};
</script>
<script src='https://connect.facebook.net/vi_VN/sdk.js' async defer crossorigin="anonymous" nonce="OXWQ6DGh"></script>
