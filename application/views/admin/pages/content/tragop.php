<section class="content" id="content_<?php echo $page_slug?>_page">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title"><?php echo $page_des; ?></h3>
		  <p class="login-box-msg" id="result_thanhvien_alert" style="display: inline;"></p>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
		  <table id="tbl_<?php echo $page_slug;?>" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>STT</th>
					<th>Mã đơn hàng</th>
					<th>Họ Tên</th>
					<th>SĐT</th>
					<th>Ngày tạo</th>
					<th>Ngày cập nhật</th>
					<th>Trạng thái</th>
					<th>Thao tác</th>
				</tr>
			</thead>
			<tbody class="post-list" id="postList">
				<?php $stt=0; if(!empty($posts)): foreach($posts as $post): ?>
						<?php
							$stt++;
							$id=$post['id'];
							$id_donhang=$post['id_tragop'];
							$ngaytao=$post['ngaytao'];
							$ngaycapnhat=$post['ngaycapnhat'];
							$trangthai=$this->functions->trangthaidonhang($post['trangthai']);

							$vl_khachhang=($post['vl_khachhang']);
							$ten_khachang=explode('*+++*', $vl_khachhang)[0];
							$sdt_khachhang=explode('*+++*', $vl_khachhang)[1];
						?>	
						<tr class="list-item trangthai-<?php echo $post['trangthai']; ?>" id="item-<?php echo $table?>-<?php echo $id;?>">
							<td><?php echo $stt; ?></td>
							<td><?php echo $id_donhang; ?></td>
							<td><?php echo $ten_khachang; ?></td>
							<td><?php echo $sdt_khachhang; ?></td>
							<td><?php echo $ngaytao; ?></td>
							<td><?php echo $ngaycapnhat; ?></td>
							<td><?php echo $trangthai; ?></td>
							<td>
								<a href="<?php echo URL_AD.'view_tragop?id='.$id; ?>" title="Xem đơn hàng <?php echo $id_donhang; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
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
					<th>Mã đơn hàng</th>
					<th>Họ Tên</th>
					<th>SĐT</th>
					<th>Ngày tạo</th>
					<th>Ngày cập nhật</th>
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
