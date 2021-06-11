<div class="content-middle marginCenter">
	<div class="mh680-pc row margin0">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 marginBottom22 relative hidden-xs marginTop39">
			<a title="back" href="javascript: window.history.go(-1)" class="button-back">
				<span class="icon-24 icon-button-back marginRight15"/>
			</span>Quay lại</a>
			<div class="title-content-page">Thông tin hồ sơn</div>
		</div>
		<div class=" pl12mb pr12mb"></div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-white-content marginBottom70-pc marginBottom0-mb bgWhite-mb  pl12mb pr12mb">
			<div class="content-box-white">
				<div class="col-xs-12 padding0-pc form-group">
					<?php				
						foreach($list_infor_user as $key=>$row_infor){
							if($row_infor==''){
								$row_infor='<i>(Chưa cập nhật thông tin)</i>';
							}
						?>
							<label for="" class="col-sm-3 control-label margin0 label-register2 paddingTop4-pc paddingTop15mb marginTop0-mb marginBottom5-mb"><?php echo $key;?></label>
							<div class="col-sm-9 padding0 margin0 checkbox">
									<label class="paddingLeft0 paddingTop4"><?php echo $row_infor;?></label>
							</div>
						<?php }
					?>
				</div>
			</div>
		</div>
	</div>
</div>