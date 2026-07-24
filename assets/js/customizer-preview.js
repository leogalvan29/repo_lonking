(function (wp) {
	'use strict';

	if (!wp || !wp.customize) return;

	var map = {
		header_bg_color: '--header-bg',
		header_text_color: '--header-text',
		header_accent_color: '--header-accent',
		header_submenu_bg_color: '--header-submenu-bg',
		header_submenu_text_color: '--header-submenu-text',
	};

	var mapPx = {
		product_title_size: '--product-title-size',
		product_details_title_size: '--product-details-title-size',
	};

	var mapColor = {
		product_title_color: '--product-title-color',
		product_details_title_color: '--product-details-title-color',
	};

	Object.keys(map).forEach(function (settingId) {
		wp.customize(settingId, function (value) {
			value.bind(function (newValue) {
				document.documentElement.style.setProperty(map[settingId], newValue);
			});
		});
	});

	Object.keys(mapColor).forEach(function (settingId) {
		wp.customize(settingId, function (value) {
			value.bind(function (newValue) {
				document.documentElement.style.setProperty(mapColor[settingId], newValue);
			});
		});
	});

	Object.keys(mapPx).forEach(function (settingId) {
		wp.customize(settingId, function (value) {
			value.bind(function (newValue) {
				document.documentElement.style.setProperty(mapPx[settingId], newValue + 'px');
			});
		});
	});
})(window.wp);
