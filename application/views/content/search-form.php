
<form class="frm-timkiem" action="<?php echo base_url();?>" method="GET">
	<div class="frm-gr">
		<div class="content-frm">
			<?php 
				$list_dmsp= $this->page_model->select_table_dk_col_get('post','typepost ="danhmucsanpham" and trangthai=1 order by ngaycapnhat','ten,id');
				if($list_dmsp){?>
					<div class="col-ip col-lg-4 col-md-4 col-xs-3 hidden-xs">
						<select name="id_postpr" class="form-control">
							<option value="0">Tất cả</option>
							<?php
								if(base_url(uri_string())!=URL && isset($id_post)){
									$typepost_cus=$this->page_model->select_value_table_dk_col('post','id','="'.$id_post.'"','typepost');
									if($typepost_cus=='danhmucsanpham'){ ?>
										<option value="<?php echo $id_post; ?>" selected><?php echo $ten_post; ?></option>
									<?php }
								}else{
									if(isset($_GET['id_postpr']) && $_GET['id_postpr']!='0' ){ 
										$ten_ip_postpr=$this->page_model->select_value_table_dk_col('post','id','="'.$_GET['id_postpr'].'"','ten');
										?>
										<option value="<?php echo $_GET['id_postpr']; ?>" selected><?php echo $ten_ip_postpr; ?></option>
									<?php }
								} ?>						
							<?php 
								foreach ($list_dmsp as $value) {
									echo '<option value="'.$value->id.'">'.$value->ten.'</option>';
								}
							?>
						</select>
					</div>
				<?php } ?>
			<div class="col-ip col-lg-8 col-md-8 col-xs-12">
				<input type="text" name="s" placeholder="Nhập giá trị tìm kiếm" />
				<button type="submit" value="Submit"><i class="fa fa-search"></i></button>
			</div>
		</div>
	</div>
</form>
