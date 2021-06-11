<section class="content" id="content_<?php echo $page_slug?>_page">
  <div class="row result-box3">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title"><?php echo $page_title; ?></h3>
		  <p class="login-box-msg" id="result_thanhvien_alert" style="display: inline;"></p>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
		  <table id="tbl_<?php echo $page_slug;?>" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>STT</th>
					<th>Mã hồ sơ</th>
					<th>Môn dạy</th>
					<th>Lớp dạy</th>
					<th>Tỉnh dạy</th>
					<th>Lương</th>
					<th>Ngày đăng</th>
					<th>Trạng thái</th>
					<th>Thao tác</th>
				</tr>
			</thead>
			<tbody class="post-list" id="postList">
				<?php $stt=0; if(!empty($posts)): foreach($posts as $post): ?>
						<?php
							$stt++;
							$id=$post['id'];
							$mahoso=$post['mahoso'];	
							
							$monday=$post['monday'];
							$list_chuyenmuc_ex=explode(',',$monday);
							$ten_chuyenmuc_arr=array();
							foreach($list_chuyenmuc_ex as $chuyenmuc){
								$ten_chuyenmuc=$this->page_model->select_table_dk('post','id','='.$chuyenmuc.' ');
								foreach($ten_chuyenmuc as $row_ten_chuyenmuc){
									array_push($ten_chuyenmuc_arr, $row_ten_chuyenmuc->ten);
									$monday = implode(", ", $ten_chuyenmuc_arr);
								}
							}
							
							$lopday=$post['lopday'];
							$list_chuyenmuc_ex=explode(',',$lopday);
							$ten_chuyenmuc_arr=array();
							foreach($list_chuyenmuc_ex as $chuyenmuc){
								$ten_chuyenmuc=$this->page_model->select_table_dk('post','id','='.$chuyenmuc.' ');
								foreach($ten_chuyenmuc as $row_ten_chuyenmuc){
									array_push($ten_chuyenmuc_arr, $row_ten_chuyenmuc->ten);
									$lopday = implode(", ", $ten_chuyenmuc_arr);
								}
							}
							
							$tinhday=$post['tinhday'];
							$list_chuyenmuc_ex=explode(',',$tinhday);
							$ten_chuyenmuc_arr=array();
							foreach($list_chuyenmuc_ex as $chuyenmuc){
								$ten_chuyenmuc=$this->page_model->select_table_dk('post','id','='.$chuyenmuc.' ');
								foreach($ten_chuyenmuc as $row_ten_chuyenmuc){
									array_push($ten_chuyenmuc_arr, $row_ten_chuyenmuc->ten);
									$tinhday = implode(", ", $ten_chuyenmuc_arr);
								}
							}
							
							$luong=$post['luong'];
							$ngaydang=$post['ngaydang'];
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
						?>	
						<tr class="list-item" id="item-<?php echo $table?>-<?php echo $id;?>">
							<td><?php echo $stt; ?></td>
							<td><?php echo $mahoso; ?></td>
							<td><?php echo $monday; ?></td>
							<td><?php echo $lopday; ?></td>
							<td><?php echo $tinhday; ?></td>
							<td><?php echo $luong; ?></td>
							<td><?php echo $ngaydang; ?></td>
							<td id="trangthai_<?php echo $table; ?>_<?php echo $id; ?>"><?php echo $trangthai; ?></td>
							<td>
								<button type="button" class="btn btn-primary <?php echo $btn_khoa_table ?>" id="btn_khoa_<?php echo $table; ?>_<?php echo $id ?>"><i class="fa fa-<?php echo $lock_fa; ?>"></i></button>
								<button type="button" class="btn btn-primary btn_xoa_table" id="btn_xoa_<?php echo $table ?>_<?php echo $id ?>"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
				<?php endforeach; else: ?>
					<p>Post(s) not available.</p>
				<?php endif; ?>
				<?php echo $this->ajax_pagination->create_links(); ?>
					<div class="loading" style="display: none;"><div class="content"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i></div></div>
			<tbody>
			<tfoot>
				<tr>
					<th>STT</th>
					<th>Mã hồ sơ</th>
					<th>Môn dạy</th>
					<th>Lớp dạy</th>
					<th>Tỉnh dạy</th>
					<th>Lương</th>
					<th>Ngày đăng</th>
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
