<?php

	$siteurl=$this->page_model->select_table_dk_col_get_1value('option','name="siteurl"','value');

	$blogname=$this->page_model->select_table_dk_col_get_1value('option','name="blogname"','value');

	$blogdescription=$this->page_model->select_table_dk_col_get_1value('option','name="blogdescription"','value');

	$anhdaidien=$this->page_model->select_table_dk_col_get_1value('option','name="logo"','value');

	$keyword_website=$this->page_model->select_table_dk_col_get_1value('option','name="keyword"','value');

	$type_website='website';

	$homeurl=$this->page_model->select_table_dk_col_get_1value('option','name="home"','value');



	if(!empty($id_post)){

		$type_website=$this->page_model->select_table_dk_col_get_1value('post','id="'.$id_post.'"','typepost');

		$blogname=$this->page_model->select_table_dk_col_get_1value('post','id="'.$id_post.'"','ten');

		$blogdescription=$this->page_model->select_table_dk_col_get_1value('post','id="'.$id_post.'"','mota');

		$anhdaidien=UPLOAD_URL.$this->page_model->select_table_dk_col_get_1value('post','id="'.$id_post.'"','anhdaidien');

		$blogcontent=$this->page_model->select_table_dk_col_get_1value('post','id="'.$id_post.'"','noidung');



		$blog_seotitle=$this->page_model->select_table_dk_col_get_1value('post','id="'.$id_post.'"','seo_title');

		if($blog_seotitle!=''){

			$blogname=$blog_seotitle;

		}

		if($blogdescription==''){

			$blogdescription=$blogname;	

		}

		if($this->page_model->select_table_dk_col_get_1value('post','id="'.$id_post.'"','keyword')!=''){

			$keyword_website=$this->page_model->select_table_dk_col_get_1value('post','id="'.$id_post.'"','keyword');

		}

	}

?>



<title><?php echo $blogname; ?> | <?php echo $siteurl; ?></title>

<meta name="description" content="<?php echo strip_tags_content($blogdescription); ?>" />

<meta name="keywords" itemprop="keywords" content="<?php echo strip_tags_content($keyword_website); ?>" />

<meta property="og:url"         content="<?php echo base_url($this->uri->uri_string()); ?>" />

<meta property="og:type"        content="<?php echo $type_website; ?>" />

<meta property="og:title"       content="<?php echo strip_tags_content($blogname); ?>" />

<meta property="og:description" content="<?php echo strip_tags_content($blogdescription); ?>" />

<meta property="og:image"       content="<?php echo $anhdaidien; ?>" /> 

