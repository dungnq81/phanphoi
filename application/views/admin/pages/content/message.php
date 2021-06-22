<section class="content" id="content_message_page">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><?php echo $page_des; ?></h3>
					<p class="login-box-msg" id="result_setting_alert" style="display: inline;color: #E91E63;"><?php echo $this->session->flashdata('message');?></p>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="box-body pad">
						<form id="frm_message" method="post" role="form" class="form-group" accept-charset="UTF-8" enctype="multipart/form-data">
							<?php
							$link_dr = URL . 'admin/post_new?post_type=message';
							if ( $this->input->get('edit') )
							{
								$id = $this->input->get('edit');

								// check tồn tại
								$query = $this->db->where( 'id', $id )->get('hd_messages');
								if ($query->num_rows() < 1)
								{
									redirect( $link_dr );
								}

								$btn_action_title = 'Cập nhật';
								$action        = 'edit';
							} else
							{
								$id = 0;
								$btn_action_title = 'Thêm';
								$action        = 'add';
							}
							?>
							<div class="col-md-9">
								<div class="form-group">
									<label for="title">Tiêu đề <span style="color:red">*</span></label>
									<input required type="text" class="form-control" name="title" id="title" value="<?=$title; ?>" placeholder="Tiêu đề">
								</div>
								<div class="form-group">
									<label for="url">URL <span style="color:red">*</span></label>
									<input required type="url" class="form-control" name="url" id="url" value="<?=$url?>" placeholder="URL" aria-describedby="url_help">
									<small id="url_help" class="form-text text-muted">Đường dẫn liên kết của thông báo</small>
								</div>
								<div class="form-group">
									<label for="content">Mô tả</label>
									<textarea class="form-control" name="content" id="content" rows="8"><?=$content?></textarea>
								</div>
							</div>
							<div class="col-md-3">
								<?php if ( 'edit' == $action ) : ?>
									<div class="form-group">
										<div class="box box-info">
											<div class="box-header with-border">
												<h3 class="box-title">Thời gian cập nhật</h3>
												<span class="note">Đổi thời gian thứ tự cũng sẽ thay đổi</span>
											</div>
											<div class="box-body">
												<input value="<?=date('Y-m-d H:i:s', $updated_at)?>" class="form-control" id="updated_at" type="text" name="updated_at">
											</div>
										</div>
									</div>
								<?php endif;?>
								<div class="form-group">
									<div class="box box-info">
										<div class="box-header with-border">
											<h3 class="box-title">Thao tác</h3>
										</div>
										<div class="box-body">
											<span class="list_cb"><input type="checkbox" class="level-0" name="status" id="status" value="1">Lưu dưới dạng bản nháp</span>
											<input type="hidden" name="link_dr" value="<?php echo $link_dr; ?>">
											<input type="hidden" name="action" value="<?=$action?>">
											<input type="hidden" name="edit" value="<?=$id?>">
											<button type="submit" class="btn btn-primary"><?php echo $btn_action_title; ?></button>
											<p class="process-msg-box" style="color:#c90f4e;display:none;margin-top:10px;"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i> đang xử lý ... </p>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
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
<script>
	function open_popup(url) {
		var w = 880;
		var h = 570;
		var l = Math.floor((screen.width-w)/2);
		var t = Math.floor((screen.height-h)/2);
		var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
	}

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

	$(function () {
		$('#updated_at').datetimepicker({
			format:'YYYY-MM-DD HH:mm:ss',
		});

		var btn_message = $("#frm_message");
		btn_message.on('submit', function (e) {
			$(this).find('.process-msg-box').show();
			$.ajax({
				context: this,
				type: 'POST',
				url: BASE_URL + 'admin/insert_message',
				data: $(this).serializeArray(),
				beforeSend: function () {
					$(this).find(':submit').prop('disabled', true);
				},
				success: function (data) {
					$(this).find(':submit').prop('disabled', false);
					var json = JSON.parse(data);
					redirect($.trim(json.callback));
				}
			});

			e.preventDefault();
			return false;
		});
	});
</script>
