<div class="container no-padding post-wrapper">
	<h2 class="title-post"><?php echo $ten_post; ?></h2>
	<div class="details-post-gr">
		<div class="col-lg-12 col-md-12 col-xs-12 no-padding details-post details-thanhtoan main-page">
			<?php $this->load->view('content/template-parts/breadcrumb',$ten_postpr_post);  ?>
			<div class="entry-post list-cart">
				<?php 
					if(isset($_GET['id_tragop'])){
						$infor_donhang=$this->page_model->select_table_dk('tragop','id_tragop','="'.$_GET['id_tragop'].'" ');
						if($infor_donhang){
							$data['infor_donhang']=$infor_donhang;
							$this->load->view('content/template-parts/sanpham/noidung_chitiettragop',$data);
						}else{
							header('location:' . base_url());	
						}
					}else{
						header('location:' . base_url());
					}
				?>	
			</div>
		</div>		
	</div>
</div>