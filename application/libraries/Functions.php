<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Functions 
{	
	function PMT($interest,$num_of_payments,$PV,$FV = 0.00, $Type = 0){
		$xp=pow((1+$interest),$num_of_payments);
		$kq=($PV* $interest*$xp/($xp-1)+$interest/($xp-1)*$FV)*
			($Type==0 ? 1 : 1/($interest+1));
		$check_lamtron=substr($kq,-3)/100;	
		if($check_lamtron>0){
			$round_kq=round($kq);
			$kq_rs=substr($round_kq,0,strlen($round_kq)-3)*1000;	
			$kq_rs=$kq_rs+1000;
		}else{
			$kq_rs=round($kq,-3);
		}
		return $kq_rs+14000;
	}
	function tonglai($sothang,$pmt,$khoanvay){
		$kq=($sothang*$pmt)-$khoanvay;
		return $kq;
	}
	function tongsotien_sautragop($sothang,$pmt,$khoanvay,$tongsotien){
		$kq=$this->tonglai($sothang,$pmt,$khoanvay)+$tongsotien;
		return $kq;
	}
	function edit_sanpham_with_user($id_sanpham) {
		if(isset($_SESSION['user_admin'])){
			echo '<a href="'.base_url().'admin/post_new?post_type=sanpham&edit='.$id_sanpham.'" title="Chỉnh sửa sản phẩm" target="_blank" class="edit_post_home" hidden-xs hidden-sm><i class="fa fa-edit"></i></a>';
		}else{
			echo '';
		}
	}
	function name_pr_thuoctinhsp($thuoctinh) {
		$CI =& get_instance();
 	    $CI->load->model('page_model'); 
 	    $idpostpr_thuoctinh=$CI->page_model->select_table_dk_col_get_1value('post','ten="'.$thuoctinh.'"','idpostpr');
 	    if($idpostpr_thuoctinh){
 	    	$idpostpr_thuoctinh_name=$CI->page_model->select_table_dk_col_get_1value('post','id="'.$idpostpr_thuoctinh.'"','ten');
 	    }else{
 	    	$idpostpr_thuoctinh_name='';
 	    }
 	    return $idpostpr_thuoctinh_name;
	}
	function url_pr_thuoctinhsp($thuoctinh) {
		$CI =& get_instance();
 	    $CI->load->model('page_model'); 
 	    $idpostpr_thuoctinh=$CI->page_model->select_table_dk_col_get_1value('post','ten="'.$thuoctinh.'"','idpostpr');
 	    if($idpostpr_thuoctinh){
 	    	$idpostpr_thuoctinh_name=$CI->page_model->select_table_dk_col_get_1value('post','id="'.$idpostpr_thuoctinh.'"','url');
 	    }else{
 	    	$idpostpr_thuoctinh_name='';
 	    }
 	    return $idpostpr_thuoctinh_name;
	}
	function array_ten_thuoctinh($arrayName = array(), $vitri) {
		$x_arr=array();;
		foreach ($arrayName as $key=> $value) { 
			$x1=explode(' * ', $value[0]);
			if(!in_array($x1[$vitri], $x_arr)){
	      		$x_arr[]=$x1[$vitri];
	        }		
		}
		return $x_arr;
	}
	function trangthaidonhang($number) {
		if($number==0){
			$kq='Chưa xử lý';
		}
		else if($number==1){
			$kq='Đang xử lý';
		}
		else if($number==2){
			$kq='Đã xử lý';
		}
	    return $kq;  
	}
	function formatMoney($number, $fractional=false) {
		if($number>1){
			if ($fractional) {  
				$number = sprintf('%.2f', $number);  
			}  
			while (true) {  
				$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);  
				if ($replaced != $number) {  
					$number = $replaced;  
				} else {  
					break;  
				}  
			}  
		}
	    return $number;  
	}
	function widget_content($wg_ct,$title_gr) {
		if($wg_ct){
			echo '<div class="wg-content-gr"><h2 class="wg-title-gr">'.$title_gr.'</h2>';
			echo '<div class="wg-content-details">';
				foreach($wg_ct as $wg){
					$ten_wg=$wg->ten;
					$noidung_wg=$wg->noidung;?>
						<div class="wg-content col-lg-12 col-md-12 col-xs-12">
							<h3 class="wg-title"><?php echo $ten_wg; ?></h3>
							<div class="wg-details"><?php echo $noidung_wg; ?></div>
						</div>
				<?php }
				echo '</div>';
			echo '</div>';
		}
	}
	function menu($categories, $current_url, $parent_id = 0)
	{
		$cate_child = [];
		foreach ($categories as $key => $item)
		{	
			if ($item->idpostpr == $parent_id)
			{
				$cate_child[] = $item;
				unset($categories[$key]);
			}
		}
		if ($cate_child)
		{
			echo '<ul class="menu-item-gr">';
			foreach ($cate_child as $item)
			{
				if($item->menu_link!=""){
					$link_menu=URL.$item->menu_link;
				}else{
					if($item->url=='/'){
						$link_menu=URL;
					}else{
						$link_menu=URL.$item->url;
					}
					
				}
				// echo $current_url;
				$current_css='';
				if($current_url==$link_menu){
					$current_css='current-menu';
				}
				echo '<li class="menu-item menu-item-'.$item->id.' '.$current_css.'">';
					if($item->anhdaidien!=''){
						echo '<img src="'.UPLOAD_URL.$item->anhdaidien.'" />';
					}
					echo '<a href="'.$link_menu.'" title="'.$item->ten.'">'.$item->ten.'</a>';
						 $this->menu($categories,$current_url, $item->id);
				 	echo '</li>';
			}
			echo '</ul>';
		}
	}
}
?>