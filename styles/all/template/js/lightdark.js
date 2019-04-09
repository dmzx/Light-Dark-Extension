phpbb.addAjaxCallback('close_lightdark', function(res) {
	'use strict';
	if (res.success) {
		location.reload(true);
	}
});

function fav()
{
	var icon = document.getElementById("favIcon");

	if (icon.classList.contains("fa-sun-o"))
	{
		icon.classList.remove("fa-sun-o");
		icon.classList.add("fa-moon-o");
	}
	else
	{
		icon.classList.remove("fa-moon-o");
		icon.classList.add("fa-sun-o");
	}
}
