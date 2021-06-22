<section class="identity-section register-section edit-section">
	<div class="modal-header">
		<h3 class="modal-title"><?php echo @$title ?></h3>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="points">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12,2C6.486,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.514,2,12,2z M13,16.915V18h-2v-1.08 C8.661,16.553,8,14.918,8,14h2c0.011,0.143,0.159,1,2,1c1.38,0,2-0.585,2-1c0-0.324,0-1-2-1c-3.48,0-4-1.88-4-3 c0-1.288,1.029-2.584,3-2.915V6.012h2v1.109c1.734,0.41,2.4,1.853,2.4,2.879h-1l-1,0.018C13.386,9.638,13.185,9,12,9 c-1.299,0-2,0.516-2,1c0,0.374,0,1,2,1c3.48,0,4,1.88,4,3C16,15.288,14.971,16.584,13,16.915z"></path></svg>
			<span class="content">
				<span>Thông tin điểm thưởng</span>
				<span>Bạn có <b><?php echo number_format($user->points)?></b> điểm. Mỗi điểm đổi được <b><?php echo number_format($this->setting->point_to_money)?>đ</b></span>
			</span>
		</div>
		<div id="infoMessage"><?php echo @$message; ?></div>
		<?php echo form_open( base_url() . "users/profile?_action=add_user", [ 'id' => "profile_form", 'class' => @$class ] ); ?>
		<div class="form-group">
			<?php echo __('edit_user_fullname_label', 'fullname');?>
			<input value="<?php echo set_value('fullname', $user->fullname)?>" id="fullname" value="<?php echo _post('fullname')?>" type="text" name="fullname" pattern="^(.*\S+.*)$" placeholder="Họ và tên">
		</div>
		<div class="form-group">
			<?php echo __('edit_user_email_label', 'email');?>
			<?php echo form_error('email');?>
			<input readonly value="<?php echo set_value('email', $user->email)?>" id="email" type="email" required name="email" placeholder="Email">
		</div>
		<div class="form-group">
			<?php echo __('edit_user_phone_label', 'phone');?>
			<input value="<?php echo set_value('phone', $user->phone)?>" id="phone" type="tel" name="phone" pattern="^\+?[0-9\+\-\.\s\(\)]+\*?$" placeholder="Điện thoại">
		</div>
		<div class="form-group">
			<?php echo __('edit_user_password_label', 'password');?>
			<input id="password" type="password" name="password" oninput="form.password_confirm.pattern=escapeRegExp(this.value)" placeholder="Mật khẩu">
		</div>
		<div class="form-group">
			<?php echo __('edit_user_password_confirm_label', 'password_confirm');?>
			<input id="password_confirm" type="password" name="password_confirm" pattern="" placeholder="Xác nhận mật khẩu">
		</div>
		<div class="form-group">
			<?php echo __('edit_user_address_label', 'address');?>
			<input value="<?php echo set_value('address', $user->address)?>" id="address" type="text" name="address" pattern="^(.*\S+.*)$" placeholder="Địa chỉ">
		</div>
		<div class="form-group">
			<span class="form-label"><?php echo __('edit_user_sex_label');?></span>
			<div class="radio-group">
				<label><?php echo form_radio( 'gender', 'Nam', null, 'id="nam" ' . set_radio( 'gender', 'Nam', true ) ); ?>Nam </label>
				<label><?php echo form_radio( 'gender', 'Nữ', null, 'id="nu" ' . set_radio( 'gender', 'Nữ' ) ); ?>Nữ </label>
				<label><?php echo form_radio( 'gender', 'Khác', null, 'id="khac" ' . set_radio( 'gender', 'Khác' ) ); ?>Khác </label>
			</div>
		</div>
		<div class="form-group">
			<?php echo __('edit_user_birthday_label', 'birthday');?>
			<input class="date-input" value="<?php echo $this->form_validation->set_value('birthday', $user->birthday)?>" type="date" name="birthday" placeholder="mm/dd/yyyy" min="1930-01-01" max="<?=date('Y-m-d')?>">
		</div>
		<div class="form-group btn-group">
			<button type="submit" class="button"><?php echo __( 'edit_user_submit_btn' )?></button>
		</div>
		<?php echo form_hidden('_action', 'edit_user'); ?>
		<?php echo form_hidden('id', $user->id);?>
		<?php echo form_hidden($csrf); ?>
		<?php echo form_close(); ?>
	</div>
</section>
