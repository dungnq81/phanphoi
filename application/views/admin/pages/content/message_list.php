<section class="content" id="content_<?php echo $page_slug?>_page">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><?php echo $page_des; ?></h3>
					<p class="login-box-msg" id="result_<?php echo $table; ?>_alert" style="display: inline;color: #E91E63"></p>
				</div>
				<div class="box-body">
					<div class="col-md-12">
						<div class="form-group col-lg-4 col-xs-12 group-action-right">
							<div class="col-lg-8 col-xs-8" style="padding: 0 2px;"><input type="text" name="title_post_filter" class="form-control" placeholder="Nhập thông tin cần tìm"></div>
							<button class="btn btn-default col-lg-4 col-xs-4" id="filter_title_post">Tìm kiếm</button>
						</div>
						<div class="form-group col-lg-3 col-xs-12 group-action">
							<select class="form-control" id="action_message_all">
								<option value="0">Tác vụ</option>
								<option value="unactive">Hủy kích hoạt</option>
								<option value="active">Kích hoạt</option>
								<option value="remove">Xóa</option>
							</select>
							<button class="btn btn-default" id="action_message_all_btn">Áp dụng</button>
							<div class="group_active col-md-12"><a href="?post_type=<?php echo $post_type; ?>&post_status=1">Đã kích hoạt(<?php echo $this->db->where('status', 1)->get('hd_messages')->num_rows()?>)</a> | <a href="?post_type=<?php echo $post_type;?>&post_status=0">Chưa kích hoạt(<?php echo $this->db->where('status', 0)->get('hd_messages')->num_rows()?>)</a></div>
							<input type="hidden" name="link_dr" value="?post_type=<?php echo $post_type;?>">
						</div>
						<table id="tbl_<?php echo $page_slug;?>" class="table table-bordered table-striped">
							<thead>
							<tr>
								<th><input type="checkbox" id="select_all"></th>
								<th>Tiêu đề</th>
								<th>Mô tả</th>
								<th>URL</th>
								<th>Ngày đăng</th>
								<th>Ngày cập nhật</th>
								<th>Trạng thái</th>
								<th>Thao tác</th>
							</tr>
							</thead>
							<tbody class="post-list" id="postList">
							<?php
							foreach ($message as $item) :
								$trangthai = '<span><svg style="width:28px" fill="green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"/></svg></span>';
								if ( !$item->status)
									$trangthai = '<span><svg style="width:28px" fill="red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M248 8C111.03 8 0 119.03 0 256s111.03 248 248 248 248-111.03 248-248S384.97 8 248 8zm176 296H72c-8.84 0-16-7.16-16-16v-64c0-8.84 7.16-16 16-16h352c8.84 0 16 7.16 16 16v64c0 8.84-7.16 16-16 16z"/></svg></span>';

								$href_edit = URL . 'admin/post_new?post_type=message&edit=' . $item->id
								?>
								<tr class="list-item" id="item-hd_messages-<?=$item->id?>" >
									<td><input type="checkbox" class="cb_post" value="<?php echo $item->id;?>"></td>
									<td><?php echo $item->title; ?></td>
									<td><?php echo $item->content; ?></td>
									<td><a target="_blank" title href="<?php echo $item->url; ?>" style="color:red">Xem chi tiết</a></td>
									<td><?php echo date( 'd/m/Y H:i:s', $item->created_at); ?></td>
									<td><?php echo date( 'd/m/Y H:i:s', $item->updated_at); ?></td>
									<td><?php echo $trangthai; ?></td>
									<td>
										<a class="btn btn-primary btn_sua_table" href="<?php echo $href_edit;?>" title="Sửa thông tin"><i class="fa fa-edit"></i></a>
										<button type="button" class="btn btn-primary btn_message_row_remove" data-id="<?=$item->id?>" title="Xóa thông tin" role="button"><i class="fa fa-trash"></i></button>
									</td>
								</tr>
							<?php endforeach;?>
							</tbody>
							<tfoot>
							<tr>
								<th><input type="checkbox" id="select_all"></th>
								<th>Tiêu đề</th>
								<th>Mô tả</th>
								<th>URL</th>
								<th>Ngày đăng</th>
								<th>Ngày cập nhật</th>
								<th>Trạng thái</th>
								<th>Thao tác</th>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function () {
		$('#select_all').click(function () {
			var c = this.checked;
			$(':checkbox').prop('checked', c);
		});

		// remove row
		var btn_message_row_remove = $(".btn_message_row_remove");
		btn_message_row_remove.on('click', function (e) {
			var id = $(this).data('id');
			$('.login-box-msg').html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i> đang xử lý ... ');
			if (confirm('Bạn có chắc muốn xóa khách hàng này?') === true) {
				$.ajax({
					context: this,
					url: 'message_row_remove/' + id,
					type: 'POST',
					data: $(this).serializeArray(),
					beforeSend: function () {
						$(this).prop('disabled', true);
					},
					success: function (data) {
						$(this).prop('disabled', false);
						$(this).closest('tr').remove();
						$(".login-box-msg").html('Xóa thành công');
					}
				});
			}
		});

		//
		$(document).on('click','#action_message_all_btn',function(){

			$("#result_action_alert").removeClass('alert_ad');
			$("#result_action_alert" ).empty();
			var link_dr=$("input[name='link_dr']").val();
			var action_vl=$('#action_message_all').val();
			var url_href=$('header .logo').attr('href');
			var chkArray = [];

			$(".cb_post:checked").each(function() {
				chkArray.push($(this).val());
			});
			var list_id;
			list_id = chkArray.join(',') ;
			if(list_id.length > 0) {
				$.ajax({
					type:'POST',
					url:'all_action_message',
					data:{
						'action':action_vl,
						'list_id':list_id,
						'link_dr':link_dr,
					},
					beforeSend: function () {
						$("#result_action_alert").addClass('alert_ad');
						$("#result_action_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
					},
					success: function(result){
						redirect(link_dr);
					}
				});
				//---------//
			}else{
				setTimeout(function() {
						$("#result_action_alert" ).empty().append('Vui lòng chọn giá trị');
				},1000);
				$("#result_action_alert").addClass('alert_ad');
				$("#result_action_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
			}
		});

		/**
		 *
		 * @param url
		 * @param $delay
		 */
		function redirect(url = null, $delay = 10) {
			setTimeout(function() {
				if (url === null || url === '' || typeof url === "undefined") {
					document.location.assign(window.location.href);
				} else {
					url = url.replace(/\s+/g, '');
					document.location.assign(url);
				}
			}, $delay);
		}
	});
</script>
