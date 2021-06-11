<?php 
	$logo=$this->page_model->select_value_table_dk_col('option','name','="logo"','value');
	$menu=$this->page_model->select_table_dk_col_get('post','typepost="menu" and trangthai=1 order by ngaycapnhat DESC','id,ten,url,menu_link,idpostpr,anhdaidien,mota');
	$facebook_link=$this->page_model->select_value_table_dk_col('option','name','="facebook"','value');
	$twister_link=$this->page_model->select_value_table_dk_col('option','name','="twister"','value');
	$fanpage_link=$this->page_model->select_value_table_dk_col('option','name','="fanpage"','value');
	$instagram_link=$this->page_model->select_value_table_dk_col('option','name','="instagram"','value');
	$share_bv=$this->page_model->select_value_table_dk_col('option','name','="share_bv"','value');
	$phantrang=$this->page_model->select_value_table_dk_col('option','name','="phantrang"','value');
	$menu_top=$this->page_model->select_table_dk_col_get_1value('post','id=1290','noidung');
	$blogname=$this->page_model->select_table_dk_col_get_1value('option','name="blogname"','value');
	$blogdescription=$this->page_model->select_table_dk_col_get_1value('option','name="blogdescription"','value');
	$bando=$this->page_model->select_table_dk_col_get_1value('option','name="bando"','value');
	$data['logo']=$logo;
	$data['menu']=$menu;
	$data['facebook_link']=$facebook_link;
	$data['twister_link']=$twister_link;
	$data['fanpage_link']=$fanpage_link;
	$data['instagram_link']=$instagram_link;
	$data['share_bv']=$share_bv;
	$data['phantrang']=$phantrang;
	$data['menu_top']=$menu_top;
	$data['blogname']=$blogname;
	$data['blogdescription']=$blogdescription;
	$data['bando']=$bando;
	$this->load->view('content/head',$data); 
?>
<body class="content-site">
	<?php 
		// echo $slug;
		$this->load->view('content/header',$data);
		if($slug=='home'){?>
			<?php 
				if(isset($_GET['s'])){
					$search_value=$_GET['s'];
					$search_id_postpr=$_GET['id_postpr'];
					$data['search_value']=$search_value; 
					$data['search_id_postpr']=$search_id_postpr;
					?>
					<div class="content-page-details" id="content-page">
						<div class="main-content">
							<div class="content-details" id="page-search">								
							<?php $this->load->view('content/search',$data); ?>
							</div>
						</div>
					</div>
				<?php }else{ 
					$this->load->view('content/template-parts/'.$slug);
				}
		}else{?>
				<div class="content-page-details" id="content-page">
					<div class="main-content">
						<div class="content-details" id="page-id-<?php echo $id_post; ?>">						
						<?php 								
							$data_slider['slider_cat']=$id_slider;	
							if($id_slider!=0){								
								$this->load->view('content/template-parts/slider',$data_slider);	
							} 					
						?>
						<?php $this->load->view('content/template-parts/'.$slug);?>
						</div>
					</div>
				</div>
		<?php }
	?>
	<?php $this->load->view('content/footer', $data);?>
</body>
</html>
