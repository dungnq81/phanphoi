<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Xulychuoi

{

	function to_slug($str,$count_chart) {

		$str = trim(mb_strtolower($str));

		$str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);

		$str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);

		$str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);

		$str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);

		$str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);

		$str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);

		$str = preg_replace('/(đ)/', 'd', $str);

		$str = preg_replace('/[^a-z0-9-\s]/', '', $str);

		$str = preg_replace('/([\s]+)/', '-', $str);

		

		if($count_chart!=0){

			$str=$str.'-'.($count_chart);

		}

		return $str;

	}

	function to_slug_style_1($str) {

		$str = trim(mb_strtolower($str));

		$str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);

		$str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);

		$str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);

		$str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);

		$str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);

		$str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);

		$str = preg_replace('/(đ)/', 'd', $str);

		$str = preg_replace('/[^a-z0-9-\s]/', '', $str);

		$str = preg_replace('/([\s]+)/', '-', $str);

		

		return $str;

	}



	function vn_str_filter ($str){

		$unicode = array(

			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

			'd'=>'đ',

			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

			'i'=>'í|ì|ỉ|ĩ|ị',

			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

			'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

			'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

			'D'=>'Đ',

			'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

			'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

			'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

			'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

			'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

		);

		

	   foreach($unicode as $nonUnicode=>$uni){

			$str = preg_replace("/($uni)/i", $nonUnicode, $str);

	   }

		return $str;

	}



	function set_defause_user($str,$str_replace) {

		if($str=='' || $str=='0000-00-00 00:00:00'){

			$str=$str_replace;

		}

		return $str;

	}

	function ex_post($string='',$size=100,$link='...')

	{

		$string = strip_tags(trim($string));

		$strlen = strlen($string);

		$str = substr($string,$size,20);

		$exp = explode(" ",$str);

		$sum =  count($exp);

		$yes= "";

		for($i=0;$i<$sum;$i++)

		{

			if($yes==""){

				$a = strlen($exp[$i]);

				if($a==0){ $yes="no"; $a=0;}

				if(($a>=1)&&($a<=12)){ $yes = "no"; $a;}

				if($a>12){ $yes = "no"; $a=12;}

			}

		}

		$sub = substr($string,0,$size+$a);

		if($strlen-$size>0){ $sub.= $link;}

		return $sub;

	}

	

	function CreateThumbImage($filenameImage, $filenameThumb, $ext, $thumb_width, $thumb_height)

	{

		if($ext == "jpeg" || $ext == "jpg")

		{

			$image = imagecreatefromjpeg($filenameImage);

		}

		if($ext == "png")

		{

			$image = imagecreatefrompng($filenameImage);

		}

		$filename = $filenameThumb;



		// $thumb_width = 300;

		// $thumb_height = 300;



		$width = imagesx($image);

		$height = imagesy($image);



		$original_aspect = $width / $height;

		$thumb_aspect = $thumb_width / $thumb_height;



		if ( $original_aspect >= $thumb_aspect )

		{

		   // If image is wider than thumbnail (in aspect ratio sense)

		   $new_height = $thumb_height;

		   $new_width = $width / ($height / $thumb_height);

		}

		else

		{

		   // If the thumbnail is wider than the image

		   $new_width = $thumb_width;

		   $new_height = $height / ($width / $thumb_width);

		}



		$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );



		switch ($ext) {

		    case 'png':

		        // integer representation of the color black (rgb: 0,0,0)

		        $background = imagecolorallocate($thumb , 0, 0, 0);

		        // removing the black from the placeholder

		        imagecolortransparent($thumb, $background);



		        // turning off alpha blending (to ensure alpha channel information

		        // is preserved, rather than removed (blending with the rest of the

		        // image in the form of black))

		        imagealphablending($thumb, false);



		        // turning on alpha channel information saving (to ensure the full range

		        // of transparency is preserved)

		        imagesavealpha($thumb, true);

		        break;



		    default:

		        break;

		}



		// Resize and crop

		imagecopyresampled($thumb,

		                   $image,

		                   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally

		                   0 - ($new_height - $thumb_height) / 2, // Center the image vertically

		                   0, 0,

		                   $new_width, $new_height,

		                   $width, $height);

		switch ($ext) {

			case 'jpg':

			case 'jpeg':

			{

				imagejpeg($thumb, $filename, 100);break;

			}

			case 'png':

			{

				imagepng($thumb,$filename,1);break;

			}

			default:

			{

				imagejpeg($thumb, $filename, 100);

			}

		}

	}

	

	function replace_name_form($str) {

		$str = trim(mb_strtolower($str));

		$str = str_replace('ngaycapcmnd_cha','<i class="fa fa-calendar"></i> Ngày cấp CMND của cha',$str);

		$str = str_replace('noicapcmnd_cha','<i class="fa fa-map-marker"></i> Nơi cấp CMND của cha',$str);

		$str = str_replace('ngaycapcmnd_me','<i class="fa fa-calendar"></i> Ngày cấp CMND của mẹ',$str);

		$str = str_replace('noicapcmnd_me','<i class="fa fa-map-marker"></i> Nơi cấp CMND của mẹ',$str);

		$str = str_replace('email_cha','<i class="fa fa-envelope"></i> Email của cha',$str);

		$str = str_replace('email_me','<i class="fa fa-envelope"></i> Email của mẹ',$str);

		$str = str_replace('hotenphuhuynh','<i class="fa fa-users"></i> Tên cha mẹ',$str);

		$str = str_replace('hotencha','<i class="fa fa-users"></i> Họ tên cha',$str);

		$str = str_replace('hotenme','<i class="fa fa-users"></i> Họ tên mẹ',$str);

		$str = str_replace('tenchame','<i class="fa fa-users"></i> Tên cha mẹ',$str);

		$str = str_replace('tenbe','<i class="fa fa-child"></i> Tên bé',$str);

		$str = str_replace('sodienthoai','<i class="fa fa-mobile"></i> Số điện thoại',$str);

		$str = str_replace('tuoibe','<i class="fa fa-child"></i> Tuổi bé',$str);

		$str = str_replace('email','<i class="fa fa-envelope"></i> Email',$str);

		$str = str_replace('khuvuctruong','<i class="fa fa-graduation-cap"></i> Khu vực trường',$str);

		$str = str_replace('thoigian','<i class="fa fa-calendar"></i> Thời gian',$str);

		$str = str_replace('ngaygio','<i class="fa fa-hourglass"></i> Ngày giờ',$str);

		$str = str_replace('lopdangky_be','<i class="fa fa-graduation-cap"></i> Lớp bé đăng ký',$str);

		$str = str_replace('lopdangky','<i class="fa fa-graduation-cap"></i> Ngày giờ',$str);

		$str = str_replace('frm_mau_dk_online','Đăng ký online',$str);

		$str = str_replace('frm_dangky_nhanbantin','Đăng ký nhận bản tin',$str);

		$str = str_replace('frm_mau_dk_thamquantruong','Đăng ký tham quan trường',$str);

		$str = str_replace('hoten','<i class="fa fa-users"></i> Họ và tên',$str);
		$str = str_replace('sdt','<i class="fa fa-mobile"></i> Số điện thoại',$str);
		

		$str = str_replace('hoten_be','<i class="fa fa-child"></i> Họ tên bé',$str);

		$str = str_replace('ngaysinh_be','<i class="fa fa-calendar"></i> Ngày sinh',$str);

		$str = str_replace('noisinh_be','<i class="fa fa-map-marker"></i> Nơi sinh',$str);

		$str = str_replace('gioitinh_be','<i class="fa fa-genderless"></i> Giới tính',$str);

		$str = str_replace('quoctich_be','<i class="fa fa-map"></i> Quốc tịch',$str);

		$str = str_replace('diachithuongtru_be','<i class="fa fa-map-pin"></i> Địa chỉ thường trú',$str);

		$str = str_replace('diachitamtru_be','<i class="fa fa-map-pin"></i> Địa chỉ tạm trú',$str);

		$str = str_replace('nienhoc_be','<i class="fa fa-calendar"></i> Niên học',$str);

		$str = str_replace('ngaydudinhvaohoc_be','<i class="fa fa-calendar"></i> Ngày dự định vào học',$str);

		$str = str_replace('hoten_cha','<i class="fa fa-male"></i> Họ tên cha',$str);

		$str = str_replace('cmnd_cha','<i class="fa fa-barcode"></i> CMND của cha',$str);

		$str = str_replace('quoctich_cha','<i class="fa fa-map"></i> Quốc tịch của cha',$str);

		$str = str_replace('nghenghiep_cha','<i class="fa fa-building"></i> Nghề nghiệp của cha',$str);

		$str = str_replace('tencongty_cha','<i class="fa fa-building"></i> Tên công ty của cha',$str);

		$str = str_replace('noilamviec_cha','<i class="fa fa-building"></i> Nơi làm việc của cha',$str);

		$str = str_replace('sdt_cha','<i class="fa fa-phone"></i> SĐT cha',$str);

		$str = str_replace('hoten_me','<i class="fa fa-female"></i> Họ tên mẹ',$str);

		$str = str_replace('cmnd_me','<i class="fa fa-barcode"></i> Số CMND của mẹ',$str);

		$str = str_replace('quoctich_me','<i class="fa fa-map"></i> Quốc tịch của mẹ',$str);

		$str = str_replace('nghenghiep_me','<i class="fa fa-building"></i> Nghề nghiệp của mẹ',$str);

		$str = str_replace('tencongty_me','<i class="fa fa-building"></i> Tên công ty của mẹ',$str);

		$str = str_replace('noilamviec_me','<i class="fa fa-building"></i> Nơi làm việc của mẹ',$str);

		$str = str_replace('sdt_me','<i class="fa fa-phone"></i> SĐT mẹ',$str);

		$str = str_replace('cachtimduoc','<i class="fa fa-search"></i> Cách tìm chúng tôi',$str);

		

		$str = str_replace('hoten_nguoi1','<i class="fa fa-address-card"></i> Họ tên người 1',$str);

		$str = str_replace('quanhe_nguoi1','<i class="fa fa-certificate"></i> Quan hệ với trẻ người 1',$str);

		$str = str_replace('dienthoainha_nguoi1','<i class="fa fa-phone"></i> Điện thoại nhà người 1',$str);

		$str = str_replace('dienthoaididong_nguoi1','<i class="fa fa-phone"></i> Điện thoại di động người 1',$str);

		$str = str_replace('dienthoainoilamviec_nguoi1','<i class="fa fa-phone"></i> Điện thoại nơi làm việc người 1',$str);

		

		$str = str_replace('hoten_nguoi2','<i class="fa fa-address-card"></i> Họ tên người 2',$str);

		$str = str_replace('quanhe_nguoi2','<i class="fa fa-certificate"></i> Quan hệ với trẻ người 2',$str);

		$str = str_replace('dienthoainha_nguoi2','<i class="fa fa-phone"></i> Điện thoại nhà người 2',$str);

		$str = str_replace('dienthoaididong_nguoi2','<i class="fa fa-phone"></i> Điện thoại di động người 2',$str);

		$str = str_replace('dienthoainoilamviec_nguoi2','<i class="fa fa-phone"></i> Điện thoại nơi làm việc người 2',$str);

					

		return $str;

	}

}

?>