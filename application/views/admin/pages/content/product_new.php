<div class="pannel form-group form-group-sp product-type-gr" id="product-type-variable-gr" hidden=""> 



	<div class="form-group">



		<label>Gói bảo hành</label>



		<div class="form-group form-thuoctinhsanpham-gr">



			<?php

				

				



				$array_thuoctinh_edit=array(); 



				if(isset($_GET['edit']) and ($meta_baohanh_edit!='[["undefined"]]' and $meta_baohanh_edit!='null' and $meta_baohanh_edit!='')){



					$giatri_thuoctinhsanpham_edit=$this->admin_model->select_table_dk_col_get('sanpham','id_sanpham = "'.$_GET['edit'].'" ','meta_baohanh');



					//---- convert to one array



					$array_thuoctinh=($giatri_thuoctinhsanpham_edit[0]->meta_baohanh); 



					$array_thuoctinh = json_decode($array_thuoctinh, true);







					



					foreach($array_thuoctinh as $value)



					{



					    $array_thuoctinh_edit=array_merge($array_thuoctinh_edit,$value);



					}







					//--------------------------------------------



					$giatri_thuoctinhsanpham_value_edit=$this->admin_model->select_table_dk_col_get('sanpham','id_sanpham = "'.$_GET['edit'].'" ','meta_value_baohanh');



					$array_thuoctinh_value=($giatri_thuoctinhsanpham_value_edit[0]->meta_value_baohanh);



					$array_thuoctinh_value = json_decode($array_thuoctinh_value, true);



					



					$giatri_count=0;



					foreach ($array_thuoctinh_value as $array_thuoctinh_value_row) {



						$array_thuoctinh_value_row_implode=implode(',', $array_thuoctinh_value_row);



						



						echo '<input type="text" name="goibaohanh_ip_'.$giatri_count.'" value="'.$array_thuoctinh_value_row_implode.'" disabled hidden>';



						$giatri_count++;



					}



				}



				







				$thuoctinhsanpham=$this->admin_model->select_table_dk_col_get('post','typepost = "thuoctinhsanpham" and url="goi-bao-hanh" order by ngaycapnhat DESC ','id,ten');



				if($thuoctinhsanpham){ ?>



					<div class="thuoctinhsanpham_sl">



						<?php



							 foreach ($thuoctinhsanpham as $value) {



								$ten_thuoctinh=$value->ten;



								$id_thuoctinh=$value->id; ?>



									<div class="thuoctinhsanpham_gr" id="goibaohanh_gr_<?php echo $id_thuoctinh; ?>">



										<span><?php echo $ten_thuoctinh; ?></span>



										<?php 



											$giatri_thuoctinhsanpham=$this->admin_model->select_table_dk_col_get('post','typepost = "giatrithuoctinhsanpham" and idpostpr='.$id_thuoctinh.' order by ngaycapnhat DESC','id,ten');



											if($giatri_thuoctinhsanpham){



												$checked_css='';



												foreach ($giatri_thuoctinhsanpham as $value_giatri) {

													$string_nhiu_thuoctinh=implode(' * ', $array_thuoctinh_edit);



													$check_nhiu_thuoctinh = strpos($string_nhiu_thuoctinh, $value_giatri->id);



													if(in_array($value_giatri->id, $array_thuoctinh_edit) || ($check_nhiu_thuoctinh!==false)){



														$checked_css='checked';



													}else{



														$checked_css='';



													}







													$value_giatri_id_rs=$id_thuoctinh.'+++'.$value_giatri->id;



													echo '<span class="list_cb"><input type="checkbox" name="goibaohanh_ip_'.$id_thuoctinh.'" value="'.$value_giatri->ten.'" id="'.$value_giatri->id.'" '.$checked_css.' >'.$value_giatri->ten.'</span>';







												}



											}



										?>



									</div>



						<?php } ?>



					</div>



					<button type="button" class="button add_goibaohanh">Thêm</button>

					<i class="note">Click để hệ thống tạo gói bảo hành cho sản phẩm</i>



				<?php } ?>



		</div>



		<div class="form-group list_sp_baohanh"></div>



		<button type="button" class="button save_thuoctinhsanpham" hidden="">Lưu thuộc tính</button>



	</div>



</div>





<div class="pannel form-group form-group-sp" hidden="">



	<label>Loại sản phẩm</label>



	<select id="product-type" name="product-type">



		<option value="variable">Sản phẩm có biến thể</option>

		<option value="simple">Sản phẩm đơn giản</option>



	</select>



</div>



<div class="pannel form-group form-group-sp product-type-gr" id="product-type-simple-gr"  style="display: block;">



	<div class="form-group">



		<label>Giá</label>



		<input type="number" class="form-control" name="gia" value="<?php echo $gia_product_edit; ?>"placeholder="Nhập giá tại đây">



	</div>



	<div class="form-group">



		<label>Giá khuyến mãi</label>



		<input type="number" class="form-control" name="giakhuyenmai" value="<?php echo $giakhuyenmai_product_edit; ?>"placeholder="Nhập giá khuyến mãi tại đây">



	</div>



