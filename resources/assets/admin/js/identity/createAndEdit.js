$('#kt_content .form').validate({
    rules: {
        name: {required: true, minlength: 2, maxlength: 10},
        description: {maxlength: 50},
    },
    callback: '/identity',
    beforeSubmit: function (semantics) {
        var keys = $('#jstree').jstree('get_checked');
        if (! keys.length) {
            swal.fire({text: '请选择默认菜单', icon: 'warning'});
            return false;
        } else if (! $('input[name="role_id[]"]').length) {
            swal.fire({text: '请至少选择一个角色', icon: 'warning'});
            return false;
        } else {
            semantics.push({name: 'menu_id', value: keys[0]});
        }
    }
});
var treeData = [];
menus.forEach(function (menu) {
    menu.text = menu.is_verify ? '<span class="text-danger">' + menu.name + '</span>' : menu.name;
    menu.parent = menu.parent_id ? menu.parent_id : '#';
    menu.state = {};
    // 没有路由的不能选中
    // 编辑时对数据默认选中
    if (! menu.route) {
        menu.state.checkbox_disabled = true;
    } else if (typeof selected !== 'undefined' && menu.id == selected) {
        menu.state.selected = true;
    }
    // 不展示有路由但是非get请求的菜单
    if (! menu.method || menu.method == method.GET) {
        treeData.push(menu);
    }
});
var jstree = $('#jstree').jstree({
    plugins: ['wholerow', 'checkbox'],
    core: {
        data: treeData,
        themes: {
            icons: false,
            responsive: false,
        },
        multiple: false,
        expand_selected_onload: true
    },
    checkbox: {
        three_state: false
    }
});