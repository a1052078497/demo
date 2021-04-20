$("#kt_content .table").treetable({expandable: true});

// 菜单排序
$('tbody input').change(function () {
    var value = parseInt($(this).val());
    if (! value) {
        value = 0;
    } else if (value > 255) {
        value = 255;
    } else if (value < -255) {
        value = -255;
    }
    $(this).val(value);
    $.post('/menu/' + $(this).closest('tr').attr('key') + '/sort', {sequence: value, _method: 'PUT'}, function (result) {
        swal.msg({text: result.message, icon: 'success', timer: 1500});
    });
});

// 更新文件
function updateFile()
{
    $.post('/menu/file', {_method: 'PUT'}, function (result) {
        swal.msg({text: result.message, icon: 'success', timer: 1500});
    });
}