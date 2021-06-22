<?php if ( ! is_ajax_request() ) echo '<section class="identity-section">'; ?>
<div class="modal-header">
	<h3 class="modal-title"><?php echo @$title ?></h3>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
	<p class="desc"><?php echo __( 'login_subheading' ); ?></p>
	<div id="infoMessage"><?php echo @$message; ?></div>
	<?php echo form_open( base_url() . "users/login?_action=login", [ 'id' => "login_form", 'class' => @$class ] ); ?>
	<div class="form-group">
		<?php echo __( 'login_identity_label', 'identity' ); ?>
		<input id="identity" type="text" name="identity" required pattern="^(.*\S+.*)$">
	</div>
	<div class="form-group">
		<?php echo __( 'login_password_label', 'password' ); ?>
		<input autocomplete="new-password" id="password" type="password" name="password" required pattern="^(.*\S+.*)$">
	</div>
	<div class="form-group checkbox-group">
		<?php echo form_checkbox( 'remember', '1', false, 'id="remember"' ); ?>
		<label for="remember">Nhớ mật khẩu ( <?php echo $this->config->item( 'remember_expire', 'auth' ) / 86400 ?> ngày)</label>
	</div>
	<div class="form-group btn-group">
		<button type="submit" class="button"><?php echo __( 'login_submit_btn' )?></button>
		<!--<button type="submit" class="g-recaptcha button" data-sitekey="<?php echo $this->setting->recaptcha_sitekey; ?>" data-callback="loginSubmit"><?php echo __( 'login_submit_btn' )?></button>-->
		<a class="forgot" href="#"><?php echo __( 'login_forgot_password' ); ?></a>
	</div>
	<?php echo form_hidden( 'redirect_to', $this->input->get('redirect_to') ); ?>
	<?php echo form_hidden( '_action', 'login' ); ?>
	<p class="reg">Bạn chưa có tài khoản? <a href="<?=base_url()?>users/register" title="Đăng ký thành viên">Đăng ký ngay</a></p>
	<?php echo form_close(); ?>
</div>
<?php if ( ! is_ajax_request() ) echo '</section>'; ?>
<script src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script>
<script>hd.LOGIN_BTN="<?php echo __( 'login_submit_btn' )?>"</script>
<?php asset_js('asset::users.js', FALSE, 'usersjs') ?>
<!--<script>function loginSubmit(e) {document.getElementById("login_form").submit();}</script>-->
