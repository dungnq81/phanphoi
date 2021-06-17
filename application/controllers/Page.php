<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Class Page
 * @property Phpmailer_lib $phpmailer_lib
 */
class Page extends MY_Controller {

	private $prefix = PREFIX;

	public function __construct() {

		parent::__construct();

		$this->load->library( 'xulychuoi' );
		$this->load->library( 'functions' );
		$this->load->library( 'Md5_system' );
		$this->load->model( "page_model" );
		$this->load->library( "Ajax_pagination" );
		$this->load->library( 'email' );
		$this->load->helper( 'form' );
		$this->load->library( 'pagination' );
		$this->load->library( "cart" );
		$this->load->library( 'Phpmailer_lib' );
		$this->perPage = 10;
	}

	public function index() {
		$baotri = $this->page_model->select_value_table_dk_col( 'option', 'name', '="bao_tri"', 'value' );
		if ( $baotri == 'Bật' ) {
			header( 'Location: ' . URL . 'maintenance' );
		} else {
			$data['slug'] = 'home';
			$this->load->view( 'content/page', $data );
		}
	}
	//--- 2852019 --//
	//public function post($url,$)
	public function post( $url, $pagination = null ) {
		//$check_id_post=$this->page_model->count_table_dk_new('post','url="'.$url.'" and trangthai=1');
		$check_id_post = $this->db
			->where( 'trangthai', 1 )
			->where( 'url', $url )
			->get( $this->prefix . 'post' )
			->num_rows();

		//var_dump($_check_post);
		if ( $check_id_post == 0 ) {
			header( 'Location: ' . URL . '404page' );
		} else {
			$get_post_type   = $this->page_model->select_table_dk_col_get_1value( 'post', 'url="' . $url . '" and typepost!="menu"', 'typepost' );
			$id_post         = $this->page_model->select_table_dk_col_get_1value( 'post', 'url="' . $url . '" and typepost!="menu"', 'id' );
			$ten_post        = $this->page_model->select_value_table_dk_col( 'post', 'url', '="' . $url . '"', 'ten' );
			$mota_post       = $this->page_model->select_value_table_dk_col( 'post', 'url', '="' . $url . '"', 'mota' );
			$noidung_post    = $this->page_model->select_value_table_dk_col( 'post', 'url', '="' . $url . '"', 'noidung' );
			$anhdaidien_post = $this->page_model->select_value_table_dk_col( 'post', 'url', '="' . $url . '"', 'anhdaidien' );
			$thuvienanh_post = $this->page_model->select_value_table_dk_col( 'post', 'url', '="' . $url . '"', 'thuvienanh' );
			$url_post        = $this->page_model->select_value_table_dk_col( 'post', 'url', '="' . $url . '"', 'url' );
			$id_postpr_post  = $this->page_model->select_value_table_dk_col( 'post', 'url', '="' . $url . '"', 'idpostpr' );
			$id_slider       = $this->page_model->select_value_table_dk_col( 'post', 'url', '="' . $url . '"', 'id_slider' );
			if ( $id_postpr_post ) {
				$ten_postpr_post = $this->page_model->select_value_table_dk_col( 'post', 'id', '="' . $id_postpr_post . '"', 'ten' );
			}
			$data['slug']            = $get_post_type;
			$data['id_post']         = $id_post;
			$data['ten_post']        = $ten_post;
			$data['noidung_post']    = $noidung_post;
			$data['anhdaidien_post'] = $anhdaidien_post;
			$data['mota_post']       = $mota_post;
			$data['url_post']        = $url_post;
			$data['id_slider']       = $id_slider;
			$data['thuvienanh_post'] = $thuvienanh_post;
			if ( $id_postpr_post ) {
				$data['id_postpr_post']  = $id_postpr_post;
				$data['ten_postpr_post'] = $ten_postpr_post;
			} else {
				$data['ten_postpr_post'] = '';
			}
			if ( $url == 'tra-gop' ) {
				$data['slug'] = 'sanpham/tragop';
			}
			if ( $url == 'gio-hang' ) {
				$data['slug'] = 'sanpham/giohang';
			}
			if ( $url == 'thanh-toan' ) {
				$data['slug'] = 'sanpham/thanhtoan';
			}
			if ( $url == 'chi-tiet-don-hang' ) {
				$data['slug'] = 'sanpham/chitietdonhang';
			}
			if ( $url == 'chi-tiet-tra-gop' ) {
				$data['slug'] = 'sanpham/chitiettragop';
			}
			$this->load->view( 'content/page', $data );
		}
	}

	public function dangky() {
		$data['slug'] = '/dangky/dangky';
		$this->load->view( 'content/page', $data );
	}

	public function dangkygiasu() {
		$data['slug']          = '/dangky/dangkygiasu';
		$data['typethanhvien'] = 'giasu';
		$this->load->view( 'content/page', $data );
	}

