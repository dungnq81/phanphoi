<section class="content" id="content_<?php echo $page_slug?>_page">

  <div class="row">

	<div class="col-xs-12">

	  <div class="box">

		<div class="box-header">

		  <h3 class="box-title"><?php echo $page_des; ?></h3>

		  <p class="login-box-msg" id="result_thanhvien_alert" style="display: inline;"></p>

		</div>

		<!-- /.box-header -->

		<div class="box-body">

			<?php 

				$infor_mail=json_decode($infor[0]->noidung);

				if($infor_mail){

					echo '<div class="infor_mail">';

					foreach($infor_mail as $value){

						$value_slug=$value->name;

						$name=$this->xulychuoi->replace_name_form($value->name);

						if($value->name=='ngaydudinhvaohoc_be' || $value->name=='email_me' || $value->name=='cachtimduoc' || $value->name=='hoten_be'){

							if($value->name=='ngaydudinhvaohoc_be'){

								$title='THÔNG TIN PHỤ HUYNH';

							}

							if($value->name=='email_me'){

								$title='BẠN BIẾT ĐẾN TRƯỜNG MẦM NON FUJISCHOOL BẰNG CÁCH NÀO';

							}

							if($value->name=='cachtimduoc'){

								$title='LIÊN LẠC TRONG TRƯỜNG HỢP KHẨN CẤP NẾU KHÔNG GỌI ĐƯỢC CHA MẸ';

							}

							if($value->name=='hoten_be'){

								$title='THÔNG TIN HỌC SINH';

							}

							$class='<div class="break_hr">'.$title.'</div>';

							

						}else{

							$class='';		

						}				

						$value_rs=$value->value;

						

						?>

							<?php if($value->name!='hoten_be'){?>

								<div class="infor_mail_details col-xs-12 col-md-6 col-lg-6">

									<span class="name_infor"><?php echo $name; ?>: </span>

									<span class="value_infor"><?php echo $value_rs; ?></span> 

								</div>

								<?php echo $class;

							}else{

								echo $class; ?>

								<div class="infor_mail_details col-xs-12 col-md-6 col-lg-6">

									<span class="name_infor"><?php echo $name; ?>: </span>

									<span class="value_infor"><?php echo $value_rs; ?></span> 

								</div>

							<?php } ?>

					<?php }

					echo '</div>';

				}

			?>

		</div>

		<!-- /.box-body -->

	  </div>

	  <!-- /.box -->

	</div>

	<!-- /.col -->

  </div>

  <!-- /.row -->

</section>

<!-- /.content -->

</div>

