<div class="container no-padding post-wrapper">



	<h2 class="title-post"><?php echo $ten_post; ?></h2>



	<div class="details-post-gr">



		<div class="col-lg-12 col-md-12 col-xs-12 no-padding details-post details-thanhtoan main-page">



			<?php $this->load->view('content/template-parts/breadcrumb',$ten_postpr_post);  ?>



			<div class="entry-post list-cart">



				<?php if($this->cart->contents()){ ?>



					<div class="col-md-7 col-sm-12 col-xs-12 no-padding padding-right">



						<div class="cart_totals cart_totals_bf_thanhtoan customer_details">



							<h3 id="order_review_heading">THÔNG TIN THANH TOÁN</h3>



							<div class="frm-thongtinthanhtoan">



								<form name="frm-thongtinthanhtoan" class="form-thanhtoan">



									<div class="form-group">



										<label for="hoten">Họ và tên <abbr class="required" title="bắt buộc">*</abbr> </label>



										<input name="hoten" type="text" class="form-control" placeholder="Nhập đầy đủ họ và tên của bạn" required="">



									</div>



									<div class="form-group">



										<label for="email" >Địa chỉ email <abbr class="required" title="bắt buộc">*</abbr> </label>



										<input name="email" type="email" class="form-control" placeholder="Nhập địa chỉ của bạn" required="">



									</div>



									<div class="form-group">



										<label for="sodienthoai">Số điện thoại  <abbr class="required" title="bắt buộc">*</abbr> </label>



										<input name="sodienthoai" type="number" class="form-control" placeholder="Nhập số điện thoại của bạn" required="">



									</div>



									<div class="form-group">



										<label for="thanhpho">Tỉnh/Thành phố  <abbr class="required" title="bắt buộc">*</abbr> </label>



										<select name="thanhpho" class="form-control" required="">



											<option value="TP. Hồ Chí Minh">--- Vui lòng chọn Tỉnh/Thành phố ---</option>



											<?php 



												$thanhpho=$this->page_model->select_table_dk_col_get('post','typepost="diadiem"','ten');



												foreach ($thanhpho as $value) {



													echo "<option value='".$value->ten."'>".$value->ten."</option>";



												}



											?>



										</select>



									</div>



									<div class="form-group">



										<label for="quanhuyen">Quận/Huyện <abbr class="required" title="bắt buộc">*</abbr> </label>



										<input name="quanhuyen" type="text" class="form-control" placeholder="Nhập quận/huyện của bạn" required="">



									</div>



									<div class="form-group">



										<label for="diachi">Địa chỉ <abbr class="required" title="bắt buộc">*</abbr> </label>



										<input name="diachi" type="text" class="form-control" placeholder="Nhập địa chỉ của bạn" required="">



									</div>



									<div class="form-group">



										<label for="ghichu">Ghi chú đơn hàng</label>



										<textarea name="ghichu" rows="5" class="form-control"></textarea> 



									</div>



									<input type="text" name="tt_sanpham" value="<?php echo $array_cart=base64_encode(serialize($this->cart->contents())); ?>" disabled hidden>



								</form>



							</div>



						</div>



					</div>	



					<div class="col-md-5 col-sm-12 col-xs-12 no-padding">



						<div class="cart_totals cart_totals_bf_thanhtoan order_review">



							<h3 id="order_review_heading">Đơn hàng của bạn</h3>



						    <table border="0" class="list-cart-tbl">



						        <?php 



						        	$count = 1;



						      	  	$list_cart=$this->cart->contents();



						      	  	$total=0;



						      	  	// $array_cart=base64_encode(serialize($list_cart));



						      	  	// $array = unserialize(base64_decode($array_cart));



						      	  	// $x=(serialize($list_cart));



						      	 	 // var_dump(unserialize($x))	;







						       	 	foreach ($list_cart as $cart) { 



						       	 		$id_sanpham=$cart['id'];







						       	 		$text_thuoctinh=($cart['option']['text_thuoctinh']);



						       	 		$text_thuoctinh_check=str_replace('-', '*', ($cart['option']['text_thuoctinh']));



						       	 		$anhdaidien_sp=$this->page_model->select_table_dk_col_get_1value('post','id= '.$id_sanpham.' ','anhdaidien');	



						       	 		$ten_sp=$this->page_model->select_table_dk_col_get_1value('post','id= '.$id_sanpham.' ','ten');	



						       	 		$url_sp=$this->page_model->select_table_dk_col_get_1value('post','id= '.$id_sanpham.' ','url');	



						       	 		

						       	 		$goibaohanh=($cart['option']['goibaohanh']); 



						       	 		if($goibaohanh!='Không chọn gói bảo hành' && $goibaohanh!=''){

						       	 			$meta_value_baohanh=$this->page_model->select_table_dk_col_get_1value('sanpham','id_sanpham= '.$id_sanpham.' ','meta_value_baohanh');

						       	 			$meta_value_baohanh=json_decode($meta_value_baohanh, true);

						       	 			//var_dump($meta_value_baohanh); 

						       	 			foreach ($meta_value_baohanh as $value_giatri) {

												if(in_array($goibaohanh, $value_giatri)){

													$gia_goibaohanh=$value_giatri[1]; 

													$goibaohanh=$goibaohanh.' ('. $this->functions->formatMoney($gia_goibaohanh).')'; 

												}

											}

						       	 		}else{

						       	 			$gia_goibaohanh=0;

						       	 		}	



						       	 		if($text_thuoctinh!=''){



						       	 			$meta_sanpham=json_decode($this->page_model->select_table_dk_col_get_1value('sanpham','id_sanpham= '.$id_sanpham.' ','meta_value'),true);



						       	 			foreach ($meta_sanpham as $value) {



						       	 				$text_thuoctinh_check_dacbiet=str_replace('*', '-', ($cart['option']['text_thuoctinh']));

												$value_thuoctinh_dacbiet=str_replace('*', '-', $value[0]);	



						       	 				if ($value[0]==$text_thuoctinh_check || $value_thuoctinh_dacbiet==$text_thuoctinh_check_dacbiet) {



						       	 					if($value[3]!=''){



						       	 						$gia_sp=$value[3];



						       	 					}else{



						       	 						$gia_sp=$value[2];



						       	 					}



													



												}



											}	



						       	 			



						       	 		}else{



						       	 			$gia_sp=$this->page_model->select_table_dk_col_get_1value('sanpham','id_sanpham= '.$id_sanpham.' ','gia');	



						       	 			$giakm_sp=$this->page_model->select_table_dk_col_get_1value('sanpham','id_sanpham= '.$id_sanpham.' ','giakhuyenmai');	



						       	 			if ($giakm_sp!=0) {



						       	 				$gia_sp=$giakm_sp;



						       	 			}



						       	 		}

						       	 		$gia_sp_have_baohanh=$gia_sp+$gia_goibaohanh;	



						       	 		$total+=$cart['qty']*$gia_sp_have_baohanh;



						       	 	?>



					       			<tr>



							            <td>



							            	<?php 



							            	if($anhdaidien_sp){?>



												<a href="<?php echo $url_sp; ?>" title="<?php echo $ten_sp; ?>" ><img loading="lazy" src="<?php echo UPLOAD_URL.$anhdaidien_sp; ?>" class="img-post-avt" alt="<?php echo $ten_sp; ?>" style="width:60px"/></a>



											<?php }else{?>



												<a href="<?php echo $url_sp; ?>" title="<?php echo $ten_sp; ?>" ><img loading="lazy" src="<?php echo UP_POST_THUMB ?>no_image.jpg" class="img-post-avt" alt="<?php echo $ten_sp; ?>"/></a>



											<?php } ?>	



							            </td>



							            <td>



							            	<a href="<?php echo $url_sp; ?>" title="<?php echo $ten_sp; ?>" ><?php echo $ten_sp; ?></a> x <?php echo $cart['qty']; ?> <br>



							            	<b><?php echo $text_thuoctinh; ?></b>



							            		



							            </td>



							            <td><b><?php echo number_format($cart['qty']*$gia_sp); ?></b></td>



							        </tr>



						        <?php } ?>



						    </table>



							<table cellspacing="0" class="shop_table shop_table_responsive">



								<tbody>



									<tr class="shipping">



										<th>Giao hàng</th>



										<td>Phí ship tùy khu vực</td>



									</tr>



									<tr class="order-total">



										<th>Tổng cộng</th>



										<td>



											<strong>



												<span class="Price-amount amount"><?php echo $this->functions->formatMoney($total); ?><span class="Price-currencySymbol">₫</span></span>



											</strong> 



										</td>



									</tr>



								</tbody>



							</table>







							<?php 



								$payment_type=$this->page_model->select_table_dk_col_get('post','idpostpr=723 and typepost="widget"','id,url,ten,noidung');



								if($payment_type){ ?>



									<div id="payment" class="checkout-payment">



										<ul class="wc_payment_methods payment_methods methods">



											<?php



												$i=0;



												foreach ($payment_type as $value) { $i++; 



													if($i==1){



														$css_block='style="display: block;"';



														$checked='checked="checked"';



													}else{



														$css_block='style="display: none;"';



														$checked='';



													}



													?>



													<li class="payment_method payment_method_<?php echo $value->url; ?>">



														<input id="<?php echo $value->url; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo $value->ten; ?>" <?php echo $checked;?> >



														<label for="<?php echo $value->url; ?>"><?php echo $value->ten; ?></label>



														<div class="payment_box payment_method_<?php echo $value->url; ?>" <?php echo $css_block; ?> >



															<?php echo $value->noidung; ?>



														</div>



													</li>



												<?php }



											?>



										</ul>



									</div>



								<?php } ?>



							<div class="proceed-to-checkout">



								<span class="alert-checkout-button"></span>



								<button class="btn checkout-button button alt wc-forward">Đặt hàng</button>



							</div>



						</div>



					</div>



				<?php } else{ ?>



					<div class="no-cart">Chưa có sản phẩm nào trong giỏ hàng.</div>



				<?php }	?>



			</div>



		</div>		



	</div>



</div>