	public function dangkyphuhuynh() {
		$data['id_post']       = 'dangkyphuhuynh';
		$data['slug']          = '/dangky/dangkyphuhuynh';
		$data['typethanhvien'] = 'phuhuynh';
		$this->load->view( 'content/page', $data );
	}

	public function dangnhap() {
		$data['slug'] = '/dangnhap/dangnhap';
		$this->load->view( 'content/page', $data );
	}

	public function dangnhapgiasu() {
		$data['slug']          = '/dangnhap/dangnhapgiasu';
		$data['typethanhvien'] = 'giasu';
		$this->load->view( 'content/page', $data );
	}

	public function dangnhapphuhuynh() {
		$data['slug']          = '/dangnhap/dangnhapphuhuynh';
		$data['typethanhvien'] = 'phuhuynh';
		$this->load->view( 'content/page', $data );
	}

	public function update_email() {
		if ( $this->check_session_user() == 0 ) {
			header( 'Location: ' . URL . 'dang-nhap' );
		} else {
			$data['slug'] = '/thanhvien/update-email';
			$this->load->view( 'content/page', $data );
		}
	}

	public function update_sodienthoai() {
		if ( $this->check_session_user() == 0 ) {
			header( 'Location: ' . URL . 'dang-nhap' );
		} else {
			$data['slug'] = '/thanhvien/update-sodienthoai';
			$this->load->view( 'content/page', $data );
		}
	}

	public function update_password() {
		if ( $this->check_session_user() == 0 ) {
			header( 'Location: ' . URL . 'dang-nhap' );
		} else {
			$data['slug'] = '/thanhvien/update-password';
			$this->load->view( 'content/page', $data );
		}
	}

	public function update_infor() {
		if ( $this->check_session_user() == 0 ) {
			header( 'Location: ' . URL . 'dang-nhap' );
		} else {
			$data['slug'] = '/thanhvien/update-infor';
			$this->load->view( 'content/page', $data );
		}
	}

	public function creat_cv_giasu() {
		if ( $this->check_session_user() == 0 ) {
			header( 'Location: ' . URL . 'dang-nhap' );
		} else {
			$data['slug'] = '/thanhvien/creat-cv-giasu';
			$this->load->view( 'content/page', $data );
		}
	}

	public function infor_tv( $id_tv ) {
		$count_char    = substr_count( $id_tv, '-' ); // 2
		$ex_id_tv      = explode( '-', $id_tv );
		$data['id_tv'] = $ex_id_tv[3];
		$check_hs      = $this->page_model->count_table_dk( 'hoso', 'id', '="' . $data['id_tv'] . '" ' );
		if ( $check_hs == 0 ) {
			header( 'Location: ' . URL . 'dang-nhap' );
		} else {
			$infor_hs = $this->page_model->select_table_dk( 'hoso', 'id', '="' . $data['id_tv'] . '" ' );
			foreach ( $infor_hs as $row_gs ) {
				$id_hs             = $row_gs->id;
				$id_tv             = $row_gs->id_tv;
				$monday            = $row_gs->monday;
				$mucluong          = $row_gs->luong;
				$tinhday           = $row_gs->tinhday;
				$thoigianday       = $row_gs->thoigianday;
				$yeucaukhac        = $row_gs->yeucaukhac;
				$ngaydang          = date( 'd/m/Y', strtotime( $row_gs->ngaydang ) );
				$list_chuyenmuc_ex = explode( ',', $monday );
				$ten_chuyenmuc_arr = array();
				foreach ( $list_chuyenmuc_ex as $chuyenmuc ) {
					$ten_chuyenmuc = $this->page_model->select_table_dk( 'post', 'id', '=' . $chuyenmuc . ' ' );
					foreach ( $ten_chuyenmuc as $row_ten_chuyenmuc ) {
						array_push( $ten_chuyenmuc_arr, $row_ten_chuyenmuc->ten );
						$monday = implode( ", ", $ten_chuyenmuc_arr );
					}
				}
				$lopday            = $row_gs->lopday;
				$list_chuyenmuc_ex = explode( ',', $lopday );
				$ten_chuyenmuc_arr = array();
				foreach ( $list_chuyenmuc_ex as $chuyenmuc ) {
					$ten_chuyenmuc = $this->page_model->select_table_dk( 'post', 'id', '=' . $chuyenmuc . ' ' );
					foreach ( $ten_chuyenmuc as $row_ten_chuyenmuc ) {
						array_push( $ten_chuyenmuc_arr, $row_ten_chuyenmuc->ten );
						$lopday = implode( ", ", $ten_chuyenmuc_arr );
					}
				}
				$ten                     = $this->page_model->select_value_table_dk_col( 'thanhvien', 'id', '="' . $id_tv . '"', 'hoten' );
				$tinhday                 = $this->page_model->select_value_table_dk_col( 'post', 'id', '="' . $tinhday . '"', 'ten' );
				$thoigianday             = $this->page_model->select_value_table_dk_col( 'post', 'id', '="' . $thoigianday . '"', 'ten' );
				$data['list_infor_user'] = array(
					'Họ tên'        => $ten,
					'Tỉnh dạy'      => $tinhday,
					'Môn dạy'       => $monday,
					'Lớp dạy'       => $lopday,
					'Thời gian dạy' => $thoigianday,
					'Mức lương'     => $mucluong,
					'Yêu cầu khác'  => $yeucaukhac,
				);
				$data['slug']            = '/thanhvien/infor-tv';
				$this->load->view( 'content/page', $data );
			}
		}
	}

