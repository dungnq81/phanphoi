<?php

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Class PHPMailer_lib
 */
class PHPMailer_lib {

	/**
	 * @var mixed|PHPMailer
	 */
	private $email;

	/**
	 * Enables the use of CI super-global without having to define an extra variable.
	 *
	 * @param string $var
	 *
	 * @return    mixed
	 */
	public function __get( $var ) {
		static $ci;
		isset( $ci ) or $ci =& get_instance();

		return $ci->{$var};
	}

	/**
	 * @return PHPMailer
	 * @throws \PHPMailer\PHPMailer\Exception
	 */
	public function load() {

		$this->email = new PHPMailer( true );

		// SMTP configuration
		$this->email->isSMTP();
		$this->email->Host       = 'smtp.gmail.com';
		$this->email->SMTPAuth   = true;
		$this->email->CharSet    = "utf-8";
		$this->email->Username   = 'dungnq81@gmail.com';
		$this->email->Password   = 'hqlbadocqbyjlfby';
		$this->email->SMTPSecure = 'TLS';
		$this->email->Port       = 587;

		$this->email->setFrom( 'duongtuancuong@gmail.com', $this->setting->blogname );

		return $this->email;
	}

	/**
	 * @param $to
	 * @param null $subject
	 * @param null $content
	 * @param null $reply
	 * @param null $cc
	 * @param null $bcc
	 *
	 * @return bool
	 * @throws \PHPMailer\PHPMailer\Exception
	 */
	public function send_mail( $to, $subject = null, $content = null, $reply = null, $cc = null, $bcc = null ) {
		if ( empty( $to ) ) {
			return false;
		}

		$this->load();

		if ( is_array( $to ) ) {

			if (isset($to['to'])) $to = $to['to'];
			if (isset($to['subject'])) $subject = $to['subject'];
			if (isset($to['content'])) $content = $to['content'];
			if (isset($to['reply'])) $reply = $to['reply'];
			if (isset($to['cc'])) $cc = $to['cc'];
			if (isset($to['bcc'])) $bcc = $to['bcc'];
		}

		$this->email->Subject = $subject;
		$this->email->MsgHTML( $content );

		// reply to
		if ( ! empty( $reply ) ) {
			$this->email->AddReplyTo( $reply );
		}

		// to
		if ( is_string( $to ) ) {
			$to = explode( ',', $to );
		}
		foreach ( $to as $_to ) {
			if ( ! empty( $_to ) ) {
				$this->email->AddAddress( $_to );
			}
		}

		// cc
		if ( ! empty( $cc ) ) {
			if ( is_string( $cc ) ) {
				$cc = explode( ',', $cc );
			}
			foreach ( $cc as $_cc ) {
				if ( ! empty( $_cc ) ) {
					$this->email->AddCC( $_cc );
				}
			}
		}

		// bcc
		if ( ! empty( $bcc ) ) {
			if ( is_string( $bcc ) ) {
				$bcc = explode( ',', $bcc );
			}
			foreach ( $bcc as $_bcc ) {
				if ( ! empty( $_bcc ) ) {
					$this->email->AddBCC( $_bcc );
				}
			}
		}

		//send the message,
		if ( ! $this->email->Send() ) {
			return false;
		}

		return true;
	}
}
