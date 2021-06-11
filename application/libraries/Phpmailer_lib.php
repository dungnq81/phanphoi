<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailer_Lib {
	public function __construct() {
		//log_message( 'Debug', 'PHPMailer class is loaded.' );
	}

	public function load() {
		// Include PHPMailer library files
		require_once APPPATH . 'third_party/phpmailer/src/Exception.php';
		require_once APPPATH . 'third_party/phpmailer/src/PHPMailer.php';
		require_once APPPATH . 'third_party/phpmailer/src/SMTP.php';

		$mail = new PHPMailer( true );

		// SMTP configuration
		$mail->isSMTP();
		$mail->Host       = 'smtp.gmail.com';
		$mail->SMTPAuth   = true;
		$mail->CharSet    = "utf-8";
		$mail->Username   = 'dungnq81@gmail.com';
		$mail->Password   = 'hqlbadocqbyjlfby';
		$mail->SMTPSecure = 'TLS';
		$mail->Port       = 587;

		$mail->setFrom( 'duongtuancuong@gmail.com', 'Công ty TNHH LÂM HẢI AN' );

		return $mail;
	}
}
