$('#kt_content .form').validate({
    rules: {
        name: {required: true, minlength: 2, maxlength: 20},
        description: {maxlength: 50},
    },
    callback: '/role',
    beforeSubmit: function (semantics) {
        var keys = $('#jstree').jstree('get_checked');
        if (! keys.length) {
            swal.fire({text: '请至少选择一个权限', icon: 'warning'});
            return false;
        } else {
            keys.forEach(function (key) {
                semantics.push({name: 'menu_id[]', value: key});
            });
        }
    }
});
menus.forEach(function (menu) {
    menu.text = menu.is_verify ? '<span class="text-danger">' + menu.name + '</span>' : menu.name;
    menu.parent = menu.parent_id ? menu.parent_id : '#';
    // 编辑时对数据默认选中
    if (typeof selected !== 'undefined' && $.inArray(menu.id, selected) > -1) {
        menu.state = {};
        menu.state.selected = true;
    }
});
var jstree = $('#jstree').jstree({
    plugins: ['wholerow', 'checkbox'],
    core: {
        data: menus,
        themes: {
            icons: false,
            responsive: false,
        },
        expand_selected_onload: true
    },
    checkbox: {
        three_state: false,
        cascade: 'down+undetermined'
    }
});