	public function list_hoso_all()//hienthitatca
	{
		$data['slug'] = 'list-hoso';
		$this->load->view( 'content/page', $data );
	}

	public function list_hoso_giasu()//cho thanh vien
	{
		if ( $this->check_session_user() == 0 ) {
			header( 'Location: ' . URL . 'dang-nhap' );
		} else {
			$data    = array();
			$id_user = $this->page_model->select_value_table_dk_col( 'thanhvien', 'email', '="' . $_SESSION['user'] . '"', 'id' );
			//total rows count
			$totalRec = count( $this->page_model->getRows( 'hoso', 'id_tv="' . $id_user . '"', 'id' ) );
			//pagination configuration
			$config['target']     = '#postList';
			$config['base_url']   = URL . 'page/list_hoso_giasu_phantrang';
			$config['total_rows'] = $totalRec;
			$config['per_page']   = $this->perPage;
			$this->ajax_pagination->initialize( $config );
			//get the posts data
			$data['posts'] = $this->page_model->getRows( 'hoso', 'id_tv="' . $id_user . '"', 'id', array( 'limit' => $this->perPage ) );
			//load the view
			$data["page_slug"]  = "member";
			$data["page_title"] = "Quản lý hồ sơ";
			$data["page_des"]   = "Danh sách hồ sơ";
			$data["table"]      = "hoso";
			$data['slug']       = '/thanhvien/list-hoso-giasu';
			$this->load->view( 'content/page', $data );
		}
	}

	function list_hoso_giasu_phantrang() {
		$page = $this->input->post( 'page' );
		if ( ! $page ) {
			$offset = 0;
		} else {
			$offset = $page;
		}
		echo $offset;
		//total rows count
		$totalRec = count( $this->admin_model->getRows( 'thanhvien', 'typethanhvien!="admin"', 'id' ) );
		//pagination configuration
		$config['target']     = '#postList';
		$config['base_url']   = URL . 'admin/member_phantrang';
		$config['total_rows'] = $totalRec;
		$config['per_page']   = $this->perPage;
		$this->ajax_pagination->initialize( $config );
		//get the posts data
		$data['posts'] = $this->admin_model->getRows( 'thanhvien', 'typethanhvien!="admin"', 'id', array(
			'start' => $offset,
			'limit' => $this->perPage
		) );
		//load the view
		$this->load->view( 'content/template-parts/thanhvien/creat-cv-giasu-phantrang.php', $data, false );
	}

	public function check_register_user() {
		if ( isset( $_POST['hoten'] ) && isset( $_POST['email'] ) && isset( $_POST['sodienthoai'] ) && isset( $_POST['matkhau'] ) && isset( $_POST['type_register'] ) ) {
			$hoten         = $_POST['hoten'];
			$sodienthoai   = $_POST['sodienthoai'];
			$email         = $_POST['email'];
			$matkhau       = $this->md5_system->hsc_md5_password( $email, $_POST['matkhau'] );
			$type_register = $_POST['type_register'];
			$ngaydangky    = date( 'Y-m-d H:i:s' );
			$count_email   = $this->page_model->count_table_dk( 'thanhvien', 'email', '="' . $email . '"' );
			if ( $count_email != 0 ) {
				echo $count_email;
			} else {
				$sql   = " INSERT INTO " . $this->prefix . "thanhvien(hoten,sodienthoai,matkhau,email,ngaydangky,ngaycapnhat,trangthai,typethanhvien)
				VALUES ('" . $hoten . "','" . $sodienthoai . "','" . $matkhau . "','" . $email . "','" . $ngaydangky . "','" . $ngaydangky . "',1,'" . $type_register . "')";
				$query = $this->db->query( $sql );
			}
		} else {
			header( 'Location: ' . URL . '404page' );
		}
	}

	public function check_name_register_user() {
		if ( isset( $_POST['email'] ) ) {
			$email       = $_POST['email'];
			$count_email = $this->page_model->count_table_dk( 'thanhvien', 'email', '="' . $email . '"' );
			echo $count_email;
		} else {
			header( 'Location: ' . URL . '404page' );
		}
	}

