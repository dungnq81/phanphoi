<div class="container no-padding post-wrapper">



	<h2 class="title-post"><?php echo $ten_post; ?></h2>



	<div class="details-post-gr">



		<div class="col-lg-12 col-md-12 col-xs-12 no-padding details-post details-giohang main-page">



			<?php $this->load->view('content/template-parts/breadcrumb',$ten_postpr_post);  ?>



			<div class="entry-post list-cart">



				<?php if($this->cart->contents()){ ?>

					<div class="col-lg-8 col-sm-8 col-xs-12 no-padding details-tragop-tbl">

						<div class="boxresult infor-sp-tragop">

							<div class="col-lg-12 col-sm-12 col-xs-12 no-padding details-giohang-tbl details-tragop-tbl">



							    <table border="1" class="list-cart-tbl">



							        <tr>



							        	<td>Ảnh đại diện</td>	



							            <td>Thông tin</td>



							            <td>Gói bảo hành</td>



							            <td>Giá</td>



							            <td>Số lượng</td>



							            <td>Tổng</td>



							            <td>Xóa</td>



							            <td>Cập nhật</td>



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



													<a href="<?php echo $url_sp; ?>" title="<?php echo $ten_sp; ?>" ><img loading="lazy" src="<?php echo UPLOAD_URL.$anhdaidien_sp; ?>" class="img-post-avt" alt="<?php echo $ten_sp; ?>" style="width:60px" /></a>



												<?php }else{?>



													<a href="<?php echo $url_sp; ?>" title="<?php echo $ten_sp; ?>" ><img loading="lazy" src="<?php echo UP_POST_THUMB ?>no_image.jpg" class="img-post-avt" alt="<?php echo $ten_sp; ?>"/></a>



												<?php } ?>	



								            </td>



								            <td>



								            	<a href="<?php echo $url_sp; ?>" title="<?php echo $ten_sp; ?>" ><?php echo $ten_sp; ?></a><br>



								            	<b><?php echo $text_thuoctinh; ?></b>



								            		



								            </td>



								             <td><?php echo $goibaohanh; ?></td>



								            <td><?php echo number_format($gia_sp); ?></td>



								            <td><input type="number" value="<?php echo $cart['qty']; ?>" name="number_qty_sp" min="1" id="<?php echo $cart['rowid']; ?>"></td>



								            <td><b><?php echo number_format($cart['qty']*$gia_sp_have_baohanh); ?></b></td>



								            <td><a class="delete_tragop" id="<?php echo $cart['rowid']; ?>"><i class="fa fa-trash"></i></a></td>



								            <td><button type="submit" class="button" name="update_tragop" value="Cập nhật giỏ hàng" disabled="">Cập nhật</button></td>



								        </tr>



							        <?php } ?>



							    </table>



							</div>

						</div>



						<div class="boxresult">

                            <div class="infocard">

                                <div class="tabslink">

									<a class="href_tabslink current" data-code="tragop_tindung1" data-value="Qua thẻ tín dụng (đến shop quẹt thẻ, nhận máy ngay không cần xét duyệt)">

										<div class="dt_tabs">

											<i class="fa fa-credit-card"></i>Qua thẻ tín dụng <span>(đến shop quẹt thẻ, nhận máy ngay không cần xét duyệt)</span>

										</div>

									</a>



									<a class="href_tabslink" data-code="tragop_tindung2" data-value="Qua thẻ tín dụng (online tại nhà, giao hàng tận nơi, không cần xét duyệt)">

										<div class="dt_tabs">

											<i class="fa fa-cc-discover"></i>Qua thẻ tín dụng<span>(online tại nhà, giao hàng tận nơi, không cần xét duyệt)</span>

										</div>

									</a>

									<a class="href_tabslink" data-code="tragop_tindung1" data-value="Qua công ty tài chính (đến shop nhận máy từ 15 đến 45 phút, lãi suất thấp)">

										<div class="dt_tabs">

										    <i class="fa fa-user"></i>Qua công ty tài chính<span>(đến shop nhận máy từ 15 đến 45 phút, lãi suất thấp)</span>

										</div>

									</a>

							   	</div> 

        

                                <div class="paymentMethod">

                                    <table border="1" class="list-tragop-tbl">

								        <tr>

								        	<td>Giá sản phẩm</td>	

											<td colspan="3"><?php echo number_format($total); ?></td>

								        </tr>

								        <tr>

								        	<td>Khoản trả trước</td>

								        	<td colspan="3"><input type="text" name="sotientratruoc_tragop" value="" placeholder="Nhập số tiền" autofocus=""></td>

								        </tr>

								       	<tr>

								        	<td>Khoản vay</td>

								        	<td colspan="3" class="khoanvay_tragop"><?php echo number_format($total); ?></td>

								        </tr>

								         <tr>

								            <td colspan="4" class="note_tragop">Khách hàng muốn vay > 20 triệu thì trực tiếp đến cửa hàng để được hướng dẫn</td>

								        </tr>

								        <tr style="background: #fd5622;color: white;">

								        	<td>KÌ HẠN</td>

								        	<td>Số Tiền Góp Mỗi Tháng (đã cộng phí đóng tiền hàng tháng 14k)</td>

								        	<td>Tổng Lãi</td>

								        	<td>Tổng tiền sau trả góp</td>

								        </tr>

										<?php 

							          		$i=0;

							          		while ($i<18) {

							          			$i+=3;?>

							          				<tr>

							          					<td>

							          						<label class="chonmua_tragop_gr">

							          							<input type="radio" name="chonmua_tragop" id="chonmua_<?php echo $i ?>" value="<?php echo $i ?>"><span class="checkmark"></span>

							          						</label> <b style="padding-left: 25px;"><?php echo $i; ?> tháng</b> 

							          					</td>

								          				<td id="gopmoithang_<?php echo ($i/3-1); ?>"><?php echo number_format($this->functions->PMT(0.35/12,$i,$total)); ?></td>

														<td id="tonglai_<?php echo ($i/3-1); ?>"><?php echo number_format( (($this->functions->PMT(0.35/12,$i,$total))*$i)-$total); ?></td>

								          				<td id="tongtientragop_<?php echo ($i/3-1); ?>"><?php echo number_format($this->functions->tongsotien_sautragop($i,$this->functions->PMT(0.35/12,$i,$total),$total,$total)) ?></td>

							          				</tr>

							          		<?php }

							          	?>

							          	<tr>

								            <td colspan="4" style="color: #fd5622;">* Lãi suất dao động từ 1.67</td>

								        </tr>

								       

								    </table>

                                </div>



                            </div>

                        </div>	

					</div>



					<div class="col-lg-4 col-sm-4 col-xs-12 no-padding details-infor-user-tragop">

						<div class="frm-tragop" id="form-content-tragop">

							<h3>THÔNG TIN NGƯỜI MUA</h3>

							<div role="form" class="wpcf7">

								<form class="wpcf7-form" name="form-tragop-cs">

									<input type="text" name="hoten" placeholder="Vui lòng nhập tên *" required="" autofocus="">

									<input type="number" name="sodienthoai" placeholder="Vui lòng nhập số điện thoại *" required="">

									<input type="email" name="email" placeholder="Vui lòng nhập email" >

									<div class="form-control-gr tragop_tindung" id="tragop_tindung1">

										<select class="form-control" name="chinhanh">

											<option value="0">Chọn chi nhánh đến quẹt thẻ nhận máy</option>

											<option value="CN1: 194B Trần Quang Khải, P. Tân Định , Q.1">CN1: 194B Trần Quang Khải, P. Tân Định , Q.1</option>

											<option value="CN2: 369 Hoàng Văn Thụ, P.2, Quận Tân Bình">CN2: 369 Hoàng Văn Thụ, P.2, Quận Tân Bình</option>

											<option value="CN3: 522 Đường 3 Tháng 2, P.14, Quận 10">CN3: 522 Đường 3 Tháng 2, P.14, Quận 10</option>

										</select>

									</div>

									<div class="form-control-gr tragop_tindung" id="tragop_tindung2" hidden="">

										<select name="thanhpho" class="form-control" required="">

											<option value="TP. Hồ Chí Minh">--- Vui lòng chọn Tỉnh/Thành phố ---</option>

											<?php 

												$thanhpho=$this->page_model->select_table_dk_col_get('post','typepost="diadiem"','ten');

												foreach ($thanhpho as $value) {

													echo "<option value='".$value->ten."'>".$value->ten."</option>";

												}

											?>

										</select>

										<input type="text" name="diachi" placeholder="Vui lòng nhập địa chỉ">

										<div class="box-timeship">

											<label class="chonmua_tragop_gr">Giao hàng trong 1 giờ <input type="radio" name="timeship" id="timeship_1" value="Giao hàng trong 1 giờ"><span class="checkmark"></span></label>

											<label class="chonmua_tragop_gr">Giao hàng trong ngày <input type="radio" name="timeship" id="timeship_2" value="Giao hàng trong ngày"><span class="checkmark"></span></label>

											<label class="chonmua_tragop_gr">Giao hàng thời gian khác <input type="radio" name="timeship" id="timeship_3" value="Giao hàng thời gian khác"><span class="checkmark"></span></label>	

										</div>

									</div>

									<textarea name="ghichu" placeholder="Nhập ghi chú" rows="5"></textarea>

									<input type="text" name="tt_sanpham" value="<?php echo $array_cart=base64_encode(serialize($this->cart->contents())); ?>" disabled hidden>

									<input type="text" name="link_sp" placeholder="Vui lòng nhập số điện thoại" required="" hidden="" disabled="" value="<?php echo URL.$url_sp; ?>" style="display: none">

									<input type="submit" name="submit_tragop_cus" value="Đặt mua" onclick="check_tragop();">

									<div class="wpcf7-response-output"></div>

								</form>

							</div>

						</div>

					</div>





				<?php }else{ ?>



					<div class="no-cart">Chưa chọn sản phẩm để trả góp.</div>



				<?php } ?>	



			</div>



		</div>		



	</div>



