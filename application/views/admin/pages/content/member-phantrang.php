<?php if(!empty($posts)): foreach($posts as $post): ?>
	<?php
		$stt=1;
		$id=$post['id'];
		$email=$post['email'];
		$hoten=$post['hoten'];
		$sdt=$post['sodienthoai'];
		$ngaydangky=$post['ngaydangky'];
		$loai=$post['typethanhvien'];
		$trangthai=$post['trangthai'];
		if($trangthai==1){
			$trangthai='Đã kích hoạt';
			$btn_khoa_member='btn_khoa_member';
			$lock_fa='lock';
		}else{
			$trangthai='Chưa kích hoạt';
			$btn_khoa_member='btn_mokhoa_member';
			$lock_fa='unlock-alt';
		}
		//-----
		if($loai=='nguoitimviec'){
			$loai='Người tìm việc';
		}else if($loai=='nhatuyendung'){
			$loai='Nhà tuyển dụng';
		}
		else if($loai=='tuyensinh'){
			$loai='Cộng tác viên';
		}
	?>	
	<tr class="list-item">
		<td><?php echo $stt; ?></td>
		<td><?php echo $email; ?></td>
		<td><?php echo $hoten; ?></td>
		<td><?php echo $sdt; ?></td>
		<td><?php echo $ngaydangky; ?></td>
		<td><?php echo $loai; ?></td>
		<td id="trangthai_member_<?php echo $id; ?>"><?php echo $trangthai; ?></td>
		<td>
			<a href="<?php echo URL_AD.'infor_user?id='.$id; ?>" title="Xem thành viên <?php echo $hoten; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
			<button type="button" class="btn btn-primary <?php echo $btn_khoa_member ?>" id="btn_khoa_member_<?php echo $id ?>"><i class="fa fa-<?php echo $lock_fa; ?>"></i></button>
			<button type="button" class="btn btn-primary" id="btn_xoa_member"><i class="fa fa-trash"></i></button>
		</td>
	</tr>
<?php endforeach; else: ?>
<p>Post(s) not available.</p>
<?php endif; ?>
<?php echo $this->ajax_pagination->create_links(); ?>