	public function check_login_user() {
		if ( isset( $_POST['email'] ) && isset( $_POST['matkhau'] ) && isset( $_POST['typethanhvien'] ) ) {
			$email         = $_POST['email'];
			$matkhau       = $_POST['matkhau'];
			$typethanhvien = $_POST['typethanhvien'];
			$check_email   = $this->page_model->checkuser( $email, $matkhau, $typethanhvien );
			if ( $check_email != 0 ) {
				$this->session->set_userdata( "user", $email );
			}
			echo $check_email;
		} else {
			header( 'Location: ' . URL . '404page' );
		}
	}

	public function logout() {
		$this->session->unset_userdata( 'user' );
		header( 'Location: ' . URL . 'dang-nhap' );
	}

	public function check_session_user() {
		$kq = 0;
		if ( ! empty( $this->session->userdata( "user" ) ) ) {
			$kq = 1;
		}

		return $kq;
	}

	public function quanlytaikhoan() {
		if ( $this->check_session_user() == 0 ) {
			header( 'Location: ' . URL . 'dang-nhap' );
		} else {
			$data['slug']     = '/thanhvien/quanlytaikhoan';
			$data['bg_color'] = 'bgWhite bgGray-mb-new';
			$this->load->view( 'content/page', $data );
		}
	}

	public function update_email_user() {
		if ( isset( $_POST['email'] ) && isset( $_POST['old_email'] ) && isset( $_POST['typethanhvien'] ) ) {
			$old_email       = $_POST['old_email'];
			$email           = $_POST['email'];
			$typethanhvien   = $_POST['typethanhvien'];
			$ngaycapnhat     = date( 'Y-m-d H:i:s' );
			$check_email     = $this->page_model->count_table_2dk( 'thanhvien', 'email', '="' . $old_email . '"', 'typethanhvien', '="' . $typethanhvien . '"' );
			$check_email_new = $this->page_model->count_table_2dk( 'thanhvien', 'email', '="' . $email . '"', 'typethanhvien', '="' . $typethanhvien . '"' );
			if ( $check_email != 0 ) {
				if ( $check_email_new == 0 ) {
					$sql   = "UPDATE " . $this->prefix . "thanhvien
					SET email = '" . $email . "',
					ngaycapnhat='" . $ngaycapnhat . "'
					WHERE email='" . $old_email . "' and typethanhvien='" . $typethanhvien . "' ";
					$query = $this->db->query( $sql );
					echo $check_email_new;
				} else {
					echo $check_email_new;
				}
			} else {
				echo $check_email;
			}
		} else {
			header( 'Location: ' . URL . '404page' );
		}
	}

	public function update_sodienthoai_user() {
		if ( isset( $_POST['email'] ) && isset( $_POST['sodienthoai'] ) && isset( $_POST['typethanhvien'] ) ) {
			$email         = $_POST['email'];
			$sodienthoai   = $_POST['sodienthoai'];
			$typethanhvien = $_POST['typethanhvien'];
			$ngaycapnhat   = date( 'Y-m-d H:i:s' );
			$check_sdt     = $this->page_model->count_table_3dk( 'thanhvien', 'email', '="' . $email . '"', 'sodienthoai', '="' . $sodienthoai . '"', 'typethanhvien', '="' . $typethanhvien . '"' );
			if ( $check_sdt == 0 ) {
				$sql   = "UPDATE " . $this->prefix . "thanhvien
				SET sodienthoai = '" . $sodienthoai . "'
				WHERE email='" . $email . "' and typethanhvien='" . $typethanhvien . "' ";
				$query = $this->db->query( $sql );
				echo $check_sdt;
			} else {
				echo $check_sdt;
			}
		} else {
			header( 'Location: ' . URL . '404page' );
		}
	}

	public function update_password_user() {
		if ( isset( $_POST['email'] ) && isset( $_POST['old_password'] ) && isset( $_POST['new_password'] ) && isset( $_POST['typethanhvien'] ) ) {
			$email          = $_POST['email'];
			$old_password   = $this->md5_system->hsc_md5_password( $email, $_POST['old_password'] );
			$new_password   = $this->md5_system->hsc_md5_password( $email, $_POST['new_password'] );
			$typethanhvien  = $_POST['typethanhvien'];
			$ngaycapnhat    = date( 'Y-m-d H:i:s' );
			$check_password = $this->page_model->count_table_3dk( 'thanhvien', 'email', '="' . $email . '"', 'matkhau', '="' . $old_password . '"', 'typethanhvien', '="' . $typethanhvien . '"' );
			if ( $check_password != 0 ) {
				$sql   = "UPDATE " . $this->prefix . "thanhvien
				SET matkhau = '" . $new_password . "'
				WHERE email='" . $email . "' and typethanhvien='" . $typethanhvien . "' ";
				$query = $this->db->query( $sql );
				echo $check_password;
			} else {
				echo $check_password;
			}
		} else {
			header( 'Location: ' . URL . '404page' );
		}
	}

