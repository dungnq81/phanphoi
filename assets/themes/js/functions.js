/**
 * @param page
 * @param title
 * @param url
 */
function pushState(page, title, url) {
	if ("undefined" !== typeof history.pushState) {
		history.pushState({page: page}, title, url);
	} else {
		window.location.assign(url);
	}
}

/**
 * @param url
 * @param $delay
 */
function redirect(url = null, $delay = 0) {
	setTimeout(function() {
		if (url === null || url === '' || typeof url === "undefined") {
			window.location.reload(true);
		} else {
			url = url.replace(/\s+/g, '');
			window.location = url;
		}
	}, $delay);
}

/**
 *
 * @param str
 * @returns {*}
 */
function escapeRegExp(str) {
	return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
}
