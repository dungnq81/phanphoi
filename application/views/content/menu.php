<div class="main-menu">
		<?php
			if(empty($url_post)){
				$url_post=base_url();	
			}
			$this->functions->menu($menu,$url_post); 
		?>	
</div>