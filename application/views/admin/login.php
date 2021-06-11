<!DOCTYPE html>

<html>

	<head>

		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>Quản trị website | Đăng nhập</title>

		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<link rel="stylesheet" href="<?php echo(BC_AD.'bootstrap/dist/css/bootstrap.min.css');?>">

		<link rel="stylesheet" href="<?php echo(BC_AD.'font-awesome/css/font-awesome.min.css');?>">

		<link rel="stylesheet" href="<?php echo(BC_AD.'Ionicons/css/ionicons.min.css');?>">

		<link rel="stylesheet" href="<?php echo(DIST_AD.'css/AdminLTE.min.css');?>">

		<link rel="stylesheet" href="<?php echo(PLUGINS_AD.'iCheck/square/blue.css');?>">

		<link rel="stylesheet" href="<?php echo(CSS_AD.'custom.css');?>">

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

		<script src="<?php echo(BC_AD.'jquery/dist/jquery.min.js');?>"></script>

		<script src="<?php echo(BC_AD.'bootstrap/dist/js/bootstrap.min.js');?>"></script>

		<script src="<?php echo(PLUGINS_AD.'iCheck/icheck.min.js');?>"></script>

		<script src="<?php echo(JS_AD.'xuly.js');?>"></script>

		<script>

		  $(function () {

			$('input').iCheck({

			  checkboxClass: 'icheckbox_square-blue',

			  radioClass: 'iradio_square-blue',

			  increaseArea: '20%' /* optional */

			});

		  });

		</script>

	</head>

	<body class="hold-transition login-page">

		<div class="login-box">

			<div class="login-logo">

				<img loading="lazy" src="<?php echo URL; ?>assets/admin/img/logo_webhd.png" alt="WebHD">

			</div>

		  <!-- /.login-logo -->

			<div class="login-box-body">

				<p class="login-box-msg" id="result_login_alert">Đăng nhập để quản trị webstite</p>

				<form method="post" id="frm_login_ad">

					<div class="form-group has-feedback">

						<input type="email" name="email_login_ad" class="form-control" placeholder="Email">

						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>

					</div>

					<div class="form-group has-feedback">

						<input type="password" name="password_login_ad" class="form-control" placeholder="Password">

						<span class="glyphicon glyphicon-lock form-control-feedback"></span>

					</div>

				</form>

				<div class="row">

					<div class="col-xs-8" hidden>

					  <div class="checkbox icheck">

						<label>

						  <input type="checkbox"> Nhớ tài khoản

						</label>

					  </div>

					</div>

					<div class="col-xs-4">

						  <button type="submit" id="btn_login_ad" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>

					</div>

				</div>

				<div class="row" hidden>

					<div class="col-xs-8">

						<a href="#">Quên mật khẩu</a>

					</div>

				</div>

		  </div>

		</div>

		<!-- /.login-box -->

		<!-- jQuery 3 -->

	</body>

</html>

