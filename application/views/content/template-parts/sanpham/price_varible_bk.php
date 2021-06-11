<?php
	$check_thuoctinh = strpos($meta_value[0][0], ' * ');

	$data_baohanh['meta_value_baohanh']=$meta_value_baohanh;
	$data_baohanh['meta_baohanh']=$meta_baohanh;


	if($check_thuoctinh!==false){
		$count_thuoctinh=count(explode(' * ', $meta_value[0][0]));
		for ($i=0;$i<=$count_thuoctinh-1;$i++) {
			$array_tt=$this->functions->array_ten_thuoctinh($meta_value,$i);

				$min_price = $meta_value[0][2]; 
				$min_price_km = $meta_value[0][3];
				if($min_price_km!='' && $min_price_km<$min_price){
					$min_price=$min_price_km;
				}
				$name_pr_thuoctinhsp=$this->functions->name_pr_thuoctinhsp($array_tt[0]);

				if($name_pr_thuoctinhsp=='Màu sắc'){
					$type_select='size=2';

				}else{
					$type_select='';
				}
			 ?>
			
			<table class="variations" cellspacing="0">
				<tbody>
					<tr>
						<td class="label"><label for="pa_mau"><?php echo $name_pr_thuoctinhsp; ?></label></td>
						<td class="value woo-variation-items-wrapper">

							<?php if($name_pr_thuoctinhsp=='Màu sắc'){// ul mausac ?>
								<ul class="color-select-ul">
									<?php 
									foreach ($array_tt as $key => $value) {
										//---------------	
										if($name_pr_thuoctinhsp=='Màu sắc'){
											$mamau=$this->page_model->select_table_dk_col_get_1value('post','ten="'.$value.'"','noidung');
											$mamau='style=background:linear-gradient('.$mamau.','.$mamau.');background:-webkit-linear-gradient('.$mamau.','.$mamau.') ';
											
										}else{
											$mamau='';
										}
										echo '<li value="'.$value.'" '.$mamau.' title="'.$value.'">'.$value.'</li>';
									}
								?>
								</ul>
							<?php } ?>

							<select class="pa_select_multi form-control " name="attribute_pa" <?php echo $type_select?> id="pa_select_multi_<?php echo $i; ?>">
								<?php if($name_pr_thuoctinhsp!='Màu sắc'){ ?>
									<option value="0">Chọn một tùy chọn</option>
								<?php } ?>
								<?php 
									foreach ($array_tt as $key => $value) {
										//---------------	
										if($name_pr_thuoctinhsp=='Màu sắc'){
											$mamau=$this->page_model->select_table_dk_col_get_1value('post','ten="'.$value.'"','noidung');
											$mamau='style=background:linear-gradient('.$mamau.','.$mamau.');background:-webkit-linear-gradient('.$mamau.','.$mamau.') ';
											
										}else{
											$mamau='';
										}
										echo '<option value="'.$value.'" '.$mamau.' title="'.$value.'">'.$value.'</option>';
									}
								?>
							</select>
						</td>
					</tr>
				</tbody>
			</table>

		<?php } ?>
		<select class="pa_select form-control" name="attribute_pa" id="pa_select_multi_hidden" hidden="" disabled="" style="display: none">
			<option value="">Chọn một tùy chọn</option>
			<?php 
				$min_price = $meta_value[0][2];
				$min_price_km = $meta_value[0][3];
				if($min_price_km!='' && $min_price_km<$min_price){
					$min_price=$min_price_km;
				}
				$x1_arr=array();
				$x2_arr=array();
				$count_i=0;
				foreach ($meta_value as $key=> $value) { 

						$id_vl=$meta_value[$key][0];

						$ten=str_replace("*","-", $value[0]);

						$anh_sp=str_replace("*","-", $value[1]);

						$gia=str_replace("*","-", $value[2]);

						$gia_km=str_replace("*","-", $value[3]);

						if($gia_km!='' && $gia_km<$gia){
							$gia=$gia_km;
						}				

						$selected_css='selected';
						if(count($meta_value)==1){
							$selected_css ='selected';	
						}else{
							$selected_css='';
							if($min_price > $gia) {
								$min_price = $gia;
								$selected_css='selected';
					        }else if($count_i==0){
					        	$selected_css='selected';
					        }
						}

						if($gia_km!=''){

							$gia_rs=$this->functions->formatMoney($gia_km).' đ';
							$gia_baohanh=$gia_km;

						}else{
							if($gia==''){
								$gia_rs='Liên hệ hotline 0365234567';
							}else{
								$gia_rs= $this->functions->formatMoney($gia). ' đ'; 
							}

							$gia_baohanh=$gia;

						}
					?>
					<option value="<?php echo $id_vl; ?>"  data-giasp="<?php echo $gia_rs; ?>" data-giabaohanh="<?php echo $gia_baohanh; ?>" data-imagelink="<?php echo base_url().'upload/' ; ?>" data-image="<?php echo $anh_sp; ?>" <?php echo $selected_css;?> ><?php echo $ten; ?></option>
				<?php $count_i++;} ?>
		</select>

		<?php $this->load->view('content/template-parts/sanpham/goibaohanh_sp',$data_baohanh); //goibaohanh ?>

		<div class="price-group price-group-varible">
			<div class="variation-price">
				<?php 
					$min_price = $meta_value[0][2];
					$min_price_km = $meta_value[0][3];
					if($min_price_km!='' && $min_price_km<$min_price){
						$min_price=$min_price_km;
					}
					foreach ($meta_value as $key=> $value) {
						$id_vl=$meta[$key][0];
						$ten=str_replace("*","-", $value[0]);
						$anh_sp=str_replace("*","-", $value[1]);
						$gia=str_replace("*","-", $value[2]);
						$gia_km=str_replace("*","-", $value[3]);
						
						if($min_price!='' && $min_price > $gia) { 
							$min_price = $gia;
				            if($gia_km>0){
								$gia_rs= $this->functions->formatMoney($gia_km);
								$gia_baohanh=$gia_km;
							}else{
								$gia_rs= $this->functions->formatMoney($gia);
								$gia_baohanh=$gia;
							}
							$min_price_text = $gia_rs;
							$min_price_baohanh = $gia_baohanh;
				        }else{
				        	if($gia_km>0){
				        		$min_price=$gia_km;
				        	}
				        	$min_price_text =$this->functions->formatMoney($min_price);
				        	$min_price_baohanh =  $min_price;
				        } 
					} 
					if($min_price_text>0){
						echo '<span class="price">'.$min_price_text .' đ'.'</span>'; 
						echo '<span class="price_baohanh" hidden>'.$min_price_baohanh.'</span>'; 
					}
					else{
						echo '<span class="price">Liên hệ hotline 0365234567</span>';
						echo '<span class="price_baohanh" hidden>'.$min_price_baohanh.'</span>'; 
					}
				?>	
			</div>	

		</div>

	<?php }else{// 1 thuco tinh ?>

		<table class="variations" cellspacing="0">
			<tbody>
				<tr>
					<?php 
						$name_pr_thuoctinhsp_one=$this->functions->name_pr_thuoctinhsp($meta_value[0][0]);

						if($name_pr_thuoctinhsp_one=='Màu sắc'){
							$type_select='size=2';
						}else{
							$type_select='';
						}
					?>
					<td class="label"><label for="pa_mau"><?php echo $name_pr_thuoctinhsp_one; ?></label></td>
					<td class="value woo-variation-items-wrapper">

						<?php if($name_pr_thuoctinhsp_one=='Màu sắc'){// ul mausac ?>
								<ul class="color-select-ul color-select-ul-one">
									<?php 
										$min_price = $meta_value[0][2];
										$min_price_km = $meta_value[0][3];
										if($min_price_km!='' && $min_price_km<$min_price){
											$min_price=$min_price_km;
										}
										$x1_arr=array();
										$x2_arr=array();
										$count_i=0;
										foreach ($meta_value as $key=> $value) { 

										$id_vl=$meta[$key][0];

										$ten=str_replace("*","-", $value[0]);

										$anh_sp=str_replace("*","-", $value[1]);

										$gia=str_replace("*","-", $value[2]);

										$gia_km=str_replace("*","-", $value[3]);

										if($gia_km!='' && $gia_km<$gia){
											$gia=$gia_km;
										}
									

										if(count($meta_value)==1){
											$selected_css ='selected';	
										}else{
											$selected_css='';
											if($min_price > $gia && $count_i!=0 ) {
												$min_price = $gia;
												$selected_css='selected';
									        }else if($count_i==0 && $gia<$min_price){
									        	$selected_css='selected';
									        }
										}
											
										if($gia_km!=''){
											$gia_rs= $this->functions->formatMoney($gia_km).' đ';
											$gia_baohanh=$gia_km;

										}else{
											$gia_rs= $this->functions->formatMoney($gia). ' đ';
											$gia_baohanh=$gia;

										}
										//---------------	
										if($name_pr_thuoctinhsp_one=='Màu sắc'){
											$mamau=$this->page_model->select_table_dk_col_get_1value('post','id="'.$id_vl.'"','noidung');
											$mamau='style=background:linear-gradient('.$mamau.','.$mamau.'); background:-webkit-linear-gradient('.$mamau.','.$mamau.') ';
											
										}else{
											$mamau='';
										}
										//---------------
									?>
									<li value="<?php echo $id_vl; ?>" data-giasp="<?php echo $gia_rs; ?>" data-giabaohanh="<?php echo $gia_baohanh; ?>" data-imagelink="<?php echo base_url().'upload/' ; ?>" data-image="<?php echo $anh_sp; ?>" class="<?php echo $selected_css;?>" <?php echo $mamau; ?> title=<?php echo $ten; ?> ><?php echo $ten; ?></li>
								<?php $count_i++; } ?>
								</ul>
						<?php } ?>


						<select class="pa_select form-control" name="attribute_pa" <?php echo $type_select?> >
							<?php if($name_pr_thuoctinhsp_one!='Màu sắc'){ ?>
									<option value="0">Chọn một tùy chọn</option>
							<?php } ?>

							<?php 
								$min_price = $meta_value[0][2];
								$min_price_km = $meta_value[0][3];
								if($min_price_km!='' && $min_price_km<$min_price){
									$min_price=$min_price_km;
								}
								$x1_arr=array();
								$x2_arr=array();
								$count_i=0;
								foreach ($meta_value as $key=> $value) { 

										$id_vl=$meta[$key][0];

										$ten=str_replace("*","-", $value[0]);

										$anh_sp=str_replace("*","-", $value[1]);

										$gia=str_replace("*","-", $value[2]);

										$gia_km=str_replace("*","-", $value[3]);

										if($gia_km!='' && $gia_km<$gia){
											$gia=$gia_km;
										}


										if(count($meta_value)==1){
											$selected_css ='selected';	
										}else{
											$selected_css='';
											if($min_price > $gia) {
												$min_price = $gia;
												$selected_css='selected';
									        }else if($count_i==0){
									        	$selected_css='selected';
									        }
										}
											
										if($gia_km!=''){

											$gia_rs= $this->functions->formatMoney($gia_km).' đ';
											$gia_baohanh=$gia_km;

										}else{

											$gia_rs= $this->functions->formatMoney($gia). ' đ';
											$gia_baohanh=$gia;

										}
										//---------------	
										if($name_pr_thuoctinhsp_one=='Màu sắc'){
											$mamau=$this->page_model->select_table_dk_col_get_1value('post','id="'.$id_vl.'"','noidung');
											$mamau='style=background:linear-gradient('.$mamau.','.$mamau.'); background:-webkit-linear-gradient('.$mamau.','.$mamau.') ';
											
										}else{
											$mamau='';
										}
										//---------------
									?>
									<option value="<?php echo $id_vl; ?>" data-giasp="<?php echo $gia_rs; ?>" data-giabaohanh="<?php echo $gia_baohanh; ?>" data-imagelink="<?php echo base_url().'upload/' ; ?>" data-image="<?php echo $anh_sp; ?>" <?php echo $selected_css;?> <?php echo $mamau; ?> title=<?php echo $ten; ?> ><?php echo $ten; ?></option>
								<?php $count_i++; } ?>
						</select>

					</td>

				</tr>

			</tbody>

		</table>

		<?php $this->load->view('content/template-parts/sanpham/goibaohanh_sp',$data_baohanh); //goibaohanh ?>

		<div class="price-group price-group-varible">
			<div class="variation-price">
				<?php 
					$min_price = $meta_value[0][2];
					$min_price_km = $meta_value[0][3];
					if($min_price_km!='' && $min_price_km<$min_price){
						$min_price=$min_price_km;
					}

					foreach ($meta_value as $key=> $value) {
						$id_vl=$meta[$key][0];
						$ten=str_replace("*","-", $value[0]);
						$anh_sp=str_replace("*","-", $value[1]);
						$gia=(int)str_replace("*","-", $value[2]); 
						$gia_km=(int)str_replace("*","-", $value[3]);  

						//echo $gia; 
						if($min_price!='' and $min_price > $gia) { 
							$min_price=$gia;
				            if($gia_km>0){
								$gia_rs=$this->functions->formatMoney($gia_km);
								$gia_baohanh=$gia_km;
							}else{
								$gia_rs= $this->functions->formatMoney($gia);
								$gia_baohanh=$gia;
							} 
							$min_price_text = $gia_rs;
							$min_price_baohanh = $gia_baohanh; 
				        }else{ 
				        	if($gia_km>0){
				        		$min_price=$gia_km;
				        	}
				        	$min_price_text =$this->functions->formatMoney($min_price);
				        	$min_price_baohanh = $min_price; 
				        } 
					} ?>
					<?php if($min_price_text>0){ ?>
						<span class="price"><?php echo $min_price_text .' đ'?></span>
						<span class="price_baohanh" hidden=""><?php echo $min_price_baohanh; ?></span>  
					<?php }else{
						echo '<span class="price">Liên hệ hotline 0365234567</span>';
						echo '<span class="price_baohanh" hidden>'.$min_price_baohanh.'</span>'; 
					} ?>
			</div>	

		</div>
<?php } ?>

	<div class="btn_submit_addtocart"></div>

