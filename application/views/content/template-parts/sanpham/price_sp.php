<?php
	if(isset($gia) && $gia==0){
		$gia='Liên hệ';
		$giakhuyenmai='';
		$price_km='';
		$gia_number=0;
	}else{
		if(isset($giakhuyenmai) && $giakhuyenmai>0){
			$price_km='price-km';
			// $giakhuyenmai='<span class="price-amount">'.$this->functions->formatMoney($giakhuyenmai).'<span class="price-currencySymbol">₫</span></span>';
			$phantramgiamgia='- '.round(100-($giakhuyenmai*100/$gia),1).' %';
			$giakhuyenmai='<div class="ribbon"><div class="rib">'.$phantramgiamgia.'</div></div><span class="price-amount">'.$this->functions->formatMoney($giakhuyenmai).'<span class="price-currencySymbol">₫</span></span>';
		}else{
			$giakhuyenmai='';
			$price_km='';
		}
		if(isset($gia)) {
			$gia_number=$gia;
			$gia=$gia.'<span class="price-currencySymbol">₫</span>';
		}

	}
	$arr_meta_value=json_decode($meta_value,true);
	$arr_meta=json_decode($meta,true);
	$arr_meta_value_baohanh=json_decode($meta_value_baohanh,true);
	$arr_meta_baohanh=json_decode($meta_baohanh,true);
	$data_meta['meta_value']=$arr_meta_value;
	$data_meta['meta']=$arr_meta;
	$data_meta['meta_value_baohanh']=$arr_meta_value_baohanh;
	$data_meta['meta_baohanh']=$arr_meta_baohanh;
?>
<?php if($meta=='[["undefined"]]' || $meta=='null'){//gia thuong ?>
	<?php $this->load->view('content/template-parts/sanpham/goibaohanh_sp',$data_meta); //goibaohanh ?>
	<div class="price-group">
		<div class="variation-price">
			<span class="price_baohanh" hidden><?php echo $gia; ?></span>
			<span class="price"><?php echo $giakhuyenmai;?><span class="price-amount <?php echo $price_km; ?>"><?php echo $this->functions->formatMoney($gia);?></span></span>
		</div>
	</div>
	<?php if($mota_post){ ?>
		<div id="thongtin_sp" class="block-info">
			<div class="block-content">
				<div class="scrollbar"><?php echo $mota_post; ?></div>
			</div>
		</div>
	<?php } ?>
	<?php if($gia_number>0){ ?>
		<div class="btn_submit_addtocart">
			<input type="number" name="number_pr_to_cart" value="1" class="number_pr_to_cart" min="1">
			<button type="submit" class="single_add_to_cart_button button alt">MUA NGAY<span>Giao tận nơi hoặc nhận ở cửa hàng</span></button>
		</div>
	<?php } ?>
<?php }else{ 
	$this->load->view('content/template-parts/sanpham/price_varible',$data_meta); 
} 
?>
<!--<div class="group_btn_tragop">
	<a class="single_tu_van_tra_gop_form button alt" title="Tư vấn trả góp lãi suất thấp qua điện thoại">Tư vấn trả góp lãi suất thấp<span>QUA ĐIỆN THOẠI</span></a>
	<a class="single_tu_van_tra_gop_button button alt" title="MUA TRẢ GÓP 0% THỦ TỤC ĐƠN GIẢN">MUA TRẢ GÓP 0%<span>THỦ TỤC ĐƠN GIẢN</span></a>	
</div>-->
<div class="group_field_ct">
	<div class="col large-4">
		<div class="block-promotion">
			<?php
				$wg_ct=$this->page_model->select_table_2dk('post','id','=711','trangthai','=1');
			?>
			<div class="block-content">
				<div class="scrollbar"><?php echo $this->functions->widget_content($wg_ct,''); ?></div>
			</div>
		</div>
	</div>
</div>   