	public function update_infor_user() {
		if ( isset( $_POST['id'] ) && isset( $_POST['hoten'] ) && isset( $_POST['ngaysinh'] )
		     && isset( $_POST['gioitinh'] ) && isset( $_POST['honnhan'] ) && isset( $_POST['tinh'] ) && isset( $_POST['diachi'] ) ) {
			$id          = $_POST['id'];
			$hoten       = $_POST['hoten'];
			$ngaysinh    = $_POST['ngaysinh'];
			$gioitinh    = $_POST['gioitinh'];
			$honnhan     = $_POST['honnhan'];
			$diachi      = $_POST['diachi'];
			$tinh        = $_POST['tinh'];
			$ngaycapnhat = date( 'Y-m-d H:i:s' );
			$sql         = "UPDATE " . $this->prefix . "thanhvien
			SET hoten = '" . $hoten . "',
			ngaysinh = '" . $ngaysinh . "',
			gioitinh = '" . $gioitinh . "',
			honnhan = '" . $honnhan . "',
			diachi = '" . $diachi . "',
			tinh= '" . $tinh . "',
			ngaycapnhat = '" . $ngaycapnhat . "'
			WHERE id='" . $id . "' ";
			$query       = $this->db->query( $sql );
		} else {
			header( 'Location: ' . URL . '404page' );
		}
	}

	public function creat_cv_giasu_xuly() {
		if ( isset( $_POST['id'] ) && isset( $_POST['monday'] ) && isset( $_POST['lopday'] )
		     && isset( $_POST['thoigianday'] ) && isset( $_POST['luong'] ) ) {
			$id_tv       = $_POST['id'];
			$monday      = implode( ",", $_POST['monday'] );
			$lopday      = implode( ",", $_POST['lopday'] );
			$thoigianday = implode( ",", $_POST['thoigianday'] );
			$luong       = $_POST['luong'];
			$trangthai   = 1;
			$tinhday     = $_POST['tinhday'];
			$ngaycapnhat = date( 'Y-m-d H:i:s' );
			$mahoso      = 'HS-GS-' . $id_tv . '-' . date( 'YmdHis' );
			$sql         = " INSERT INTO " . $this->prefix . "hoso(id_tv,monday,lopday,thoigianday,luong,ngaydang,tinhday,ngaycapnhat,mahoso,trangthai)
				VALUES ('" . $id_tv . "','" . $monday . "','" . $lopday . "','" . $thoigianday . "','" . $luong . "','" . $ngaycapnhat . "','" . $tinhday . "','" . $ngaycapnhat . "','" . $mahoso . "',1)";
			$query       = $this->db->query( $sql );
		} else {
			header( 'Location: ' . URL . '404page' );
		}
	}

	public function send_mail_user( $email_to, $subject, $content ) {
		$url         = 'https://api.sendgrid.com/';
		$user        = 'vinhomebason';
		$pass        = 'vinhomebason@123';
		$json_string = array(
			'to'       => array( $email_to ),
			'category' => 'test_category'
		);
		$params      = array(
			'api_user'  => $user,
			'api_key'   => $pass,
			'x-smtpapi' => json_encode( $json_string ),
			'to'        => $email_to,
			'subject'   => $subject,
			'html'      => $content,
			'from'      => 'tranhoson1991@gmail.com',
		);
		$request     = $url . 'api/mail.send.json';
		// Generate curl request
		$session = curl_init( $request );
		// Tell curl to use HTTP POST
		curl_setopt( $session, CURLOPT_POST, true );
		// Tell curl that this is the body of the POST
		curl_setopt( $session, CURLOPT_POSTFIELDS, $params );
		// Tell curl not to return headers, but do return the response
		curl_setopt( $session, CURLOPT_HEADER, false );
		// Tell PHP not to use SSLv3 (instead opting for TLS)
		//curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2); // ssl
		curl_setopt( $session, CURLOPT_RETURNTRANSFER, true );
		// obtain response
		$response = curl_exec( $session );
		curl_close( $session );
	}

	/**
	 * @param $subject
	 * @param $content
	 * @param $to
	 * @param $reply
	 * @param null $cc
	 * @param null $bcc
	 *
	 * @return bool
	 * @throws \PHPMailer\PHPMailer\Exception
	 */
	public function send_mail_user2( $subject, $content, $to, $reply, $cc = null, $bcc = null ) {
		if ( empty( $to ) ) {
			return false;
		}

		// PHPMailer object
		$mail = $this->phpmailer_lib->load();

		$mail->Subject = $subject;
		$mail->MsgHTML( $content );

		// reply to
		if ( ! empty( $reply ) ) {
			$mail->AddReplyTo( $reply, "" );
		}

		// to
		if ( is_string( $to ) ) {
			$to = explode( ',', $to );
		}
		foreach ( $to as $_to ) {
			if ( ! empty( $_to ) ) {
				$mail->AddAddress( $_to, "" );
			}
		}

		// cc
		if ( ! empty( $cc ) ) {
			if ( is_string( $cc ) ) {
				$cc = explode( ',', $cc );
			}
			foreach ( $cc as $_cc ) {
				if ( ! empty( $_cc ) ) {
					$mail->AddCC( $_cc, "" );
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
					$mail->AddBCC( $_bcc, "" );
				}
			}
		}

		//send the message,
		if ( ! $mail->Send() ) {
			return false;
		}

		return true;
	}

