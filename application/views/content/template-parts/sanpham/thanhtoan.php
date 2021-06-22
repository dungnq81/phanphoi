<div class="checkout-wrapper">
	<div class="container no-padding post-wrapper">
		<?php $this->load->view('content/template-parts/breadcrumb',$ten_postpr_post);  ?>
		<h2 class="title-post"><?php echo $ten_post; ?></h2>
		<?php if ( ! $this->current_user ) : ?>
		<div class="users-checkout-alert">
			<strong>Vui lòng <a href="<?=base_url()?>users/login<?=redirect_get( current_url() )?>" data-target="#user-login" data-toggle="modal" data-backdrop="static" data-keyboard="false" title="<?php echo esc_attr_( 'login_heading' ) ?>">đăng nhập</a> thành viên để được nhiều ưu đãi, hoặc <a href="<?=base_url()?>users/register<?=redirect_get( current_url() )?>" title="<?php echo esc_attr_( 'create_user_heading' ) ?>">đăng ký nhanh</a> tại đây</strong>
			<p class="title">Các lợi ích khi là thành viên</p>
			<ul>
				<li>Được tích điểm thưởng trên mỗi đơn hàng</li>
				<li>Nhận được thông báo các chương trình khuyến mãi hấp dẫn</li>
				<li>Theo dõi đơn hàng</li>
			</ul>
		</div>
		<?php else : if ($this->cart->contents()) : ?>
		<div class="points-dropdown">
			<a href="#" title="Sử dụng điểm thưởng!">Sử dụng điểm thưởng!</a>
			<div class="dropdown-menu">
				<label for="points">
					<input form="frm-checkout" type="number" name="points" id="points">
					<button type="button" class="btn btn-points">Áp dụng</button>
				</label>
			</div>
		</div>
		<?php endif; endif;?>
		<div class="details-post-gr">
			<div class="col-lg-12 col-md-12 col-xs-12 no-padding details-post details-thanhtoan main-page">
				<div class="entry-post list-cart">
					<?php if($this->cart->contents()){
						$user = (object) [
								'fullname' => '',
								'email' => '',
								'phone' => '',
								'address' => '',
						];
						$user_id = null;
						if ($this->current_user) {
							$user = (object) [
									'fullname' => $this->current_user->fullname,
									'email' => $this->current_user->email,
									'phone' => $this->current_user->phone,
									'address' => $this->current_user->address,
							];
							$user_id = $this->current_user->id;
						}

						?>
						<div class="col-md-7 col-sm-12 col-xs-12 no-padding padding-right">
							<div class="cart_totals cart_totals_bf_thanhtoan customer_details">
								<h3 class="order_review_heading">THÔNG TIN THANH TOÁN</h3>
								<div class="frm-thongtinthanhtoan">
									<form method="post" name="frm-thongtinthanhtoan" class="form-thanhtoan" id="frm-checkout">
										<div class="form-group">
											<label for="hoten">Họ và tên <abbr class="required" title="bắt buộc">*</abbr> </label>
											<input value="<?php echo set_value('hoten', $user->fullname)?>" id="hoten" name="hoten" type="text" class="form-control" pattern="^(.*\S+.*)$" placeholder="Họ và tên của bạn" required>
										</div>
										<div class="form-group">
											<label for="email" >Email <abbr class="required" title="bắt buộc">*</abbr> </label>
											<input value="<?php echo set_value('email', $user->email)?>" id="email" name="email" type="email" class="form-control" placeholder="Địa chỉ của bạn" required>
										</div>
										<div class="form-group">
											<label for="sodienthoai">Số điện thoại  <abbr class="required" title="bắt buộc">*</abbr> </label>
											<input value="<?php echo set_value('sodienthoai', $user->phone)?>" id="sodienthoai" name="sodienthoai" type="tel" pattern="^\+?[0-9\+\-\.\s\(\)]+\*?$" class="form-control" placeholder="Số điện thoại của bạn" required>
										</div>
										<div class="form-group">
											<label for="thanhpho">Tỉnh/Thành phố  <abbr class="required" title="bắt buộc">*</abbr> </label>
											<select id="thanhpho" name="thanhpho" class="form-control" required>
												<option value="" data-default>-- Tỉnh/Thành phố --</option>
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
											<input id="quanhuyen" name="quanhuyen" type="text" pattern="^(.*\S+.*)$" class="form-control" placeholder="Quận/huyện của bạn" required="">
										</div>
										<div class="form-group">
											<label for="diachi">Địa chỉ <abbr class="required" title="bắt buộc">*</abbr> </label>
											<input id="diachi" value="<?php echo set_value('diachi', $user->address)?>" name="diachi" type="text" pattern="^(.*\S+.*)$" class="form-control" placeholder="Địa chỉ của bạn" required="">
										</div>
										<div class="form-group">
											<label for="ghichu">Ghi chú đơn hàng</label>
											<textarea id="ghichu" name="ghichu" rows="5" class="form-control"></textarea>
										</div>
										<input form="frm-checkout" type="text" name="tt_sanpham" value="<?php echo $array_cart=base64_encode(serialize($this->cart->contents())); ?>" disabled hidden>
									</form>
								</div>
							</div>
						</div>
						<div class="col-md-5 col-sm-12 col-xs-12 no-padding">
							<div class="cart_totals cart_totals_bf_thanhtoan order_review">
								<h3 class="order_review_heading">Đơn hàng của bạn</h3>
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
											<td><b><?php echo number_format($cart['qty']*$gia_sp); ?>đ</b></td>
										</tr>
									<?php } ?>
								</table>
								<table cellspacing="0" class="shop_table shop_table_responsive">
									<tbody>
										<tr class="shipping">
											<th>Giao hàng: </th>
											<td>Phí ship tùy khu vực</td>
										</tr>
										<?php
										$_point_to_money = $this->setting->point_to_money;
										$_points = $this->session->userdata( 'points' );
										$_point_user_id = $this->session->userdata( 'point_user_id' );
										if ($_points
											&& $_point_user_id == $this->current_user->id
											&& $_points <= $this->current_user->points
										) :

											if ($_points * $_point_to_money > $total) {
												$_points = $total / $_point_to_money;
												$this->session->set_userdata( [
														'points' => $_points,
														'point_user_id' => $this->current_user->id,
												] );
											}

											$total = $total - $_points * $_point_to_money;
											$this->session->set_userdata( [
												'order_totals' => $total,
											] );
										?>
										<tr class="order-points">
											<th>Sử dụng điểm:</th>
											<td><strong class="Price-amount amount">-<?php echo number_format($_points * $_point_to_money)?><span class="Price-currencySymbol">₫</span></strong></td>
										</tr>
										<?php else : $_points = 0; endif;?>
										<tr class="order-total">
											<th>Tổng cộng: </th>
											<td>
												<strong>
													<span class="Price-amount amount"><?php echo $this->functions->formatMoney($total); ?><span class="Price-currencySymbol">₫</span></span>
												</strong>
											</td>
										</tr>
										<?php if ($this->current_user) :
											$_money_to_point = (int) $this->setting->money_to_point;
											if ($_money_to_point < 0)
												$_money_to_point = 10000;

											$_points_recive = round($total / $_money_to_point, 0);
											?>
										<tr class="points hide">
											<th>Điểm thưởng: </th>
											<td>
												<strong class="Price-amount amount"><?php echo number_format( $_points_recive );?> điểm</strong>
											</td>
										</tr>
										<?php endif;?>
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
															<input form="frm-checkout" id="<?php echo $value->url; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo $value->ten; ?>" <?php echo $checked;?> >
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
									<input form="frm-checkout" type="hidden" name="user_id" value="<?php echo $user_id;?>">
									<input form="frm-checkout" type="hidden" name="pointsx" value="<?php echo base64_encode($_points)?>">
									<input form="frm-checkout" type="hidden" name="totals" value="<?=base64_encode($total)?>">
									<button form="frm-checkout" type="submit" class="btn checkout-button button alt wc-forward">Đặt hàng</button>
									<span class="alert-checkout-button"></span>
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
</div>
