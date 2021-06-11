<?php
	$thongtin_sp=$this->page_model->select_table_dk('sanpham','id_sanpham=',$id_sanpham);
	$price_km='';
	if($thongtin_sp){
		foreach ($thongtin_sp as $value_sp) {
			$meta_value=json_decode($value_sp->meta_value,true);
			if($value_sp->meta_value=='null'){
				$gia=$value_sp->gia;
				$giakhuyenmai=$value_sp->giakhuyenmai;
			}else{
				$min_price = $meta_value[0][2];
				foreach ($meta_value as $key=> $value) { 
					$gia=str_replace("*","-", $value[2]);
					$giakhuyenmai=str_replace("*","-", $value[3]);
					if($min_price > $gia && $gia!=0) { 
						$min_price = $gia;
			            if($giakhuyenmai!=''){
							$gia= $this->functions->formatMoney($giakhuyenmai);
						}else{
							$gia= $this->functions->formatMoney($gia);
						}
			        }else{
			        	$gia =$this->functions->formatMoney($min_price);
			        } 
				}
			}
			if($gia==0){
				$gia='Liên hệ';
				$giakhuyenmai='';
			}else{
				if($giakhuyenmai>0){
					$price_km='price-km';
					$phantramgiamgia='- '.round(100-($giakhuyenmai*100/$gia),1).' %';
					$giakhuyenmai='<div class="ribbon"><div class="rib">'.$phantramgiamgia.'</div></div><span class="price-amount">'.$this->functions->formatMoney($giakhuyenmai).'<span class="price-currencySymbol">₫</span></span>';
				}else{
					$giakhuyenmai='';
					$price_km='';
				}
				$gia=$gia.'<span class="price-currencySymbol">₫</span>';
			} ?>
			<div class="price-group price-sp-dmsp">
				<div class="variation-price">
					<span class="price">
						<?php echo $giakhuyenmai;?>
						<span class="price-amount <?php echo $price_km; ?>"><?php echo $this->functions->formatMoney($gia);?></span>
				</div>
			</div>
		<?php } 
	}
?>
