<div class="container no-padding post-wrapper">


	<div class="details-post-gr">

		<?php $this->load->view('content/template-parts/breadcrumb',$ten_postpr_post);  ?>

		<div class="col-lg-3 col-md-3 col-xs-12 no-padding sidebar-page sidebar-dmsp">

			<?php $this->load->view('content/template-parts/sanpham/sidebar_dmsp');  ?>

		</div>	

		<div class="col-lg-9 col-md-9 col-xs-12 no-padding details-post main-page">
			<h1 class="title-post"><?php echo $ten_post; ?></h1>
			<?php 

				if($id_post==454){ 

					$this->load->view('content/template-parts/form-register'); 

				}else{ 
					if($id_post==388){?>
						<div class="entry-post">
							<div class="col-xs-12 col-md-12 col-lg-6"><?php $this->load->view('content/template-parts/form-lienhe');  ?></div>
							<div class="col-xs-12 col-md-12 col-lg-6">
								<div class="wg-frm-lienhe-txt">
									<?php echo $noidung_post; ?>
								</div>
							</div>
							<?php
							$bando=$this->page_model->select_table_dk_col_get_1value('option','name="bando"','value');
							if ($bando) :
								echo '<span class="res res-map">';
								echo $bando; endif;
								echo '</span>'
							?>
						</div> 
					<?php }else{?>
						<div class="entry-post">
							<?php echo $noidung_post; ?>
						</div>
					<?php } ?>
					

					<?php $this->load->view('content/template-parts/share'); 

				} ?>

		</div>

	</div>

</div>
