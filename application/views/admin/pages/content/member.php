<section class="content" id="content_<?php echo $page_slug?>_page">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title">Thành viên đăng ký</h3>
		  <p class="login-box-msg" id="result_thanhvien_alert" style="display: inline;"></p>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
		  <table id="tbl_<?php echo $page_slug;?>" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>STT</th>
					<th>Email</th>
					<th>Họ Tên</th>
					<th>SĐT</th>
					<th>Ngày đăng ký</th>
					<th>Loại</th>
					<th>Trạng thái</th>
					<th>Thao tác</th>
				</tr>
			</thead>
			<tbody class="post-list" id="postList">
				<?php $stt=0; if(!empty($posts)): foreach($posts as $post): ?>
						<?php
							$stt++;
							$id=$post['id'];
							$email=$post['email'];
							$hoten=$post['hoten'];
							$sdt=$post['sodienthoai'];
							$ngaydangky=$post['ngaydangky'];
							$loai=$post['typethanhvien'];
							$trangthai=$post['trangthai'];
							if($trangthai==1){
								$trangthai='Đã kích hoạt';
								$btn_khoa_table='btn_khoa_table';
								$lock_fa='lock';
							}else{
								$trangthai='Chưa kích hoạt';
								$btn_khoa_table='btn_mokhoa_table';
								$lock_fa='unlock-alt';
							}
							//-----
							if($loai=='phuhuynh'){
								$loai='Phụ huynh';
							}else if($loai=='giasu'){
								$loai='Gia sư';
							}
							else if($loai=='tuyensinh'){
								$loai='Cộng tác viên';
							}
						?>	
						<tr class="list-item" id="item-<?php echo $table?>-<?php echo $id;?>">
							<td><?php echo $stt; ?></td>
							<td><?php echo $email; ?></td>
							<td><?php echo $hoten; ?></td>
							<td><?php echo $sdt; ?></td>
							<td><?php echo $ngaydangky; ?></td>
							<td><?php echo $loai; ?></td>
							<td id="trangthai_<?php echo $table; ?>_<?php echo $id; ?>"><?php echo $trangthai; ?></td>
							<td>
								<a href="<?php echo URL_AD.'infor_user?id='.$id; ?>" title="Xem thành viên <?php echo $hoten; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
								<button type="button" class="btn btn-primary <?php echo $btn_khoa_table ?>" id="btn_khoa_<?php echo $table; ?>_<?php echo $id ?>"><i class="fa fa-<?php echo $lock_fa; ?>"></i></button>
								<button type="button" class="btn btn-primary btn_xoa_table" id="btn_xoa_<?php echo $table ?>_<?php echo $id ?>"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
				<?php endforeach; else: ?>
					<p>Post(s) not available.</p>
				<?php endif; ?>
					<div class="pagination"><?php echo $pagination; ?></div>
					<div class="loading" style="display: none;"><div class="content"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i></div></div>
			<tbody>
			<tfoot>
				<tr>
				  <th>STT</th>
				  <th>Email</th>
				  <th>Họ Tên</th>
				  <th>SĐT</th>
				  <th>Loại</th>
				  <th>Ngày đăng ký</th>
				  <th>Trạng thái</th>
				  <th>Thao tác</th>
				</tr>
			</tfoot>
		  </table>
		</div>
		<!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>
