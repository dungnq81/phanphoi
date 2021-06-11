<?php if($share_bv=='Bật'){?>	<ul class="shareThis">

		<li>

			<p>Chia sẻ bài viết<a class="addthis_button"><i class="fa fa-share-alt"></i></a></p>

			<ul class="share_mxh">

				<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo URL_POST.$url_post; ?>" title="Share Facebook"><i class="fab fa-facebook-f"></i> Facebook</a></li>

				<li><a href="https://twitter.com/home?status=<?php echo URL_POST.$url_post; ?>"><i class="fab fa-twitter" title="Share Twitter"></i> Twitter</a></li>

				<li><a href="https://www.linkedin.com/shareArticle?url=<?php echo URL_POST.$url_post; ?>"><i class="fab fa-linkedin" title="Share Linkedin"></i> Linkedin</a></li>

				<li><a href="https://pinterest.com/pin/create/button/?url=&media=<?php echo URL_POST.$url_post; ?>"><i class="fab fa-pinterest" title="Share Pinterest"></i> Pinterest</a></li>

				<li><a href="https://plus.google.com/share?url=<?php echo URL_POST.$url_post; ?>"><i class="fas fa-envelope" title="Share Gmail"></i> Gmail</a></li>

			</ul>

		</li>

	</ul><?php } ?>
