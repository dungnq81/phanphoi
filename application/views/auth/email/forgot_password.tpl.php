<html>
<body>
	<h1><?php echo sprintf(__('email_forgot_password_heading'), @$email);?></h1>
	<p><?php echo sprintf(__('email_forgot_password_subheading'), anchor('users/reset-password/'. @$forgotten_code, __('email_forgot_password_link')));?></p>
</body>
</html>
