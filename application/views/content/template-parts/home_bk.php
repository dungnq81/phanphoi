<?php $blogname=$this->page_model->select_table_dk_col_get_1value('option','name="blogname"','value'); ?>
<div class="no-padding post-wrapper" id="content-home">
	<h1 hidden=""><?php echo $blogname; ?></h1>		
	<div class="fullwidth no-padding">
		<div class="details-post-gr">
			<div class="col-lg-12 col-md-12 col-xs-12 no-padding">
				<?php 
					$infor_home=$this->page_model->select_table_dk_col_get('post','typepost="config" and ten="home_config"','noidung');
					$infor_home=json_decode($infor_home[0]->noidung);

					$dmsp_arr_cs =[];

					foreach ($infor_home as $item) {
					    $dmsp_arr_cs[] = $item->name;
					}
					

					// $dmsp_arr=array_column($infor_home,'name');
					$count_dmsp=count(array_keys($dmsp_arr_cs,'danhmucsanpham_home'))+1;
					if($infor_home){
						$dem=0;
						foreach($infor_home as $value){
							$name=$this->xulychuoi->replace_name_form($value->name);
							$value=$value->value;
							$get_name_wg=explode('_home_',$name);
							$name_wg=$get_name_wg[0];
							
							$id_wg=$name.'_'.$dem;
							if($name_wg=='slider' and $value!=0){?>
								<div class="home-content" id="<?php echo $id_wg; ?>">
									<div class="col-lg-12 col-sm-12 col-xs-12 no-padding">
										<?php
											$data['slider_cat']=$value;
											$this->load->view('content/template-parts/slider',$data);
										?>
									</div>
								</div>
							<?php }
							else if($name_wg=='cat' and $value!=0){?>
								<div class="home-content" id="<?php echo $name; ?>">
									<?php 
										$data['id_wg']=$value;
										$this->load->view('content/widgets/chuyenmucs1',$data);
									?>
								</div>
							<?php }
							/*else if($name_wg=='wgcat' and $value!=0){?>
								<div class="home-content" id="<?php echo $name; ?>">
									<?php 
										$data['id_wg']=$value;
										$this->load->view('content/widgets/chuyenmucs4',$data); 
									?>
								</div>
							<?php }*/
							else if($name_wg=='cats2' and $value!=0){?>
								<div class="home-content" id="<?php echo $name; ?>">
									<?php 
										$data['id_wg']=$value;
										$this->load->view('content/widgets/postcat',$data);
									?>
								</div>
							<?php }
							else if($name_wg=='sp_by_danhmucsanpham' and $value!=0){
								$title_wg=$this->page_model->select_table_dk_col_get_1value('post','id='.$value.' ','ten');
								?>
								<div class="home-content sp_by_danhmucsanpham" id="<?php echo $id_wg; ?>">
									<div class="col-lg-12 col-md-12 col-xs-12 no-padding">
										<div class="container no-padding">
											<?php
												$url_danhmuc=$this->page_model->select_table_dk_col_get_1value('post','id="'.$value.'"','url');
												$id_related=$this->page_model->select_table_dk_col_get_1value('post','id="'.$value.'"','id_related');
												// $img_cover_link=$this->page_model->select_table_dk_col_get_1value('post','id="'.$value.'"','anhdaidien');
												// $href_img_cover_link=$this->page_model->select_table_dk_col_get_1value('post','id="'.$value.'"','link_anhdaidien');
												// if($img_cover_link){
												// 	if($href_img_cover_link){
												// 		echo '<a href="'.$href_img_cover_link.'" title="'.$title_wg.'" target="_blank"><img loading="lazy" src="'.UPLOAD_URL.$img_cover_link.'" alt="'.$title_wg.'" class="img-cover-dmsp"></a>';
												// 	}else{
												// 		echo '<img loading="lazy" src="'.UPLOAD_URL.$img_cover_link.'" alt="'.$title_wg.'" class="img-cover-dmsp">';
												// 	}
												// }
											?>
											<div class="title-wg-home">

												<p class="titleboxheading-home"><?php echo $title_wg; ?></p>
												<a class="pull-right view-more-dm" href="<?php echo URL.$url_danhmuc; ?>">Xem thêm <i class="fa fa-angle-right"></i></a>
												<?php 
													if($id_related){
														$id_related_loop = explode(",", $id_related);
														echo '<ul class="list-dmsp-related-home hidden-xs hidden-sm">';
															foreach ($id_related_loop as $related_dmsp) {
																$related_dmsp_url=$this->page_model->select_table_dk_col_get_1value('post','id="'.$related_dmsp.'"','url');
																$related_dmsp_name=$this->page_model->select_table_dk_col_get_1value('post','id="'.$related_dmsp.'"','ten');
																echo '<li><i class="fa fa-caret-right"></i> <a href="'.$related_dmsp_url.'" title="'.$related_dmsp_name.'" target="_blank">'.$related_dmsp_name.'</a></li>';
															}		
														echo '</ul>';
													}
												?>
											</div>
											<div class="list-sp-dmsp-home">
												<?php
													$data['id_dmsp']=$value;
													$this->load->view('content/template-parts/sanpham/wg_sp_by_dmsp',$data);
												?>
											</div>
										</div>
									</div>	
								</div>
								<?php } else if($name_wg=='page' and $value!=0){ ?>
									<div class="home-content" id="<?php echo $id_wg; ?>">
										<?php 
											$data['id_wg']=$value;
											$this->load->view('content/widgets/'.$name_wg,$data); 
										?>
									</div>
								<?php }else if($name_wg=='danhmucsanpham_home' and $value!=0){
										if($dem==2){
											echo '<div class="home-content danhmucsanpham_home" id="'.$id_wg.'">
													<div class="col-lg-12 col-md-12 col-xs-12 no-padding">
														<div class="container no-padding">
															<div class="title-wg-home">
																<p class="titleboxheading-home">Danh mục sản phẩm</p>
															</div>
															<div class="list-dmsp-home no-padding">';
																$data['id_dmsp']=$value;
																$this->load->view('content/widgets/dmsp-home',$data); 
										}else if($dem>2 && $dem<$count_dmsp){
											$data['id_dmsp']=$value;
											$this->load->view('content/widgets/dmsp-home',$data); 
										} else if($dem==$count_dmsp){
											$data['id_dmsp']=$value;
											$this->load->view('content/widgets/dmsp-home',$data); 
											echo '</div></div></div></div>';
										}
				
									?>		
								<?php } else if($name_wg=='form' and $value==1){?>
								<div class="home-content" id="<?php echo $id_wg; ?>">
										<?php $this->load->view('content/widgets/'.$name_wg,$data); ?>
									</div>
								<?php } else if($name_wg=='video' and $value!=''){ ?>
									<div class="home-content" id="<?php echo $id_wg; ?>">
										<?php 
											$data['list_video']=$value;
											$this->load->view('content/widgets/'.$name_wg,$data); 
										?>
									</div>
								<?php }
								$dem++;
							} 
					} ?>
			</div>
		</div>
	</div>
</div>	
