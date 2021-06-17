<?php

defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );


class Admin extends MY_Controller {

	private $prefix = PREFIX;

	public function __construct() {

		parent::__construct();

		$this->load->library( 'xulychuoi' );
		$this->load->library( 'functions' );
		$this->load->library( 'md5_system' );
		$this->load->model( "admin_model" );
		$this->load->library( "ajax_pagination" );
		$this->load->library( "pagination" );

		$this->perPage = $this->admin_model->select_value_table_dk_col( 'option', 'name', '="phantrang"', 'value' );

	}


	public function check_session_user() {

		$kq = 0;

		if ( ! empty( $this->session->userdata( "user_admin" ) ) ) {

			$kq = 1;

		}

		return $kq;

	}


	public function error_page() {

		$data["page_title"] = "404 Page";

		$data["page_des"] = "Link không tồn tại";

		$this->load->view( 'admin/404', $data );

	}

	public function maintenance() {

		if ( $this->check_session_user() == 0 ) {

			$data["page_title"] = "Bảo trì website";

			$data["page_des"] = "Website đang trong quá trình bảo trì";

			$this->load->view( 'admin/maintenance', $data );

		} else {

			$this->load->model( "page_model" );

			$this->load->library( "Functions" );

			$data['slug'] = 'home';

			$this->load->view( 'content/page', $data );

		}

	}

