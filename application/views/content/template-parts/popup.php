<?php

$popup_url = $this->page_model->select_table_dk_col_get_1value( 'option', 'name="popup"', 'value' );
$popup_number = $this->page_model->select_table_dk_col_get_1value( 'option', 'name="popup_number"', 'value' );
$popup_delay = $this->page_model->select_table_dk_col_get_1value( 'option', 'name="popup_delay"', 'value' );
$popup_a = $this->page_model->select_table_dk_col_get_1value( 'option', 'name="popup_url"', 'value' );

$popup_delay = $popup_delay * 1000;
if ( ! isset( $_SESSION['popup'] ) || $_SESSION['popup'] < $popup_number ) :
	if ( ! isset( $_SESSION['popup'] ) ) :
		$_SESSION['popup'] = 1;
	else :
		$_SESSION['popup'] = $_SESSION['popup'] + 1;
	endif;

	if ( $popup_url ) :
?>
<div class="reveal" id="myModal" data-reveal data-close-on-click="true" data-show-delay="3" data-animation-in="fade-in" data-animation-out="fade-out">
    <span class="img--wrap" rel="nofollow">
		<?php if (empty($popup_a)) : ?>
		<img loading="lazy" src="<?php echo $popup_url;?>" alt="" />
		<?php else : ?>
		<a aria-label="Popup" target="_blank" href="<?php echo $popup_a; ?>"><img loading="lazy" src="<?php echo $popup_url;?>" alt="" /></a>
		<?php endif; ?>
	</span>
	<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/motion-ui@1.2.3/dist/motion-ui.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.6.3/js/foundation.min.js"></script>
<script>(function ($) {
        var o = $('#myModal');
        if (o.length > 0) {
            $(document).ready(function () {
                $.wait = function (ms) {
                    var defer = $.Deferred();
                    setTimeout(function () {
                    	defer.resolve();
					}, ms);
                    return defer;
                };
                var w = <?php echo $popup_delay?>;
                $.wait(w).then(_reveal);
            });
        }

		/**
		 * @private
		 */
		function _reveal() {
            var popup = new Foundation.Reveal(
					o, {
						closeOnClick: false,
						closeOnEsc:   false
					});
            popup.open();
        }
    })(jQuery);
</script>
<?php endif; endif;
