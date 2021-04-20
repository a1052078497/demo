// 修改提示信息
var icon = '<i class="fa fa-times-circle"></i> ';
$.extend($.validator.messages, {
	required: icon + '不能为空',
    remote: icon + '请修正此栏位',
    email: icon + '请输入有效的电子邮件',
    url: icon + '请输入有效的网址',
    date: icon + '请输入有效的日期',
    dateISO: icon + '请输入有效的日期 (YYYY-MM-DD)',
    number: icon + '请输入正确的数字',
    digits: icon + '请输入正确的整数',
    creditcard: icon + '请输入有效的信用卡号码',
    equalTo: icon + '你的输入不相同',
    extension: icon + '请输入有效的后缀',
    maxlength: icon + '最多 {0} 个字符',
    minlength: icon + '最少 {0} 个字符',
    rangelength: icon + '请输入长度为 {0} 至 {1} 之间的字符',
    range: icon + '请输入 {0} 至 {1} 之间的数值',
    max: icon + '请输入不大于 {0} 的数值',
    min: icon + '请输入不小于 {0} 的数值'
});
// 设置validate默认配置
$.validator.setDefaults({
    ignore: false,
	highlight: function (e) {
		var appendTo = $(e).data('errorAppendTo');
		$(e).addClass('is-invalid').removeClass('is-valid').closest(appendTo ? appendTo : 'div').removeClass('has-success').addClass('has-danger');
	},
	success: function (e, r) {
		var appendTo = $(r).data('errorAppendTo');
		$(r).removeClass('is-invalid').addClass('is-valid').closest(appendTo ? appendTo : 'div').removeClass('has-danger').addClass('has-success');
	},
	errorElement: 'div',
	errorPlacement: function (error, element) {
		var appendTo = element.data('errorAppendTo');
		error.appendTo(appendTo ? element.closest(appendTo) : element.parent());
	},
	errorClass: 'help-block',
	submitHandler: function (form) {
		var beforeSubmit = this.settings.beforeSubmit;
		var callback = this.settings.callback;
		var beforeError = this.settings.beforeError;
		$(form).ajaxSubmit({
			aynsc: false,
			beforeSubmit: beforeSubmit,
			beforeSend: function () {
        		swal.fire({
        			text: '请求中...',
        			didOpen: function() {
			            swal.showLoading();
			        }
        		});
			},
			beforeError: beforeError,
			success: typeof callback === 'function' ? callback : function (result) {
				swal.fire({
					icon: 'success',
					text: result.message,
				}).then(function () {
					if (callback) {
						location.href = callback;
					} else {
						location.reload();
					}
				});
			}
		});
	}
});

// 添加文件最大验证规则
$.validator.addMethod('maxSize', function (value, element, param) {
 	return this.optional(element) || element.files[0].size / 1000 <= param;
}, icon + '请上传大小在{0}kb以下的文件');

/**
 * 插入错误图标
 * 
 * @param  object  data
 * @return object
 */
function insertErrorIcon(data)
{
	$.each(data, function (key, value) {
		if (typeof value === 'object') {
			$.each(value, function (sonKey, sonValue) {
				data[key][sonKey] = icon + sonValue;
			});
		} else {
			data[key] = icon + value;
		}
	});
	return data;
}