</div>



<script type="text/javascript">



   	$(document).on('keyup','input[name=sotientratruoc_tragop]',function(){

	  	

		// var sothang=$('input[name=chonmua_tragop]:checked').attr('id');

		//sothang=sothang.split('chonmua_')[1];

	  	var tongsotien=<?php echo $total; ?>;

	  

	  	if(event.which >= 37 && event.which <= 40) return;



		$(this).val(function(index, value) {

			return value

			.replace(/\D/g, "")

			.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

		});

	 	var sotientratruoc=($(this).val().replace(/[^0-9\,]+/g, ''));

	 	//console.log(sotientratruoc);

	 	$('.note_tragop').empty().text('Nếu hạn mức thẻ của quý khách không đủ, vui lòng trả trước 1 khoản tiền mặt');

	 	$('input[name=submit_tragop_cus]').prop("disabled",false);

	  	if(sotientratruoc<tongsotien){

	  		if(tongsotien<=10000000 && tongsotien<20000000 && sotientratruoc<(tongsotien*0.1)){

	  			var sotien_toithieu='<?php echo number_format($total*0.1); ?>';

	  			$('.note_tragop').empty().html('Số tiền trả trước tối thiểu phải là <b style="color: #e80d0d;font-size: 15px;">'+(sotien_toithieu)+'</b>');

	  			$('input[name=submit_tragop_cus]').prop("disabled",true);

	  		}else if(tongsotien>=20000000 && (tongsotien-sotientratruoc)>20000000){

	  			$('.note_tragop').empty().text('Khoản vay tối đa là 20 triệu');

	  			$('input[name=submit_tragop_cus]').prop("disabled",true);

	  			//$('input[name=sotientratruoc_tragop]').val('');

	  		}



  			$.ajax({    

				type: 'POST',

				url: '<?php echo URL ?>page/tinh_tragop',  

				dataType:'json',

				data:{				

					'tongsotien':tongsotien,

					'sotientratruoc':sotientratruoc

				},            

				success: function(result){

					$('.khoanvay_tragop').empty().text(result[6]);		



					for(var i=0;i<result.length;i++){	

						// console.log(result);

						var gopmoithang=result[i].split('+++')[0];

						var tonglai=result[i].split('+++')[1]; 

						var tongtientragop=result[i].split('+++')[2]; 

						$('#gopmoithang_'+i).empty().text(gopmoithang);

						$('#tonglai_'+i).empty().text(tonglai);

						$('#tongtientragop_'+i).empty().text(tongtientragop);

					}	        

				}			

			});

	  		

	  		

	  	}else{

	  		$(".note_tragop" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

	  		$('input[name=sotientratruoc_tragop]').prop("disabled",true);

	  		$("input[name=submit_tragop_cus]").prop("disabled",true);

	  		setTimeout(function() {

					$('.note_tragop').empty().text('Số tiền vượt quá mức');

					$('input[name=sotientratruoc_tragop]').val('');

					$('input[name=sotientratruoc_tragop]').prop("disabled",false);

	  				$('input[name=sotientratruoc_tragop]').focus();

					$("input[name=submit_tragop_cus]").prop("disabled",false);

				},500

			);

	  		

	  	}

	  	

	});

	function check_tragop(){

		var tongsotien=<?php echo $total; ?>;

		var sotientratruoc=$('input[name=sotientratruoc_tragop]').val();

		if(tongsotien<=10000000 && tongsotien<20000000 && sotientratruoc<(tongsotien*0.1)){

			var sotien_toithieu='<?php echo number_format($total*0.1); ?>';

			$('.note_tragop').empty().html('Số tiền trả trước tối thiểu phải là <b style="color: #e80d0d;font-size: 15px;">'+(sotien_toithieu)+'</b>');

			$('input[name=submit_tragop_cus]').prop("disabled",true);

			return false;

		}else if(tongsotien>=20000000 && (tongsotien-sotientratruoc)>20000000){

			$('.note_tragop').empty().text('Khoản vay tối đa là 20 triệu');

			$('input[name=submit_tragop_cus]').prop("disabled",true);

			return false;

			//$('input[name=sotientratruoc_tragop]').val('');

		}else{

			return true;

		}

	}

</script>
