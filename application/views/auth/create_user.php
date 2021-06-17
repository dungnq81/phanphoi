<section class="identity-section register-section">
	<div class="modal-header">
		<h3 class="modal-title"><?php echo __( 'create_user_heading' ); ?></h3>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<p class="desc"><?php echo __( 'create_user_subheading' ); ?></p>
		<div id="infoMessage"><?php echo @$message; ?></div>
		<?php echo form_open( "users/register?_action=add_user", [ 'id' => "register_form", 'class' => @$class ] ); ?>
		<div class="form-group">
			<?php echo __('create_user_fullname_label', 'fullname');?>
			<input id="fullname" type="text" name="fullname" placeholder="Họ và tên">
		</div>
		<div class="form-group">
			<?php echo __('create_user_email_label', 'email');?>
			<?php echo form_error('email');?>
			<input id="email" type="email" required name="email" placeholder="Email">
		</div>
		<div class="form-group">
			<?php echo __('create_user_phone_label', 'phone');?>
			<input id="phone" type="tel" name="phone" pattern="^\+?[0-9\+\-\.\s\(\)]+\*?$" placeholder="Điện thoại">
		</div>
		<div class="form-group">
			<?php echo __('create_user_password_label', 'password');?>
			<input id="password" type="password" required name="password" oninput="form.password_confirm.pattern=escapeRegExp(this.value)" placeholder="Mật khẩu">
		</div>
		<div class="form-group">
			<?php echo __('create_user_password_confirm_label', 'password_confirm');?>
			<input id="password_confirm" type="password" required name="password_confirm" pattern="" placeholder="Mật khẩu">
		</div>
		<div class="form-group btn-group">
			<button type="submit" class="button"><?php echo __( 'create_user_submit_btn' )?></button>
		</div>
		<?php echo form_hidden('_action', 'add_user'); ?>
		<p class="login">Bạn đã có tài khoản? <a href="/users/login" title="Đăng nhập">Đăng nhập</a></p>
		<?php echo form_close(); ?>
	</div>
</section>
