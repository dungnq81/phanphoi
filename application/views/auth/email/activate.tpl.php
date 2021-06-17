<html>
<body>
	<h1><?php echo sprintf(__('email_activate_heading'), @$email);?></h1>
	<p><?php echo sprintf(__('email_activate_subheading'), anchor('users/activate/'. @$id .'/'. @$activation, __('email_activate_link')));?></p>
</body>
</html>