	public function index() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );

		} else {

			$data["page_title"] = "Bảng tin";

			$data["page_des"] = "Bảng tin website";

			$this->load->view( 'admin/index', $data );

		}

	}

	public function login() {

		if ( $this->check_session_user() == 0 ) {

			$this->load->view( 'admin/login.php' );

		} else {

			redirect( URL . 'admin' );
		}

	}

	public function check_login() {

		if ( isset( $_POST['email_login_ad'] ) && isset( $_POST['password_login_ad'] ) ) {

			$email_login_ad = $_POST['email_login_ad'];

			$password_login_ad = $_POST['password_login_ad'];

			$get_typethanhvien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email_login_ad . '"', 'typethanhvien' );

			if ( $get_typethanhvien ) {

				$rs = $this->admin_model->checkuser( $email_login_ad, $password_login_ad, $get_typethanhvien );

				if ( $rs != 0 ) {

					$get_trangthai = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email_login_ad . '"', 'trangthai' );

					if ( $get_trangthai == 1 ) {

						$this->session->set_userdata( "user_admin", $email_login_ad );

					} else {

						$rs = 2;

					}

				}

				echo $rs;

			}

		} else {

			redirect( URL . '404page' );
		}


	}

	public function logout() {

		$this->session->unset_userdata( 'user_admin' );

		redirect( URL . 'login' );
		
	}

	public function media() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			$email = $this->session->userdata( "user_admin" );

			$get_typethanhvien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email . '"', 'typethanhvien' );

			if ( $get_typethanhvien == 'admin' ) {

				$this->session->userdata( "user_admin" );

				$data["page_slug"] = "media";

				$data["page_title"] = "Thư viện";

				$data["page_des"] = "Thư viện webstie";

				$this->load->view( 'admin/page', $data );

			} else {

				echo 'Xin lỗi ! Bạn không có quyền truy cập.';

			}

		}

	}

	public function setting() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			$email = $this->session->userdata( "user_admin" );

			$get_typethanhvien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email . '"', 'typethanhvien' );

			if ( $get_typethanhvien == 'admin' ) {

				$data["page_slug"] = "setting";

				$data["page_title"] = "Cài đặt";

				$data["page_des"] = "Cài đặt webstie";

				$this->load->view( 'admin/page', $data );

			} else {

				echo 'Xin lỗi ! Bạn không có quyền truy cập.';

			}

		}

	}

	public function infor_admin() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			$email = $this->session->userdata( "user_admin" );

			$get_typethanhvien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email . '"', 'typethanhvien' );

			if ( $get_typethanhvien == 'admin' ) {

				$data["page_slug"] = "infor_admin";

				$data["page_title"] = "Thông tin admin";

				$data["page_des"] = "Quản lý thông tin admin";

				$this->load->view( 'admin/page', $data );

			} else {

				echo 'Xin lỗi ! Bạn không có quyền truy cập.';

			}

		}

	}

	public function infor_user() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			$data["page_slug"] = "infor_user";

			$data["page_title"] = "Thông tin thành viên";

			$data["page_des"] = "Quản lý thông tin quyền tuyển sinh";

			$this->load->view( 'admin/page', $data );

		}

	}


	public function update_setting() {
		if ( isset( $_POST['setting_ip_col'] ) ) {

			$id    = $_POST['id_option'];
			$value = $_POST['setting_ip_value'];

			$arr['value'] = $value;
			$this->db->update( "hd_option", $arr, array( 'id' => $id ) );

			echo 'ok';

		} else {

			redirect( URL . '404page' );

		}

	}

	public function update_infor_ad() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			$email = $this->session->userdata( "user_admin" );

			$get_typethanhvien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email . '"', 'typethanhvien' );

			if ( $get_typethanhvien == 'admin' ) {

				$hoten = $_POST['hoten'];

				$sodienthoai = $_POST['sodienthoai'];

				$gioitinh = $_POST['gioitinh'];

				$ngaysinh = $_POST['ngaysinh'];

				$anhdaidien_string = $_POST['anhdaidien'];


				// $name_avt=round(microtime(true)) . '.' ;

				$name_avt = date( 'YmdHis' ) . '.';

				if ( ! empty( $anhdaidien_string ) ) {

					$anhdaidien_string_ex = explode( '.', $anhdaidien_string );

					$anhdaidien_post = $name_avt . $anhdaidien_string_ex[1];

				}


				$get_anhdaidien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'typethanhvien="admin"', 'anhdaidien' );

				if ( $anhdaidien_post == '' ) {

					$anhdaidien_post = $get_anhdaidien;

				}


				$query = $this->db->query( "

					UPDATE " . $this->prefix . "thanhvien

					SET hoten='$hoten',

						sodienthoai='$sodienthoai',

						gioitinh='$gioitinh',

						ngaysinh='$ngaysinh',

						anhdaidien='$anhdaidien_post'

					WHERE typethanhvien='admin'

				" );

			} else {

				echo 'Xin lỗi ! Bạn không có quyền truy cập.';

			}

		}

	}


	public function update_infor_user() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			$hoten = $_POST['hoten'];

			$sodienthoai = $_POST['sodienthoai'];

			$gioitinh = $_POST['gioitinh'];

			$ngaysinh = $_POST['ngaysinh'];

			$anhdaidien_string = $_POST['anhdaidien'];

			$id_user_rs = $_POST['id_user_rs'];


			//$name_avt=round(microtime(true)) . '.' ;

			$name_avt = date( 'YmdHis' ) . '.';

			if ( ! empty( $anhdaidien_string ) ) {

				$anhdaidien_string_ex = explode( '.', $anhdaidien_string );

				$anhdaidien_post = $name_avt . $anhdaidien_string_ex[1];

			}


			$get_anhdaidien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'id="' . $id_user_rs . '"', 'anhdaidien' );

			if ( $anhdaidien_post == '' ) {

				$anhdaidien_post = $get_anhdaidien;

			}


			$query = $this->db->query( "

				UPDATE " . $this->prefix . "thanhvien

				SET hoten='$hoten',

					sodienthoai='$sodienthoai',

					gioitinh='$gioitinh',

					ngaysinh='$ngaysinh',

					anhdaidien='$anhdaidien_post'

				WHERE id='$id_user_rs' and typethanhvien!='admin'

			" );

		}

	}

	public function update_password_ad() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			$email = $this->session->userdata( "user_admin" );

			$get_typethanhvien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email . '"', 'typethanhvien' );

			if ( $get_typethanhvien == 'admin' ) {

				if ( isset( $_POST['password'] ) ) {

					$matkhau_ad = $_POST['password'];

					$email_ad = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'typethanhvien="admin"', 'email' );


					$pass_update = $this->md5_system->hsc_md5_password( $email_ad, $matkhau_ad );

					$query = $this->db->query( "

						UPDATE " . $this->prefix . "thanhvien

						SET matkhau='$pass_update'

						WHERE typethanhvien='admin' and email='$email_ad'

					" );

				}

			} else {

				echo 'Xin lỗi ! Bạn không có quyền truy cập.';

			}

		}

	}


	public function update_password_member() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			if ( isset( $_POST['password'] ) and isset( $_POST['id_user_rs'] ) ) {

				$id_user_rs = $_POST['id_user_rs'];

				$matkhau_user = $_POST['password'];

				$email_user = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'id="' . $id_user_rs . '" and typethanhvien!="admin"', 'email' );


				$pass_update = $this->md5_system->hsc_md5_password( $email_user, $matkhau_user );

				$query = $this->db->query( "

					UPDATE " . $this->prefix . "thanhvien

					SET matkhau='$pass_update'

					WHERE typethanhvien!='admin' and email='$email_user'

				" );

			}

		}

	}


	public function member() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			$email = $this->session->userdata( "user_admin" );

			$get_typethanhvien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email . '"', 'typethanhvien' );

			if ( $get_typethanhvien == 'admin' ) {

				$data = array();

				$totalRec = count( $this->admin_model->getRows( 'thanhvien', 'typethanhvien!="admin"', 'id' ) );


				$offset = ( $this->uri->segment( 3 ) == '' ) ? 0 : $this->uri->segment( 3 );

				$config['total_rows'] = $totalRec;

				$config['per_page'] = $this->perPage;

				$config['next_link'] = '»';

				$config['prev_link'] = '«';

				$config['num_links'] = 5;

				$config['cur_tag_open'] = '<a class="currentpage">';

				$config['cur_tag_close'] = '</a>';

				$config['base_url'] = URL_AD . 'member/';

				$config['uri_segment'] = 3;

				$config['reuse_query_string'] = true;

				$this->pagination->initialize( $config );


				$pagination = $this->pagination->create_links();


				$data['posts'] = $this->admin_model->getRows( 'thanhvien', 'typethanhvien!="admin"', 'id', array(
					'start' => $offset,
					'limit' => $this->perPage
				) );


				//load the view

				$data["page_slug"] = "member";

				$data["page_title"] = "Thành viên";

				$data["page_des"] = "Danh sách thành viên";

				$data["table"] = "thanhvien";

				$data["pagination"] = $pagination;

				$this->load->view( 'admin/page', $data );


			} else {

				echo 'Xin lỗi ! Bạn không có quyền truy cập.';

			}

		}

	}


	public function donhang() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			$email = $this->session->userdata( "user_admin" );

			$get_typethanhvien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email . '"', 'typethanhvien' );

			if ( $get_typethanhvien == 'admin' ) {

				$data = array();

				$totalRec = 0;

				if ( $this->admin_model->getRows( 'donhang', 'id!=0', 'id' ) ) {

					$totalRec = count( $this->admin_model->getRows( 'donhang', 'id!=0', 'id' ) );

				}


				$offset = ( $this->uri->segment( 3 ) == '' ) ? 0 : $this->uri->segment( 3 );

				$config['total_rows'] = $totalRec;

				$config['per_page'] = $this->perPage;

				$config['next_link'] = '»';

				$config['prev_link'] = '«';

				$config['num_links'] = 5;

				$config['cur_tag_open'] = '<a class="currentpage">';

				$config['cur_tag_close'] = '</a>';

				$config['base_url'] = URL_AD . 'donhang/';

				$config['uri_segment'] = 3;

				$config['reuse_query_string'] = true;

				$this->pagination->initialize( $config );


				$pagination = $this->pagination->create_links();


				$data['posts'] = $this->admin_model->getRows( 'donhang', 'id!=0', 'id', array(
					'start' => $offset,
					'limit' => $this->perPage
				) );


				//load the view

				$data["page_slug"] = "donhang";

				$data["page_title"] = "Đơn hàng";

				$data["page_des"] = "Danh sách đơn hàng";

				$data["table"] = "donhang";

				$data["pagination"] = $pagination;

				$this->load->view( 'admin/page', $data );


			} else {

				echo 'Xin lỗi ! Bạn không có quyền truy cập.';

			}

		}

	}


	public function view_donhang() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			$email = $this->session->userdata( "user_admin" );

			$get_typethanhvien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email . '"', 'typethanhvien' );

			if ( $get_typethanhvien == 'admin' ) {

				$id_donhang = $_GET['id'];

				$data = array();

				$totalRec = $this->admin_model->select_table_dk( 'donhang', 'id', '!="' . $id_donhang . '" ' );

				if ( $totalRec == 0 ) {

					echo 'Xin lỗi ! Đơn hàng không tồn tại';

				} else {

					$data["page_slug"] = "view_donhang";

					$data["page_title"] = "Đơn hàng";

					$data["page_des"] = "Chi tiết đơn hàng";

					$data["table"] = "donhang";

					$this->load->view( 'admin/page', $data );

				}


			} else {

				echo 'Xin lỗi ! Bạn không có quyền truy cập.';

			}

		}

	}


	public function tragop() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			$email = $this->session->userdata( "user_admin" );

			$get_typethanhvien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email . '"', 'typethanhvien' );

			if ( $get_typethanhvien == 'admin' ) {

				$data = array();

				$totalRec = 0;

				if ( $this->admin_model->getRows( 'tragop', 'id!=0', 'id' ) ) {

					$totalRec = count( $this->admin_model->getRows( 'tragop', 'id!=0', 'id' ) );

				}


				$offset = ( $this->uri->segment( 3 ) == '' ) ? 0 : $this->uri->segment( 3 );

				$config['total_rows'] = $totalRec;

				$config['per_page'] = $this->perPage;

				$config['next_link'] = '»';

				$config['prev_link'] = '«';

				$config['num_links'] = 5;

				$config['cur_tag_open'] = '<a class="currentpage">';

				$config['cur_tag_close'] = '</a>';

				$config['base_url'] = URL_AD . 'tragop/';

				$config['uri_segment'] = 3;

				$config['reuse_query_string'] = true;

				$this->pagination->initialize( $config );


				$pagination = $this->pagination->create_links();


				$data['posts'] = $this->admin_model->getRows( 'tragop', 'id!=0', 'id', array(
					'start' => $offset,
					'limit' => $this->perPage
				) );


				//load the view

				$data["page_slug"] = "tragop";

				$data["page_title"] = "Trả góp";

				$data["page_des"] = "Danh sách đơn trả góp";

				$data["table"] = "tragop";

				$data["pagination"] = $pagination;

				$this->load->view( 'admin/page', $data );


			} else {

				echo 'Xin lỗi ! Bạn không có quyền truy cập.';

			}

		}

	}


	public function view_tragop() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			$email = $this->session->userdata( "user_admin" );

			$get_typethanhvien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email . '"', 'typethanhvien' );

			if ( $get_typethanhvien == 'admin' ) {

				$id_donhang = $_GET['id'];

				$data = array();

				$totalRec = $this->admin_model->select_table_dk( 'tragop', 'id', '!="' . $id_donhang . '" ' );

				if ( $totalRec == 0 ) {

					echo 'Xin lỗi ! Đơn hàng không tồn tại';

				} else {

					$data["page_slug"] = "view_tragop";

					$data["page_title"] = "Trả góp";

					$data["page_des"] = "Chi tiết đơn trả góp";

					$data["table"] = "tragop";

					$this->load->view( 'admin/page', $data );

				}


			} else {

				echo 'Xin lỗi ! Bạn không có quyền truy cập.';

			}

		}

	}


	function member_phantrang() {

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

		$config['target'] = '#postList';

		$config['base_url'] = URL . 'admin/member_phantrang';

		$config['total_rows'] = $totalRec;

		$config['per_page'] = $this->perPage;

		$this->ajax_pagination->initialize( $config );


		//get the posts data

		$data['posts'] = $this->admin_model->getRows( 'thanhvien', 'typethanhvien!="admin"', 'id', array(
			'start' => $offset,
			'limit' => $this->perPage
		) );


		//load the view


		$this->load->view( 'admin/pages/content/member-phantrang', $data, false );

	}

	public function add_member() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );
			

		} else {

			$email = $this->session->userdata( "user_admin" );

			$get_typethanhvien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email . '"', 'typethanhvien' );

			if ( $get_typethanhvien == 'admin' ) {

				$data["page_slug"] = "add_member";

				$data["page_title"] = "Thành viên";

				$data["page_des"] = "Thêm mới thành viên";

				$this->load->view( 'admin/page', $data );

			} else {

				echo 'Xin lỗi ! Bạn không có quyền truy cập.';

			}

		}

	}

	public function lock_table() {

		if ( ( isset( $_POST['table_rs'] ) ) and ( isset( $_POST['id_rs'] ) ) ) {

			$table_rs = $_POST['table_rs'];

			$id_rs = $_POST['id_rs'];

			$query = $this->db->query( "

				UPDATE " . $this->prefix . "$table_rs

				SET trangthai=0

				WHERE id='$id_rs'

			" );

		} else {

			redirect( URL . '404page');

		}

	}

	public function unlock_table() {

		if ( ( isset( $_POST['table_rs'] ) ) and ( isset( $_POST['id_rs'] ) ) ) {

			$table_rs = $_POST['table_rs'];

			$id_rs = $_POST['id_rs'];

			$query = $this->db->query( "

				UPDATE " . $this->prefix . "$table_rs

				SET trangthai=1

				WHERE id='$id_rs'

			" );

		} else {

			redirect( URL . '404page');

		}

	}

	public function delete_table() {

		if ( ( isset( $_POST['table_rs'] ) ) and ( isset( $_POST['id_rs'] ) ) ) {

			$table_rs = $_POST['table_rs'];

			$id_rs = $_POST['id_rs'];

			if ( $table_rs == 'sanpham' ) {//table sanpham

				$query  = $this->db->query( "DELETE FROM " . $this->prefix . "$table_rs WHERE id_sanpham='$id_rs'" );
				$query1 = $this->db->query( "DELETE FROM " . $this->prefix . "post WHERE id='$id_rs'" );

				//echo "DELETE FROM " . $this->prefix . "$table_rs WHERE id_sanpham='$id_rs'";

			} else {

				$query = $this->db->query( "DELETE FROM " . $this->prefix . "$table_rs WHERE id='$id_rs'" );
			}


		} else {

			redirect( URL . '404page');

		}

	}

	public function post() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );

		} else {


			$data = array();

			$post_type = 'post';

			$data["page_title"] = "Bài viết";

			$data["page_des"] = "Danh sách bài viết";

			$trangthai = '';

			$name_lienhe = '';

			$title_search = '';

			$thuoctinhsanpham = '';

			if ( isset( $_GET['post_type'] ) ) {

				$post_type = $_GET['post_type'];

				if ( $post_type == 'page' ) {

					$data["page_title"] = "Trang";

					$data["page_des"] = "Danh sách trang";

				} else if ( $post_type != 'post' ) {

					if ( $post_type == 'widget' ) {

						$data["page_title"] = "Widget";

						$data["page_des"] = "Danh sách widget";

					} else if ( $post_type == 'cat' ) {

						$data["page_title"] = "Chuyên mục";

						$data["page_des"] = "Danh sách chuyên mục";

					} else if ( $post_type == 'widget_cat' ) {

						$data["page_title"] = "Chuyên mục widget";

						$data["page_des"] = "Danh sách chuyên mục widget";

					} else if ( $post_type == 'menu' ) {//Menu

						$data["page_title"] = "Main menu";

						$data["page_des"] = "Menu chính";

					} else if ( $post_type == 'sanpham' ) {//prodcut

						$data["page_title"] = "Sản phẩm";

						$data["page_des"] = "Danh sách sản phẩm";

					}

				}

			}


			if ( isset( $_GET['post_status'] ) ) {

				$trangthai = 'and trangthai=' . $_GET['post_status'] . '';

			}

			if ( isset( $_GET['title_post_filter'] ) ) {

				$title_search = 'and ten LIKE "%' . $_GET['title_post_filter'] . '%" ';

			}


			if ( isset( $_GET['name_lienhe'] ) ) {

				$name_lienhe = 'and ten="' . $_GET['name_lienhe'] . '" ';

			}


			if ( isset( $_GET['thuoctinhsanpham'] ) ) {

				$thuoctinhsanpham = 'and idpostpr="' . $_GET['thuoctinhsanpham'] . '" ';

			}


			if ( $this->admin_model->getRows( 'post', 'typepost="' . $post_type . '" ' . $trangthai . ' ' . $name_lienhe . ' ' . $title_search . ' ' . $thuoctinhsanpham . ' ', 'id' ) ) {

				$totalRec = count( $this->admin_model->getRows( 'post', 'typepost="' . $post_type . '" ' . $trangthai . ' ' . $name_lienhe . ' ' . $title_search . ' ' . $thuoctinhsanpham . ' ', 'id' ) );

			} else {

				$totalRec = 0;

			}//add


			$offset = ( $this->uri->segment( 3 ) == '' ) ? 0 : $this->uri->segment( 3 );

			$config['total_rows'] = $totalRec;

			$config['per_page'] = $this->perPage;

			$config['next_link'] = '»';

			$config['prev_link'] = '«';

			$config['num_links'] = 5;

			$config['cur_tag_open'] = '<a class="currentpage">';

			$config['cur_tag_close'] = '</a>';

			$config['base_url'] = URL_AD . 'post';

			// $config['suffix'] 			= '?'.http_build_query($_GET, '0', "&");

			$config['reuse_query_string'] = true;

			$config['uri_segment'] = 3;

			$this->pagination->initialize( $config );


			$pagination = $this->pagination->create_links();


			//get the posts data

			$data['posts'] = $this->admin_model->getRows( 'post', 'typepost="' . $post_type . '" ' . $trangthai . ' ' . $name_lienhe . ' ' . $title_search . ' ' . $thuoctinhsanpham . ' ', 'ngaycapnhat', array(
				'start' => $offset,
				'limit' => $this->perPage
			) );


			//load the view

			$data["page_slug"] = "post";

			$data["post_type"] = $post_type;

			$data["table"] = "post";


			if ( $post_type == 'sanpham' ) {//prodcut

				$data["table"] = "sanpham";

			}

			$data["pagination"] = $pagination;

			$this->load->view( 'admin/page', $data );


		}

	}

	function post_phantrang() {

		$page = $this->input->post( 'page' );


		$trangthai = '';

		if ( isset( $_GET['post_type'] ) ) {

			$post_type = $_GET['post_type'];

			if ( $post_type == 'page' ) {

				$data["page_title"] = "Trang";

				$data["page_des"] = "Danh sách trang";

			} else if ( $post_type != 'post' ) {

				if ( $post_type == 'widget' ) {

					$data["page_title"] = "Widget";

					$data["page_des"] = "Danh sách widget";

				} else if ( $post_type == 'cat' ) {

					$data["page_title"] = "Chuyên mục";

					$data["page_des"] = "Danh sách chuyên mục";

				} else if ( $post_type == 'widget_cat' ) {

					$data["page_title"] = "Chuyên mục widget";

					$data["page_des"] = "Danh sách chuyên mục widget";

				} else if ( $post_type == 'menu' ) {//Menu

					$data["page_title"] = "Main menu";

					$data["page_des"] = "Menu chính";

				}

			}

		} else {

			$post_type = 'post';

		}


		if ( ! $page ) {

			$offset = 0;

		} else {

			$offset = $page;

		}

		echo $offset;

		//total rows count

		if ( isset( $_GET['post_status'] ) ) {

			$trangthai = 'and trangthai=' . $_GET['post_status'] . '';

		}


		//total rows count

		$totalRec = count( $this->admin_model->getRows( 'post', 'typepost="' . $post_type . '" ' . $trangthai . ' ', 'id' ) );


		//pagination configuration

		$config['target'] = '#postList';

		$config['base_url'] = URL . 'admin/post_phantrang';

		$config['total_rows'] = $totalRec;

		$config['per_page'] = $this->perPage;

		$this->ajax_pagination->initialize( $config );


		//get the posts data

		$data['posts'] = $this->admin_model->getRows( 'post', 'typepost="' . $post_type . '" ' . $trangthai . ' ', 'id', array(
			'start' => $offset,
			'limit' => $this->perPage
		) );

		echo $post_type;

		//load the view

		$data["page_slug"] = "post";

		$data["post_type"] = $post_type;

		$data["table"] = "post";

		$this->load->view( 'admin/pages/content/post-phantrang', $data, false );

	}


	public function post_new() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'admin' );

		} else {

			$data['id_post_edit'] = '';

			$data['ten_post_edit'] = '';

			$data['url_post_edit'] = '';

			$data['keyword_post_edit'] = '';

			$data['focus_keywords_post_edit'] = '';

			$data['seo_title_post_edit'] = '';


			$data['idpostpr_post_edit'] = '';

			$data['mota_post_edit'] = '';

			$data['noidung_post_edit'] = '';

			$data['ten_cat_edit'] = '';

			$data['url_cat_edit'] = '';

			$data['anhdaidien_post_edit'] = '';

			$data['link_anhdaidien_post_edit'] = '';


			$data['gia_product_edit'] = '';

			$data['giakhuyenmai_product_edit'] = '';

			$data['thongsokythuat_product_edit'] = '';

			$data['hotro_product_edit'] = '';

			//---

			$data["page_slug"] = "post_new";

			$data["page_title"] = "Thêm bài viết";

			$data["page_des"] = "Thêm bài viết";

			$data["table"] = "post";


			$data["post_type"] = "post";

			if ( isset( $_GET['post_type'] ) ) {

				$post_type = $_GET['post_type'];

				if ( $post_type == 'page' ) {

					$data["post_type"] = "page";

					$data["page_title"] = "Trang";

					$data["page_des"] = "Thêm trang";

				} else if ( $post_type == 'widget' ) {

					$data["post_type"] = "widget";

					$data["page_title"] = "Widget";

					$data["page_des"] = "Thêm mới widget";

				} else if ( $post_type == 'slider' ) {

					$data["post_type"] = "slider";

					$data["page_title"] = "Slider";

					$data["page_des"] = "Thêm mới slider";

				} else if ( $post_type == 'home_config' ) {//config home

					$data["post_type"] = "home_config";

					$data["page_title"] = "Cấu hình trang chủ";

					$data["page_des"] = "Cấu hình thuộc tính trang chủ";

					$data["page_slug"] = "home_config";

				} else if ( $post_type == 'sanpham' ) {//config home

					$data["post_type"] = "sanpham";

					$data["page_title"] = "Sản phẩm";

					$data["page_des"] = "Danh sách sản phẩm";

				} else {

					if ( empty( $post_type ) ) {

						$data["post_type"] = "cat";

						$data["page_title"] = "Chuyên mục";

						$data["page_des"] = "Danh sách chuyên mục";

					}

				}

			}

			//----

			if ( ! empty( $_GET['edit'] ) ) {

				$id_post_get = $_GET['edit'];

				$get_post = $this->admin_model->select_table_dk( 'post', 'id', '=' . $id_post_get . '' );

				foreach ( $get_post as $row_get_post ) {

					$data['id_post_edit'] = $row_get_post->id;

					$data['ten_post_edit'] = $row_get_post->ten;

					$data['seo_title_post_edit'] = $row_get_post->seo_title;

					$data['url_post_edit'] = $row_get_post->url;

					$data['keyword_post_edit'] = $row_get_post->keyword;

					$data['idpostpr_post_edit'] = $row_get_post->idpostpr;

					$data['mota_post_edit'] = $row_get_post->mota;

					$data['noidung_post_edit'] = $row_get_post->noidung;

					$data['anhdaidien_post_edit'] = $row_get_post->anhdaidien;

					$data['focus_keywords_post_edit'] = $row_get_post->focus_keywords;

					$data['thuvienanh_post_edit'] = $row_get_post->thuvienanh;

					$data['ngaycapnhat_post_edit'] = $row_get_post->ngaycapnhat;

					$data['link_anhdaidien_post_edit'] = $row_get_post->link_anhdaidien;


					if ( $post_type == 'sanpham' ) {//get infor sp

						$get_sanpham = $this->admin_model->select_table_dk( 'sanpham', 'id_sanpham', '=' . $id_post_get . '' );

						foreach ( $get_sanpham as $row_get_sanpham ) {

							$data['gia_product_edit'] = $row_get_sanpham->gia;

							$data['giakhuyenmai_product_edit'] = $row_get_sanpham->giakhuyenmai;

							$data['thongsokythuat_product_edit'] = $row_get_sanpham->thongsokythuat;

							$data['hotro_product_edit'] = $row_get_sanpham->hotro;

							$data['meta_product_edit'] = $row_get_sanpham->meta;

							$data['metavl_product_edit'] = $row_get_sanpham->meta_value;

							$data['meta_baohanh_edit'] = $row_get_sanpham->meta_baohanh;

							$data['metavl_baohanh_edit'] = $row_get_sanpham->meta_value_baohanh;

						}

					}

					// $name_cat=$this->admin_model->select_table_dk('post','id','='.$row_get_post->idpostpr.'');

					// foreach($name_cat as $row_name_cat){

					// $data['ten_cat_edit']=$row_get_post->ten;

					// $data['url_cat_edit']=$row_get_post->url;

					// }


					$list_chuyenmuc = $row_get_post->idpostpr;

					if ( $post_type == 'thuoctinhsanpham' ) {

						if ( $list_chuyenmuc == 0 ) {

							$data['ten_cat_edit'] = 'Lựa chọn';

							$data['url_cat_edit'] = $list_chuyenmuc;

						} else {

							$data['ten_cat_edit'] = 'Color';

							$data['url_cat_edit'] = $list_chuyenmuc;

						}


					} else {


						$list_chuyenmuc_ex = explode( ',', $list_chuyenmuc );

						$ten_chuyenmuc_arr = array();

						foreach ( $list_chuyenmuc_ex as $chuyenmuc ) {

							$name_cat = $this->admin_model->select_table_dk( 'post', 'id', '=' . $chuyenmuc . '' );

							foreach ( $name_cat as $row_name_cat ) {

								$data['ten_cat_edit'] = $row_get_post->ten;

								$data['url_cat_edit'] = $row_get_post->url;

								// $data['id_cat_edit']=$row_get_post->url;

								array_push( $ten_chuyenmuc_arr, $row_name_cat->id );

								$ten_chuyenmuc_rs = implode( ", ", $ten_chuyenmuc_arr );

								$data['id_cat_edit'] = $ten_chuyenmuc_rs;// =>post_new

							}

						}

					}


				}

			}


			$this->load->view( 'admin/page', $data );


		}

	}

	public function mail_view() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'admin' );

		} else {

			$data["page_slug"] = "infor_mail";

			$data["page_title"] = "Mail khách hàng";

			$data["page_des"] = "Thông tin đăng ký";

			$data["id_mail"] = $_GET['view'];


			$infor = $this->admin_model->select_table_dk_col_get( 'post', 'typepost="lienhe" and id="' . $_GET['view'] . '"', 'noidung' );

			$data["infor"] = $infor;

			$this->load->view( 'admin/page', $data );

		}

	}

	public function upload() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'admin' );

		} else {

			$data["page_slug"] = "upload";

			$data["page_title"] = "Thư viện";

			$data["page_des"] = "Danh sách hình ảnh, tập tin";

			$this->load->view( 'admin/page', $data );

		}

	}

	public function insert_post() {

		$name_avt = date( 'YmdHis' ) . '.';

		// $name_avt=round(microtime(true)) . '.' ;

		if ( isset( $_FILES['file'] ) ) {

			$temp = pathinfo( $_FILES["file"]["name"], PATHINFO_EXTENSION );

			$newfilename = $name_avt . $temp;

			// $temp = explode(".", $_FILES["file"]["name"]);

			// $newfilename = $name_avt . end($temp);

			if ( $_FILES['file']['size'] > 1048576 ) {

				die( "Kích thước ảnh không được lớn hơn 1mb" );

			} else {

				define( "SITE_PATH", $_SERVER['DOCUMENT_ROOT'] . '/upload/baiviet/' );  // Thư mục gốc của website

				if ( move_uploaded_file( $_FILES['file']['tmp_name'], 'upload/baiviet/' . $newfilename ) ) {

					// die('Upload thành công file: '. $newfilename);


					$this->xulychuoi->CreateThumbImage( SITE_PATH . $newfilename, SITE_PATH . "thumb/" . $newfilename, ( $temp ), 300, 325 );

					$this->xulychuoi->CreateThumbImage( SITE_PATH . $newfilename, SITE_PATH . "small/" . $newfilename, ( $temp ), 90, 90 );


					die( '<img alt="" src="' . UP_POST . $newfilename . '" width="90%"/>' );

				} else {

					die( 'Có lỗi!' );

				}

			}

		}

		if ( isset( $_POST['ten_post'] ) ) {

			$ten_post = str_replace( "'", "''", $_POST['ten_post'] );

			$check_name = $this->admin_model->count_table_dk( 'post', 'ten', '"' . $ten_post . '"' );


			$typepost = $_POST['typepost'];

			$url_post = $_POST['url_post'];

			if ( $url_post == '' ) {

				$url_post = $this->xulychuoi->to_slug( $ten_post, $check_name );

			} else {

				$check_url = $this->admin_model->count_table_dk( 'post', 'url', '"' . $url_post . '"' );

				if ( $check_url == 0 ) {

					$url_post = $_POST['url_post'];

				} else {

					$url_post = $this->xulychuoi->to_slug( $ten_post, $check_name );

				}


			}


			$keyword_post = $_POST['keyword_post'];

			$seo_title_post = $_POST['seo_title_post'];

			$idpostpr_post = $_POST['idpostpr_post'];

			$mota_post = str_replace( "'", "''", $_POST['mota_post'] );

			$noidung_post = str_replace( "'", "''", $_POST['noidung_post'] );

			$date = date( 'Y-m-d H:i:s' );


			$anhdaidien_string = $_POST['anhdaidien_post'];

			$anhdaidien_post = '';

			$menu_link = $this->admin_model->select_value_table_dk_col( 'post', 'id', '="' . $_POST['menu_link'] . '"', 'url' );

			$id_slider = $_POST['id_slider'];

			$trangthai = $_POST['trangthai'];

			//---

			if ( $idpostpr_post == '' ) {

				$idpostpr_post = 0;

			}

			//---

			if ( ! empty( $anhdaidien_string ) ) {

				$anhdaidien_string_ex = pathinfo( $anhdaidien_string, PATHINFO_EXTENSION );

				$anhdaidien_post = $name_avt . $anhdaidien_string_ex;

			}

			//---------------------------

			$anhdaidien_post_manager = $_POST['anhdaidien_post'];

			$link_anhdaidien = $_POST['link_anhdaidien'];

			$id_related = $_POST['id_related'];


			$thuvienanh_post_arr = $_POST['thuvienanh'];

			$thuvienanh_post = str_replace( '[', '', $thuvienanh_post_arr );

			$thuvienanh_post = str_replace( ']', '', $thuvienanh_post );

			$thuvienanh_post = str_replace( '"', '', $thuvienanh_post );


			$sql = " INSERT INTO " . $this->prefix . "post(ten,url,keyword,mota,noidung,anhdaidien,link_anhdaidien,thuvienanh,idpostpr,typepost,id_related,ngaydang,ngaycapnhat,trangthai,menu_link,id_slider,seo_title)

				VALUES ('" . $ten_post . "','" . $url_post . "','" . $keyword_post . "','" . $mota_post . "','" . $noidung_post . "','" . $anhdaidien_post_manager . "','" . $link_anhdaidien . "','" . $thuvienanh_post . "','" . $idpostpr_post . "','" . $typepost . "','" . $id_related . "','" . $date . "','" . $date . "','" . $trangthai . "','" . $menu_link . "','" . $id_slider . "','" . $seo_title_post . "')";

			$query = $this->db->query( $sql );

			$id_sanpham = $this->db->insert_id();

			//------ add sanpham ---------

			if ( $typepost == 'sanpham' ) {


				$gia = $_POST['gia'];

				$giakhuyenmai = $_POST['giakhuyenmai'];

				$thongsokythuat = str_replace( "'", "''", $_POST['thongsokythuat'] );

				$hotro = str_replace( "'", "''", $_POST['hotro'] );

				$meta = json_encode( $_POST['meta'] );

				$meta_value = json_encode( $_POST['meta_value'], JSON_UNESCAPED_UNICODE );

				$meta_baohanh = json_encode( $_POST['meta_baohanh'] );

				$meta_value_baohanh = json_encode( $_POST['meta_value_baohanh'], JSON_UNESCAPED_UNICODE );


				$sql_sp = " INSERT INTO " . $this->prefix . "sanpham(id_sanpham,gia,giakhuyenmai,thongsokythuat,hotro,meta,meta_value,meta_baohanh,meta_value_baohanh)

				VALUES ('" . $id_sanpham . "','" . $gia . "','" . $giakhuyenmai . "','" . $thongsokythuat . "','" . $hotro . "','" . $meta . "','" . $meta_value . "','" . $meta_baohanh . "','" . $meta_value_baohanh . "')";

				$query_sp = $this->db->query( $sql_sp );

			}

			//-------------------------

		} else {

			redirect( URL . '404page' );

		}

	}

	public function update_post() {

		$name_avt = date( 'YmdHis' ) . '.';;

		if ( isset( $_FILES['file'] ) ) {

			$temp = pathinfo( $_FILES["file"]["name"], PATHINFO_EXTENSION );

			$newfilename = $name_avt . $temp;

			// $temp = explode(".", $_FILES["file"]["name"]);

			// $newfilename = $name_avt . end($temp);


			if ( $_FILES['file']['size'] > 1048576 ) {

				die( "Kích thước ảnh không được lớn hơn 1mb" );

			} else {

				define( "SITE_PATH", 'upload/baiviet/' );  // Thư mục gốc của website

				if ( move_uploaded_file( $_FILES['file']['tmp_name'], 'upload/baiviet/' . $newfilename ) ) {

					// die('Upload thành công file: '. $newfilename);

					$this->xulychuoi->CreateThumbImage( SITE_PATH . $newfilename, SITE_PATH . "thumb/" . $newfilename, ( $temp ), 300, 325 );

					$this->xulychuoi->CreateThumbImage( SITE_PATH . $newfilename, SITE_PATH . "small/" . $newfilename, ( $temp ), 90, 90 );


					die( '<img src="' . UP_POST . $newfilename . '" width="90%"/>' );

				} else {

					die( 'Có lỗi!' );

				}

			}

		}


		if ( isset( $_POST['ten_post'] ) ) {

			$ten_post = str_replace( "'", "''", $_POST['ten_post'] );

			$check_name = $this->admin_model->count_table_dk( 'post', 'ten', '"' . $ten_post . '"' );

			$id_update = $_POST['id_update'];

			$typepost = $_POST['typepost'];


			$url_post_cr = $this->admin_model->select_table_dk( 'post', 'id', '=' . $id_update . '' );

			foreach ( $url_post_cr as $row_url_post_cr ) {

				$ten_check = $row_url_post_cr->ten;

				$url_check = $row_url_post_cr->url;

			}


			if ( $ten_post != $ten_check ) {//update url


				$url_post = $this->xulychuoi->to_slug( $ten_post, $check_name );


			} else {

				//if($typepost=='menu' || $typepost=='slider'){

				$url_post = $_POST['url_post'];

				if ( $url_post == '' ) {

					$url_post = $url_check;

				}


			}


			$keyword_post = $_POST['keyword_post'];

			$seo_title_post = $_POST['seo_title_post'];

			$focus_keywords = $_POST['focus_keywords'];

			$idpostpr_post = $_POST['idpostpr_post'];

			if ( $idpostpr_post == '' ) {

				$idpostpr_post = 0;

			}

			$mota_post = str_replace( "'", "''", $_POST['mota_post'] );

			$id_slider = $_POST['id_slider'];

			$noidung_post = str_replace( "'", "''", $_POST['noidung_post'] );

			$date = date( 'Y-m-d H:i:s' );


			$anhdaidien_post_check = $this->admin_model->select_value_table_dk_col( 'post', 'id', '=' . $id_update . '', 'anhdaidien' );

			$ngaycapnhat_post_check = $this->admin_model->select_value_table_dk_col( 'post', 'id', '=' . $id_update . '', 'ngaycapnhat' );


			$anhdaidien_string = $_POST['anhdaidien_post'];

			$anhdaidien_post = '';


			if ( ! empty( $anhdaidien_string ) and ( $anhdaidien_string != $anhdaidien_post_check ) ) {

				$anhdaidien_string_ex = pathinfo( $anhdaidien_string, PATHINFO_EXTENSION );

				$anhdaidien_post = $name_avt . $anhdaidien_string_ex;

			} else {

				$anhdaidien_post = $anhdaidien_post_check;

			}

			//------

			$anhdaidien_post_manager = $_POST['anhdaidien_post'];

			$link_anhdaidien = $_POST['link_anhdaidien'];

			$id_related = $_POST['id_related'];


			$thuvienanh_post_arr = $_POST['thuvienanh'];

			$thuvienanh_post = str_replace( '[', '', $thuvienanh_post_arr );

			$thuvienanh_post = str_replace( ']', '', $thuvienanh_post );

			$thuvienanh_post = str_replace( '"', '', $thuvienanh_post );


			$ngaycapnhat_post = $_POST['ngaycapnhat'];

			if ( $ngaycapnhat_post != $ngaycapnhat_post_check ) {

				$ngaycapnhat = $ngaycapnhat_post;

			} else {

				$ngaycapnhat = $ngaycapnhat_post_check;

			}

			$menu_link = $this->admin_model->select_value_table_dk_col( 'post', 'id', '="' . $_POST['menu_link'] . '"', 'url' );

			$trangthai = $_POST['trangthai'];

			$sql = "UPDATE " . $this->prefix . "post

				SET ten = '" . $ten_post . "',

					url = '" . $url_post . "',

					keyword = '" . $keyword_post . "',

					focus_keywords = '" . $focus_keywords . "',

					mota = '" . $mota_post . "',

					noidung = '" . $noidung_post . "',

					ngaycapnhat = '" . $ngaycapnhat . "',

					anhdaidien = '" . $anhdaidien_post_manager . "',

					thuvienanh = '" . $thuvienanh_post . "',

					idpostpr='" . $idpostpr_post . "',

					id_related='" . $id_related . "',

					menu_link='" . $menu_link . "',

					id_slider='" . $id_slider . "', 

					trangthai='" . $trangthai . "',

					link_anhdaidien='" . $link_anhdaidien . "',

					seo_title='" . $seo_title_post . "'

				WHERE id=" . $id_update . " ";


			$query = $this->db->query( $sql );


			//------ add sanpham ---------

			if ( $typepost == 'sanpham' ) {

				$gia = $_POST['gia'];

				$giakhuyenmai = $_POST['giakhuyenmai'];

				$thongsokythuat = str_replace( "'", "''", $_POST['thongsokythuat'] );

				$hotro = str_replace( "'", "''", $_POST['hotro'] );

				$meta = json_encode( $_POST['meta'] );

				$meta_value = json_encode( $_POST['meta_value'], JSON_UNESCAPED_UNICODE );

				$meta_baohanh = json_encode( $_POST['meta_baohanh'] );

				$meta_value_baohanh = json_encode( $_POST['meta_value_baohanh'], JSON_UNESCAPED_UNICODE );


				$sql = "UPDATE " . $this->prefix . "sanpham

				SET gia = '" . $gia . "',

					giakhuyenmai = '" . $giakhuyenmai . "',

					thongsokythuat = '" . $thongsokythuat . "',

					hotro = '" . $hotro . "',

					meta = '" . $meta . "',

					meta_value = '" . $meta_value . "',

					meta_baohanh = '" . $meta_baohanh . "',

					meta_value_baohanh = '" . $meta_value_baohanh . "'

				WHERE id_sanpham=" . $id_update . " ";


				$query = $this->db->query( $sql );

			}

			//-------------------------


		} else {

			redirect( URL . '404page' );

		}

	}

	public function action_post() {

		if ( isset( $_POST['action'] ) || isset( $_POST['list_id'] ) ) {

			$action = $_POST['action'];

			$list_id = $_POST['list_id'];

			$list_id_ex = explode( ',', $list_id );

			foreach ( $list_id_ex as $row_list_id_ex ) {

				if ( $action == 'unactive' ) {

					$sql = "UPDATE " . $this->prefix . "post

						SET trangthai = 0	

						WHERE id=" . $row_list_id_ex . " ";

				} else if ( $action == 'active' ) {

					$sql = "UPDATE " . $this->prefix . "post

						SET trangthai = 1	

						WHERE id=" . $row_list_id_ex . " ";

				} else if ( $action == 'remove' ) {

					$sql = "DELETE FROM " . $this->prefix . "post where id=" . $row_list_id_ex . " ";

				}

				$query = $this->db->query( $sql );

			}

		} else {

			redirect( URL . '404page' );

		}

	}

	public function upload1()//text example

	{

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'admin' );

		} else {

			// $data["page_slug"]="editors";

			// $data["page_title"]="Thư viện";

			// $data["page_des"]="Danh sách hình ảnh, tập tin";

			$this->load->view( 'admin/pages/forms/general.php' );

		}

	}


	public function insert_config() {

		if ( isset( $_POST['data'] ) ) {

			$ten = $_POST['name'];

			$noidung = json_encode( $_POST['data'], JSON_UNESCAPED_UNICODE );

			$ngaydang = date( 'Y-m-d H:i:s' );


			$check_home_config = $this->admin_model->count_table_dk_cus( 'post', 'ten="' . $ten . '"' );

			if ( $check_home_config != 0 ) {

				$sql = "UPDATE " . $this->prefix . "post SET 

				ngaycapnhat = '" . $ngaydang . "',

				noidung = '" . $noidung . "'					

				WHERE ten='" . $ten . "' ";

			} else {

				$sql = " INSERT INTO " . $this->prefix . "post(ten,noidung,typepost,trangthai,ngaydang,ngaycapnhat)

				VALUES ('" . $ten . "','" . $noidung . "','config',1,'" . $ngaydang . "','" . $ngaydang . "')";

			}

			$query = $this->db->query( $sql );


		} else {

			redirect( URL . '404page');

		}

	}


	public function insert_user() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );

		} else {

			$email = $this->session->userdata( "user_admin" );

			$get_typethanhvien = $this->admin_model->select_value_table_dk_col_1value( 'thanhvien', 'email="' . $email . '"', 'typethanhvien' );

			if ( $get_typethanhvien == 'admin' ) {

				$email = $_POST['email'];

				$matkhau = $_POST['matkhau'];

				$hoten = $_POST['hoten'];

				$ngaydang = date( 'Y-m-d H:i:s' );

				$ngaycapnhat = date( 'Y-m-d H:i:s' );


				$check_email = $this->admin_model->count_table_dk_cus( 'thanhvien', 'email="' . $email . '"' );

				if ( $check_email != 0 ) {

					$rs = 0;

				} else {

					$matkhau_up = $this->md5_system->hsc_md5_password( $email, $matkhau );

					echo $sql = " INSERT INTO " . $this->prefix . "thanhvien(hoten,email,matkhau,ngaydangky,ngaycapnhat,typethanhvien,trangthai)

					VALUES ('" . $hoten . "','" . $email . "','" . $matkhau_up . "','" . $ngaydang . "','" . $ngaydang . "','tuyensinh',1)";

					$query = $this->db->query( $sql );

					$rs = 1;

				}

				echo $rs;

			} else {

				echo 'Xin lỗi ! Bạn không có quyền truy cập.';

			}

		}

	}


	public function update_donhang() {

		$id = $_POST['id'];

		$ghichu = $_POST['ghichu'];

		$trangthai = $_POST['trangthai'];

		$ngaycapnhat = date( 'Y-m-d H:i:s' );


		$sql = "UPDATE " . $this->prefix . "donhang

			SET ghichu = '" . $ghichu . "',

				ngaycapnhat = '" . $ngaycapnhat . "',

				trangthai = '" . $trangthai . "'

			WHERE id=" . $id . " ";


		$query = $this->db->query( $sql );


		if ( $query ) {

			echo URL_AD . 'donhang';

		} else {

			echo '0';

		}

	}


	public function update_tragop() {

		$id = $_POST['id'];

		$ghichu = $_POST['ghichu'];

		$trangthai = $_POST['trangthai'];

		$ngaycapnhat = date( 'Y-m-d H:i:s' );


		$sql = "UPDATE " . $this->prefix . "tragop

			SET ghichu = '" . $ghichu . "',

				ngaycapnhat = '" . $ngaycapnhat . "',

				trangthai = '" . $trangthai . "'

			WHERE id=" . $id . " ";


		$query = $this->db->query( $sql );


		if ( $query ) {

			echo URL_AD . 'tragop';

		} else {

			echo '0';

		}

	}


	// create xlsx

	public function export_sp() {

		if ( $this->check_session_user() == 0 ) {

			redirect( URL . 'login' );

		} else {

			// create file name

			$fileName = 'data-product-' . time() . '.xlsx';

			// load excel library

			$this->load->library( 'excel' );

			$empInfo = $this->admin_model->select_table_dk_col_get( 'sanpham', 'id!=0', 'id,id_sanpham,gia,giakhuyenmai' );

			$objPHPExcel = new PHPExcel();

			$objPHPExcel->setActiveSheetIndex( 0 );

			// set Header

			$objPHPExcel->getActiveSheet()->SetCellValue( 'A1', 'ID' );

			$objPHPExcel->getActiveSheet()->SetCellValue( 'B1', 'Tiêu đề' );

			$objPHPExcel->getActiveSheet()->SetCellValue( 'C1', 'Mô tả' );

			$objPHPExcel->getActiveSheet()->SetCellValue( 'D1', 'Liên kết' );

			$objPHPExcel->getActiveSheet()->SetCellValue( 'E1', 'Tình trạng' );

			$objPHPExcel->getActiveSheet()->SetCellValue( 'F1', 'Giá' );

			$objPHPExcel->getActiveSheet()->SetCellValue( 'G1', 'Còn hàng' );

			$objPHPExcel->getActiveSheet()->SetCellValue( 'H1', 'Liên kết hình ảnh' );

			$objPHPExcel->getActiveSheet()->SetCellValue( 'I1', 'Gtin' );

			// set Row

			$rowCount = 2;

			foreach ( $empInfo as $element ) {

				$ten_sp = $this->admin_model->select_value_table_dk_col_1value( 'post', 'id=' . $element->id_sanpham . '', 'ten' );

				$mota_sp = $this->admin_model->select_value_table_dk_col_1value( 'post', 'id=' . $element->id_sanpham . '', 'mota' );

				$anhdaidien_sp = $this->admin_model->select_value_table_dk_col_1value( 'post', 'id=' . $element->id_sanpham . '', 'anhdaidien' );

				$meta_value = $this->admin_model->select_value_table_dk_col_1value( 'sanpham', 'id_sanpham=' . $element->id_sanpham . '', 'meta_value' );

				$meta_value = json_decode( $meta_value, true );


				//var_dump($meta_value);

				if ( $meta_value != 'null' ) {

					$min_price = $meta_value[0][2];

					$min_price_km = $meta_value[0][3];


					$gia_rs_arr = array();

					$gia_km_rs_arr = array();

					$count_i = 0;

					foreach ( $meta_value as $key => $value ) {

						$gia = str_replace( "*", "-", $value[2] );

						$gia_km = str_replace( "*", "-", $value[3] );


						if ( $gia != '' ) {

							array_push( $gia_rs_arr, $gia );

						}


						if ( $gia_km != '' ) {

							array_push( $gia_km_rs_arr, $gia_km );

						}

						//----


						if ( count( $gia_rs_arr ) > 0 ) {

							$gia_rs = min( $gia_rs_arr );

						} else {

							$gia_rs = '';

						}


						if ( count( $gia_km_rs_arr ) > 0 ) {

							$gia_km_rs = min( $gia_km_rs_arr );

						} else {

							$gia_km_rs = '';

						}


					}

				} else {

					$gia_rs = $element->gia;

					$gia_km_rs = $element->giakhuyenmai;

				}


				if ( $gia_km_rs ) {

					$gia_rs = $gia_km_rs;

				}


				$url_sp = $this->admin_model->select_value_table_dk_col_1value( 'post', 'id=' . $element->id_sanpham . '', 'url' );

				$url_sp = URL . $url_sp;

				$anhdaidien_sp = UPLOAD_URL . $anhdaidien_sp;

				$objPHPExcel->getActiveSheet()->SetCellValue( 'A' . $rowCount, $element->id_sanpham );

				$objPHPExcel->getActiveSheet()->SetCellValue( 'B' . $rowCount, $ten_sp );

				$objPHPExcel->getActiveSheet()->SetCellValue( 'C' . $rowCount, $mota_sp );

				$objPHPExcel->getActiveSheet()->SetCellValue( 'D' . $rowCount, $url_sp );

				$objPHPExcel->getActiveSheet()->SetCellValue( 'E' . $rowCount, 'Mới' );

				$objPHPExcel->getActiveSheet()->SetCellValue( 'F' . $rowCount, $gia_rs );

				$objPHPExcel->getActiveSheet()->SetCellValue( 'G' . $rowCount, 'Còn hàng' );

				$objPHPExcel->getActiveSheet()->SetCellValue( 'H' . $rowCount, $anhdaidien_sp );

				$objPHPExcel->getActiveSheet()->SetCellValue( 'I' . $rowCount, 'CTSTORE' );

				$rowCount ++;

			}

			$objWriter = new PHPExcel_Writer_Excel2007( $objPHPExcel );

			$objWriter->save( "upload/" . $fileName );

			//download file

			header( "Content-Type: application/vnd.ms-excel" );

			redirect( base_url() . "/upload/" . $fileName );

		}

	}


}