	public function insert_lienhe() {
		if ( isset( $_POST['data'] ) ) {
			$ten      = $_POST['name'];
			$noidung  = json_encode( $_POST['data'], JSON_UNESCAPED_UNICODE );
			$ngaydang = date( 'Y-m-d H:i:s' );
			$sql      = " INSERT INTO " . $this->prefix . "post(ten,noidung,typepost,trangthai,ngaydang,ngaycapnhat)
				VALUES ('" . $ten . "','" . $noidung . "','lienhe',0,'" . $ngaydang . "','" . $ngaydang . "')";
			$query    = $this->db->query( $sql );
			$blogname = $this->page_model->select_value_table_dk_col( 'option', 'name', '="blogname"', 'value' );
			if ( $ten == 'frm_mau_dk_thamquantruong' ) {
				$email    = $this->page_model->select_value_table_dk_col( 'option', 'name', '="email1"', 'value' );
				$tieude   = strtoupper( $blogname ) . ' - ĐĂNG KÝ THAM QUAN TRƯỜNG';
				$reply_to = '';
			}
			if ( $ten == 'frm_mau_dk_online' ) {
				$email    = $this->page_model->select_value_table_dk_col( 'option', 'name', '="email2"', 'value' );
				$tieude   = strtoupper( $blogname ) . ' - ĐĂNG KÝ ONLINE';
				$reply_to = '';
			}
			if ( $ten == 'frm_dangky_nhanbantin' ) {
				$email    = $this->page_model->select_value_table_dk_col( 'option', 'name', '="email1"', 'value' );
				$tieude   = strtoupper( $blogname ) . ' - Đăng ký nhận thông tin khuyến mãi';
				$reply_to = '';
			}
			if ( $ten == 'frm_lienhe' ) {
				$email    = $this->page_model->select_value_table_dk_col( 'option', 'name', '="email1"', 'value' );
				$tieude   = strtoupper( $blogname ) . ' - Thông tin liên hệ';
				$reply_to = json_decode( $noidung )[2]->value;
			}
			$id_post      = $this->page_model->select_table_dk_col_get_1value( 'post', 'ngaydang="' . $ngaydang . '"', 'id' );
			$link_mail    = URL_AD . 'mail_view?post_type=lienhe&view=' . $id_post;
			$email_dk     = json_decode( $noidung )[0]->value;
			$content_mail = 'Hệ thống nhận vừa nhận được 1 yêu cầu đăng ký nhận bản tin từ email <b>' . $email_dk . ' <br> Clicl vào link ' . $link_mail . ' để xem chi tiết.</b>';

			//$this->send_mail_user( $email, $tieude, $content_mail );
			$this->send_mail_user2( $tieude, $content_mail, $email, $reply_to );

		} else {
			header( 'Location: ' . URL . '404page' );
		}
	}

	/**
	 * insert_cart
	 */
	public function insert_cart() {
		$id_sanpham        = $_POST['id_sanpham'];
		$name_sanpham      = $_POST['name_sanpham'];
		$price_sanpham     = $_POST['price_sanpham'];
		$val_thuoctinh     = $_POST['val_thuoctinh'];
		$text_thuoctinh    = $_POST['text_thuoctinh'];
		$goibaohanh        = $_POST['goibaohanh'];
		$number_pr_to_cart = $_POST['number_pr_to_cart'];
		$data              = array(
			"id"     => $id_sanpham,
			"name"   => $name_sanpham,
			"qty"    => $number_pr_to_cart,
			"price"  => $price_sanpham,
			"option" => array(
				"val_thuoctinh"  => $val_thuoctinh,
				"text_thuoctinh" => $text_thuoctinh,
				'goibaohanh'     => $goibaohanh
			),
		);
		// Them san pham vao gio hang
		if ( $this->cart->insert( $data ) ) {
			echo "ok";
		} else {
			$name_sanpham = $id_sanpham;
			if ( $this->cart->insert( $data ) ) {
				echo "ok";
			} else {
				echo "0";
			}
		}
	}

	public function delete_cart() {
		$rowid = $_POST['rowid'];
		if ( $this->cart->update( array( 'rowid' => $rowid, 'qty' => 0 ) ) ) {
			echo base_url() . 'gio-hang';
		} else {
			echo "0";
		}
	}

	public function delete_tragop() {
		$rowid = $_POST['rowid'];
		if ( $this->cart->update( array( 'rowid' => $rowid, 'qty' => 0 ) ) ) {
			echo base_url() . 'tra-gop';
		} else {
			echo "0";
		}
	}

