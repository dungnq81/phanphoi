<?php $stt=0; if(!empty($posts)): foreach($posts as $post): ?>
	<?php
		echo $post_type;
		$id=$post['id'];
		$tieude=$post['ten'];
		$chuyenmuc=$post['idpostpr'];
		$ngaydang=$post['ngaydang'];
		$trangthai=$post['trangthai'];
		$url_post=$post['url'];
		
		if($trangthai==1){
			$trangthai='Đã kích hoạt';
			if($post_type=='lienhe'){
				$trangthai='Đã xem';
			}

			$btn_khoa_table='btn_khoa_table';
			$lock_fa='lock';
		}else{
			$trangthai='Chưa kích hoạt';
			if($post_type=='lienhe'){
				$trangthai='Chưa xem';
			}
			$btn_khoa_table='btn_mokhoa_table';
			$lock_fa='unlock-alt';
		}
		//-----
		if($chuyenmuc==0){
			$ten_chuyenmuc_rs='Chưa xác định';
		}else{
			$list_chuyenmuc=$chuyenmuc;
			$list_chuyenmuc_ex=explode(',',$list_chuyenmuc);
			$ten_chuyenmuc_arr=array();
			foreach($list_chuyenmuc_ex as $chuyenmuc){
				$ten_chuyenmuc=$this->admin_model->select_table_dk('post','id','='.$chuyenmuc.' ');
				foreach($ten_chuyenmuc as $row_ten_chuyenmuc){
					array_push($ten_chuyenmuc_arr, $row_ten_chuyenmuc->ten);
					$ten_chuyenmuc_rs = implode(", ", $ten_chuyenmuc_arr);
				}
			}
			
		}
		//----
		if($post_type!='post' and $post_type!='page' and $post_type!='widget' and $post_type!='slider' and $post_type!='lienhe'){
			$href_edit="?post_type=".$post_type."&edit=".$id." ";
		}
		else if($post_type=='lienhe'){
			$href_edit="mail_view?post_type=".$post_type."&view=".$id." ";
			$tieude=$this->xulychuoi->replace_name_form($tieude);
		}
		else{
			$href_edit="post_new?post_type=".$post_type."&edit=".$id." ";
		}
		
	?>	
	<tr class="list-item" id="item-<?php echo $table?>-<?php echo $id;?>" >
		<th><input type="checkbox" class="cb_post" value="<?php echo $id;?>"></th>
		<td><?php echo $tieude; ?></td>
		<td><?php echo $ten_chuyenmuc_rs; ?></td>
		<td><?php echo $ngaydang; ?></td>
		<td id="trangthai_<?php echo $table; ?>_<?php echo $id; ?>"><?php echo $trangthai; ?></td>
		<td>
			<?php if($post_type!='lienhe' and $post_type!='menu'){ ?>
				<a target="_blank" class="btn btn-primary btn_xem_table" id="btn_sua_<?php echo $table ?>_<?php echo $id ?>" href="<?php echo URL_POST.$url_post;?>" title="Xem bài viết"><i class="fa fa-eye"></i></a>
			<?php } ?>
			<button type="button" class="btn btn-primary <?php echo $btn_khoa_table; ?>" id="btn_khoa_<?php echo $table; ?>_<?php echo $id ?>" title="Khóa bài viết"><i class="fa fa-<?php echo $lock_fa; ?>"></i></button>
			<?php if($post_type=='lienhe'){ ?>
				<a class="btn btn-primary btn_sua_table" id="btn_sua_<?php echo $table ?>_<?php echo $id ?>" href="<?php echo $href_edit;?>" title="Xem chi tiết"><i class="fa fa-eye"></i></a>
			<?php }else{ ?>
				<a class="btn btn-primary btn_sua_table" id="btn_sua_<?php echo $table ?>_<?php echo $id ?>" href="<?php echo $href_edit;?>" title="Sửa bài viết"><i class="fa fa-edit"></i></a>
			<?php } ?>
			<button type="button" class="btn btn-primary btn_xoa_table" id="btn_xoa_<?php echo $table ?>_<?php echo $id ?>" title="Xóa bài viết"><i class="fa fa-trash"></i></button>
		</td>
	</tr>
<?php endforeach; else: ?>
<p>Hiện tại không có bài viết</p>
<?php endif; ?>
<?php echo $this->ajax_pagination->create_links(); ?>