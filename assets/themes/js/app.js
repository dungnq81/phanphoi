!function ($) {
	'use strict';

	$.event.special.touchstart = { setup: function (_, ns, handle) { this.addEventListener('touchstart', handle, { passive: !ns.includes('noPreventDefault') }); } };
	$.event.special.touchmove = { setup: function (_, ns, handle) { this.addEventListener('touchmove', handle, { passive: !ns.includes('noPreventDefault') }); } };
	$(function () {

		$(window).on("load", function () {
			var _action = $.query.get('_action');
			if(_action) {
				pushState({}, document.title, window.location.href.split(/[?#]/)[0]);
			}
		});

		/************************************/

		/*attribute target="_blank" is not W3C compliant*/
		var _blank = $('a._blank, a.blank, a[target="_blank"]');
		_blank.removeAttr('target').attr('target', '_blank');
		$.each(_blank, function (index, item) {
			if (false === $(item)[0].hasAttribute('rel')) {
				$(item).attr('rel', 'noopener noreferrer nofollow');
			}
		});

		/************************************/
		var rating_inner = $(".rating--inner");
		var rating_data = rating_inner.data('id');

		rating_inner.not( $( ".selected" ) ).find('li').on('click', function (e) {
			e.preventDefault();
			rating_inner.find('li').removeClass('active');

			var _target = $(this);
			$(this).addClass('active');

			$.ajax({
				type: 'POST',
				url: BASE_URL + "page/rating",
				data: {
					star: $(this).data('star'),
					post_id: rating_data,
				},
				success: function (data) {
					_target.closest('.rating--inner').find('.votes').html(data);
				}
			});
		});
	});
}(jQuery);

/*! current-device v0.10.2 - https://github.com/matthewhudson/current-device */
!function (n, e) { "object" == typeof exports && "object" == typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define([], e) : "object" == typeof exports ? exports.device = e() : n.device = e() }(window, function () { return function (n) { var e = {}; function o(t) { if (e[t]) return e[t].exports; var r = e[t] = { i: t, l: !1, exports: {} }; return n[t].call(r.exports, r, r.exports, o), r.l = !0, r.exports } return o.m = n, o.c = e, o.d = function (n, e, t) { o.o(n, e) || Object.defineProperty(n, e, { enumerable: !0, get: t }) }, o.r = function (n) { "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(n, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(n, "__esModule", { value: !0 }) }, o.t = function (n, e) { if (1 & e && (n = o(n)), 8 & e) return n; if (4 & e && "object" == typeof n && n && n.__esModule) return n; var t = Object.create(null); if (o.r(t), Object.defineProperty(t, "default", { enumerable: !0, value: n }), 2 & e && "string" != typeof n) for (var r in n) o.d(t, r, function (e) { return n[e] }.bind(null, r)); return t }, o.n = function (n) { var e = n && n.__esModule ? function () { return n.default } : function () { return n }; return o.d(e, "a", e), e }, o.o = function (n, e) { return Object.prototype.hasOwnProperty.call(n, e) }, o.p = "", o(o.s = 0) }([function (n, e, o) { n.exports = o(1) }, function (n, e, o) { "use strict"; o.r(e); var t = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (n) { return typeof n } : function (n) { return n && "function" == typeof Symbol && n.constructor === Symbol && n !== Symbol.prototype ? "symbol" : typeof n }, r = window.device, i = {}, a = []; window.device = i; var c = window.document.documentElement, d = window.navigator.userAgent.toLowerCase(), u = ["googletv", "viera", "smarttv", "internet.tv", "netcast", "nettv", "appletv", "boxee", "kylo", "roku", "dlnadoc", "pov_tv", "hbbtv", "ce-html"]; function l(n, e) { return -1 !== n.indexOf(e) } function s(n) { return l(d, n) } function f(n) { return c.className.match(new RegExp(n, "i")) } function b(n) { var e = null; f(n) || (e = c.className.replace(/^\s+|\s+$/g, ""), c.className = e + " " + n) } function p(n) { f(n) && (c.className = c.className.replace(" " + n, "")) } function w() { i.landscape() ? (p("portrait"), b("landscape"), y("landscape")) : (p("landscape"), b("portrait"), y("portrait")), v() } function y(n) { for (var e = 0; e < a.length; e++)a[e](n) } i.macos = function () { return s("mac") }, i.ios = function () { return i.iphone() || i.ipod() || i.ipad() }, i.iphone = function () { return !i.windows() && s("iphone") }, i.ipod = function () { return s("ipod") }, i.ipad = function () { var n = "MacIntel" === navigator.platform && navigator.maxTouchPoints > 1; return s("ipad") || n }, i.android = function () { return !i.windows() && s("android") }, i.androidPhone = function () { return i.android() && s("mobile") }, i.androidTablet = function () { return i.android() && !s("mobile") }, i.blackberry = function () { return s("blackberry") || s("bb10") }, i.blackberryPhone = function () { return i.blackberry() && !s("tablet") }, i.blackberryTablet = function () { return i.blackberry() && s("tablet") }, i.windows = function () { return s("windows") }, i.windowsPhone = function () { return i.windows() && s("phone") }, i.windowsTablet = function () { return i.windows() && s("touch") && !i.windowsPhone() }, i.fxos = function () { return (s("(mobile") || s("(tablet")) && s(" rv:") }, i.fxosPhone = function () { return i.fxos() && s("mobile") }, i.fxosTablet = function () { return i.fxos() && s("tablet") }, i.meego = function () { return s("meego") }, i.cordova = function () { return window.cordova && "file:" === location.protocol }, i.nodeWebkit = function () { return "object" === t(window.process) }, i.mobile = function () { return i.androidPhone() || i.iphone() || i.ipod() || i.windowsPhone() || i.blackberryPhone() || i.fxosPhone() || i.meego() }, i.tablet = function () { return i.ipad() || i.androidTablet() || i.blackberryTablet() || i.windowsTablet() || i.fxosTablet() }, i.desktop = function () { return !i.tablet() && !i.mobile() }, i.television = function () { for (var n = 0; n < u.length;) { if (s(u[n])) return !0; n++ } return !1 }, i.portrait = function () { return screen.orientation && Object.prototype.hasOwnProperty.call(window, "onorientationchange") ? l(screen.orientation.type, "portrait") : i.ios() && Object.prototype.hasOwnProperty.call(window, "orientation") ? 90 !== Math.abs(window.orientation) : window.innerHeight / window.innerWidth > 1 }, i.landscape = function () { return screen.orientation && Object.prototype.hasOwnProperty.call(window, "onorientationchange") ? l(screen.orientation.type, "landscape") : i.ios() && Object.prototype.hasOwnProperty.call(window, "orientation") ? 90 === Math.abs(window.orientation) : window.innerHeight / window.innerWidth < 1 }, i.noConflict = function () { return window.device = r, this }, i.ios() ? i.ipad() ? b("ios ipad tablet") : i.iphone() ? b("ios iphone mobile") : i.ipod() && b("ios ipod mobile") : i.macos() ? b("macos desktop") : i.android() ? i.androidTablet() ? b("android tablet") : b("android mobile") : i.blackberry() ? i.blackberryTablet() ? b("blackberry tablet") : b("blackberry mobile") : i.windows() ? i.windowsTablet() ? b("windows tablet") : i.windowsPhone() ? b("windows mobile") : b("windows desktop") : i.fxos() ? i.fxosTablet() ? b("fxos tablet") : b("fxos mobile") : i.meego() ? b("meego mobile") : i.nodeWebkit() ? b("node-webkit") : i.television() ? b("television") : i.desktop() && b("desktop"), i.cordova() && b("cordova"), i.onChangeOrientation = function (n) { "function" == typeof n && a.push(n) }; var m = "resize"; function h(n) { for (var e = 0; e < n.length; e++)if (i[n[e]]()) return n[e]; return "unknown" } function v() { i.orientation = h(["portrait", "landscape"]) } Object.prototype.hasOwnProperty.call(window, "onorientationchange") && (m = "orientationchange"), window.addEventListener ? window.addEventListener(m, w, !1) : window.attachEvent ? window.attachEvent(m, w) : window[m] = w, w(), i.type = h(["mobile", "tablet", "desktop"]), i.os = h(["ios", "iphone", "ipad", "ipod", "android", "blackberry", "macos", "windows", "fxos", "meego", "television"]), v(), e.default = i }]).default });