	public function update_cart() {
		$rowid = $_POST['rowid'];
		$value = $_POST['value'];
		if ( $this->cart->update( array( 'rowid' => $rowid, 'qty' => $value ) ) ) {
			echo base_url() . 'gio-hang';
		} else {
			echo "0";
		}
	}

	public function update_tragop() {
		$rowid = $_POST['rowid'];
		$value = $_POST['value'];
		if ( $this->cart->update( array( 'rowid' => $rowid, 'qty' => $value ) ) ) {
			echo base_url() . 'tra-gop';
		} else {
			echo "0";
		}
	}

	public function insert_donhang() {
		$tt_khachhang    = $_POST['tt_khachhang'];
		$vl_khachhang    = $_POST['vl_khachhang'];
		$ngaytao         = date( 'Y-m-d H:i:s' );
		$tt_khachhang    = implode( "*+++*", $tt_khachhang );
		$vl_khachhang    = implode( "*+++*", $vl_khachhang );
		$tt_sanpham      = $_POST['tt_sanpham'];
		$type_thanhtoan  = $_POST['type_thanhtoan'];
		$id_donhang      = date( 'YmdHis' );
		$sql             = " INSERT INTO " . $this->prefix . "donhang(id_donhang,tt_khachhang,vl_khachhang,tt_sanpham,ngaytao,ngaycapnhat,type_thanhtoan,trangthai)
			VALUES ('" . $id_donhang . "','" . $tt_khachhang . "','" . $vl_khachhang . "','" . $tt_sanpham . "','" . $ngaytao . "','" . $ngaytao . "','" . $type_thanhtoan . "', 0)";
		$query           = $this->db->query( $sql );
		$id_sanpham_mail = $this->db->insert_id();
		if ( $query ) {
			$blogname = $this->page_model->select_value_table_dk_col( 'option', 'name', '="blogname"', 'value' );
			$this->cart->destroy();
			$ten_mail        = strtoupper( $blogname ) . ' - HỆ THỐNG VỪA NHẬN ĐƯỢC MỘT ĐƠN HÀNG - MÃ: ' . $id_donhang;
			$email_to        = $this->page_model->select_value_table_dk_col( 'option', 'name', '="email1"', 'value' );
			$content_mail_rs = '<p>Chi tiết xem tại: ' . base_url() . 'admin/view_donhang?id=' . $id_sanpham_mail . ' (Vui lòng đăng nhập quản trị để xem)</p>';
			$this->send_mail_user( $email_to, $ten_mail, $content_mail_rs );
			echo base_url() . 'chi-tiet-don-hang/?id_donhang=' . $id_donhang;
		} else {
			echo '0';
		}
		//var_dump(unserialize(base64_decode($tt_sanpham))); // get value sp
	}

	public function sendmail_tragop() {
		$hoten           = $_POST['hoten'];
		$sodienthoai     = $_POST['sodienthoai'];
		$link_sp         = $_POST['link_sp'];
		$ten_mail        = $this->page_model->select_table_dk_col_get_1value( 'post', 'id="729"', 'ten' );
		$content_mail    = $this->page_model->select_table_dk_col_get_1value( 'post', 'id="729"', 'noidung' );
		$content_mail_rs = str_replace( '{hoten}', $hoten, $content_mail );
		$content_mail_rs = str_replace( '{sodienthoai}', $sodienthoai, $content_mail_rs );
		$content_mail_rs = str_replace( '{link_sp}', $link_sp, $content_mail_rs );
		$email_to        = $this->page_model->select_value_table_dk_col( 'option', 'name', '="email2"', 'value' );
		$this->send_mail_user( $email_to, $ten_mail, $content_mail_rs );
	}

	public function tinh_tragop() {
		$tongsotien = $_POST['tongsotien'];
		//$sothang=$_POST['sothang'];
		$sotientratruoc = $_POST['sotientratruoc'];
		$sothang        = 0;
		$arr_kq         = array();
		while ( $sothang < 18 ) {
			$sothang        += 3;
			$gopmoithang    = number_format( $this->functions->PMT( 0.35 / 12, $sothang, $tongsotien - $sotientratruoc ) );
			$tongtientragop = number_format( $this->functions->tongsotien_sautragop( $sothang, $this->functions->PMT( 0.35 / 12, $sothang, $tongsotien - $sotientratruoc ), $tongsotien - $sotientratruoc, $tongsotien ) );
			$tonglai        = number_format( ( $this->functions->PMT( 0.35 / 12, $sothang, $tongsotien - $sotientratruoc ) * $sothang ) - ( $tongsotien - $sotientratruoc ) );
			$kq_rs          = $gopmoithang . '+++' . $tonglai . '+++' . $tongtientragop;
			$arr_kq[]       = $kq_rs;
		}
		array_push( $arr_kq, number_format( $tongsotien - $sotientratruoc ) );
		echo json_encode( $arr_kq );
	}

