// 设置sweetalert2默认参数
const swal = Swal.mixin({
	allowOutsideClick: false,
    cancelButtonText: '取消',
    confirmButtonText: '确认'
});

/**
 * 使用提示信息
 * 不需要遮罩层和确认按钮
 *
 * @param  object  config
 * @return void
 */
swal.msg = function (config) {
	swal.fire(Object.assign(config, {backdrop: false, showConfirmButton: false}));
}

// 设置ajax默认参数
jQuery.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
	},
	error: function (XMLHttpRequest, textStatus, errorThrown) {
		if (typeof this.beforeError !== 'function' || this.beforeError(XMLHttpRequest, textStatus, errorThrown) !== false) {
			ajaxGeneralError(XMLHttpRequest, textStatus, errorThrown)
		}
	}
});

/**
 * ajax通用错误
 * 
 * @param  object  XMLHttpRequest
 * @param  string  textStatus 	  
 * @param  mixed   errorThrown   
 * @return void
 */
function ajaxGeneralError(XMLHttpRequest, textStatus, errorThrown)
{
	if (XMLHttpRequest.status === 413) {
        swal.fire({text: '上传文件超过服务器限制大小', icon: 'error'});
	} else if (XMLHttpRequest.status === 401) {
        swal.fire({text: XMLHttpRequest.responseJSON.message, icon: 'error'}).then(function () {
        	window.open(window.location.protocol + '//' + window.location.hostname + '/login?back=' + window.location.href);
        });
	} else if (XMLHttpRequest.status === 422 && ! $.isEmptyObject(XMLHttpRequest.responseJSON.errors)) {
		var errors = '';
		// 循环组装提示
		$.each(XMLHttpRequest.responseJSON.errors, function (key, values) {
			$.each(values, function (sonKey, value) {
				errors += '<div>' + value + '</div>';
			});
		});
		swal.fire({html: errors, icon: 'error'});
	} else if (XMLHttpRequest.responseJSON && XMLHttpRequest.responseJSON.message) {
		swal.fire({text: XMLHttpRequest.responseJSON.message, icon: 'error'});
	} else {
		swal.fire({text: '异常错误', icon: 'error'});
	}
};

// 点击上传按钮或输入框时触发文件选择
$('.choice-file-box .choice-file-puppet').click(function () {
    $(this).closest('.choice-file-box').find('.choice-file-control').click();
});

// 选择文件后变化输入框内容提示
$('.choice-file-box .choice-file-control').change(function (event) {
    var files = $(this)[0].files;
    var input = $(this).closest('.choice-file-box').find('.choice-file-input');
    if (files.length === 1 && ! input.data('old-value')) {
    	input.data('old-value', input.val());
    }
    var text = files.length > 1 ? '已选择' + files.length + '个文件' : (files.length ? $(this).val() : input.data('old-value'));
    input.val(text) && typeof input.valid == 'function' && input.valid();
});

// 获得get参数
$.getUrlParam = function (name) {
    var regex = new RegExp('(^|&)' + name + '=([^&]*)(&|$)');
    var result = window.location.search.substr(1).match(regex);
    return result != null ? unescape(result[2]) : null;
}