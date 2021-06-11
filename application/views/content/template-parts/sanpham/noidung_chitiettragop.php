<?php

	foreach ($infor_donhang as $value) {

		//var_dump($value);

		$vl_khachhang_ex=explode('*+++*', $value->vl_khachhang);


		$id_donhang=$value->id_tragop;

		$ngaytao=$value->ngaytao;

		$type_thanhtoan=$value->type_thanhtoan;



		$ten=$vl_khachhang_ex[0];
		$sdt=$vl_khachhang_ex[1];

		$tt_sanpham=$value->tt_sanpham;

		$sotientratruoc=$value->sotientratruoc;
		$sothangtragop=$value->sothang;

	}



	//var_dump($tt_sanpham);

	$tt_sanpham_rs=unserialize(base64_decode($tt_sanpham)); // get value sp

	//var_dump($tt_sanpham_rs);



?>



<div class="details-order">

	<p class="thankyou-order-received">Cảm ơn bạn. Yêu cầu của bạn đã được nhận, chúng tôi sẽ gọi điện để xác nhận.</p>

	<ul class="thankyou-order-details order_details">

		<li>Mã đơn hàng: <strong><?php echo $id_donhang; ?></strong></li>

		<li>Ngày: <strong><?php echo $ngaytao; ?></strong></li>

		<li>Tên: <strong><?php echo $ten; ?></strong></li>

		<li>SĐT: <strong><?php echo $sdt; ?></strong></li>

		<li class="order-overview__payment-method method">Phương thức thanh toán:<strong><?php echo $type_thanhtoan; ?></strong></li>		

	</ul>

	

	<section class="order-details">	

		<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">	

			<h2 class="woocommerce-order-details__title">Thông tin trả góp</h2>

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

		       	 		$anhdaidien_sp=$this->page_model->select_table_dk_col_get_1value('post','id= '.$id_sanpham.' ','anhdaidien');	

		       	 		$ten_sp=$this->page_model->select_table_dk_col_get_1value('post','id= '.$id_sanpham.' ','ten');	

		       	 		$url_sp=$this->page_model->select_table_dk_col_get_1value('post','id= '.$id_sanpham.' ','url');	

		       	 		$goibaohanh=($cart['option']['goibaohanh']); 

		       	 		if($goibaohanh!='Không chọn gói bảo hành'){
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

		       	 					if($value[2]!=''){

		       	 						$gia_sp=$value[2];

		       	 					}else{

		       	 						$gia_sp=$value[1];

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

			            	<a href="<?php echo $url_sp; ?>" title="<?php echo $ten_sp; ?>" ><?php echo $ten_sp; ?></a> x <?php echo $cart['qty']; ?> <br>

			            	<b><?php echo $text_thuoctinh; ?></b>	

			            </td>

			            <td><strong><?php echo number_format($cart['qty']*$gia_sp); ?><span class="Price-currencySymbol">₫</span></strong></td>

			        </tr>

		        <?php } ?>

		        <tr>

	       	 		<td><b>Tổng cộng</b></td>

	       	 		<td><strong><span class="Price-amount amount"><?php echo $this->functions->formatMoney($total); ?><span class="Price-currencySymbol">₫</span></span></strong></td>

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

	</section>

</div>