	public function insert_tragop() {
		$tt_khachhang          = $_POST['tt_khachhang'];
		$vl_khachhang          = $_POST['vl_khachhang'];
		$ngaytao               = date( 'Y-m-d H:i:s' );
		$tt_khachhang          = implode( "*+++*", $tt_khachhang );
		$vl_khachhang          = implode( "*+++*", $vl_khachhang );
		$tt_sanpham            = $_POST['tt_sanpham'];
		$type_thanhtoan        = $_POST['tragop_vl'];
		$sotientratruoc_tragop = $_POST['sotientratruoc_tragop'];
		$chonmua_tragop        = $_POST['chonmua_tragop'];
		$thanhpho              = $_POST['thanhpho'];
		$ghichu_tragop         = $_POST['ghichu_tragop'];
		$thoigiangiaohang      = $_POST['thoigiangiaohang'];
		$chinhanh              = $_POST['chinhanh'];
		$id_tragop             = 'TG_' . date( 'YmdHis' );
		$sql                   = " INSERT INTO " . $this->prefix . "tragop(id_tragop,tt_khachhang,vl_khachhang,tt_sanpham,ngaytao,ngaycapnhat,type_thanhtoan,trangthai,sotientratruoc,sothang,thanhpho,ghichu_tragop,thoigiangiaohang,chinhanh)
			VALUES ('" . $id_tragop . "','" . $tt_khachhang . "','" . $vl_khachhang . "','" . $tt_sanpham . "','" . $ngaytao . "','" . $ngaytao . "','" . $type_thanhtoan . "', 0,'" . $sotientratruoc_tragop . "','" . $chonmua_tragop . "','" . $thanhpho . "','" . $ghichu_tragop . "','" . $thoigiangiaohang . "','" . $chinhanh . "')";
		$query                 = $this->db->query( $sql );
		$id_sanpham_mail       = $this->db->insert_id();
		if ( $query ) {
			$this->cart->destroy();
			$ten_mail        = 'CTMOBILE - HỆ THỐNG VỪA NHẬN ĐƯỢC MỘT ĐƠN HÀNG TRẢ GÓP - MÃ: ' . $id_tragop;
			$email_to        = $this->page_model->select_value_table_dk_col( 'option', 'name', '="email1"', 'value' );
			$content_mail_rs = '<p>Chi tiết xem tại: ' . base_url() . 'admin/view_tragop?id=' . $id_sanpham_mail . ' (Vui lòng đăng nhập quản trị để xem)</p>';
			$this->send_mail_user( $email_to, $ten_mail, $content_mail_rs );
			echo base_url() . 'chi-tiet-tra-gop/?id_tragop=' . $id_tragop;
		} else {
			echo '0';
		}
		//var_dump(unserialize(base64_decode($tt_sanpham))); // get value sp
	}

	public function rating() {
		$star    = (int) $this->input->post( 'star' );
		$post_id = (int) $this->input->post( 'post_id' );

		$_query  = $this->db->where( 'post_id', $post_id )->get( 'hd_post_vote' );
		$results = $_query->result();
		$total   = 0;
		$value   = 0;

		foreach ( $results as $item ) {
			if ( $item->vote_value ) {
				$total = $total + 1;
				$value = $value + $item->vote_value;
			}
		}

		if ( ! isset( $_SESSION['post_id'] ) || $_SESSION['post_id'] != $post_id ) {
			$_SESSION['rating']  = 1;
			$_SESSION['post_id'] = $post_id;
		} else {
			$_SESSION['rating']  = $_SESSION['rating'] + 1;
			$_SESSION['post_id'] = $post_id;
		}

		if ( 1 == $_SESSION['rating'] ) {
			$total = $total + 1;
			$value = $value + $star;
			$_arr  = array(
				'post_id'     => $post_id,
				'customer_id' => 0,
				'ip_address'  => ip_address(),
				'vote_number' => 0,
				'vote_value'  => $star,
			);

			$this->db->insert( 'hd_post_vote', $_arr );
			$x_format = @number_format( $value / $total, 1 );

		} else {
			$_tmp = $this->db->where( 'post_id', $post_id )->order_by( 'id', 'DESC' )->get( 'hd_post_vote' )->row();
			if ( $_tmp ) {
				$value = $value - $_tmp->vote_value + $star;
				$_arr  = array(
					'post_id'    => $post_id,
					'ip_address' => ip_address(),
					'vote_value' => $star,
				);

				$this->db->where( 'id', $_tmp->id );
				$this->db->update( 'hd_post_vote', $_arr );
			}

			if ( $total == 0 ) {
				$total = $total + 1;
			}
			$x_format = @number_format( $value / $total, 1 );
		}

		echo "Kết quả " . $x_format . "/5 (" . $total . " đánh giá)";
	}
}
