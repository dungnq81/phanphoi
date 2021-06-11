<?php
	$infor_donhang=$this->admin_model->select_table_dk('tragop','id','="'.$_GET['id'].'" ');
	foreach ($infor_donhang as $value) {
		//var_dump($value);
		$vl_khachhang_ex=explode('*+++*', $value->vl_khachhang);
		$id_donhang=$value->id_tragop;
		$ngaytao=$value->ngaytao;
		$type_thanhtoan=$value->type_thanhtoan;
		$ghichu=$value->ghichu;
		$trangthai=$value->trangthai;
		$chinhanh=$value->chinhanh;
		$ten_kh=$vl_khachhang_ex[0];
		$email_kh=$vl_khachhang_ex[2];
		$sdt_kh=$vl_khachhang_ex[1];
		$khuvuc_kh=$value->thanhpho;
		$diachi_kh=$vl_khachhang_ex[5];
		$thoigiangiaohang=$value->thoigiangiaohang;
		$ghichu_kh=$value->ghichu_tragop;
		$tt_sanpham=$value->tt_sanpham;
		$sotientratruoc=$value->sotientratruoc;
		$sothangtragop=$value->sothang;
	}
	//var_dump($tt_sanpham);
	$tt_sanpham_rs=unserialize(base64_decode($tt_sanpham)); // get value sp
	//var_dump($tt_sanpham_rs);
