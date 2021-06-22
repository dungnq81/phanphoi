<div class="chitietdonhang">
<div class="container no-padding post-wrapper">
	<?php $this->load->view('content/template-parts/breadcrumb',$ten_postpr_post);  ?>
	<h2 class="title-post"><?php echo $ten_post; ?></h2>

	<div class="details-post-gr">

		<div class="col-lg-12 col-md-12 col-xs-12 no-padding details-post details-thanhtoan main-page">

			<div class="entry-post list-cart">

				<?php 

					if(isset($_GET['id_donhang'])){

						$infor_donhang=$this->page_model->select_table_dk('donhang','id_donhang','="'.$_GET['id_donhang'].'" ');

						if($infor_donhang){

							$data['infor_donhang']=$infor_donhang;

							$this->load->view('content/template-parts/sanpham/noidung_chitietdonhang',$data);

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
</div>
