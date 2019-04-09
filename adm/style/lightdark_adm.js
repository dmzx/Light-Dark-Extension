(function ($) {
	'use strict';
	$('input[name=lightdark_enable]').on('click init_toggle', function () {
		$('.lightdark_toggle').toggle($('#lightdark_enable').prop('id="lightdark_enable" checked="checked"'));
	}).trigger('init_toggle');
})(jQuery);