?>
<div class="details-order box">
	<h2 class="woocommerce-order-details__title">Thông tin chung</h2>
	<ul class="thankyou-order-details order_details">
		<li>Mã đơn hàng: <strong><?php echo $id_donhang; ?></strong></li>
		<li>Ngày: <strong><?php echo $ngaytao; ?></strong></li>
		<li>Tên: <strong><?php echo $ten_kh; ?></strong></li>
		<li>SĐT: <strong><?php echo $sdt_kh; ?></strong></li>
		<li>Email: <strong><?php echo $email_kh; ?></strong></li>
		<li>Địa chỉ: <strong><?php echo $email_kh; ?></strong></li>
		<li>Phương thức thanh toán:<strong><?php echo $type_thanhtoan; ?></strong></li>
		<li>Trạng thái:<strong><?php echo $this->functions->trangthaidonhang($trangthai); ?></strong></li>		
	</ul>
	<section class="order-details">	
		<div class="col-lg-4 col-sm-4 col-xs-12 no-padding thongtin-donhang">	
			<h2 class="woocommerce-order-details__title">Thông tin đơn hàng</h2>
			<table border="0" class="shop_table order_details">
				<tr>
	       	 		<td>Sản phẩm</td>
	       	 		<td>Tổng cộng</td>
		       	</tr>
		        <?php 
		        	$count = 1;
		      	  	$list_cart=$tt_sanpham_rs;
		      	  	$total=0;
		       	 	foreach ($list_cart as $cart) { 
		       	 		$id_sanpham=$cart['id'];
		       	 		$text_thuoctinh=($cart['option']['text_thuoctinh']);
		       	 		$text_thuoctinh_check=str_replace('-', '*', ($cart['option']['text_thuoctinh']));
		       	 		$anhdaidien_sp=$this->admin_model->select_value_table_dk_col_1value('post','id= '.$id_sanpham.' ','anhdaidien');	
		       	 		$ten_sp=$this->admin_model->select_value_table_dk_col_1value('post','id= '.$id_sanpham.' ','ten');	
		       	 		$url_sp=$this->admin_model->select_value_table_dk_col_1value('post','id= '.$id_sanpham.' ','url');	
		       	 		$goibaohanh=($cart['option']['goibaohanh']);
		       	 		if($goibaohanh!='Không chọn gói bảo hành' && $goibaohanh!=''){
		       	 			$meta_value_baohanh=$this->admin_model->select_value_table_dk_col_1value('sanpham','id_sanpham= '.$id_sanpham.' ','meta_value_baohanh');
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
		       	 			$meta_sanpham=json_decode($this->admin_model->select_value_table_dk_col_1value('sanpham','id_sanpham= '.$id_sanpham.' ','meta_value'),true);
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
		       	 			$gia_sp=$this->admin_model->select_value_table_dk_col_1value('sanpham','id_sanpham= '.$id_sanpham.' ','gia');	
		       	 			$giakm_sp=$this->admin_model->select_value_table_dk_col_1value('sanpham','id_sanpham= '.$id_sanpham.' ','giakhuyenmai');	
		       	 			if ($giakm_sp!=0) {
		       	 				$gia_sp=$giakm_sp;
		       	 			}
		       	 		}
		       	 		$gia_sp_have_baohanh=$gia_sp+$gia_goibaohanh;	
		       	 		$total+=$cart['qty']*$gia_sp_have_baohanh;
		       	 	?>
	       			<tr>
			            <td>
			            	<a href="<?php echo URL.$url_sp; ?>" title="<?php echo $ten_sp; ?>" ><?php echo $ten_sp; ?></a> x <?php echo $cart['qty']; ?> <br>
			            	<b><?php echo $text_thuoctinh; ?></b>	
			            </td>
			            <td><strong><?php echo number_format($cart['qty']*$gia_sp); ?><span class="Price-currencySymbol">₫</span></strong></td>
			        </tr>
		        <?php } ?>
		        <tr>
	       	 		<td><b>Tổng cộng</b></td>
	       	 		<td><strong><span class="Price-amount amount"><?php echo number_format($total); ?><span class="Price-currencySymbol">₫</span></span></strong></td>
		       	</tr>
		       	<tr>
	       	 		<td><b>Số tiền trả trước</b></td>
	       	 		<td><strong><span class="Price-amount amount"><?php echo $this->functions->formatMoney($sotientratruoc); ?><span class="Price-currencySymbol">₫/<?php echo $sothangtragop;?> tháng</span></span></strong></td>
		       	</tr>
		       <tr>
	       	 		<td><b>Góp mỗi tháng</b></td>
	       	 		<td><strong><span class="Price-amount amount"><?php echo number_format($this->functions->PMT(0.35/12,$sothangtragop,$total-$sotientratruoc)); ?><span class="Price-currencySymbol">₫</span></strong></td>
		       	</tr>
		        <tr>
	       	 		<td><b>Tổng tiền trả góp</b></td>
	       	 		<td><strong><span class="Price-amount amount"><?php echo number_format($this->functions->tongsotien_sautragop($sothangtragop,$this->functions->PMT(0.35/12,$sothangtragop,$total-$sotientratruoc),$total-$sotientratruoc,$total)); ?><span class="Price-currencySymbol">₫</span></strong></td>
		       	</tr>
		    </table>
		</div>
		<div class="col-lg-4 col-sm-4 col-xs-12 no-padding ghichu-donhang">
			<?php if($chinhanh!='' && $chinhanh!='0'){?>
				<h2 class="woocommerce-order-details__title">Chi nhánh cửa hàng</h2>
				<div class="ghichu"><?php echo $chinhanh; ?></div>
			<?php } ?>
			<h2 class="woocommerce-order-details__title">Địa chỉ thanh toán</h2>
			<ul class="diachigiaohang">
				<li>Tỉnh/Tp: <strong><?php echo $khuvuc_kh; ?></strong></li>
				<li>Địa chỉ: <strong><?php echo $diachi_kh; ?></strong></li>	
			</ul>
			<h2 class="woocommerce-order-details__title">Thời gian giao hàng</h2>
			<div class="ghichu"><?php echo $thoigiangiaohang; ?></div>
			<h2 class="woocommerce-order-details__title">Ghi chú của khách hàng</h2>
			<div class="ghichu"><?php echo $ghichu_kh; ?></div>
		</div>
		<div class="col-lg-4 col-sm-4 col-xs-12 no-padding xuly-donhang">
			<h2 class="woocommerce-order-details__title">Xử lý đơn hàng</h2>
			<select class="form-control" name="trangthai">
				<option value="<?php echo $trangthai; ?>"><?php echo $this->functions->trangthaidonhang($trangthai); ?></option>
				<option value="0">--- Chọn trạng thái đơn hàng ---</option>
				<option value="0">Chưa xử lý</option>
				<option value="1">Đang xử lý</option>
				<option value="2">Đã xử lý</option>
			</select>
			<h2 class="woocommerce-order-details__title">Ghi chú</h2>
			<textarea class="form-control" name="ghichu" rows="6"><?php echo $ghichu; ?></textarea>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary" name="update_tragop">Cập nhật</button>
				<p class="login-box-msg" id="result_setting_alert" style="display: inline;"></p>
			</div>
		</div>
		<input type="text" name="id_donhang" value="<?php echo $_GET['id']; ?>" hidden="" disabled="">
	</section>
</div>