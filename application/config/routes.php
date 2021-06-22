<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['404page'] = 'admin/error_page';
$route['maintenance'] = 'admin/maintenance';
$route['admin'] = 'admin';
$route['login'] = 'admin/login';
$route['logout'] = 'admin/logout';
$route['export_sp'] = 'admin/export_sp';
//$route['admin/(:any)'] = 'admin/$1';
//$route['admin/(:any)(:num)'] = 'admin/$1/$2';
//--------------------------------
$route['dang-ky'] = 'page/dangky';
$route['dang-ky/gia-su'] = 'page/dangkygiasu';
$route['dang-ky/phu-huynh'] = 'page/dangkyphuhuynh';
$route['dang-nhap'] = 'page/dangnhap';
$route['dang-nhap/gia-su'] = 'page/dangnhapgiasu';
$route['dang-nhap/phu-huynh'] = 'page/dangnhapphuhuynh';
$route['quan-ly-tai-khoan'] = 'page/quanlytaikhoan';
$route['cap-nhat-thong-tin-email'] = 'page/update_email';
$route['doi-so-dien-thoai'] = 'page/update_sodienthoai';
$route['thay-doi-mat-khau'] = 'page/update_password';
$route['thay-doi-thong-tin'] = 'page/update_infor';
$route['tao-ho-so-gia-su'] = 'page/creat_cv_giasu';
$route['quan-ly-ho-so'] = 'page/list_hoso_giasu';
$route['danh-sach-ho-so'] = 'page/list_hoso_all';
//-------------
$route['ho-so/(:any)'] = 'page/infor_tv/$1';
$route['dang-xuat'] = 'page/logout';
//--- POST------
// $route['blog/(:any)'] = 'page/post/$1';
$route['(:any)'] = 'page/post/$1';
$route['(:any)/(:num)'] = 'page/post/$1/$2';
