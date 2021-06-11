<?php
	global $user_email;
	global $user_sodienthoai;
	global $user_anhdaidien;
	global $user_hoten;
	global $user_ngaydangky;
	global $user_trangthai;
	global $user_typethanhvien;
	global $user_id;
	global $user_matkhau;
	global $user_ngaysinh;
	global $user_honnhan;
	global $user_gioitinh;
	global $user_diachi;
	global $user_tinh;
	if(isset($_SESSION['user'])){
		$user_email=$_SESSION['user'];
		$infor_user=$this->page_model->select_table_dk('thanhvien','email',"='".$user_email."'");
		foreach($infor_user as $row_user){
			$user_sodienthoai=$row_user->sodienthoai;
			$user_anhdaidien=$row_user->anhdaidien;
			$user_hoten=$row_user->hoten;
			$user_ngaydangky=$row_user->ngaydangky;
			$user_trangthai=$row_user->trangthai;
			$user_typethanhvien=$row_user->typethanhvien;
			$user_id=$row_user->id;
			$user_ngaysinh=$row_user->ngaysinh;
			$user_honnhan=$row_user->honnhan;
			$user_gioitinh=$row_user->gioitinh;
			$user_diachi=$row_user->diachi;
			$user_tinh=$row_user->tinh;
			
		}
	};
?>