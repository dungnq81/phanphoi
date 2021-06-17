<?php

$data['menu']            = $this->page_model->select_table_dk_col_get( 'post', 'typepost="menu" and trangthai=1 order by ngaycapnhat DESC', 'id,ten,url,menu_link,idpostpr,anhdaidien,mota' );;
$data['logo']            = $this->setting->logo;;
$data['facebook_link']   = $this->setting->facebook;;
$data['twister_link']    = $this->setting->twister;;
$data['fanpage_link']    = $this->setting->fanpage;;
$data['instagram_link']  = $this->setting->instagram;;
$data['share_bv']        = $this->setting->share_bv;;
$data['phantrang']       = $this->setting->phantrang;;
//$data['menu_top']        = $menu_top;
$data['blogname']        = $this->setting->blogname;;
$data['blogdescription'] = $this->setting->blogdescription;;
$data['bando']           = $this->setting->bando;;
$this->load->view( 'content/head', $data );

?>
<body class="content-site">
<?php
$this->load->view( 'content/header', $data );

