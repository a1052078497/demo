$('#kt_content .form').validate({
    rules: {
        name: {required: true, minlength: 2, maxlength: 10},
        route: {maxlength: 50},
        icon: 'required'
    },
    callback: '/menu',
    beforeSubmit: function () {
        if (! $('input[name=parent_id]').length) {
            swal.fire({text: '请选择所属上级', icon: 'warning'});
            return false;
        }
    }
});
menus.forEach(function (menu) {
    menu.text = menu.name;
    menu.parent = menu.parent_id ? menu.parent_id : '#';
    // 对数据默认选中
    if (typeof selected !== 'undefined' && menu.id == selected) {
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
        multiple: false,
        expand_selected_onload: true
    },
    checkbox: {
        three_state: false
    }
});

// 菜单路由和请求方式共存
$('input[name=route],select[name=method]').change(function () {
    if ($(this).val()) {
        $('input[name=route]').rules('add', 'required');
        $('select[name=method]').rules('add', 'required');
        $('input[name=route],select[name=method]').closest('.form-group').find('.text-danger').removeClass('d-none');
    } else {
        $('input[name=route]').rules('remove', 'required');
        $('select[name=method]').rules('remove', 'required');
        $('input[name=route],select[name=method]').closest('.form-group').find('.text-danger').addClass('d-none');
    }
});

// 绑定改变事件
$('#jstree').on('changed.jstree', function (event, data) {
    $('input[name=parent_id]').remove();
    if (data.selected.length) {
        $('#kt_content .form').append('<input type="hidden" name="parent_id" value="' + data.selected[0] + '">')
    }
    toggleIcon();
});

// 选择是否显示
$('input[name=is_show]').change(toggleIcon);

/**
 * 切换图标显示隐藏
 *
 * @return void
 */
function toggleIcon()
{
    var show = $('input[name=is_show]:checked').val() === '1' ? true : false;
    var parent = $('input[name=parent_id]').val() === '0' ? true : false;
    if (show && parent) {
        $('input[name=icon]').closest('.form-group').removeClass('d-none');
        $('input[name=icon]').rules('add', 'required');
    } else {
        $('input[name=icon]').closest('.form-group').addClass('d-none');
        $('input[name=icon]').rules('remove', 'required');
    }
}

// 选择图标
$('input[name=icon]').click(function () {
    $('#iconModal').modal();
});

// 选中图标
$('.modal .text-muted').click(function () {
    $('input[name=icon]').val($(this).html());
    $('#iconModal').modal('hide');
});

// 主动触发事件
$('input[name=route],select[name=method],input[name=is_show]:checked').trigger('change');