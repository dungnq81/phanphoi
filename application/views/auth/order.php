<section class="order-section">
	<div class="container">
		<div class="breadcrump">
			<span><a href="<?php echo site_url()?>" title="Trang chủ"><b>Trang chủ</b></a></span> <i class="fa fa-angle-right"></i>
			<span>Lịch sử mua hàng</span>
		</div>
		<h3 class="heading-title"><?php echo @$title ?></h3>
		<?php
		$query = $this->db->where( 'users_id', $user->id)->get('hd_donhang');
		if ($query->num_rows() < 0) :
			echo '<p>Không có thông tin đơn hàng</p>';
		else :
			$orders = $query->result();
		?>
		<ul class="ord-wp order-wrapper <?=@$class?>">
			<?php
			foreach($orders as $value) :
				$tt_khachhang_ex = explode( '*+++*', $value->tt_khachhang );
				$vl_khachhang_ex = explode( '*+++*', $value->vl_khachhang );
				$id_donhang = $value->id_donhang;
				$ngaytao = $value->ngaytao;
				$type_thanhtoan = $value->type_thanhtoan;
				$email = $vl_khachhang_ex[1];
				$tt_sanpham = $value->tt_sanpham;
				$trangthai = $this->functions->trangthaidonhang( $value->trangthai );

				$tt_sanpham_rs = unserialize( base64_decode( $tt_sanpham ) );
			?>
			<li>
				<div class="title-order">
					<p class="ord"><span>Đơn hàng:</span><span><?=$id_donhang;?></span>, đặt lúc <span> — <?=date('d/m/Y H:i:s', strtotimetz($ngaytao))?></span></p>
					<p class="ord-method"><span>Hình thức mua hàng:</span><span><?=$type_thanhtoan?></span></p>
					<p class="ord-st"><span>Trạng thái đơn hàng:</span><strong><?=$trangthai?></strong></p>
					<?php
					$_ghichu = preg_replace( '/\s+/', '', $value->ghichu );
					if($_ghichu ) : ?>
					<p class="ord-note"><span>Chi tiết:</span><span><?=nl2br($value->ghichu)?></span></p>
					<?php endif;?>
				</div>
				<div class="cus-info tbl-wp">
					<h3>Thông tin khách hàng</h3>
					<table width="100%" class="border">
						<thead>
						<tr>
							<th><span><?=$tt_khachhang_ex[0]?></span></th>
							<th><span><?=$tt_khachhang_ex[1]?></span></th>
							<th><span><?=$tt_khachhang_ex[2]?></span></th>
							<th><span><?=$tt_khachhang_ex[3]?></span></th>
							<th><span><?=$tt_khachhang_ex[4]?></span></th>
							<th><span><?=$tt_khachhang_ex[5]?></span></th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td><span><?=$vl_khachhang_ex[0]?></span></td>
							<td><span><a title="<?=$vl_khachhang_ex[1]?>" href="mailto:<?=$vl_khachhang_ex[1]?>"><?=$vl_khachhang_ex[1]?></a></span></td>
							<td><span><a title="<?=$vl_khachhang_ex[2]?>" href="tel:<?=$vl_khachhang_ex[2]?>"><?=$vl_khachhang_ex[2]?></a></span></td>
							<td><span><?=$vl_khachhang_ex[3]?></span></td>
							<td><span><?=$vl_khachhang_ex[4]?></span></td>
							<td><span><?=$vl_khachhang_ex[5]?></span></td>
						</tr>
						</tbody>
					</table>
				</div>
				<div class="ord-infomation tbl-wp">
					<h3>Thông tin sản phẩm</h3>
					<table width="100%" class="border">
						<thead>
						<tr>
							<th><span>ID</span></th>
							<th><span>Tên sản phẩm</span></th>
							<th><span>Đơn giá</span></th>
							<th><span>Số lượng</span></th>
							<th><span>Thành tiền</span></th>
						</tr>
						</thead>
						<tbody>
						<?php

						//debug_r($tt_sanpham_rs);
						$totals = 0;
						foreach ($tt_sanpham_rs as $cart) :
							$post = $this->db->where('id', $cart['id'])->where('typepost', 'sanpham')->get('hd_post', 1)->row();
							//$product = $this->db->where('id_sanpham', $cart['id'])->get('hd_sanpham', 1)->row();
							$totals = $totals + $cart['subtotal'] * 1000;
						?>
						<tr>
							<td><span style="white-space: nowrap"><?=$cart['id']?></span></td>
							<td>
								<div class="ord-item">
									<?php if (!$post) : ?>
									<p style="color:red;margin-bottom: 0;">Không tồn tại</p>
									<?php else: ?>
										<?php if ( ! $post->anhdaidien) : ?>
										<a target="_blank" href="<?=$post->url?>" title="<?=html_escape($post->ten);?>"><img loading="lazy" src="<?php echo UP_POST_THUMB ?>no_image.jpg" class="img-post-avt" alt="<?=html_escape($post->ten);?>"/></a>
										<?php else : ?>
											<a target="_blank" href="<?=$post->url?>" title="<?=html_escape($post->ten);?>"><img loading="lazy" src="<?php echo THUMBS_URL.$post->anhdaidien; ?>" class="img-post-avt" alt="<?=html_escape($post->ten);?>"/></a>
										<?php endif;?>
									<div class="ord-item-body">
										<p><a title="<?=html_escape($post->ten);?>" target="_blank" href="<?=$post->url?>"><?=$post->ten?></a></p>
									</div>
									<?php endif;?>
								</div>
							</td>
							<td><span style="color:blue"><?=number_format($cart['price'] * 1000)?>đ</span></td>
							<td><span><?=number_format($cart['qty'])?></span></td>
							<td><span style="color:red"><?=number_format($cart['subtotal'] * 1000)?>đ</span></td>
						</tr>
						<?php endforeach;?>
						</tbody>
						<tfoot>
						<tr>
							<td colspan="4"><span>Phí giao hàng: </span></td>
							<td><span style="white-space: nowrap">Phí ship tùy khu vực</span></td>
						</tr>
						<tr>
							<td colspan="4"><strong>Tổng tiền</strong></td>
							<td><strong style="color:red;"><?=number_format($totals)?>đ</strong></td>
						</tr>
						</tfoot>
					</table>
				</div>
			</li>
			<?php endforeach;?>
		</ul>
		<?php endif;?>
	</div>
</section>
