// 清除左右斜杠
// 使用id作为key生成新的object方便查找
var currentMenu;
var simpleMenus = {};
var locationPathName = window.location.pathname.replace(/(^\/*)|(\/*$)/g, '');
$.each(allMenus, function (key, menu) {
	menu.route = menu.route && menu.route.replace(/(^\/*)|(\/*$)/g, '');
	simpleMenus[menu.id] = menu;
	if (! currentMenu && menu.route) {
		var regex = new RegExp('^' + menu.route.replaceAll('*', '[\\\S\\\s]*?')  + '$', 'ig');
		if (locationPathName.search(regex) > -1) {
			currentMenu = menu;
		}
	}
});
// 逐层寻找对应的菜单选中并展开
while (currentMenu) {
	var currentMenuDom = $('#kt_aside_menu a[href="' + window.location.origin + '/' + currentMenu.route + '"]');
	if (currentMenuDom.length) {
		currentMenuDom.parents('.menu-item,.menu-item-submenu').addClass('menu-item-active menu-item-open');
		currentMenu = false;
	} else {
		currentMenu = simpleMenus[currentMenu.parent_id];
	}
}

// 删除数据
$('.table .destroy').click(function () {
	var This = $(this);
	swal.fire({
		icon: 'question',
		text: '确认删除这条数据？',
		showCancelButton: true
	}).then(function (result) {
		if (result.value) {
			$.post(This.attr('href'), {_method: 'DELETE'}, function (result) {
				swal.fire({text: result.message, icon: 'success'});
				This.closest('tr').remove();
			});	
		}
	});
	return false;
});