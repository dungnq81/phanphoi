<div class="container no-padding post-wrapper">
	<h2 class="title-post"><?php echo $ten_post; ?></h2>
	<div class="details-post-gr">
		<div class="col-lg-12 col-md-12 col-xs-12 no-padding details-post details-giohang main-page">
			<?php $this->load->view('content/template-parts/breadcrumb',$ten_postpr_post);  ?>
			<div class="entry-post list-cart">
				<?php if($this->cart->contents()){ ?>
					<div class="col-md-8 col-sm-12 col-xs-12 no-padding details-giohang-tbl">
					    <table border="1" class="list-cart-tbl">
					        <tr>
					        	<td>Ảnh</td>	
					            <td>Thông tin</td>
					            <td>Giá</td>
					            <td>Số lượng</td>
					            <td>Tổng</td>
					            <td></td>
					        </tr>
					        <?php 
					        	$count = 1;
					      	  	$list_cart=$this->cart->contents();
					      	  	$total=0;
					      	    //var_dump($list_cart);
					       	 	foreach ($list_cart as $cart) { 
					       	 		$id_sanpham=$cart['id'];
					       	 		$text_thuoctinh=($cart['option']['text_thuoctinh']);
					       	 		$text_thuoctinh_check=str_replace('-', '*', ($cart['option']['text_thuoctinh']));
					       	 		$anhdaidien_sp=$this->page_model->select_table_dk_col_get_1value('post','id= '.$id_sanpham.' ','anhdaidien');	
					       	 		$ten_sp=$this->page_model->select_table_dk_col_get_1value('post','id= '.$id_sanpham.' ','ten');	
					       	 		$url_sp=$this->page_model->select_table_dk_col_get_1value('post','id= '.$id_sanpham.' ','url');	
					       	 		$goibaohanh=($cart['option']['goibaohanh']);
					       	 		if($goibaohanh!='Không chọn gói bảo hành' and $goibaohanh!=''){
					       	 			$meta_value_baohanh=$this->page_model->select_table_dk_col_get_1value('sanpham','id_sanpham= '.$id_sanpham.' ','meta_value_baohanh');
					       	 			if($meta_value_baohanh!='null'){
					       	 				$meta_value_baohanh=json_decode($meta_value_baohanh, true);
						       	 			//var_dump($meta_value_baohanh); 
						       	 			foreach ($meta_value_baohanh as $value_giatri) {
												if(in_array($goibaohanh, $value_giatri)){
													$gia_goibaohanh=$value_giatri[1]; 
													$goibaohanh=$goibaohanh.' ('. $this->functions->formatMoney($gia_goibaohanh).')'; 
												}
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
										$gia_sp_have_baohanh=$gia_sp+$gia_goibaohanh;	
					       	 		}else{
					       	 			$gia_sp=$this->page_model->select_table_dk_col_get_1value('sanpham','id_sanpham= '.$id_sanpham.' ','gia');	
					       	 			$giakm_sp=$this->page_model->select_table_dk_col_get_1value('sanpham','id_sanpham= '.$id_sanpham.' ','giakhuyenmai');	
					       	 			if ($giakm_sp!=0) {
					       	 				$gia_sp=$giakm_sp;
					       	 			}
					       	 			$gia_sp_have_baohanh=$gia_sp+$gia_goibaohanh;
					       	 		}
					       	 		$total+=$cart['qty']*$gia_sp_have_baohanh;
					       	 	?>
				       			<tr>
						            <td>
						            	<?php 
						            	if($anhdaidien_sp){?>
											<a href="<?php echo $url_sp; ?>" title="<?php echo $ten_sp; ?>" ><img loading="lazy" src="<?php echo THUMBS_URL.$anhdaidien_sp; ?>" class="img-post-avt" alt="<?php echo $ten_sp; ?>" style="width:60px" /></a>
										<?php }else{?>
											<a href="<?php echo $url_sp; ?>" title="<?php echo $ten_sp; ?>" ><img loading="lazy" src="<?php echo UP_POST_THUMB ?>no_image.jpg" class="img-post-avt" alt="<?php echo $ten_sp; ?>"/></a>
										<?php } ?>	
						            </td>
						            <td>
						            	<a href="<?php echo $url_sp; ?>" title="<?php echo $ten_sp; ?>" ><?php echo $ten_sp; ?></a><br>
						            	<b><?php echo $text_thuoctinh; ?></b>
						            </td>
						            <td><?php echo number_format($gia_sp); ?></td>
						            <td><input type="number" value="<?php echo $cart['qty']; ?>" name="number_qty_sp" min="1" id="<?php echo $cart['rowid']; ?>"></td>
						            <td><b><?php echo number_format($cart['qty']*$gia_sp_have_baohanh); ?></b></td>
						            <td><a class="delete_cart" id="<?php echo $cart['rowid']; ?>"><i class="fa fa-trash"></i></a></td>
						        </tr>
					        <?php } ?>
					        	<tr>
									<td colspan="6" class="actions">
										<a class="button continuous-btn" title="Tiếp tục chọn sản phẩm" href="https://phanphoi.com.vn/">Tiếp tục chọn sản phẩm</a>
										<!--<button class="button" name="history-button-cs" value="Quay trờ lại" onclick="history.go(-1); return false;">Tiếp tục chọn sản phẩm</button>-->
										<button type="submit" class="button" name="update_cart" value="Cập nhật giỏ hàng" disabled="">Cập nhật giỏ hàng</button>
									</td>
								</tr>	
					    </table>
					</div>
				    <div class="col-md-4 col-sm-12 col-xs-12 no-padding padding-left subtotal-giohang-tbl">
						<div class="cart_totals ">
							<h2>Tổng số lượng</h2>
							<table cellspacing="0" class="shop_table shop_table_responsive">
								<tbody>
									<tr class="cart-subtotal">
										<th>Tổng cộng</th>
										<td><span class="Price-amount amount"><?php echo $this->functions->formatMoney($total); ?><span class="Price-currencySymbol">₫</span></span></td>
									</tr>
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
							<div class="proceed-to-checkout">
								<a href="<?php echo base_url();?>thanh-toan" class="checkout-button-process btn btn-primary button alt wc-forward">Tiến hành thanh toán</a>
							</div>
						</div>
					</div>
				<?php }else{ ?>
					<div class="no-cart">Chưa có sản phẩm nào trong giỏ hàng.</div>
				<?php } ?>	
			</div>
		</div>		
	</div>
</div>
