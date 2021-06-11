<div class="block-new marginBottom30-pc">
	<h2 class="fontSize28 txt-36 fontSize20-mb pl12mb pr12mb">Danh sách hồ sơ</h2>
	<div class="result-box new-result-box marginTop15 paddingBottom10">
		<div class="row th-box tr-box hidden-xs">
			<div class="td-box col-xs-12 col-sm-6">Thông tin gia sư</div>
			<div class="td-box col-xs-12 col-sm-2">Mức lương</div>
			<div class="td-box col-xs-12 col-sm-2">Tỉnh/TP</div>
			<div class="td-box col-xs-12 col-sm-2">Ngày đăng ký</div>
		</div>
			<?php
				$infor_hs=$this->page_model->select_table('hoso');
				foreach($infor_hs as $row_gs){
					$id_hs=$row_gs->id;		
					$id_tv=$row_gs->id_tv;								
					$monday=$row_gs->monday;
					$mucluong=$row_gs->luong;
					$tinhday=$row_gs->tinhday;
					$thoigianday=$row_gs->thoigianday;
					$yeucaukhac=$row_gs->yeucaukhac;
					$ngaydang=date('d/m/Y', strtotime($row_gs->ngaydang));
					
					$list_chuyenmuc_ex=explode(',',$monday);
					$ten_chuyenmuc_arr=array();
					foreach($list_chuyenmuc_ex as $chuyenmuc){
						$ten_chuyenmuc=$this->page_model->select_table_dk('post','id','='.$chuyenmuc.' ');
						foreach($ten_chuyenmuc as $row_ten_chuyenmuc){
							array_push($ten_chuyenmuc_arr, $row_ten_chuyenmuc->ten);
							$monday = implode(", ", $ten_chuyenmuc_arr);
						}
					}
					
					$lopday=$row_gs->lopday;
					$list_chuyenmuc_ex=explode(',',$lopday);
					$ten_chuyenmuc_arr=array();
					foreach($list_chuyenmuc_ex as $chuyenmuc){
						$ten_chuyenmuc=$this->page_model->select_table_dk('post','id','='.$chuyenmuc.' ');
						foreach($ten_chuyenmuc as $row_ten_chuyenmuc){
							array_push($ten_chuyenmuc_arr, $row_ten_chuyenmuc->ten);
							$lopday = implode(", ", $ten_chuyenmuc_arr);
						}
					}
					
					$ten=$this->page_model->select_value_table_dk_col('thanhvien','id','="'.$id_tv.'"','hoten');
					$tinhday=$this->page_model->select_value_table_dk_col('post','id','="'.$tinhday.'"','ten');
					$thoigianday=$this->page_model->select_value_table_dk_col('post','id','="'.$thoigianday.'"','ten');
					$group_lop=$monday.' - '.$lopday;
					$link_hs=URL.'ho-so/'.$this->xulychuoi->to_slug_style_1($ten).'-'.$id_hs;
			?>
		<div class="row margin0 normal-job paddingTop10">
			<div class="row tr-box job-info  ">
					<div class="td-box col-xs-12 col-sm-6">
						<h2 class="job-name margin0">
							<a href="<?php echo $link_hs; ?>"><?php echo $ten; ?></a>
						</h2>
						<a title="<?php echo $ten; ?>" href="<?php echo $link_hs;?>" class="com-name text-gray fontSize14"><?php echo $group_lop; ?></a>
					</div>
					<div class="td-box col-xs-4 col-sm-2 col-rev-2">
						<span class="icon-24 icon-13-20 icon-dolar-small "></span><?php echo $mucluong; ?>    
					</div>
					<div class="td-box col-xs-4 col-sm-2 col-rev-1">
						<span class="icon-24 icon-13-20 icon-address-small"></span>
						<span title="Hồ Chí Minh"><?php echo $tinhday; ?></span>
					</div>
						<div class="td-box col-xs-4 col-sm-2">
						<span class="icon-24 icon-13-20 icon-clock-small "></span><?php echo $ngaydang; ?>
					</div>
			</div>
		</div>				
<?php }?>
	</div>
	<div class="alignCenter marginBottom10 marginTop20 pl12mb pr12mb">
		 <a href="<?php echo URL;?>danh-sach-ho-so" class="btn btn-see-more fontSize16 font500 w320 w100p-mb"> <i class="icon-24 icon-24-17 icon-add-item"></i> XEM THÊM HỒ SƠ </a>
	</div>
</div>