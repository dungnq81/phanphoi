!function ($) {
	'use strict';

	$(function () {
		var ajax_login = $(".ajax-login");
		ajax_login.on("submit", function(e) {
			var $this = $(this);
			e.preventDefault();

			var button_text = hd.LOGIN_BTN;
			var button_text_loading = '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>';
			$.ajax({
				type: 'POST',
				url: BASE_URL + "users/ajax_login",
				data: $this.serializeArray(),
				beforeSend: function() {
					$this.find(':submit').prop('disabled', true).html(button_text_loading);
				},
				success: function(data) {
					var infoMessage = $("#infoMessage");
					$this.find(':submit').prop('disabled', false).html(button_text);
					var json = JSON.parse(data);
					infoMessage.html(json.message);
					if ( json.status === 'success' ) {
						redirect(null, 1000);
					}
				}
			});
		})
	});
}(jQuery);