</div>







<div class="pannel form-group form-group-sp product-type-gr" id="product-type-variable-gr" hidden="">



	<div class="form-group">



		<label>Các thuộc tính</label>



		<div class="form-group form-thuoctinhsanpham-gr">



			<?php



			



				$array_thuoctinh_edit=array();



				if(isset($_GET['edit']) and $meta_product_edit!='null'){



					$giatri_thuoctinhsanpham_edit=$this->admin_model->select_table_dk_col_get('sanpham','id_sanpham = "'.$_GET['edit'].'" ','meta');



					//---- convert to one array



					$array_thuoctinh=($giatri_thuoctinhsanpham_edit[0]->meta);



					$array_thuoctinh = json_decode($array_thuoctinh, true);







					



					foreach($array_thuoctinh as $value)



					{



					    $array_thuoctinh_edit=array_merge($array_thuoctinh_edit,$value);



					}







					//--------------------------------------------



					$giatri_thuoctinhsanpham_value_edit=$this->admin_model->select_table_dk_col_get('sanpham','id_sanpham = "'.$_GET['edit'].'" ','meta_value');



					$array_thuoctinh_value=($giatri_thuoctinhsanpham_value_edit[0]->meta_value);



					$array_thuoctinh_value = json_decode($array_thuoctinh_value, true);







					$giatri_count=0;



					foreach ($array_thuoctinh_value as $array_thuoctinh_value_row) {



						$array_thuoctinh_value_row_implode=implode(',', $array_thuoctinh_value_row);



						



						echo '<input type="text" name="giatrithuoctinhsanpham_'.$giatri_count.'" value="'.$array_thuoctinh_value_row_implode.'" disabled hidden>';



						$giatri_count++;



					}



				}



				







				$thuoctinhsanpham=$this->admin_model->select_table_dk_col_get('post','typepost = "thuoctinhsanpham" and url!="goi-bao-hanh" order by ngaycapnhat DESC ','id,ten');



				if($thuoctinhsanpham){ ?>



					<div class="thuoctinhsanpham_sl">



						<?php



							 foreach ($thuoctinhsanpham as $value) {



								$ten_thuoctinh=$value->ten;



								$id_thuoctinh=$value->id; ?>



									<div class="thuoctinhsanpham_gr" id="thuoctinhsanpham_gr_<?php echo $id_thuoctinh; ?>">



										<span><?php echo $ten_thuoctinh; ?></span>



										<?php 



											$giatri_thuoctinhsanpham=$this->admin_model->select_table_dk_col_get('post','typepost = "giatrithuoctinhsanpham" and idpostpr='.$id_thuoctinh.' order by ngaycapnhat DESC','id,ten');



											if($giatri_thuoctinhsanpham){



												$checked_css='';



												foreach ($giatri_thuoctinhsanpham as $value_giatri) {

													$string_nhiu_thuoctinh=implode(' * ', $array_thuoctinh_edit);



													$check_nhiu_thuoctinh = strpos($string_nhiu_thuoctinh, $value_giatri->id);



													if(in_array($value_giatri->id, $array_thuoctinh_edit) || ($check_nhiu_thuoctinh!==false)){



														$checked_css='checked';



													}else{



														$checked_css='';



													}







													$value_giatri_id_rs=$id_thuoctinh.'+++'.$value_giatri->id;



													echo '<span class="list_cb"><input type="checkbox" name="giatrithuoctinhsanpham_ip_'.$id_thuoctinh.'" value="'.$value_giatri->ten.'" id="'.$value_giatri->id.'" '.$checked_css.' >'.$value_giatri->ten.'</span>';







												}



											}



										?>



									</div>



						<?php } ?>



					</div>



					<button type="button" class="button add_thuoctinhsanpham">Thêm</button>

					<i class="note">Click để hệ thống tạo sản phẩm có biến thể</i>



				<?php } ?>



		</div>



		<div class="form-group list_sp_varible"></div>



		<button type="button" class="button save_thuoctinhsanpham" hidden="">Lưu thuộc tính</button>



	</div>



</div>







<div class="pannel form-group-sp" hidden="">



	<div class="form-group">



		<label>Thông số kỹ thuật</label>



		<textarea class="form-control tinymce"" name="thongsokythuat" rows="10" cols="80"><?php echo $thongsokythuat_product_edit; ?></textarea>



	</div>



	<div class="form-group">



		<label>Hỗ trợ khi mua sản phẩm</label>



		<textarea class="form-control tinymce"" name="hotro" rows="10" cols="80"><?php echo $hotro_product_edit; ?></textarea>



	</div>



</div>
